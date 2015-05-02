<?php
// Start the session
session_start();

if(!isset($_SESSION['USERID'])){
    header("Location:login.php");
    exit();
}

if(!isset($_POST['activityid'])){
	exit('Illegal Access Not Permitted!');
}

$personalUserId = $_SESSION['USERID'];
$activityId = $_POST['activityid'];
?>

<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<style>

fieldset{width:600px; margin: 0 auto;}
legend{font-weight:bold; font-size:24px;}
.left{margin-left:0px;}
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
<li><a href="activitydetails.php?activityid=<?php echo $activityId;?>">GO BACK</a></li>
</ul>

</div>

<?php
	//get all groups which is not linked to this activity but your are the member or creator of the group
	include('conn.php');
	$queryString = "SELECT GROUPS.*
	FROM USERCONNECTGROUP,GROUPS
	WHERE USERCONNECTGROUP.GROUPID = GROUPS.GROUPID
	AND USERCONNECTGROUP.USERID = $personalUserId
	AND GROUPS.IFDISMISS = 0
	AND 
	(USERCONNECTGROUP.IFMEMBER = 1
	OR USERCONNECTGROUP.IFADMIN = 1
	)
	AND GROUPS.GROUPID NOT IN
	(
		SELECT ACTIVITYASSIGNEDTOGROUP.GROUPID
		FROM ACTIVITYASSIGNEDTOGROUP
		WHERE ACTIVITYASSIGNEDTOGROUP.ACTIVITYID = $activityId
	)";
	
	$query_result = mysql_query($queryString,$db);
?>

<div id="right">
<fieldset>
<legend>Assign this activity to your Groups:</legend>
<?php if(mysql_num_rows($query_result) > 0): ?>
	<form name = "assignForm" action = "assignacResult.php" method="post" onSubmit="return InputCheck(this)">
<?php while ($row = mysql_fetch_array($query_result)) : ?>
	
	<table>
	<tr>
	<td width = "20%">
		<input type = "checkbox" name="groupid_list[]" value="<?php echo $row['GROUPID']?>"/>
	</td>
	<td width = "50%">
		<?php echo $row['GROUPTITLE']?>
	</td>
	<td>
		<?php echo $row['CREATETIME']?>
	</td>
	</tr>
	</table>
	<hr>

<?php endwhile; 
	   ?>
	<input type = "hidden" name = "activityid" value = "<?php echo $activityId;?>"/>
	<input type = "submit" name="action" value = "Submit" class="left" />
	  
</form>
<?php else: ?>
	You have no more group to assign.Please <a href="activitydetails.php?activityid=<?php echo $activityId;?>">GO BACK</a>.
	<?php endif; 
		mysql_free_result($query_result);
		mysql_close($db);
	?>
</fieldset>
</div>

<script language=JavaScript>
<!--

function InputCheck(assignForm)
{
   var textinputs = document.querySelectorAll('input[type=checkbox]'); 
	var empty = [].filter.call( textinputs, function( el ) {
		return !el.checked
	});

	if (textinputs.length == empty.length) {
		alert("None filled");
		return false;
	}
}

//-->
</script>
</body>
</html>