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

    padding:5px;
    margin-top:2em;
}


#container p{

color:lightgrey;
}


</style>


<div id="container">

<form  action="assignTechdata.php"  method='POST'>
<div class="form-group">
<label for="casenum">Case Number</label><input type='text' class="form-control" id="casenum" name='case' >
<label for="casenum">Engineer</label><input type='text' class="form-control" id="engi" name='engineer' >

</div>
<button type="submit" class="btn btn-success"> OK </button><hr>
<p class="h6"> <strong>You can only Assign cases that are 'awaiting repair'</strong> </P>
</form>




</div>


    
</body>
</html>