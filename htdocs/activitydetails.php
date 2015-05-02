<?php
// Start the session
session_start();

if(!isset($_SESSION['USERID'])){
    header("Location:login.php");
    exit();
	
	
}

$activityid = $_GET['activityid'];

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
    width:10%;
    float:left;	      
}

#right {
	float:right;
	width:90%;
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
<li><a href="userinfo.php">Profile</a></li>
<li><a href="logout.php">Log out</a></li>

</div>

<div id="header">
<h1>Online Social Circle</h1>
</div>



<div id="nav">
<ul>
<li><a href="userinfo.php">Profile</a></li>
<li><a href="friendslist.php">Friends</a></li>
<li><a href="search.php">Search</a></li>
</ul>
</div>


<div id="right">
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
	$comletelyNewmember = 1;
	$ifcreator = 0;
	$ifinvited = 0;
	$ifapplying = 0;
	$ifmember = 0;
	if(mysql_num_rows($query_result) > 0){
		$comletelyNewmember = 0;
		$activityinfo = mysql_fetch_array($query_result);
		if($activityinfo['IFCREATOR'] == 1){
			$ifcreator = 1;
		}
		$ifinvited = $activityinfo['IFINVITED'];
		$ifapplying = $activityinfo['IFAPPLYING'];
		$ifmember = $activityinfo['IFATTEND'];
	}
	else{
		$queryString = "SELECT *
		FROM ACTIVITIES
		WHERE ACTIVITYID = $activityid";
		$query_result = mysql_query($queryString,$db);
		$activityinfo = mysql_fetch_array($query_result);
	}
	
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
	<tr><td width="200">Description: </td>
		<td><?php echo $activityinfo['ACTIVITYDESCRIPTION'];?></td>
	</tr>
	<tr>
	<td width="200">Status: </td>
	<td>
	<?php
	if($ifcreator == 1){
		//creator. need edit button
		echo 'Creator</td></tr><tr><td>';
		echo '<form method="post" action="sendactinvite.php">
			    <input type="submit" name="action" value="Send Invitation to Your Friends"/>
				<input type="hidden" name="activityid" value="'.$activityid.'"/>
			    </form>';
		echo '</td><td><form method="post" action="assignactogroup.php">
			    <input type="submit" name="action" value="Assign to your Groups"/>
				<input type="hidden" name="activityid" value="'.$activityid.'"/>
			    </form></td><td>';
	}
	else if($comletelyNewmember == 1){
		echo '<form method="post" action="userapplytoactivity.php">
			    <input type="submit" name="action" value="Apply"/>
				<input type="hidden" name="activityid" value="'.$activityid.'"/>
				<input type="hidden" name="activityuserid" value = "'.$tempuserid.'"/>
			    </form>';
	}
	else if($ifmember == 1){
		echo 'Member';
	}
	else if($ifinvited == 1){
		echo 'Invited</td></tr><tr><td>';
		echo '<form method="post" action="adduserasactmember.php">
			    <input type="submit" name="action" value="Accept Invitation"/>
				<input type="hidden" name="activityid" value="'.$activityid.'"/>
				<input type="hidden" name="activityuserid" value = "'.$tempuserid.'"/>
			    </form>';
	}
	else if($ifapplying == 1){
		echo 'Applying';
	}
	?>
	</td>
	</tr>
</table>
<hr>
</fieldset>

<fieldset>
<legend>List of Participants</legend>

<?php
include('conn.php');
	
$tempuserid = $_SESSION['USERID'];

$queryString = "SELECT USERS.USERID,USERNAME,EMAILADDR,GENDER,IFATTEND,IFINVITED,IFCREATOR,IFAPPLYING,APPLYREASON
	FROM USERS,USERCONNECTACTIVITY
	WHERE USERS.USERID = USERCONNECTACTIVITY.USERID
	AND USERCONNECTACTIVITY.ACTIVITYID = $activityid";
$query_result = mysql_query($queryString,$db);
?>

<?php while ($row = mysql_fetch_array($query_result)) : ?>
<table>
	<tr>
		<td width="10%">Username: </td>
		<td width="10%"><?php echo $row['USERNAME']; ?></td>
		<td width="10%">Email Address: </td>
		<td width="10%"><?php echo $row['EMAILADDR']; ?></td>
		<td width="10%">Gender: </td>
		<td width="10%"><?php 
			if($row['GENDER'] == 1){
				echo 'Male';
			}
			else{
				echo 'Female';
			}
		?></td>
		<td width="10%">Status: </td>
		<td width="10%"><?php
			if($row['IFCREATOR'] == 1){
				echo 'Creator';
			}
			else if($row['IFATTEND'] == 1){
				echo 'Member';
			}
			else if($row['IFINVITED'] == 1){
				echo 'Invited';
			}
			else{
				echo 'Applying';
			}
		?></td>
		<td width="10%"><?php 
			if($ifcreator == 1){
				//creator
				if($row['IFCREATOR'] == 1){
					echo '-';
				}
				else if($row['IFATTEND'] == 1){
					echo '<form method="post" action="deleteuserfromac.php">
					<input type="submit" name="action" value="Delete"/>
					<input type="hidden" name="activityid" value="'.$activityid.'"/>
					<input type="hidden" name="deleteuserid" value = "'.$row['USERID'].'"/>
					</form>';
				}
				else if($row['IFINVITED'] == 1){
					echo '-';
				}
				else{
					echo '<form method="post" action="adduserasactmember.php">
					<input type="submit" name="action" value="Accept"/>
					<input type="hidden" name="activityid" value="'.$activityid.'"/>
					<input type="hidden" name="activityuserid" value = "'.$row['USERID'].'"/>
					</form>';
					echo '</td></tr><tr><td width="10%">Apply Reason: </td><td>'.$row['APPLYREASON'];
				}
			}
		?></td>
	</tr>
</table>
<hr>
<?php endwhile; 
	  mysql_free_result($query_result);
	  mysql_close($db); ?>

</fieldset>
</div>

<div id="footer">

DATABASE SYSTEMS PROJECRT 
</div>
</body>
</html>