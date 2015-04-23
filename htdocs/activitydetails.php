<?php
// Start the session
session_start();

if(!isset($_SESSION['USERID'])){
    header("Location:login.html");
    exit();
	
	
}

$activityid = $_POST['activityid'];

?>


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
    
    float:left;
    padding:5px;	      
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



<html>

<body>

<div id="menu">
<ul>
<li><a href="publicactivity.php">Home</a></li>
<li><a href="userinfo.php">Profile</a></li>
<li><a href="logout.php">Log out</a></li>

</div>

<div id="header">
<h1>Social Activity Website</h1>
</div>

<div id="nav">
<div id=¡°navmenu">
<ul>
<li><a href="userinfo.php">Profile</a></li>
<li><a href="friendslist.php">Friends</a></li>
<li><a href="search.php">Search</a></li>
</ul>
</div> 
</div>

<fieldset>

<?php
include('conn.php');
	
$tempuserid = $_SESSION['USERID'];

$queryString = "SELECT *
	FROM ACTIVITIES,USERCONNECTACTIVITY
	WHERE ACTIVITIES.ACTIVITYID = USERCONNECTACTIVITY.ACTIVITYID
	AND ACTIVITIES.ACTIVITYID = $activityid
	AND USERCONNECTACTIVITY.USERID = $tempuserid";
	$query_result = mysql_query($queryString,$db);
	$comletelyNewmember = 0;
	if(mysql_num_rows($query_result) > 0){
		$comletelyNewmember = 1;
	}
	else{
		$queryString = "SELECT *
		FROM ACTIVITIES
		WHERE ACTIVITYID = $activityid";
		$query_result = mysql_query($queryString,$db);
	}
	$activityinfo = mysql_fetch_array($query_result);
?>
<legend><?php
	echo $activityinfo['ACTIVITYTITLE'];
	mysql_free_result($query_result);
	mysql_close($db);
?></legend>
<table>
	<tr><td width="200">Location: </td>
	    <td><?php echo $activityinfo['ACTIVITYLOCATION'];?></td>
	</tr>
	<tr><td width="200">Time: </td>
	    <td><?php echo $activityinfo['ACTIVITYTIME'];?></td>
	</tr>
	<tr><td width="200">Location: </td>
		<td><?php echo $activityinfo['ACTIVITYDESCRIPTION'];?></td>
	</tr>
</table>
<hr>
</fieldset>

<fieldset>
<legend>List of Participants</legend>

</fieldset>
	
</body>
</html>