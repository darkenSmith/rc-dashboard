<?php

// Check if live server or Development PC
if (php_uname("n") == 'STO-WRK-022' ||  php_uname("n") == 'STO-LAP-094') {
  // Developer
  $sqlHost    = 'sqlsrv:Server=MPLDB\MPLDB;';
  $db         = 'Database=stone';
  $user       = 'coldfusion';
  $pw         = 'icicle';

  $green_sqlHost  = "sqlsrv:Server=greenoak;";
  $green_db       = "Database=we3recycler";
  $green_user     = "sqlro";
  $green_pwd      = "reports";

} else {
  // Live
  $sqlHost    = 'sqlsrv:Server=MPLDB\MPLDB;';
  $db         = 'Database=stone';
  $user       = 'coldfusion';
  $pw         = 'icicle';

  $green_sqlHost  = "sqlsrv:Server=greenoak;";
  $green_db       = "Database=we3recycler";
  $green_user     = "sqlro";
  $green_pwd      = "reports";

} 

// Connect to DB
$conn   = new PDO( $sqlHost.$db,$user,$pw );
$conn2  = new PDO( $green_sqlHost.$green_db,$green_user,$green_pwd );

// Errors
if( $conn === false ) {

}



