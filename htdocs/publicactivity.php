<?php
// Start the session
session_start();
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
	width:15%;    
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


<li><?php
	if(!isset($_SESSION['USERID'])){
		echo "<a href=\"login.php\">Login</a>";
	}
	else{
		echo "<a href=\"userinfo.php\">Profile</a>";
	}
?></li>
<!--<li><a href="login.php">Login</a></li>-->

<?php 
   if(!isset($_SESSION['USERID'])){
	   echo "<li><a href=\"registerPage.php\">Register</a></li>";
   }
   else{
	   echo "<li><a href=\"logout.php\">Log out</a></li>";
   }
?>
<!--<li><a href="registerPage.php">Register</a></li>-->
</ul>
</div> 

<div id="header">
<h1>Social Activity Website</h1>
</div>

<div id="nav">
<div id=“navmenu">
<ul>
<li><a> Activities </a></li>
<li><a href="friendslist.php">Friends</a></li>
<li><a href="search.php"> Search </a></li>
<li><a href="userinfo.php"> Your Page </a></li>
</ul>
</div> 
</div>

<div id="right">
<fieldset>
<legend>Recently Posted Activities:</legend>

<div>
<?php
	include('conn.php');
	$selectRecentTenActivities = "SELECT *
						FROM ACTIVITIES
						WHERE IFPUBLIC = TRUE 
						AND IFCANCELED = FALSE
						ORDER BY ACTIVITYTIME DESC
						LIMIT 10
						";
						
	//$db = mysql_connect('localhost','root','123456') or die ('Unable to connect.');
	//mysql_select_db('socialactivity',$db) or die (mysql_error($db));
	$query_result = mysql_query($selectRecentTenActivities,$db);
	
	
?>

<?php while ($row = mysql_fetch_array($query_result)) : ?>
	<table>
		<tr><td width = "20%"><?php echo $row['ACTIVITYTITLE']; ?></td>
			<td><form method="get" action="activitydetails.php" onSubmit="return LoginCheck()">
			    <input type="submit" name="action" value="Detail"/>
				<input type="hidden" name="activityid" value="<?php echo $row['ACTIVITYID']; ?>"/>
			    </form>
			</td>
		</tr>

		<tr>
		<td width = "20%">Location: </td>
		<td><?php echo $row['ACTIVITYLOCATION']; ?></td></tr>
		<tr>
		<td width = "20%">Date and Time: </td>
		<td><?php echo $row['ACTIVITYTIME']; ?></td></tr>
		<tr>
		<td width = "20%">Description: </td>
		<td><?php echo $row['ACTIVITYDESCRIPTION']; ?></td>
		</tr>
	</table>
	
	<hr>

<?php endwhile; 
	  mysql_free_result($query_result);
	  mysql_close($db); ?>


</div>

</fieldset>
</div>


<div id="footer">

DATABASE SYSTEMS PROJECRT 
</div>

<script language=JavaScript>
<!--

function LoginCheck()
{
  if(!isset($_SESSION['USERID']))
  {
    alert("Please Log in to see more details.");
    LoginForm.email.focus();
    return (false);
  }
}

//-->
</script>

</body>
</html>

