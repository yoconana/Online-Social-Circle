<?php
// Start the session
session_start();

if(!isset($_SESSION['USERID'])){
    header("Location:login.php");
    exit();
}

?>

<html>

<style type="text/css">
    html{font-size:16px;}
	
    fieldset{width:800px; margin: 0 auto;}
	
    legend{font-weight:bold; font-size:24px;}
	
    label{float:left; width:140px; margin-left:10px;}
    .left{margin-left:150px;}
    .input{width:150px;}
	
    span{color: #666666;}
	
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
    padding: 8px 8px 8px 8px;}
	
	#menu a:hover {
    color: #F90;
    background-color: #FFF;
	}
	
	#header {
    background-color:#003366;
    color:white;
    text-align:center;
    padding: 8px 8px 8px 8px;
	
	}
}
</style>

<head>
	
</head>
<body>

<div id="menu">
<ul>
<li><a href="publicactivity.php">Home</a></li>
<li><a href="userinfo.php">Profile</a></li>
</ul>
</div>

<div id="header">
<h1>Social Activity Website</h1>
</div>


<fieldset>
<legend>Create Group</legend>

<form name="createGroupForm" method="post" action="addgroupResult.php" onSubmit="return InputCheck(this)">
<label for="GroupTitle" class="label">Group Title: </label>
<input id="GroupTitle" size="300" name="GroupTitle"  type="text" class="input" style="width: 400px;" / >
<span>*</span>
<p/>

<p>
<label for="GroupDescrption" class="label">Group Descrption:</label>
<textarea name="GroupDescrption" cols="25" rows="10" style="width: 400px;"></textarea>
	<span>*</span>
</p>
<input type="submit" name="submit" value="  Submit  " class="left" />
</p>
</form>
</fieldset>

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

