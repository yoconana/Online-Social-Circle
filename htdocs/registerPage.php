<html>

<style type="text/css">
    html{font-size:16px;}
	
    fieldset{width:400px; margin: 0 auto;}
	
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
<li><a href="login.php">Login</a></li>
</ul>
</div>

<div id="header">
<h1>Online Social Circle</h1>
</div>

<fieldset>
<legend>User Register</legend>
<form name="RegForm" method="post" action="register.php" onSubmit="return InputCheck(this)">
<p>
<label for="username" class="label">Username: </label>
<input id="username" name="username" type="text" class="input" />
<span>*</span>
<p/>
<p>
<label for="password" class="label">Password: </label>
<input id="password" name="password" type="password" class="input" />
<span>*</span>
<p/>
<p>
<label for="repass" class="label">RepeatPassword: </label>
<input id="repass" name="repass" type="password" class="input" />
<span>*</span>
<p/>

<p>
<label for="email" class="label">E-mail Address:</label>
<input id="email" name="email" type="text" class="input" />
<span>*</span>
</p>

<p>
<label for="gender" class="label">Gender:</label>
<input type="radio" name="gender" value="male" checked="checked" /> Male 
<input type="radio" name="gender" value="female"/> Female <br/>

</p>
<p>
<label for="birthdate" class="label">Birth Date:</label>
<input id="birthdate" name="birthdate" type="date" class="input" />
</p>
<p>
<label for="profilepic" class="label">Profile Picture:</label>
<select onchange="change_image(this.value)">
<option value="picture1" selected="selected">Picture 1 </option>
<option value="picture2">Picture 2 </option>
<option value="picture3">Picture 3 </option>
<option value="picture4">Picture 4 </option>
<option value="picture5">Picture 5 </option>
</select>
<p><table><td id='imageHolder1'> </td></table>
</p>
<p>
<input type="submit" name="submit" value="  Submit  " class="left" />
</p>
</form>
</fieldset>

<script language=JavaScript>
<!--

function InputCheck(RegForm)
{
  if (RegForm.username.value == "")
  {
    alert("Username cannot be empty!");
    RegForm.username.focus();
    return (false);
  }
  if (RegForm.password.value == "")
  {
    alert("Username cannot be empty!");
    RegForm.password.focus();
    return (false);
  }
  if (RegForm.repass.value != RegForm.password.value)
  {
    alert("RepeatPassword should be the same as Password!");
    RegForm.repass.focus();
    return (false);
  }
  if (RegForm.email.value == "")
  {
    alert("E-mail Address cannot be empty!");
    RegForm.email.focus();
    return (false);
  }
}


function change_image(profilepic){
var dynamic_src="";
switch(profilepic){
 case "picture1":
  document.getElementById('imageHolder1').innerHTML="<a href='#'><img src='https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcR3TkCd-znc4_1yuaTHaIfObs5J0FiIsyM8pz2X43QwHYgmwmHD' style='max-width:40%' border='0'/></a>";
 break;
case "picture2":
  document.getElementById('imageHolder1').innerHTML="<a href='#'><img src='http://data3.whicdn.com/images/161465572/large.jpg' style='max-width:40%' align='center'  border='0'/></a>";
 break;
 
case "picture3":
  document.getElementById('imageHolder1').innerHTML="<a href='#'><img src='http://photo.qwled.com/media/images/0cb8be4c21.jpg' style='max-width:40%'  border='0'/></a>";
 break;
case "picture4":
  document.getElementById('imageHolder1').innerHTML="<a href='#'><img src='http://data1.whicdn.com/images/155320422/large.jpg' style='max-width:40%'  border='0'/></a>";
 break;
case "picture5":
  document.getElementById('imageHolder1').innerHTML="<a href='#'><img src='http://love-messages.cc/images/img_1/0088c3faa6ed9fd596312edabae36afe.jpg' style='max-width:40%'  border='0'/></a>";
 break;

}

$('#image_to_be_replaced').attr('src',dynamic_src);
}


//-->
</script>

</body>
</html>
