<?php
// Start the session
session_start();

if(!isset($_SESSION['USERID'])){
    header("Location:login.php");
    exit();
}

$persnalUserId = $_SESSION['USERID'];
$groupId = $_GET['groupid'];
$ifgroupAdmin = 0;

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


#subleft{
	float:left;
	width:60%;
}

#subright{
	float:right;
	width:40%;
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
<li><a href="logout.php">Log out</a></li>

</div>

<div id="header">
<h1>Online Social Circle</h1>

</div>
<div id="nav">
<ul>
<li><a href="yourgrouplist.php">Your Groups</a></li>
<li><a href="userinfo.php">Profile</a></li>
<li><a href="friendslist.php">Friends</a></li>
<li><a href="search.php">Search</a></li>
</ul>
</div>


<div id="right">


<?php
	include('conn.php');
	
	$completelyNew = 1;
	$queryString = "SELECT GROUPS.GROUPTITLE,GROUPS.CREATETIME,GROUPS.GROUPDESCRIPTION,IFMEMBER,IFINVITED,IFADMIN,IFAPPLYING,APPLYWHEN,APPLYREASON
					FROM GROUPS,USERCONNECTGROUP
					WHERE GROUPS.GROUPID = $groupId
					AND USERCONNECTGROUP.USERID = $persnalUserId
					AND GROUPS.GROUPID = USERCONNECTGROUP.GROUPID
					AND IFDISMISS = 0";
	$query_result = mysql_query($queryString,$db);
	if(mysql_num_rows($query_result) > 0){
		$completelyNew = 0;
	}
	else{
		$queryString = "SELECT *
		FROM GROUPS
		WHERE GROUPID = $groupId
		AND IFDISMISS = 0";
		$query_result = mysql_query($queryString,$db);
	}
	$groupinfo = mysql_fetch_array($query_result);
	
	if(mysql_num_rows($query_result) == 0){
		echo 'Error! Group Not Existing!';
		mysql_free_result($query_result);
		mysql_close($db);
		exit();
	}
	
	//mysql_free_result($query_result);
	//mysql_close($db);
?>

<fieldset>
<legend>Group Information:</legend>
	<table>
		<tr>
			<td width='20%'>Title: </td>
			<td><?php echo $groupinfo['GROUPTITLE'];?>
			</td>
		</tr>
			
		<tr>
		<td width='20%'>Create Time: </td>
		<td><?php echo $groupinfo['CREATETIME'];?></td>
		</tr>
		<tr>
		<td width = '20%'>Description: </td>
		<td><?php echo $groupinfo['GROUPDESCRIPTION'];?></td>
		</tr>
		<tr>
			<td width = "20%">Status: </td>
			<td>
			<?php
				if($completelyNew == 1){
					echo '<form class="button" method="post" action="applytogroup.php">
					<input type="submit" name="action" value="Apply"/>
					<input type="hidden" name="groupid" value="'.$groupId.'"/>
					</form>';
				}
				else{
					if($groupinfo['IFADMIN'] == 1){
						$ifgroupAdmin = 1;
						echo '<form class="button" method="post" action="sendgroupinvite.php">
						<input type="submit" name="action" value="Send Invitation to Friends"/>
						<input type="hidden" name="groupid" value="'.$groupId.'"/>
						</form>';
					}
					else if($groupinfo['IFMEMBER'] == 1){
						echo 'Member';
					}
					else if($groupinfo['IFINVITED'] == 1){
						echo '<form class="button" method="post" action="acceptgroupinvite.php">
						<input type="submit" name="action" value="Accept"/>
						<input type="hidden" name="groupid" value="'.$groupId.'"/>
						<input type="hidden" name="acceptuserid" value = "'.$persnalUserId.'"/>
						</form>';
					}
					else if($groupinfo['IFAPPLYING'] == 1){
						echo 'Applying';
					}
				}
			?>
			</td>
		</tr>
	</table>
	
</fieldset>
<div id="subleft">
<fieldset>
<legend>Group Activities</legend>

<?php if ($groupinfo['IFMEMBER'] == 1||$groupinfo['IFADMIN'] == 1): ?>

