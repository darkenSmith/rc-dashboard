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

    $sql = " select CaseNumber, ProductType, Engineer, AccountCode, CallerName, case when Chargeable = 1 then 'Yes' else 'No' end as Chargeable, Brand, CallerPhone, ContactName, ContactEmail, ContactMobile, CaseStatus, SerialNumber from [case] with(nolock)
    where CaseStatus like 'Awaiting Repair' ";
    if($ischarge !== ''){

                    $sql.= "and Chargeable =".$ischarge;


    }
    
    
    
  $sql.= "and  CaseType like 'Repair Centre'";


    $stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "\nPDO::errorInfo():\n";
    print_r($conn->errorInfo());
    die();
}



$stmt->execute();
$data = $stmt->fetchall(PDO::FETCH_ASSOC);








echo "       
 <table class='table table-striped'>
 <thead>
<tr>
    
<th>CaseNumber </th>

<th>ProductType </th>

<th>AccountCode </th>

<th> Engineer </th>

<th> CallerName </th>

<th> Chargeable </th>

<th> Brand </th>

<th> CallerPhone </th>

<th> ContactName </th>

<th> ContactEmail </th>

<th> ContactMobile </th>

<th> CaseStatus </th>

<th> SerialNumber </th>
</tr>

</thead>
<tbody>";

foreach($data as $row){


echo "

    <tr>
    <td> ".$row['CaseNumber']." </td>
    <td> ".$row['ProductType']." </td>
    <td> ".$row['AccountCode']." </td>
    <td> ".$row['Engineer']." </td>
    <td> ".$row['CallerName']." </td>
    <td> ".$row['Chargeable']." </td>
    <td> ".$row['Brand']." </td>
    <td> ".$row['CallerPhone']." </td>
    <td> ".$row['ContactName']." </td>
    <td> ".$row['ContactEmail']." </td>
    <td> ".$row['ContactMobile']." </td>
    <td> ".$row['CaseStatus']." </td>
    <td> ".$row['SerialNumber']." </td>

    </tr>
   






";

}

echo "      </tbody>  </table>"

    ?>
</body>
</html>