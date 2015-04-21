<?php
session_start();

if($_SESSION['authuser'] != 1){
	echo 'Sorry, you cannot see this page!';
	exit();
}

?>

<html>
 <head>
 <title>Session Test 2</title>
 </head>
 <body>
 <?php
  echo 'Welcome to our site.';
  echo $_SESSION['username'];
  echo '! <br/>';
  echo 'Val pasted from Session 1 is: ';
  echo $_GET['testse'];
  
  ?>
  </body>
  </html>