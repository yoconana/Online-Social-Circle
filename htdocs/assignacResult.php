<?php
// Start the session
session_start();

if(!isset($_SESSION['USERID'])){
    header("Location:login.php");
    exit();
}

$personalUserId = $_SESSION['USERID'];
$activityId = $_POST['activityid'];

if(!empty($_POST['groupid_list'])){

}
else{
	header("Location:assignactogroup.php");
	exit();
}
?>

<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<style>
legend{font-weight:bold; font-size:24px;}

table{
	width: 100%;    
    background-color: #f1f1c1;
	
}

#header {
    background-color:#003366;
    color:white;
    text-align:center;
    padding:5px;
}
#nav {
    line-height:30px;
    background-color:#eeeeee;
    width:15%;
    float:left;	      
}

#right {
	float:right;
	width:85%;
}

#mainpart {
	padding:10px;
}
#section {
    width:60% ;
    float:left;
	HEIGHT :150 ;
    padding:10px;
	 	 
}
#scrolldown {
 height:100x;
 width:auto;
 border:1px solid #ccc;
 font:16px/26px Georgia, Garamond, Serif;
 overflow:auto;
	 	 
}

#footer {
    background-color:#003366;
    color:white;
    clear:both;
    text-align:center;
    padding: 5px;
	
	bottom: 0;
	
	
	height: 25px;
}
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
    padding: 8px 8px 8px 8px;
}

#menu a:hover {
    color: #F90;
    background-color: #FFF;
}

#navmenu ul {
    height: auto;
    padding:0px;
    margin: 0px;
text-align:center;
 list-style-type: none;
}
#navmenu li { 
padding: 0px; 
text-align:center;

}

#navmenu a {
    text-decoration: none;
    color: black;
    padding: 8px 8px 8px 8px;

}

#menu a:hover {
    color: #F90;
    background-color: #FFF;
}

</style>
</head>
<body>
<div id="menu">
<ul>
<li><a href="publicactivity.php">Home</a></li>
<li><a href="logout.php">Log out</a></li>

</div>

<div id="header">
<h1>Social Activity Website</h1>
</div>

<?php
	include('conn.php');
	foreach($_POST['groupid_list'] as $assigngroupid){
		$queryString = "SELECT *
		FROM ACTIVITYASSIGNEDTOGROUP
		WHERE GROUPID = $assigngroupid AND ACTIVITYID = $activityId";
		$query_result = mysql_query($queryString,$db);
		if(mysql_num_rows($query_result) > 0){
			
		}
		else{
			$queryString = "INSERT INTO ACTIVITYASSIGNEDTOGROUP
			VALUES($activityId,$assigngroupid)";
			if(mysql_query($queryString,$db)){
				
			}
			else{
				echo 'Assign Failed! Please <a href="activitydetails.php?activityid='.$activityId.'">go back</a> to try again';
				mysql_free_result($query_result);
				mysql_close($db);
				exit;
			}
		}
	}
	mysql_free_result($query_result);
	mysql_close($db);
	echo 'Assign Succeed! Please go back to your <a href="activitydetails.php?activityid='.$activityId.'">activity page</a>.';
?>
</body>
</html>