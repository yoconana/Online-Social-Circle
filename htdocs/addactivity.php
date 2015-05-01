

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
<legend>Create Activity</legend>


<form name="createactvityForm" method="post" action="addactivityResult.php" onSubmit="return InputCheck(this)" >
<label for="ActivityTitle" class="label">Activity Name: </label>
<input id="ActivityTitle" size="300" name="ActivityTitle"  type="text" class="input" style="width: 400px;" / >
<span>*</span>
</p>
<p>
<label for="ActivityLocation" class="label">Activity Location </label>
<input id="ActivityLocation" name="ActivityLocation" type="text" class="input" style="width: 400px;"  />
<span>*</span>
</p>

<p>
<label for="ActivityTime" class="label">Activity Time </label>
<input id="ActivityTime" name="ActivityTime" type="datetim" class="input"
style="width: 400px;" />
<span>*</span>
</p>


<p>
<label for="ifpublic" class="label">Public:</label>
<input type="radio" name="ifpublic" value="yes" checked="checked" /> YES
<input type="radio" name="ifpublic" value="no"/> NO 
<span>*</span>
</p>


<p>
<label for="ActivityDescrption" class="label">Activity Descrption:</label>
<textarea name="ActivityDescrption" cols="25" rows="10" style="width: 400px;" >

	</textarea>
	<span>*</span>
</p>
<p>
<input type="submit" name="submit" value="  Submit  " class="left" />
</p>
</form>
</fieldset>
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

