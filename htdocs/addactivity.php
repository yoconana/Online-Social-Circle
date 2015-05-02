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
	
    
	
    legend{font-weight:bold; font-size:24px;}
	
    label{float:left; width:180px; margin-left:10px;}
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
<h1>Online Social Circle</h1>
</div>
<div id="nav">
<ul>
<li><a href="userinfo.php" >Your Activities</a></li>
<li><a >Create new Activity</a></li>
<li><a href="yourgrouplist.php">Your Groups</a></li>
<li><a href="friendslist.php">Your Friends</a></li>
<li><a href="search.php"> Search </a></li>
</ul>
</div>

<div id="right">
<fieldset>
<legend>Create Activity</legend>


<form name="createactvityForm" method="post" action="addactivityResult.php" onSubmit="return InputCheck(this)" >
<label for="ActivityTitle" class="label">Activity Name: </label>
<input id="ActivityTitle" size="300" name="ActivityTitle"  type="text" class="input" style="width: 50%;" / >
<span>*</span>
</p>
<p>
<label for="ActivityLocation" class="label">Activity Location: </label>
<input id="ActivityLocation" name="ActivityLocation" type="text" class="input" style="width: 50%;"  />
<span>*</span>
</p>

<p>
<label for="ActivityTime" class="label">Activity Time: </label>
<input id="ActivityTime" name="ActivityTime" type="datetime" class="input"
style="width: 50%;" />
<span>* (Example: 2015-01-05 13:00:00)</span>
</p>


<p>
<label for="ifpublic" class="label">Public:</label>
<input type="radio" name="ifpublic" value="yes" checked="checked" /> YES
<input type="radio" name="ifpublic" value="no"/> NO 
<span>*</span>
</p>


<p>
<label for="ActivityDescrption" class="label">Activity Descrption:</label>
<textarea name="ActivityDescrption" cols="60" rows="10"></textarea>
	<span>*</span>
</p>
<p>
<input type="submit" name="submit" value="  Submit  " class="left" />
</p>
</form>
</fieldset>
</div>
<script language=JavaScript>
<!--

function InputCheck(createactvityForm)
{
  if (createactvityForm.ActivityTitle.value == "")
  {
    alert("Activity Title cannot be empty!");
    createactvityForm.ActivityTitle.focus();
    return (false);
  }
  if (createactvityForm.ActivityLocation.value == "")
  {
    alert("Activity Location cannot be empty!");
    createactvityForm.ActivityLocation.focus();
    return (false);
  }
  if (createactvityForm.ActivityTime.value == "")
  {
    alert("Activity Time cannot be empty");
   createactvityForm.ActivityTime.focus();
    return (false);
  }
  if (createactvityForm.ActivityDescrption.value == "")
  {
    alert("Activity Description cannot be empty");
   createactvityForm.ActivityDescrption.focus();
    return (false);
  }
  
 
}


//-->
</script>

</body>
</html>

