<html>



<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
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
	.button {
    margin-bottom:0px;
}

html *
{
   font-family: Century Gothic, sans-serif;
}
	
	
</style>
</head>

<body>

<div id="menu">
<ul>
<li><a href="publicactivity.php">Home</a></li>
<li><a href="login.php">Login</a></li>
</ul>
</div>

<div id="header">
<h1>Online Social Circle</h1>
</div>

<div>
<?php

if(!isset($_POST['submit'])){
	exit('Illegal Access Not Permitted!');
}
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$birthdate = $_POST['birthdate'];
$photono = $_POST['profilepic'];

include 'connection.php';
	$myDbOperation = new DatabaseOperation();
	$result = $myDbOperation->UserRegiser($username,$password,$email,$gender,$birthdate,$photono);
	if($result == 0){
		echo 'Error ! ',$email,' already exists.<a href="javascript:history.back(-1);">Return</a>';
		exit;
	}
	else if($result == 1){
		exit('Register Succeed! Click here to <a href="login.php">Log In</a>');
	}
	else{
		echo 'Register Failed!<br />';
		echo 'Click here <a href="javascript:history.back(-1);">Return</a> to try again';
		exit;
	}
?>
</div>

</body>
</html>