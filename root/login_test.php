<?php
include_once("php_includes/check_login_status.php");
if($user_ok==true)
{
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SpiderChat-logIn</title>
	<link rel="stylesheet" type="text/css" href="styles/font-awesome.css" />
	<link rel="stylesheet" href="styles/style.css"/>

	<style>
			.formWrap
			{
				padding-top: 15px;
			}
	        .formWrap
			{
				width:800px;
				margin:0px auto;
			}
        	.formInp
			{
				border:1px solid #4C4C4C;
				border-radius:2px;
				height:30px;
				width:200px;
			}
			#logInBtn
			{
				padding:10px;
	            background-color: #f1f1f1;
	            border:none;
	            border-radius:4px;
	            border: 1px solid #880e4f;
			}
			#logInBtn:hover
			{
	            background-color: #fde3ec;
			}
	</style>
     <script type="text/javascript" src="js/main.js"></script>
     <script type="text/javascript" src="js/ajax.js"></script>
	 <script>
	function logIn()
	{
		var e = _("email").value;
		var p = _("password").value;
		if(e==""||p=="")
		{
			_("status").innerHTML="Please fill all the fields";
		}
		else
		{
			_("logInBtn").style.display="none";
			_("status").innerHTML="Please wait...";
			var ajax = ajaxObj("POST","loginValidate.php");

			ajax.onreadystatechange =  function()
			{
				if(ajaxReturn(ajax))
				{
					if(ajax.responseText=="login failed")
					{
						_("status").innerHTML = "login failed try again...";
						_("logInBtn").style.display = "block";
					}
					else
					{
						window.location = "user.php?u="+ajax.responseText;
					}
				}
			}
			ajax.send("e="+e+"&p="+p);
		}
	}
	function colorChange()
	{
		_("logInBtn").style.backgroundColor="red";
	}
	function colorNormal()
    {
    	_("logInBtn").style.backgroundColor="#fde3ec";
    }
	</script>
</head>
<body>
<?php include_once('template_top.php'); ?>

<div class="middle">
   <div class="formWrap">
      <form id="loginform" onsubmit="return false;">
      <div>Email:</div>
      <input type="text" id="email" class="formInp" onfocus="emptyElement('status')"/><br><br>
      <div>Password:</div>
      <input type="password" id="password" class="formInp" onfocus="emptyElement('status')"/><br><br>
      <button id="logInBtn" onclick="logIn()" onmousedown="colorChange()" onmouseup="colorNormal()">LogIn</button>
      <p id="status"></p><br>
      <a href="forgot_pass.php">Forgot Password</a>
      </form>
   </div>
</div>

<?php include_once('template_bottom.php'); ?>
</body>
</html>