<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main Menu</title>


 <style> 


#gui  {

        background-color:darkblue;
        width:50%;
        padding-bottom:4em;
        margin-left:500px;
        margin-top:300px;
        border-style:solid;
        
    }

    
#gui  h1 {

color:white;
padding-bottom:10px;

}


#gui  #Guimenu tr button{

padding:0.5em;

}


#gui  #Guimenu .first td{
    padding-bottom: 1em;


}


#gui  #Guimenu{
    margin-left:20px;


}

#framin{
background-color:black;


}




</style>



</head>
<body>


   


<script type="text/javascript">

$(document).ready(function(){

var subname = 'Welcome';


$('#smalltitle small').html(subname);

  




     


    $('#btn-group1').hide();
    $('#btn-group2').hide();
    $('#btn-group3').hide();
    $('#btn-group4').hide();
    $('#btn-group5').hide();
    $('#btn-group6').hide();

    $('#acase').click(function(){


        subname = 'Label';


$('#smalltitle small').html(subname);


        $("#framin").attr("src","labeldisplay.php");

         



    $('#btn-group1').hide();
    $('#btn-group2').hide();
    $('#btn-group3').hide();
    $('#btn-group4').hide();
    $('#btn-group5').hide();
    $('#btn-group6').hide();


    });

        $('#assign').click(function(){


                   subname = 'Assign a Case';


$('#smalltitle small').html(subname);

$("#framin").attr("src","assigntecch.php");



    $('#btn-group1').hide();
    $('#btn-group2').hide();
    $('#btn-group3').hide();
    $('#btn-group4').hide();
    $('#btn-group5').hide();
    $('#btn-group6').hide();


});


$('#jobsheet').click(function(){


subname = 'Assign a Case';


$('#smalltitle small').html(subname);

$("#framin").attr("src","jobprintdisplay.php");



$('#btn-group1').hide();
$('#btn-group2').hide();
$('#btn-group3').hide();
$('#btn-group4').hide();
$('#btn-group5').hide();
$('#btn-group6').hide();


});


        $('#pickedpar').click(function(){

                   subname = 'Picked Parts';


$('#smalltitle small').html(subname);

$("#framin").attr("src","PickedParts.php");


    $('#btn-group1').hide();
    $('#btn-group2').hide();
    $('#btn-group3').hide();
    $('#btn-group4').hide();
    $('#btn-group5').hide();
    $('#btn-group6').show();


});


        $('#awpay').click(function(){


                   subname = 'Awaiting Payments';


$('#smalltitle small').html(subname);

$("#framin").attr("src","Awaitingpayments.php");


    $('#btn-group1').hide();
    $('#btn-group2').show();
    $('#btn-group3').hide();
    $('#btn-group4').hide();
    $('#btn-group5').hide();
    $('#btn-group6').hide();


});


        $('#rtnbtn').click(function(){


                   subname = 'Awaiting Returns';


$('#smalltitle small').html(subname);

$("#framin").attr("src","awaitingreturn.php");


    $('#btn-group1').show();
    $('#btn-group2').hide();
    $('#btn-group3').hide();
    $('#btn-group4').hide();
    $('#btn-group5').hide();
    $('#btn-group6').hide();


});



  $('#awpart').click(function(){

subname = 'Awaiting Parts';


$('#smalltitle small').html(subname);

$("#framin").attr("src","awaitingparts.php");


$('#btn-group1').hide();
$('#btn-group2').hide();
$('#btn-group3').show();
$('#btn-group4').hide();
$('#btn-group5').hide();
$('#btn-group6').hide();

});


  $('#awrep').click(function(){

subname = 'Awaiting Repairs';


$('#smalltitle small').html(subname);

$("#framin").attr("src","awwaitingrepairs.php");


$('#btn-group1').hide();
$('#btn-group2').hide();
$('#btn-group3').hide();
$('#btn-group4').show();
$('#btn-group5').hide();
$('#btn-group6').hide();


});



  $('#awdispatch').click(function(){

subname = 'Awaiting Dispatch';


$('#smalltitle small').html(subname);

$("#framin").attr("src","awaitingdispatch.php");


$('#btn-group1').hide();
$('#btn-group2').hide();
$('#btn-group3').hide();
$('#btn-group4').hide();
$('#btn-group5').show();
$('#btn-group6').hide();


});


        $('#full').click(function(){

        window.open('awaitingreturn.php');




});





        $('#charge').click(function(){
            $("#framin").attr("src","awaitingreturn.php?ischarge=1");
               

        });


                $('#nonchage').click(function(){
            $("#framin").attr("src","awaitingreturn.php?ischarge=0");
               

        });





                $('#full2').click(function(){

window.open('Awaitingpayments.php');




});


$('#charge2').click(function(){
    $("#framin").attr("src","Awaitingpayments.php?ischarge=1");
       

});


        $('#nonchage2').click(function(){
    $("#framin").attr("src","Awaitingpayments.php?ischarge=0");
       

        });



                            $('#full3').click(function(){

window.open('awaitingparts.php');




});


$('#charge3').click(function(){
    $("#framin").attr("src","awaitingparts.php?ischarge=1");
       

});


        $('#nonchage3').click(function(){
    $("#framin").attr("src","awaitingparts.php?ischarge=0");
       

        });


                                    $('#full4').click(function(){

window.open('awwaitingrepairs.php');




});


$('#charge4').click(function(){
    $("#framin").attr("src","awwaitingrepairs.php?ischarge=1");
       

});


        $('#nonchage4').click(function(){
    $("#framin").attr("src","awwaitingrepairs.php?ischarge=0");
       

        });






                                    $('#full5').click(function(){

window.open('awaitingdispatch.php');




});


$('#charge5').click(function(){
    $("#framin").attr("src","awaitingdispatch.php?ischarge=1");
       

});


        $('#nonchage5').click(function(){
    $("#framin").attr("src","awaitingdispatch.php?ischarge=0");
       

        });


        $('#full6').click(function(){

window.open('PickedParts.php');




});


$('#charge6').click(function(){
    $("#framin").attr("src","PickedParts.php?ischarge=1");
       

});


        $('#nonchage6').click(function(){
    $("#framin").attr("src","PickedParts.php?ischarge=0");
       

        });





});











