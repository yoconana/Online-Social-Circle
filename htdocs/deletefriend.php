<?php
// Start the session
session_start();

if(!isset($_SESSION['USERID'])){
    header("Location:login.php");
    exit();
}

if(!isset($_POST['friendid'])){
	echo 'Illegal Access!';
	exit();
}

$deleteFriendid = $_POST['friendid'];
$personalUserId = $_SESSION['USERID'];

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
<h1>Online Social Circle</h1>
</div>

<?php
	include('conn.php');
	$queryString = "DELETE FROM FRIENDSHIP
		WHERE (USERID1 = $deleteFriendid AND USERID2 = $personalUserId)
		OR (USERID1 = $personalUserId AND USERID2 = $deleteFriendid)";
	if(mysql_query($queryString,$db)){
		echo 'Now you are not friends! Please check the <a href="friendslist.php">friends list</a> for more information.';
	}
	else{
		echo 'Failed! Please check the <a href="friendslist.php">friends list</a> for more information.';
	}
	
	mysql_free_result($query_result);
	mysql_close($db);
?>
</body>
</html>