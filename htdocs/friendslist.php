<?php
// Start the session
session_start();

if(!isset($_SESSION['USERID'])){
    header("Location:login.php");
    exit();
}

$searchfriendkeyword = "";

$photoPath = 'res/photo'.$_SESSION['PHOTONO'].'.jpg';

?>

<html>
<head>
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
</head>
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
<li><a href="userinfo.php">Your Activities</a></li>
<li><a href="yourgrouplist.php">Your Groups</a></li>
<li><a>Your Friends</a></li>
<li><a href="addnewfriends.php">Add new Friends</a></li>
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
<legend>Your Friends:</legend>

<?php
	include('conn.php');
	$tempuserid = $_SESSION['USERID'];
	
	$queryString = "SELECT USERS.USERID, USERS.PHOTONO,USERS.USERNAME, USERS.EMAILADDR, USERS.BIRTHDATE, USERS.GENDER,FRELIST.RSST
	FROM
	((SELECT USERID2 USID,RELATIONSTATUS RSST
	FROM FRIENDSHIP
	WHERE FRIENDSHIP.USERID1 = $tempuserid)
	UNION
	(SELECT USERID1 USID,RELATIONSTATUS+10 RSST
	FROM FRIENDSHIP
	WHERE FRIENDSHIP.USERID2 = $tempuserid)) FRELIST, USERS
	WHERE FRELIST.USID = USERS.USERID";
	$query_result = mysql_query($queryString,$db);
?>

<?php while ($row = mysql_fetch_array($query_result)) : ?>
	<table>
	<tr>
	<td width = "10%">
		<img src="<?php echo 'res/photo'.$row['PHOTONO'].'.jpg';?>" style="width:80%;">
	
	</td>
	<td width = "10%">UserName: </td>
	<td width = "15%"><?php echo $row['USERNAME']; ?></td>
	<td width = "10%">Gender: </td>
	<td width = "10%">
		<?php 
		$tempgender = $row['GENDER']; 
		if($tempgender == 1){
			echo "Male";
		}
		else{
			echo "Female";
		}
		?>
	</td>
	<td width = "15%">Relationship: </td>
	<td  width="10%">
	<?php 
		$tempStatus = $row['RSST']; 
		if($tempStatus == 1||$tempStatus == 11){
			echo 'Friends</td>
				  <td><form class="button" method="post" action="deletefriend.php">
					<input type="submit" name="submit" value="Delete"/>
					<input type="hidden" name="friendid" value="'.$row['USERID'].'"/>
					</form>
				  </td>';
		}
		else if($tempStatus == 0){
			echo "Request Sent</td><td>";
		}
		else if($tempStatus == 10){
			$tempfrid = $row['USERID'];
			echo '<form class="button" method="post" action="acceptinvatation.php">
			    <input type="submit" name="action" value="Accept"/>
				<input type="hidden" name="friendid" value="'.$tempfrid.'"/>
			    </form>';
			echo '</td><td>
					<form class="button" method="post" action="deletefriend.php">
					<input type="submit" name="submit" value="Reject"/>
					<input type="hidden" name="friendid" value="'.$row['USERID'].'"/>
					</form>
			</td>';
		}
	?>
	</td>
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