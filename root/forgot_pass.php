<?php
include "php_includes/check_login_status.php";
if($user_ok==true)
{
	header("location: user.php?u="+$_SESSION['username']);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>forgot password</title>
	   <link rel="stylesheet" type="text/css" href="styles/font-awesome.css" />
        <link rel="stylesheet" href="styles/style.css" />
        <style>
        	.formInp
			{
				border:1px solid #4C4C4C;
				border-radius:4px;
				height:30px;
				width:250px;
			}
			#forgotpassbtn
			{
				padding:10px;
	            background-color:#900;
	            color:#fff;
	            border:none;
	            border-radius:4px;
			}
			#forgotpassbtn:hover
			{
	            font-size:16px;
			}
        </style>
	<script src="js/main.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/fade_effects.js"></script>
    <script>
     function colorChange()
	{
		_("forgotpassbtn").style.backgroundColor="red";
	}
    function forgot()
    {
    	var e = _("email").value;
    	if(e=="")
    	{
    		_("status").innerHTML="Please enter your email address";
    	}
    	else
    	{
    		_("forgotpassbtn").style.display="none";
    		_("status").innerHTML="Please wait...";
    		var ajax = ajaxObj("POST","temp_pass_gen.php");
    		ajax.onreadystatechange = function()
    		{
    			if(ajaxReturn(ajax))
    			{
    				var response = ajax.responseText;
    				//alert(response);
    				if(response.split(",")[0]=="success")
    				{
    					 var arr = response.split(",");
    					 var tp = arr[1];
    					 _("forgotpassform").innerHTML="<h2>Your temporary password is: </h2>"+tp;
    					 _("forgotpassform").innerHTML+="<a href=\"temp_login_redirect.php?tp="+tp+"\">click here to login with temporary password</a>";
    				}
    				else if(response == "no_exist")
    				{
    					_("status").innerHTML="EmailId entered by you is incorrect, Please try again";
    					_("forgotpassbtn").style.display="block";
    				}
    				else
    				{
    					_("status").innerHTML="An unknown error occured";
    				}
    			}
    		}
    		ajax.send("e="+e);
    	}
    }
    function colorNormal()
    {
    	_("forgotpassbtn").style.backgroundColor="#900";
    }
   
    </script>
</head>
<body>
<?php include_once("template_top.php"); ?>
<div class="middle">
	<form id="forgotpassform" onsubmit="return false;">
	<div><b>Step 1:</b></div>
	<div>Enter your email:</div>
	<input type="text" id="email" class="formInp" onfocus="_('status').innerHTML='';" /><br><br>
	<button id="forgotpassbtn" onclick="forgot()" onmousedown="colorChange()" onmouseup="colorNormal()">Generate temporary login password</button>
	<p id="status"></p>
	</form>
</div>
<?php include_once("template_bottom.php"); ?>
</body>
</html>