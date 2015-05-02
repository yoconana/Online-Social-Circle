<?php
// Start the session
session_start();

if(!isset($_SESSION['USERID'])){
    header("Location:login.php");
    exit();
}

$personalUserId = $_SESSION['USERID'];
if (isset($_POST['keyword'])){
	$groupKeyword = $_POST['keyword'];
}
else{
	$groupKeyword = "";
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
<li><a href="userinfo.php">Profile</a></li>
<li><a href="logout.php">Log out</a></li>

</div>

<div id="header">
<h1>Online Social Circle</h1>
</div>

<div id="nav">
<ul>
<li><a href="userinfo.php">Profile</a></li>
<li><a href="search.php">Search Activities</a></li>
<li><a>Search Groups</a></li>
</ul>
</div>

<div id="right">
<fieldset>
<legend>Search for New Groups</legend>

<form name="searchForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return InputCheck(this)">
		<p>
		<label for="keyword" class="label">Keyword: </label>
		<input id="keyword" name="keyword" value = "<?php echo $groupKeyword; ?>" type="text" class="input" />
		<span>*</span>
		<p/>
		
		<p>
		<input type="submit" name="submit" value="Search" class="left" />
		</p>
</form>
<?php if ($groupKeyword != ""): ?>
<?php
	include('conn.php');
	$queryString = "SELECT *
		FROM GROUPS
		WHERE 
		(GROUPS.GROUPTITLE LIKE '%$groupKeyword%' OR GROUPS.GROUPDESCRIPTION LIKE '%$groupKeyword%')
		AND GROUPS.GROUPID NOT IN
		(SELECT GROUPS.GROUPID FROM
		GROUPS,USERCONNECTGROUP
		WHERE GROUPS.GROUPID = USERCONNECTGROUP.GROUPID
		AND USERCONNECTGROUP.USERID = $personalUserId
		)
		AND GROUPS.IFDISMISS = 0";
	$query_result = mysql_query($queryString,$db);
?>

<?php while ($row = mysql_fetch_array($query_result)) : ?>
	<table>
	<tr>
		<td width = "200"><?php echo 'Group Title:'; ?></td>
		<td width><?php echo $row['GROUPTITLE']; ?></td>
	</tr>
		<td width = "200"><?php echo 'Create Time: '; ?></td>
		<td width><?php echo $row['CREATETIME']; ?></td>
	<tr>
		<td width = "200"><?php echo 'Group Description: '; ?></td>
		<td width><?php echo $row['GROUPDESCRIPTION']; ?></td>
	</tr>
	<tr>
		<td>
			<form method="get" action="groupdetails.php">
			    <input type="submit" name="submit" value="Detail"/>
				<input type="hidden" name="groupid" value="<?php echo $row['GROUPID']; ?>"/>
			    </form>
		</td>
		<td>
			<form method="post" action="applytogroup.php">
			<input type="submit" name = "action" value="Apply" class="left"/>
			<input type="hidden" name="groupid" value="<?php echo $row['GROUPID'];?>"/>
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