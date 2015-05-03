<?php
// Start the session
session_start();

if(!isset($_SESSION['USERID'])){
    header("Location:login.php");
    exit();
}

?>

<html>


<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<style>
legend{font-weight:bold; font-size:24px;}
label{float:left; width:150px; margin-left:10px;}
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
<li><a href="userinfo.php">Profile</a></li>
</ul>
</div>

<div id="header">
<h1>Online Social Circle</h1>
</div>
<div id="nav">
<ul>
<li><a href="userinfo.php" >Your Activities</a></li>
<li><a href="yourgrouplist.php">Your Groups</a></li>
<li><a>Create New Group</a></li>
<li><a href="friendslist.php">Your Friends</a></li>
<li><a href="search.php"> Search </a></li>
</ul>
</div>

<div id="right">
<fieldset>
<legend>Create Group</legend>

<form name="createGroupForm" method="post" action="addgroupResult.php" onSubmit="return InputCheck(this)">
	<p>
	<label for="GroupTitle" class="label">Group Title: </label>
	<input id="GroupTitle" size="300" name="grouptitle"  type="text" class="input" style="width: 600px;" / >
	<span>*</span>
	</p>

<p>
	<label for="GroupDescription" class="label">Group Description:</label>
	<textarea name="groupdescription" cols="25" rows="10" style="width: 600px;"></textarea>
	<span>*</span>
</p>
	<input type="submit" name="submit" value="  Submit  " class="left" />
</p>
</form>
</fieldset>
</div>
<script language=JavaScript>
<!--

function InputCheck(createactvityForm)
{
  if (createGroupForm.GroupTitle.value == "")
  {
    alert("Group Title cannot be empty!");
    createGroupForm.GroupTitle.focus();
    return (false);
  }
 
  if (createGroupForm.GroupDescrption.value == "")
  {
    alert("Group Description cannot be empty");
   createGroupForm.GroupDescrption.focus();
    return (false);
  }
  
 
}

//-->
</script>

</body>
</html>

