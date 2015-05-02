<?php
// Start the session
session_start();

if(!isset($_SESSION['USERID'])){
    header("Location:login.php");
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

<body>

<div id="menu">
<ul>
<li><a href="publicactivity.php">Home</a></li>
<li><a href="logout.php">Log out</a></li>

</div>

<div id="header">
<h1>Online Social Circle</h1>
</div>

<div id="nav">
<div id=¡°navmenu">
<ul>
<li><a href="userinfo.php">Your Activities</a></li>
<li><a>Your Groups</a></li>
<li><a href="addgroup.php">Create New Group</a></li>
<li><a href="friendslist.php">Your Friends</a></li>
<li><a href="search.php"> Search </a></li>
</ul>
</div> 
</div>

<fieldset>
<legend>Personal Information:</legend>
<table>
	<tr><td width="200">User Name: </td>
	    <td><?php echo $_SESSION['USERNAME'];?></td>
	</tr>
	<tr><td width="200">Email Address: </td>
	    <td><?php echo $_SESSION['EMAILADDR'];?></td>
	</tr>
</table>

</fieldset>

<fieldset>
<legend>Your Groups:</legend>

<?php
	include('conn.php');
	$tempuserid = $_SESSION['USERID'];
	
	$queryString = "SELECT GROUPS.GROUPID, GROUPTITLE,GROUPDESCRIPTION,CREATETIME,IFMEMBER,IFINVITED,IFADMIN,IFAPPLYING
		FROM GROUPS, USERCONNECTGROUP 
		WHERE GROUPS.GROUPID = USERCONNECTGROUP.GROUPID
		AND GROUPS.IFDISMISS = 0
		AND USERCONNECTGROUP.USERID = $tempuserid";
	$query_result = mysql_query($queryString,$db);
?>

<?php while ($row = mysql_fetch_array($query_result)) : ?>

<table>
	<tr>
		<td width = "200"><?php echo $row['GROUPTITLE']; ?></td>
		<td><form method="get" action="groupdetails.php">
			    <input type="submit" name="action" value="Detail"/>
				<input type="hidden" name="groupid" value="<?php echo $row['GROUPID']; ?>"/>
			    </form></td>
		</td>
	</tr>
	<tr>
		<td width = "200">Create Time: </td>
		<td><?php echo $row['CREATETIME']; ?></td>
	</tr>
	<tr>
		<td width = "200">Status: </td>
		<td><?php 
			if($row['IFADMIN'] == 1){
				echo 'Admin';
			}
			else if($row['IFMEMBER'] == 1){
				echo 'Member';
			}
			else if($row['IFINVITED'] == 1){
			/*	echo '<form method="post" action="">
			    <input type="submit" name="action" value="Accept Invitation"/>
				<input type="hidden" name="groupid" value="$row[\'GROUPID\']"/>
			    </form>';*/
				echo 'Invited';
			}
			else if($row['IFAPPLYING'] == 1){
				echo 'Applying';
			}
		?></td>
	</tr>


</table>
<hr>

<?php endwhile; 
	  mysql_free_result($query_result);
	  mysql_close($db); ?>

</fieldset>

<div id="footer">

DATABASE SYSTEMS PROJECRT 
</div>

</body>

</html>