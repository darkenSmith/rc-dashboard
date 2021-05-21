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
    <?php




    require('db.php');

   

    if(isset($_GET['ischarge'])){
   
            $ischarge = $_GET['ischarge'];
       
    }else{

        $ischarge = '';
    }

    $sql = " 
    select 
    max(c.CaseNumber) casenum,
     max(isnull(Engineer, 'Not Set')) engineer, 
     max(J.JobStatus) jobstatus ,
     MAX(j.JobNumber) JobNumber,
     max(c.ProductType)  ProductType,
     max(CallerName)  CallerName, 
     max(Brand)  Brand, 
     max(CallerPhone) CallerPhone, 
       max(cast(ContactName as varchar(30))) ContactName, 
     max(cast(ContactEmail as varchar(30))) ContactEmail, 
     max(ContactMobile) ContactMobile, 
     max(CaseStatus) CaseStatus, 
     max(cast(C.Chargeable as int)) Chargeable,
     max(j.SerialNumber) SerialNumber, 
     max(c.CreatedDate) CreatedDate, 
     max(Deadline) deadline, 
          max(REPLACE(REPLACE(cast(j.JobDescription as varchar(max)), char(10), ''), char(13), '') ) jobdesc ,
    max(DBO.GetBusinessDaysDifference(ch.ActionDate, Deadline))  as sla
      from [case] as c with(nolock)
      left join Job as j with(nolock) on
      j.CaseNumber  = c.CaseNumber
      join CaseHistory ch with(nolock) on 
      ch.CaseNumber = c.CaseNumber
   
     
    where CaseStatus like 'Awaiting Dispatch' and  CaseType like 'Repair Centre' --and Engineer is not null--- awaiting repair non charge
    ---and JobStatus not like 'closed' and JobStatus not like 'Un-scheduled'
    and Summary like '%parts picked to awaiting dispatch%' and j.JobStatus not like 'Un-scheduled%' 
   
   
    group by c.casenumber, j.JobNumber
     ";
    if($ischarge !== ''){

                    $sql.= "and C.Chargeable =".$ischarge;


    }
    
    


    $stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "\nPDO::errorInfo():\n";
    print_r($conn->errorInfo());
    die();
}



$stmt->execute();
$data = $stmt->fetchall(PDO::FETCH_ASSOC);








echo "       
 <table class='table table table-hover '>
 <thead>
<tr>
    
<th>CaseNumber </th>

<th> Engineer </th>

<th> Job Status </th>

<th> Job Number</th>

<th>ProductType </th>

<th> diff </th>

<th> CallerName </th>

<th> Chargeable </th>

<th> Brand </th>

<th> Job Desc</th>

<th> CallerPhone </th>

<th> ContactName </th>

<th> ContactEmail </th>

<th> ContactMobile </th>

<th> CaseStatus </th>

<th> SerialNumber </th>

<th> CreatedDate </th>

<th> Deadline Date</th>

<th> </th>
</tr>

</thead>
<tbody>";

foreach($data as $row){


echo "

    <tr>
    <td> ".$row['casenum']." </td>
    <td> ".$row['engineer']." </td>
    <td> ".$row['jobstatus']." </td>
    <tD>".$row['JobNumber']."</tD>
    <tD>".$row['ProductType']."</tD>
    <td>".$row['sla']."</td>
    <td> ".$row['CallerName']." </td>
    <td> ".$row['Chargeable']." </td>
    <td> ".$row['Brand']."</td>
    <td> <textarea rows='4' cols='50'>".$row['jobdesc']."</textarea> </td>
    <td> ".$row['CallerPhone']." </td>
    <td> ".$row['ContactName']." </td>
    <td> ".$row['ContactEmail']." </td>
    <td> ".$row['ContactMobile']." </td>
    <td> ".$row['CaseStatus']." </td>
    <td> ".$row['SerialNumber']." </td>
    <td> ".$row['CreatedDate']." </td>
    <td>".$row['deadline']."</td>

    </tr>";

}

echo "      </tbody>  </table>"

    ?>
</body>
</html>