<?php
// Start the session
session_start();

if(!isset($_SESSION['USERID'])){
    header("Location:login.php");
    exit();
}

$photoPath = 'res/photo'.$_SESSION['PHOTONO'].'.jpg';
?>

<html>

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
    width:16%;     
}

#right {
	float:right;
	width:84%;
	}
#subleft{
	float:left;
    width:15%;
}
#subright {
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


<body>

<div id="menu">
<ul>
<li><a href="publicactivity.php">Home</a></li>
<li><a href="logout.php">Log out</a></li>

</div>

<div id="header">
<h1><?php echo $_SESSION['USERNAME'];?>'s Online Social Circle</h1>
</div>

<div id="nav">
<ul>
<li><a>Your Activities</a></li>
<li><a href="addactivity.php">Create new Activity</a></li>
<li><a href="yourgrouplist.php">Your Groups</a></li>
<li><a href="friendslist.php">Your Friends</a></li>
<li><a href="search.php"> Search </a></li>
</ul>
</div>

<div id="right">
<fieldset>
<legend>Personal Information:</legend>
<div id="subleft">
<img src="<?php echo $photoPath;?>" alt="Photo0" style="width:80%;">
</div>

<div id="subright">
<table>
	<tr><td width="200">User Name: </td>
	    <td><?php echo $_SESSION['USERNAME'];?></td>
	</tr>
	<tr><td width="200">Email Address: </td>
	    <td><?php echo $_SESSION['EMAILADDR'];?></td>
	</tr>
	<tr><td width="200">Gender: </td>
		<td><?php 
			if($_SESSION['GENDER'] == 1){
				echo 'Male';
			}
			else{
				echo 'Female';
			}
		?>
		</td>
	</tr>
	<?php
		if($_SESSION['BIRTHDATE'] != NULL){
			echo '<tr><td width="200">Birth Date: </td>
			    <td>'.$_SESSION['BIRTHDATE'].'</td>
				</tr>';
		}
	?>
</table>
</div>
</fieldset>

<fieldset>
<legend>Your Activities:</legend>

<?php
	include('conn.php');
	$tempuserid = $_SESSION['USERID'];
	
	$queryString = "SELECT USERS.USERID, ACTIVITIES.ACTIVITYID, ACTIVITIES.ACTIVITYTITLE, ACTIVITIES.ACTIVITYTIME,
	ACTIVITIES.ACTIVITYLOCATION, ACTIVITIES.ACTIVITYDESCRIPTION, IFATTEND,IFAPPLYING, IFINVITED, IFCREATOR
	FROM USERS, USERCONNECTACTIVITY, ACTIVITIES
	WHERE USERS.USERID = USERCONNECTACTIVITY.USERID
	AND USERCONNECTACTIVITY.ACTIVITYID = ACTIVITIES.ACTIVITYID 
	AND IFCANCELED = 0
	AND USERS.USERID = $tempuserid";
	$query_result = mysql_query($queryString,$db);
?>

<?php while ($row = mysql_fetch_array($query_result)) : ?>
	<table>
		<tr><td width = "200"><?php echo $row['ACTIVITYTITLE']; ?></td>
			<td><form class ="button" method="get" action="activitydetails.php">
			    <input type="submit" name="action" value="Detail"/>
				<input type="hidden" name="activityid" value="<?php echo $row['ACTIVITYID']; ?>"/>
			    </form>
			</td>
		</tr>
		
		<tr>
		<td width = "200">Status: </td>
		<td><?php
		    if($row['IFCREATOR'] == 1){
				echo "Creator";
			}
			else if($row['IFATTEND'] == 1){
				echo "Member";
			}
			else if($row['IFINVITED'] == 1){
				echo 'Invited';
			}
			else if($row['IFAPPLYING'] == 1){
				echo "Applying";
			}
		?>
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