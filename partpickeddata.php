
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

$jobnum = $_POST['jobnum'];

function clean_data($value,$type) {
    if ($type == "text") {
                    $value = preg_replace("/[^a-zA-Z0-9\-\_\ go]/","",$value);
    }
    if ($type == "email") {
                    $value = preg_replace("/[^a-zA-Z0-9\-\.\@]/","",$value);
    }
    if ($type == "date") {
                    $value = preg_replace("/[^a-zA-Z0-9\-\.\@\\\/]/","",$value);
    }
    if ($type == "password") {
                    $value = preg_replace("/[\'\"\;]/","",$value);      
    }
    if ($type == "number") {
                    $value = preg_replace("/![0-9]/","",$value);        
    } 
    if ($type == "array") {
                    $value = preg_replace("/[^a-zA-Z0-9\,]/","",$value);                        
    }              
    if ($type == "mac") {
                    $value = preg_replace("/[^a-zA-Z0-9\,\:]/","",$value);                     
    }              
    return $value;
}

$cleanjobnum = clean_data($jobnum, "text");


$sql = "

select j.JobNumber as jobnum, c.CaseNumber as casenum, p.Name as name, j.SerialNumber as serialnumber, REPLACE(REPLACE(cast(j.JobDescription as varchar(max)), char(10), ''), char(13), '') jobdesc ,
REPLACE(REPLACE(cast(p.Description as varchar(max)), char(10), ''), char(13), '') [Part-desc] 
from [Case] as c with(nolock)
join Job as j on
c.CaseNumber = j.CaseNumber
join PartsRequired as p with(nolock) on
p.jobref = j.JobNumber
where CaseType like 'repair centre' and CaseStatus like 'parts picked'
and j.JobNumber like '".$cleanjobnum."'

";


$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "\nPDO::errorInfo():\n";
    print_r($conn->errorInfo());
    die();
}
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);





echo "

<table class='table table-dark'> 
<tr>
<th> Job Number </th>
<th> Case Number </th>
<th> Part </th>
<th> Serial Number </th>
<th> Job Description </th>
<th> Part Description </th>
</tr>
<tr> 
<td> ".$data['jobnum']." </td>
<td> ".$data['casenum']." </td>
<td> ".$data['name']." </td>
<td> ".$data['serialnumber']." </td>
<td> <textarea>".$data['jobdesc']."</textarea> </td>
<td><textarea> ".$data['Part-desc']." </textarea></td>
</tr>

</table>


";

?>


</body>
</html>