<?php
	$queryString = "SELECT ACTIVITIES.*
				FROM ACTIVITIES,ACTIVITYASSIGNEDTOGROUP
				WHERE ACTIVITIES.ACTIVITYID = ACTIVITYASSIGNEDTOGROUP.ACTIVITYID
				AND ACTIVITYASSIGNEDTOGROUP.GROUPID = $groupId
				AND ACTIVITIES.IFCANCELED = 0";
	$query_result = mysql_query($queryString,$db);
?>

<?php while ($row = mysql_fetch_array($query_result)) : ?>


	<table>
		<tr><td width = "200"><?php echo $row['ACTIVITYTITLE']; ?></td>
			<td ><form class="button" method="get" action="activitydetails.php">
			    <input type="submit" name="action" value="Detail"/>
				<input type="hidden" name="activityid" value="<?php echo $row['ACTIVITYID']; ?>"/>
			    </form>
			</td>
		</tr>
		

		<tr>
		<td width = "200">Location: </td><td><?php echo $row['ACTIVITYLOCATION']; ?></td></tr>
		<tr>
		<td width = "200">Date and Time: </td><td><?php echo $row['ACTIVITYTIME']; ?></td></tr>
		<tr>
		<td width = "200">Description: </td><td><?php echo $row['ACTIVITYDESCRIPTION']; ?></td>
		</tr>
	</table>
	<hr>
<?php endwhile; ?>

<?php else: ?>

-Only members can see this area-

<?php endif; ?> 
</fieldset>
</div>

<div id="subright">
<fieldset>
<legend>Group Members</legend>

<?php if ($groupinfo['IFMEMBER'] == 1||$groupinfo['IFADMIN'] == 1): ?>
<?php
	$queryString = "SELECT USERS.USERID,USERS.USERNAME,USERS.EMAILADDR,IFMEMBER,IFINVITED,IFADMIN,IFAPPLYING,APPLYWHEN,APPLYREASON
	FROM USERS,USERCONNECTGROUP
	WHERE USERS.USERID = USERCONNECTGROUP.USERID
	AND USERCONNECTGROUP.GROUPID = $groupId";
	$query_result = mysql_query($queryString,$db);
?>

<?php while ($row = mysql_fetch_array($query_result)) : ?>
	<table>
	<tr>
	<td width = "30%"><?php echo $row['USERNAME'];?>
	</td>
	<td width = "40%"><?php echo $row['EMAILADDR'];?>
	</td>
	<td>
	<?php
	if($row['IFADMIN'] == 1){
		echo 'Admin';
	}
	else if($row['IFMEMBER'] == 1){
		if($ifgroupAdmin == 1){
			echo '<form class="button" method="post" action="deleteuserfromgroup.php">
					<input type="submit" name="action" value="Delete"/>
					<input type="hidden" name="groupid" value="'.$groupId.'"/>
					<input type="hidden" name="deleteuserid" value = "'.$row['USERID'].'"/>
					</form>';
		}
		else{
			echo 'Member';
		}
	}
	else if($row['IFINVITED'] == 1){
		echo 'Invited';
	}
	else if($row['IFAPPLYING'] == 1){
		if($ifgroupAdmin == 1){
			echo '<form class="button" method="post" action="acceptgroupinvite.php">
					<input type="submit" name="action" value="Accept"/>
					<input type="hidden" name="groupid" value="'.$groupId.'"/>
					<input type="hidden" name="acceptuserid" value = "'.$row['USERID'].'"/>
					</form></td>';
			echo '<td>
					<form class="button" method="post" action="deleteuserfromgroup.php">
					<input type="submit" name="action" value="Reject"/>
					<input type="hidden" name="groupid" value="'.$groupId.'"/>
					<input type="hidden" name="deleteuserid" value = "'.$row['USERID'].'"/>
					</form>
				 </td>';
			echo '</td></tr><tr><td colspan="4">Apply Reason: '.$row['APPLYREASON'];
		}
		else{
			echo 'Applying';
		}
	}
	?>
	</td>
	</tr>
	</table>
	<hr>
<?php endwhile; ?>

<?php
	mysql_free_result($query_result);
	mysql_close($db);
?>

<?php else: ?>

-Only members can see this area-

<?php endif; ?> 
</fieldset>
</div>

</div>



<div id="footer">

DATABASE SYSTEMS PROJECRT 
</div>
</body>

</html>