<?php
// Start the session
session_start();

if(!isset($_SESSION['USERID'])){
    header("Location:login.php");
    exit();
}

$searchfriendkeyword = "";

?>

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

<html>
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
<div id=“navmenu">
<ul>
<li><a href="userinfo.php">Your Activities</a></li>
<li><a href="yourgrouplist.php">Your Groups</a></li>
<li><a>Your Friends</a></li>
<li><a href="addnewfriends.php">Add new Friends</a></li>
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
<legend>Your Friends:</legend>

<?php
	include('conn.php');
	$tempuserid = $_SESSION['USERID'];
	
	$queryString = "SELECT USERS.USERID, USERS.USERNAME, USERS.EMAILADDR, USERS.BIRTHDATE, USERS.GENDER,FRELIST.RSST
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
	<td width = "100px">UserName: </td>
	<td width = "200px"><?php echo $row['USERNAME']; ?></td>
	<td width = "100px">Gender: </td>
	<td width = "200px">
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
	<td width = "100px">Relationship: </td>
	<td>
	<?php 
		$tempStatus = $row['RSST']; 
		if($tempStatus == 1||$tempStatus == 11){
			echo "Friends";
		}
		else if($tempStatus == 0){
			echo "Request Sent";
		}
		else if($tempStatus == 10){
			$tempfrid = $row['USERID'];
			echo '<form method="post" action="acceptinvatation.php">
			    <input type="submit" name="action" value="Accept Invitation"/>
				<input type="hidden" name="friendid" value="'.$tempfrid.'"/>
			    </form>';
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

</body>
</html>