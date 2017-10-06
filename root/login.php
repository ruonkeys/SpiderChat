
<!doctype html>
<html>
    <head>
        <title>logIn</title>
        <link rel="stylesheet" type="text/css" href="styles/font-awesome.css" />
        <link rel="stylesheet" href="styles/style.css" />
        <style type="text/css">
        body
		{
			background-color:#D0D0D0;
		}
        .formWrap
		{
			width:800px;
			margin:0px auto;
		}
        	.formInp
			{
				border:1px solid #4C4C4C;
				border-radius:4px;
				height:30px;
				width:200px;
			}
			#logInBtn
			{
				padding:10px;
	            background-color:#900;
	            color:#fff;
	            border:none;
	            border-radius:4px;
			}
			#logInBtn:hover
			{
				background-color:#906;
	            font-size:16px;
			}
			.pageMiddle
			{
				padding-top: 15px;
			}
        </style>

        <script src="js/main.js"></script>
		<script src="js/ajax.js"></script>
        <script src="js/fade_effects.js"></script>
        <script>
        function emptyElement(el)
        {
        	_(el).innerHTML="";
        }
        function logIn()
        {
        	alert();
        	var e = _("email").value;
        	var p = _("password").value;
        	if(e=""||p="")
        	{
        		_("status").innerHTML="Please fill all the fields";
        	}
        	else
        	{
        		_("logInBtn").style.display="none";
        		_("status").innerHTML="Please wait...";
        		var ajax=ajaxObj("POST","loginValidate.php");
        		ajax.onreadystatechange = function()
        		{
        			if(ajaxReturn(ajax))
        			{
        				if(ajax.responseText=="login failed")
        				{
        					_("status").innerHTML="Login failed, try again";
        					_("logInBtn").style.display="block";
        				}
        				else
        				{
        					window.location="user.php?u="+ajax.responseText;
        				}
        			}
        		}
        		ajax.send("e="+e+"&p="+p);
        	}
        }
        function test()
        {
            alert("i am working");
        }
        </script>

    </head>
    
    <body>

    <?php include 'template_top.php'; ?> 

    <div class="pageMiddle">
      <div class="formWrap">
        <form id="loginform" onSubmit="return false;">
            <div>Email:</div>
            <input type="text" id="email" class="formInp" onfocus="emptyElement('status')"/><br/><br/>
            <div>Password:</div>
            <input type="password" id="password" class="formInp" onfocus="emptyElement('status')"/><br/><br/>
            <button id="logInBtn" onClick="logIn()">LogIn</button>
            <p id="status"></p>
            <a href="#">Forgot Your Password?</a>
        </form>
      </div>
    </div>

    <?php include 'template_bottom.php'; ?>

    </body>
</html>


