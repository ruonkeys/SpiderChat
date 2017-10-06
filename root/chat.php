<?php
 include_once('php_includes/check_login_status.php');
 if($user_ok != true)
 {
 	header('location: index.php');
 } 
?>
<?php
if(isset($_GET['buddy']))
{
	$buddy = preg_replace("#[^0-9a-zA-Z]#i", "", $_GET['buddy']);
}
else
{
	header('location: index.php');
}
?>
<?php
$all_chat = "";
$sql = "select * from chat where account_owner='$login_username' and buddy='$buddy' or account_owner='$buddy' and buddy='$login_username' order by date_time asc";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows($query);
if($num > 0)
{
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
	{
		$msg_id = $row["id"];
		$account_holder = $row["account_owner"];
		$buddy_name = $row["buddy"];
		$chat_msg = $row["message"];
		if($account_holder == $login_username)
		{
			$all_chat .= "<div id=\"msg_\"".$msg_id." class=\"msg_box_o\">".$chat_msg."</div>";
		}
		else if($account_holder == $buddy)
		{
			$all_chat .= "<div id=\"msg_\"".$msg_id." class=\"msg_box_f\">".$chat_msg."</div>";
		}
	}
}
else
{
	$all_chat .= "<div id=\"empty_dsgn\">Say something to $buddy</div>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Let's Chat</title>
	<link rel="stylesheet" type="text/css" href="styles/font-awesome.css" />
    <link rel="stylesheet" href="styles/style.css" />
    <style>
      #msg
      {
      	height: 50px;
      	width: 985px;
        resize: none;
      }
      #chat_ui
      {
      	height: 400px;
      	width: 100%;
      	background-color: #fde3ec;
      	overflow-x: scroll;
      }
      .chat_wrap
      {
      	border-radius: 5px;
      	border: 2px solid #7f345a;
      	box-shadow: 0 0 5px #000;
      }
      .msg_box_o
      {
      	background-color: #4CAF50;
      	border-radius: 6px;
      	width: 65%;
      	margin-left: 320px;
      	padding-left: 20px;
      	padding-top: 10px;
      	padding-bottom: 10px;
      	margin-top: 20px;
      }
      .msg_box_f
      {
      	background-color: #fff;
      	border-radius: 6px;
      	width: 65%;
      	margin-left: 8px;
      	padding-left: 20px;
      	padding-top: 10px;
      	padding-bottom: 10px;
      	margin-top: 10px;
      	margin-bottom: 10px;
      }
      #empty_dsgn
      {
      	color: #e2e2e2;
      	text-align: center;
      	padding: 100px;
      }
      #sendBtn
      {
      	padding: 5px;
      	background-color: #00bfe7;
      	font-size: 15px;
      	color: #fff;
      	border-radius: 5px;
      	border: none;
      	margin-left:5px;
      	margin-bottom: 5px;
      	margin-top: 5px;
      }
    </style>
    <script src="js/main.js"></script>
    <script src="js/ajax.js"></script>
    <script>
        //setInterval(fetchId, 1000);
        //setInterval(checkIdChange, 2000);
        // function fetchId()
        // {
        // 	<?php
        // 	 $sql = "select id,date_time from chat where account_owner='$buddy' and buddy='$login_username' order by date_time desc limit 1";
        // 	 $query = mysqli_query($conn,$sql);
        // 	 $row = mysqli_fetch_row($query);
        // 	 $last_id = $row[0];
        // 	 $last_msg_date = $row[1];
        // 	?>
        // }
     //    function checkIdChange()
     //    {
     //    	<?php
     //    	 $sql = "select id from chat where account_owner='$buddy' and buddy='$login_username' order by date_time desc limit 1";
     //    	 $query = mysqli_query($conn,$sql);
     //    	 $row = mysqli_fetch_row($query);
     //    	 $change_id = $row[0];
     //    	 if($last_id != $change_id)
     //    	 {
     //    	 	$sql = "select * from chat where account_owner='$buddy' and buddy='$login_username' and date_time > '$last_msg_date' order by date_time asc";
     //    	 	$query = mysqli_query($conn,$sql);
     //    	 	while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
     //    	 	{
     //    	 		$c_msg_id = $row["id"];
					// $c_account_holder = $row["account_owner"];
					// $c_buddy_name = $row["buddy"];
					// $c_chat_msg = $row["message"];

					// if($c_account_holder == $buddy)
					// {?>
					// 	_("chat_ui").innerHTML += "<div id=\"msg_\""+'<?php //echo $c_msg_id; ?>'" class=\"msg_box_f\">"+c_chat_msg+"</div>";
			  //  <?php}
     //    	 	}
     //    	 	$last_id = $change_id;
     //    	 }
     //    	?>
     //    }
    	function sendMsg(buddy,ta)
    	{
    		var msg = _(ta).value;
    		if(msg == "")
    		{
    			alert("Type something first weenis");
    			return false;
    		}
    		_("sendBtn").disabled = true;
    		var ajax = ajaxObj("POST", "php_parsers/msg_system.php");
    		ajax.onreadystatechange = function()
    		{
    			if(ajaxReturn(ajax) == true)
    			{
    				var dataArr = ajax.responseText.split("|");
    				if(dataArr[0]=="send_ok")
    				{
    					var mid = dataArr[1];
    					var currentHTML = _("chat_ui").innerHTML;
    					_("chat_ui").innerHTML = currentHTML+"<div id=\"msg_\""+mid+" class=\"msg_box_o\">"+msg+"</div>";
    					_("sendBtn").disabled = false;
    					_(ta).value = "";
    					_("empty_dsgn").style.display = "none";
    				}
    				else
	    			{
	    				alert(ajax.responseText);
	    			}
    			}
    		}
    		ajax.send("action=send_msg&buddy="+buddy+"&msg="+msg);
    	}
    </script>
</head>
<body>
<?php
include 'template_top.php'; 
?>

<div class="middle">
<div class="chat_wrap">
	<div id="chat_ui"><?php echo $all_chat; ?></div>
	<div class="chat_box">
		<textarea id="msg" placeholder="Enter your message"></textarea>
		<button id="sendBtn" onclick="sendMsg('<?php echo $buddy; ?>','msg')">send</button>
	</div>
</div>
</div>

<?php
include 'template_bottom.php';
?>
</body>
</html>