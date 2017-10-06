<?php
include_once("php_includes/check_login_status.php");
if($user_ok == true)
{
	header("location:index.php");
}
?>
<!doctype html>
<html>
<head>
<title>SpiderChat-SignUp</title>
<link rel="stylesheet" type="text/css" href="styles/font-awesome.css" />
<link rel="stylesheet" href="styles/style.css" />

<style>
.formWrap
{
	width:800px;
	margin:0px auto;
}
.heading
{
	padding-top:15px;
}
.formInp
{
	border:1px solid #4C4C4C;
	border-radius:4px;
	height:30px;
	width:200px;
}
.formList
{
	border:1px solid #4C4C4C;
	border-radius:4px;
	height:30px;
	width:150px;
}
#signUpBtn
{
	padding:10px;
	background-color:#f1f1f1;
	border:none;
	border-radius:4px;
}
#signUpBtn:hover
{
	background-color: #fde3ec;
}
</style>

<script src="js/main.js"></script>
<script src="js/ajax.js"></script>
<script src="js/fade_effects.js"></script>
<script>
function restrict(element)
{
	var x=_(element);
	var rx=new RegExp;
	if(element=="username")
	{
		rx=/[^a-z 0-9]/gi;
	}
	else if(element=="email")
	{
		rx=/[' "]/gi;	
	}
	x.value = x.value.replace(rx,"");
}
// function emailRegChk()
// {
// 	var emailValue = _("email").value;
// 	var rx = new RegExp;
// 	rx = /^[a-z0-9]@[a-z]\.(com|org|co\.in|\.in)$/g;
// 	if(rx.test(emailValue)==false)
// 	{
// 		_("emailChkStatus").innerHTML = "invalid email id";
// 	}
// }
function emptyElement(ele)
{
	_(ele).innerHTML="";
}
function checkUserName()
{
	var u = _("username").value;
	if(u!="")
	{
		_("unamestatus").innerHTML="checking....";
		var ajax = ajaxObj("POST", "signUpChk.php");
		
		ajax.onreadystatechange = function()
		{
			if(ajaxReturn(ajax))
			{
				_("unamestatus").innerHTML=ajax.responseText;
			}
		}
		ajax.send("usernamecheck="+u);
	}
}
function signUp()
{
	var u = _("username").value;
	var e = _("email").value;
	var p1 = _("pass1").value;
	var p2 = _("pass2").value;
	var g = _("gender").value;
	var c = _("country").value;
	
	if(u==""||e==""||p1==""||p2==""||g==""||c=="")
	{
		_("status").innerHTML="Please fill all the fields";
	}
	else if(p1!=p2)
	{
		_("status").innerHTML="Your passwords are not matching";
	}
	else if(_("terms").style.display=="none")
	{
		_("status").innerHTML="View terms and conditions first";
	}
	else
	{
		_("signUpBtn").style.display="none";
		_("status").innerHTML="Please wait...";
		var ajx = ajaxObj("POST","signChk.php");
		
		ajx.onreadystatechange = function()
		{
			if(ajaxReturn(ajx))
			{
				//console.log(ajx.responseText);
				if(ajx.responseText!="signUp success")
				{
					_("signUpBtn").style.display="block";
					_("status").innerHTML=ajx.responseText;
					//alert("i am if block"+ajx.responseText);
				}
				else
				{
					window.scrollTo(0,0);
					_("signupform").innerHTML="Hello! "+u+" <a href=\"activation.php?u="+u+"&e="+e+"&p="+p1+"&g="+g+"&c="+c+"\">click here to activate</a>" ;
				}
			}
		}
		ajx.send("u="+u+"&e="+e+"&p="+p1+"&c="+c+"&g="+g);
	}
}
	function openTerms()
	{
		_("terms").style.display="block";
	}
     function colorChange()
	{
		_("signUpBtn").style.backgroundColor="red";
	}
	function colorNormal()
    {
    	_("signUpBtn").style.backgroundColor="#fde3ec";
    }
</script>

</head>

<body>

<?php
include 'template_top.php'; 
?>

<div class="middle">
<div class="formWrap">
<div class="heading"><strong>Sign Up here:</strong></div><br>
<form id="signupform" name="signupform" onSubmit="return false;">
<div>UserName:</div>
<input type="text" id="username" class="formInp" maxlength="16" onKeyUp="restrict('username')" onBlur="checkUserName()" />
<span id="unamestatus"></span>
<br><br>
<div>Email:</div>
<input type="text" id="email" class="formInp" maxlength="88" onFocus="emptyElement('status')" onKeyUp="restrict('email')" />
<br><br>
<span id="emailChkStatus"></span>
<div>Create Password:</div>
<input type="password" id="pass1" class="formInp" onFocus="emptyElement('status')" />
<br><br>
<div>Confirm Password:</div>
<input type="password" id="pass2" class="formInp" onFocus="emptyElement('status')" />
<br><br>
<div>Gender:</div>
<select class="formList" id="gender" onFocus="emptyElement('status')">
  <option value=""></option>
  <option value="m">male</option>
  <option value="f">female</option>
</select><br><br>
<div>Country:</div>
<select class="formList" id="country" onFocus="emptyElement('status')">
  <option value=""></option>
  <option value="America">America</option>
  <option value="Australia">Australia</option>
  <option value="India">India</option>
</select><br /><br>
<a href="#" onClick="return false;" onMouseUp="openTerms()">View the terms of use</a>
<div id="terms" style="display:none">
   <br>
   -> be focused<br />
   -> beware of fake friends<br />
   -> never hesitate to block someone<br />
</div>
<br /><br />
<button id="signUpBtn" onClick="signUp()" onmousedown="colorChange()" onmouseup="colorNormal()">Create Account</button>
<span id="status"></span>
</form>
</div>
</div>

<?php
include 'template_bottom.php';
?>

</body>
</html>