<?php
// Start the session
session_start();
if(!isset($_SESSION['USERID'])){
    header("Location:login.php");
    exit();
}
$personalUserId = $_SESSION['USERID'];
$ActivityTitle=$_POST['ActivityTitle'];
$ActivityDescrption= $_POST['ActivityDescrption'];
$ActivityLocation=$_POST['ActivityLocation'];
$ActivityTime=$_POST['ActivityTime'];
 $radio_value=$_POST['ifpublic'];
if($radio_value=="yes")	
		{ $x=1; }
	else 
		{$x=0;}

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
<li><a href="userinfo.php">Profile</a></li>
</ul>
</div>

<div id="header">
<h1>Online Social Circle</h1>
</div>


<fieldset>
	<legend>Activity Created </legend>

<?php
include('conn.php');

$queryString="INSERT INTO ACTIVITIES (ACTIVITYTITLE,ACTIVITYDESCRIPTION,ACTIVITYLOCATION,ACTIVITYTIME,IFPUBLIC) 
VALUES ('$ActivityTitle', '$ActivityDescrption','$ActivityLocation','$ActivityTime',$x)";
if(mysql_query($queryString,$db))
{
		$generatedActivityid =mysql_insert_id();
		$queryString = "INSERT INTO USERCONNECTACTIVITY (USERID ,ACTIVITYID , IFATTEND,IFINVITED ,IFCREATOR ,IFAPPLYING ) 
					 VALUES ($personalUserId ,$generatedActivityid, 0 ,0 ,1,0 )";
		if(mysql_query($queryString,$db)){
			echo 'Add Succeed! Please view <a href="userinfo.php">your Activities </a>';
		}
		else{
			echo 'Add Failed! Please <a href="addactivity.php">go back</a> to try again.';
		}
	}
	else{
		echo 'Add Failed! Please <a href="addactivity.php">go back</a> to try again.';
	}
	
	
	//mysql_free_result($query_result);
	mysql_close($db);

?>


</fieldset>
</body>
</html>
