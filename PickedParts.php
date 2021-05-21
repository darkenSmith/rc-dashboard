<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>



<body>

<style>



#container{

    padding:1em;
}

</style>

<script>

$(document).ready(function(){

     $('#ptdata tbody tr').each(function(){  

        ///  alert($(this).find('#sla').html());

        


          if($(this).find('#sla').html() > 5){


               $(this).css('background-color', 'red');
               $(this).css('color', 'white');


          }else{

          $(this).css('background-color', 'lightblue');
          }


     });

$('#search').keyup(function(){  
                search_table($(this).val());  
           });  
           function search_table(value){  
                $('#ptdata tbody tr').each(function(){  
                     var found = 'false';  
                     $(this).each(function(){  
                          if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)  
                          {  
                               found = 'true';  
                          }  
                     });  
                     if(found == 'true')  
                     {  
                          $(this).show();  
                     }  
                     else  
                     {  
                          $(this).hide();  
                     }  
                });  
           }  

});
  


</script>

<div id="container">



<div align="center">  <label> <h2><strong>Search</strong></h2></label> 
                     <input type="text" name="search" id="search" class="form-control" />  
                </div>
                </br>




    <?php




    require('db.php');

   

    if(isset($_GET['ischarge'])){
   
            $ischarge = $_GET['ischarge'];
       
    }else{

        $ischarge = '';
    }

    $sql = " 
    set nocount on

    declare @t table(
    
    jobcreatedate datetime,
    deadline datetime,
    sla int,
    jobnum int,
    casenum int,
    Casetype varchar(20),
    part varchar(20),
    serial varchar(50),
    charge int,
    jobdesc varchar(max),
    partdesc varchar(max)
    
    
    )
    
    
    insert into @t
    
    
    
    select 
    max(j.CreatedDate) as Job_createDate,
         max(c.Deadline),
         DBO.GetBusinessDaysDifference(max(ch.ActionDate), GETDATE())  as SLA,
          max(j.JobNumber) jobnum,
           c.CaseNumber as casenum,
            max(CaseType) as ct, 
            max(p.Name) as name, 
            max(j.SerialNumber) as serial,
            max(cast(c.Chargeable as int)) chg,
             max(REPLACE(REPLACE(cast(j.JobDescription as varchar(max)), char(10), ''), char(13), '')) jobdesc ,
        max(REPLACE(REPLACE(cast(p.Description as varchar(max)), char(10), ''), char(13), '')) [Part-desc] 
        from [Case] as c with(nolock)
        join Job as j on
        c.CaseNumber = j.CaseNumber and 
        c.AccountCode = j.AccountCode
        join CaseHistory as ch with(nolock) on
        ch.CaseNumber = c.CaseNumber
        join PartsRequired as p with(nolock) on
        p.jobref = j.JobNumber
        where ( CaseType like 'repair centre' and CaseStatus like 'parts picked')
        and c.CaseNumber not like '00%' and Summary like '%Awaiting return to awaiting inspection%' and ch.ActionDate not in (select HolidayDate from Holidays) and 
        j.JobStatus not like 'cancelled' and j.JobStatus not like 'Un-scheduled'
   	group by c.CaseNumber, j.JobId
        --order by j.ModifiedDate desc
    
    
        select 
        
        jobcreatedate as CreatedDate ,
    deadline ,
    (case when charge = 1 then sla - (select DBO.GetBusinessDaysDifference(max(ActionDate), (select max(actiondate) from casehistory as cc where cc.CaseNumber = casenum and Summary like '%awaiting payment to awaiting part%'  and cc.ActionDate not in (select HolidayDate from Holidays))) from  CaseHistory as ch where ch.CaseNumber = casenum 
    and Summary like '%awaiting inspection to awaiting quote%' and ch.ActionDate not in (select HolidayDate from Holidays)) else sla end) as sla,
    jobnum  ,
    casenum ,
    Casetype as ct ,
    part as name,
    serial as serial,
    charge as  chg,
    jobdesc,
    partdesc as [Part-desc] 
        
         from @t ";
    if($ischarge !== ''){

                    $sql.= "and charge =".$ischarge;


    }

    $sql.= "order by CreatedDate ASC";
    
    


    $stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "\nPDO::errorInfo():\n";
    print_r($conn->errorInfo());
    die();
}



$stmt->execute();
$data = $stmt->fetchall(PDO::FETCH_ASSOC);








echo "       
 <table class='table table-striped' id='ptdata'>
 <thead>
<tr>
    
<th>JOB Create date  </th>

<th> Job Number </th>

<th> Case Number </th>

<th> SLA </th>

<th> Serial Number </th>

<th> CaseTyp </th>

<th> Part Name </th>

<th> Charge </th>

<th> Job Desc </th>

<th> Part Desc </th>

</tr>

</thead>
<tbody>";

foreach($data as $row){

     
     $sla = $row['sla'];

     if(!isset($sla)){

          $sla = 'Awaiting Payment or Quote';
     }


echo "

    <tr>
    <td> ".$row['CreatedDate']." </td>
    <td> ".$row['jobnum']." </td>
    <td> ".$row['casenum']." </td>
    <td id='sla'> ".$sla." </td>
    <td> ".$row['serial']." </td>
    <td> ".$row['ct']." </td>
    <td> ".$row['name']." </td>
    <td> ".$row['chg']." </td>
    <td> <textarea rows='4' cols='50'>".$row['jobdesc']."</textarea> </td>
    <td> ".$row['Part-desc']." </td>


    </tr>
   






";

}

echo "      </tbody>  </table>

</br>"

    ?>
<div id="footer">
<button type='inupt' class="btn btn-primary"  onclick="window.location.href='index.php'">  < Menu </button>

</div>

</div>


</body>
</html>