</script>





<div id="gui">
<div id='header'>
<h1 id='smalltitle' align="center"> Main-Menu <small class="text-muted">{{ message }}</small></h1>
<hr>
</div>


<br/>

<div class="row">

<div class="col-sm-5">

<table id="Guimenu" align="center" cellspacing="3" cellpadding="7" width="90%"> 
<tr class="first">
<td> <button class="btn btn-primary" id="assign"> Assign a case </button></td>
<td> <button class="btn btn-primary" id="acase"> Print case Label </button></td>

</tr>
<tr class="first">
<td><button class="btn btn-primary" id="jobsheet">  print Job-Sheet </button></td>
<td><button class="btn btn-primary" id="rtnbtn">  Awaiting Return </button></td>
</tr>
<tr class="first">
<td><button class="btn btn-primary"id="awpay">  Awaiting Payment </button></td>
<td><button class="btn btn-primary" id="awpart">  Awaiting Parts </button></td>
</tr>
<tr class="first">
<td><button class="btn btn-primary" id="pickedpar">  Parts Picked </button></td>
<td><button class="btn btn-primary" id="awdispatch">  Awaiting Despatch </button></td>
</tr>
<tr class="first">
<td> <button class="btn btn-primary" id="awrep">  Awaiting Repairs </button> </td>
<td><button class="btn btn-primary" onclick="window.open('dashdisplay.php')">  Open dashboard </button></td>
</tr>


</table>
</div>

<div class="col-sm-7">

<iframe id="framin"  width="490" height="300" src=""></iframe><br/>
<div class="btn-group" id='btn-group1'role="group" aria-label="Basic example">
<button class="btn btn-secondary" id="full"> full screen </button>
<button class="btn btn-info" id="charge"> Chargable </button>
<button class="btn btn-info" id="nonchage"> Non-Chargable </button>
</div>

<div class="btn-group" id='btn-group2'role="group" aria-label="Basic example">
<button class="btn btn-secondary" id="full2"> full screen </button>
<button class="btn btn-info" id="charge2"> Chargable </button>
<button class="btn btn-info" id="nonchage2"> Non-Chargable </button>
</div>


<div class="btn-group" id='btn-group3'role="group" aria-label="Basic example">
<button class="btn btn-secondary" id="full3"> full screen </button>
<button class="btn btn-info" id="charge3"> Chargable </button>
<button class="btn btn-info" id="nonchage3"> Non-Chargable </button>
</div>


<div class="btn-group" id='btn-group4'role="group" aria-label="Basic example">
<button class="btn btn-secondary" id="full4"> full screen </button>
<button class="btn btn-info" id="charge4"> Chargable </button>
<button class="btn btn-info" id="nonchage4"> Non-Chargable </button>
</div>



<div class="btn-group" id='btn-group5'role="group" aria-label="Basic example">
<button class="btn btn-secondary" id="full5"> full screen </button>
<button class="btn btn-info" id="charge5"> Chargable </button>
<button class="btn btn-info" id="nonchage5"> Non-Chargable </button>
</div>




<div class="btn-group" id='btn-group6'role="group" aria-label="Basic example">
<button class="btn btn-secondary" id="full6"> full screen </button>
<button class="btn btn-info" id="charge6"> Chargable </button>
<button class="btn btn-info" id="nonchage6"> Non-Chargable </button>
</div>

</div>
</div>




</div>



    
</body>
</html>