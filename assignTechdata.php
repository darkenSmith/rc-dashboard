
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
    <title>Document</title>

        <style>

    


</style>

</head>
<body>

<div id="container">



<?php


require('db.php');

$case = $_POST['case'];
$engineer = $_POST['engineer'];



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



$cas = clean_data($case, "text");
$techn = clean_data($techn, "text");

if($engineer == '' && $case == ''){


    echo "<p>Please fill in all feild before submiting.</p>";
}elseif($engineer == ''){


    echo "<p>Sorry you havent entered a engineer name.</p>";
}elseif($case == ''){

    echo "<p>sorry case number empty</p>";
    
    }

    else{

$sql = "  update [Case]
set Engineer = '".$techn."'
where CaseNumber = ".$cas."
and casetype like 'Repair Centre' and casestatus like 'Awaiting Repair' ";


$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "\nPDO::errorInfo():\n";
    print_r($conn->errorInfo());
    die();
}
$stmt->execute();


echo "

<P> The engineer <strong>".$techn."</strong> has been assigned to case number:".$cas."</p>


";








    }




?>

</div>

</body>
</html>