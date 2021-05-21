
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


  <script type='text/javascript'>


function PrintElem(elem)
{
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    //mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body >');
   // mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}



</script>



    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


<style>

  #printlab {
    position: relative;
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
    vertical-align: middle;
    border-width:1px;
    display: inline-block;
    border-style: solid;
    padding:5px;
  }
  
  #casetxt{
  	
	font-size:18px;
  }


</style>








<?php


    
require('db.php');


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


$casenum = $_POST['case'];

$caseclean = clean_data($casenum, "text");


$sql="
    select casenumber, brand,(case when Chargeable = 1 then 'chargeable' else 'non-chargable' end) as charg, SerialNumber, RCCollectionDate from[Case]  where casetype like 'Repair Centre' and CaseNumber = ".$caseclean."

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

<div id=printlab> 

<table>

<Tr>
<td  align='center' id='casetxt' style='font-size:24px;'><Strong>Case :</Strong>  <b>".$data['casenumber']."</b> </td>
</tr>
<Tr>
<td align='center'><Strong> ".$data['charg']." </Strong></td>
</tr>
<Tr>
<td align='center'><Strong> ".$data['brand']." </Strong></td>
</tr>
<Tr>
<td align='center'><Strong>Serial Number :</Strong>  <b>".$data['SerialNumber']." </b></td>
</tr>

</table>



</div>


";





?>



<button class="btn btn-success" onclick="PrintElem('printlab')" id="printbtn"> Print </button>
</body>
</html>