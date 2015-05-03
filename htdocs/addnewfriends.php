<?php
// Start the session
session_start();

if(!isset($_SESSION['USERID'])){
    header("Location:login.php");
    exit();
}

if (isset($_POST['keyword'])){
	$friendKeyword = $_POST['keyword'];
}
else{
	$friendKeyword = "";
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
<div id=¡°navmenu">
<ul>
<li><a href="userinfo.php">Your Activities</a></li>
<li><a href="yourgrouplist.php">Your Groups</a></li>
<li><a href="friendslist.php">Your Friends</a></li>
<li><a>Add new Friends</a></li>
<li><a href="search.php"> Search </a></li>
</ul>
</div> 
</div>

<div id="right">

<fieldset>

<legend>Search for New Friends</legend>

<form name="searchForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return InputCheck(this)">
		<p>
		<label for="keyword" class="label">Keyword: </label>
		<input id="keyword" name="keyword" value = "<?php echo $friendKeyword;?>" type="text" class="input" />
		<span>*</span>
		<p/>
		
		<p>
		<input type="submit" name="submit" value="Search" class="left" />
		</p>
</form>

<?php if ($friendKeyword != ""): ?>
<?php
	include('conn.php');
	$tempuserid = $_SESSION['USERID'];
	
	$queryString = "SELECT * FROM USERS 
	WHERE 
	USERID <> $tempuserid
	AND (USERNAME LIKE '%$friendKeyword%' OR EMAILADDR LIKE '%$friendKeyword%')
	AND
	USERID NOT IN
	(SELECT USERS.USERID
	FROM
	((SELECT USERID2 USID,RELATIONSTATUS RSST
	FROM FRIENDSHIP
	WHERE FRIENDSHIP.USERID1 = $tempuserid)
	UNION
	(SELECT USERID1 USID,RELATIONSTATUS+10 RSST
	FROM FRIENDSHIP
	WHERE FRIENDSHIP.USERID2 = $tempuserid)) FRELIST, USERS
	WHERE FRELIST.USID = USERS.USERID)";
	$query_result = mysql_query($queryString,$db);
?>

<?php while ($row = mysql_fetch_array($query_result)) : ?>
	<table>
	
	<tr>
	<td width= "10%">
	<img src="<?php echo 'res/photo'.$row['PHOTONO'].'.jpg';?>" style="width:80%;">
	</td>
	<td width = "10%">UserName: </td>
	<td width = "10%"><?php echo $row['USERNAME']; ?></td>
	<td width = "10%">Email: </td>
	<td width = "15%"><?php echo $row['EMAILADDR']; ?></td>
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
	<td>
		<form class="button" method="post" action="checkandsendFriendRequest.php">
		<input type="submit" name = "action" value="Add" class="left"/>
		<input type="hidden" name="friendid" value="<?php echo $row['USERID'];?>"/>
		</form>
	</td>
	</tr>
	
	</table>
	<hr>
<?php endwhile; 
	  mysql_free_result($query_result);
	  mysql_close($db); ?>


<?php endif; ?> 






</fieldset>



</div>

<script language=JavaScript>
<!--

function InputCheck(searchForm)
{
   if (searchForm.keyword.value == "")
  {
    alert("Key word cannot be empty!");
    LoginForm.keyword.focus();
    return (false);
  }
}

//-->
</script>

</body>

</html>