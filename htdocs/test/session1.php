<?php
session_start();
$_SESSION['username'] = 'YangTian';
$_SESSION['authuser'] = 1;
?>
<html>
<head>
 <title>Session Test</title>
 </head>
 <body>
 <?php
  $mytestse = urlencode('Session of My Test');
  echo "<a href=\"session2.php?testse=$mytestse\">";
  echo 'Click here to see more';
  echo '</a>';
  ?>
  </body>
  </html>