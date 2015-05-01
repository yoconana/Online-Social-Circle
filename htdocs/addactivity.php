<?php
// Start the session
session_start();

if(!isset($_SESSION['USERID'])){
    header("Location:login.php");
    exit();
}

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
<h1>Social Activity Website</h1>
</div>


<fieldset>
	<legend>Activity Created </legend>

<?php

include('conn.php');
$tempuserid = $_SESSION['USERID'];
 $radio_value=$_POST['ifpublic'];
	if($radio_value=="yes")	
	{
$queryString="INSERT INTO ACTIVITIES (ACTIVITYTITLE,ACTIVITYDESCRIPTION,ACTIVITYLOCATION,ACTIVITYTIME,IFPUBLIC) 
VALUES ('$_POST[ActivityTitle]', '$_POST[ActivityDescrption]','$_POST[ActivityLocation]','$_POST[ActivityTime]',1)";
$query_result = mysql_query($queryString,$db);

}

else
{
	$queryString="INSERT INTO ACTIVITIES (ACTIVITYTITLE,ACTIVITYDESCRIPTION,ACTIVITYLOCATION,ACTIVITYTIME,IFPUBLIC) 
	VALUES ('$_POST[ActivityTitle]', '$_POST[ActivityDescrption]','$_POST[ActivityLocation]','$_POST[ActivityTime]',0)";
	$query_result = mysql_query($queryString,$db);
	
}



?>
</p>
<h2>
<a href="userinfo.php"> view your Activities </a>
</h2>
</p>
</fieldset>
</body>
</html>
