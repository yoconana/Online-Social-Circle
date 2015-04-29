<html>

<style type="text/css">

	#menu ul {
    height: auto;
    padding: 8px 0px;
    margin: 0px;
	text-align:center;
	}
	
	#menu li { 
	display: inline; 
	padding: 20px; 
	text-align:center;
	}

	#menu a {
    text-decoration: none;
    color: black;
    padding: 8px 8px 8px 8px;}
	
	#menu a:hover {
    color: #F90;
    background-color: #FFF;
	}
	
	#header {
    background-color:#003366;
    color:white;
    text-align:center;
    padding: 8px 8px 8px 8px;
	
	}
	
	
</style>

<body>

<div id="menu">
<ul>
<li><a href="publicactivity.php">Home</a></li>
<li><a href="userinfo.php">Profile</a></li>
</ul>
</div>

<div id="header">
<h1>Social Activity Website</h1>
</div>

<?php

session_start();
if($_GET['action'] == "logout"){
    unset($_SESSION['USERNAME']);
	unset($_SESSION['USERID']);
    unset($_SESSION['EMAILADDR']);
    echo 'Log out Succeed! Please click here to <a href="login.php">Log in</a>';
    exit;
}

if(!isset($_POST['submit'])){
    exit('Illegal Access Not Permitted!');
}
$emailaddress = $_POST['email'];
$password = $_POST['password'];
	include('conn.php');

$user_query = mysql_query("SELECT * from USERS where EMAILADDR='$emailaddress' AND USERPASSWORD='$password' LIMIT 1");

if($result = mysql_fetch_array($user_query)){
	$_SESSION['USERNAME'] = $result['USERNAME'];
    $_SESSION['USERID'] = $result['USERID'];
	$_SESSION['EMAILADDR'] = $result['EMAILADDR'];
	$tempuser = $result['USERNAME'];
	
	echo 'Welcome, '.$tempuser.'! You can go to our <a href="publicactivity.php">Public Page</a>';
	exit;
}
else{
	echo 'Log in Failed!';
	echo 'Click here <a href="javascript:history.back(-1);">Return</a> to try again';
	exit;
}

?>

</body>

</html>