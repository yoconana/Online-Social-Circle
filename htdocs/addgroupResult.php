<?php
// Start the session
session_start();

if(!isset($_SESSION['USERID'])){
    header("Location:login.php");
    exit();
}

$personalUserId = $_SESSION['USERID'];
$groupTitle = $_POST['grouptitle'];
$groupDescription = $_POST['groupdescription'];

?>
<html>
<style type="text/css">
    html{font-size:16px;}
	
    fieldset{width:800px; margin: 0 auto;}
	
    legend{font-weight:bold; font-size:24px; text-align:center;}
	
    label{float:left; width:140px; margin-left:10px;}
    .left{margin-left:150px;}
    .input{width:150px;}
	
    span{color: #666666;} 
	
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
}
</style>

	
</head>
<body>
<div id="menu">
<ul>
<li><a href="publicactivity.php">Home</a></li>
<li><a href="userinfo.php">Profile</a></li>
</ul>
</div>

<div id="header">
<h1>Online Social Circle</h1>
</div>

<div id="right">
<fieldset>
	<legend>Group Created </legend>

<?php

	include('conn.php');
	$queryString= "INSERT INTO GROUPS (GROUPTITLE,CREATETIME,GROUPDESCRIPTION) 
		VALUES ('$groupTitle',NOW(), '$groupDescription')";
	if(mysql_query($queryString,$db)){
		$generatedGroupid =mysql_insert_id();
		$queryString = "INSERT INTO USERCONNECTGROUP (USERID , GROUPID , IFMEMBER,IFINVITED ,IFADMIN,IFAPPLYING ) 
					 VALUES ($personalUserId ,$generatedGroupid, 0 ,0 ,1,0 )";
		if(mysql_query($queryString,$db)){
			echo 'Add Succeed! Please view <a href="yourgrouplist.php">your groups </a>';
		}
		else{
			echo 'Add Failed! Please <a href="addgroup.php">go back</a> to try again.';
		}
	}
	else{
		echo 'Add Failed! Please <a href="addgroup.php">go back</a> to try again.';
	}
	
	
	//mysql_free_result($query_result);
	mysql_close($db);

?>

</fieldset>
</div>
</body>
</html>
