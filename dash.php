
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">



    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

<style>

th {
   padding:10px;
   font-size:1.5em;
   color:white;
   padding-bottom:10px;


}

thead{

       background-color:darkblue;
       font-family: "Arial Black", Gadget, sans-serif
}

td{

      font-size:2em;
      color:lightgreen;
}


#container{

   margin: auto;
    width: 50%;
 
    padding: 10px;


}

body{

    background-color:black;
}

#header{

 background-color:black;
 width:100%;
 height:10%;


}

#data{

   margin-top:200px;


}

#footer{


    margin-top:21em;
    margin-left:3em;
}



</style>



<div id='header'>

<img src='stone_ic.png' width='150px'/>


</div>
    


<div id="container" align='center'>
<div class="row">


<div id='data'>

<?php

echo date('l jS \of F Y h:i:s A');


include('db.php');


$sqltech = "
declare @startdate datetime
declare @endate datetime


set @startdate = getdate()
set @endate = getdate()


select  

 --ch.CaseNumber, 
 count(CaseSkill) as total,
 CaseSkill

  from CaseHistory as ch 
 join [case] as c with(nolock) on
c.CaseNumber = ch.CaseNumber

where ch.Summary like '%to awaiting dispatch' and DATEADD(dd, DATEDIFF(dd, 0, ch.actiondate), 0) between  DATEADD(dd, DATEDIFF(dd, 0, @startdate), 0) and DATEADD(dd, DATEDIFF(dd, 0, @endate), 0)  and CaseType like 'Repair Centre'  and Action like 'Status Change'
group by  CaseSkill

";


$stmt2 = $conn->prepare($sqltech);
if (!$stmt2) {
    echo "\nPDO::errorInfo():\n";
    print_r($conn->errorInfo());
    die();
}
$stmt2->execute();
$data2 = $stmt2->fetchall(PDO::FETCH_ASSOC);

$sql = "

set nocount on

declare @t table(

    [Awaiting Inspection] int, 
    [booked-in Today] int, 
    [inspect qty] int,
    pending int,
    [awaiting_war qty] int,
    [awaiting_chr qty] int,
    [todays Dispatch qty] int 

)


insert into @t


select

    (

        select COUNT(*) from [case]
       
        
        where CaseType like 'Repair Centre' and CaseStatus like 'Awaiting inspection%'--Summary LIKE '%Inspected%'  --- cases made today
      
        ),
      
        (
      
  select count(*) from CaseHistory as ch
join [case] as c with(nolock) on
c.CaseNumber = ch.CaseNumber
 where ActionDate >= CAST(GETDATE() AS DATE) and  Summary like '%Case Status changed from Awaiting Return to Awaiting Inspection%'
and CaseType like 'Repair Centre'

      
        ),



  ( select count(*) from CaseHistory as ch
join [case] as c with(nolock) on
c.CaseNumber = ch.CaseNumber
 where ActionDate >= CAST(GETDATE() AS DATE) and  Summary like '% Awaiting Inspection to%'
and CaseType like 'Repair Centre' and Action = 'Status Change'),



   (select count(*) from CaseHistory as ch
join [case] as c with(nolock) on
c.CaseNumber = ch.CaseNumber
 where ActionDate >= CAST(GETDATE() AS DATE) and  Summary like '% to Pending%'
and CaseType like 'Repair Centre'  and Action like 'Status Change'), 




     (select COUNT(*) from [case]

  
 where CaseStatus like 'Awaiting Repair'  and Chargeable = 0 and  CaseType like 'Repair Centre'),



     ( select COUNT(*) from [Case] 

  
 where CaseStatus like 'Awaiting Repair'  and Chargeable = 1  and  CaseType like 'Repair Centre'),




     (select count(*) from CaseHistory as ch
join [case] as c with(nolock) on
c.CaseNumber = ch.CaseNumber
 where ActionDate >= CAST(GETDATE() AS DATE) and  Summary like '%Dispatch to Resolved%'
and CaseType like 'Repair Centre'  and Action like 'Case Resolved')


 select * from @t";


 $stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "\nPDO::errorInfo():\n";
    print_r($conn->errorInfo());
    die();
}
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);



echo "

<table class='table'>
<thead>
<tr>
<th scope='col'> Awaiting Inspection</th>
<th scope='col'> booked-in Today</th>
<th scope='col'> Inspections</th>
<th scope='col'> Pending</th>

<th scope='col'> Awaiting <br/> with <br/> warranty  </th>
<th scope='col'>  Awaiting <br/>with <br/> Charge  </th>
<th scope='col'>Today's dispatches </th>
</tr>
</thead>
<tbody>
<tr>
<td align='center'><strong> ".$data['Awaiting Inspection']."</strong> </td>
<td align='center'><strong> ".$data['booked-in Today']."</strong> </td>
<td align='center'> <strong>".$data['inspect qty']." </strong></td>
<td align='center'> <strong>".$data['pending']." </strong></td>
<td align='center'><strong> ".$data['awaiting_war qty']."</strong> </td>
<td align='center'> <strong>".$data['awaiting_chr qty']." </strong></td>
<td align='center'> <strong>".$data['todays Dispatch qty']." </strong></td>
</tr>

</tbody>
</table>
<br>

";


echo "
<table class='table'>
<tr>
";

foreach($data2 as $tec){
    echo "
    <th scope='col'> ".$tec['CaseSkill']."</th>
    ";
}
echo "</tr><tr>";

foreach($data2 as $tec2){
echo "<td >".$tec2['total']."</td>";

}

echo "</tr></table>"


?>
</div>
</div>
</div>

<div id="footer">
<button type='inupt' class="btn btn-primary"  onclick="window.location.href='index.php'">  < Menu </button>

</div>


</body>

</html>