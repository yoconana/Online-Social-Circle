<meta name="viewport" content="width=device-width, initial-scale=1" />
<html>
<head>
<style>

	fieldset{width:400px; margin: 0 auto;}
	
    legend{font-weight:bold; font-size:24px;}
	
    label{float:left; width:140px; margin-left:10px;}
    .left{margin-left:150px;}
    .input{width:150px;}
	
    span{color: #666666;}

#header {
    background-color:#003366;
    color:white;
    text-align:center;
    padding:5px;
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
<li><a href="registerPage.php">Register</a></li>
</ul>
</div> 

<div id="header">
<h1>Online Social Circle</h1>
</div>


<div id="section">

<fieldset>
<legend>User Login</legend>
    <form name="LoginForm" method="post" action="logincheck.php" onSubmit="return InputCheck(this)">
		<p>
		<label for="email" class="label">E-mail Address:</label>
		<input id="email" name="email" type="text" class="input" />
		<span>*</span>
		<p/>
		
		<p>
		<label for="password" class="label">Password: </label>
		<input id="password" name="password" type="password" class="input" />
		<span>*</span>
		<p/>
		
		<p>
		<input type="submit" name="submit" value="  Submit  " class="left" />
		</p>
	</form>
			
</fieldset>
</div>

<!--<div id="footer">
DATABASE SYSTEMS PROJECRT 
</div>-->

<script language=JavaScript>
<!--

function InputCheck(LoginForm)
{
   if (LoginForm.email.value == "")
  {
    alert("E-mail Address cannot be empty!");
    LoginForm.email.focus();
    return (false);
  }
  if (LoginForm.password.value == "")
  {
    alert("Password cannot be empty!");
    LoginForm.password.focus();
    return (false);
  }
}

//-->
</script>

</body>
</html>

