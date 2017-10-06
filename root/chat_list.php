<?php
include_once("php_includes/check_login_status.php");
if($user_ok != true)
{
	header("location: index.php");
	exit();
}
?>
<?php
$chat_list = "";
$sql = "select distinct buddy from chat where account_owner='$login_username'";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows($query);
if($num < 1)
{
	$chat_list = "<div class='msg'>You have not messaged to any of your buddy</div>";
}
else
{
	$chat_name = array();
	while($row = mysqli_fetch_row($query))
	{
		array_push($chat_name, $row[0]);
	}
	$chat_list = "<ul>";
	foreach($chat_name as $chat_person)
	{
		$sql = "select * from users where username='$chat_person' limit 1";
		$query = mysqli_query($conn, $sql);
		$per = mysqli_fetch_array($query,MYSQLI_ASSOC);
		$pic = $per["avatar"];
		if($pic != null)
		{
			$pic = "<img src=\"user/$chat_person/$pic\" height='30px' width='30px'/>";
		}
		else
		{
			$pic = "<img src=\"images/avatarDefault.JPG\" height='30px' width='30px'/>";
		}
		$chat_list .= 
		"<li>
		 <span>$pic</span>
		 <span><a href='chat.php?buddy=$chat_person'>$chat_person</a></span>
		 </li>";
	}
	$chat_list .= "</ul>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>ChatList</title>
	<link rel="stylesheet" type="text/css" href="styles/font-awesome.css" />
    <link rel="stylesheet" href="styles/style.css" />
    <script src="js/ajax.js"></script>
    <script src="js/main.js"></script>
    <style>
    .msg
    {
    	text-align: center;
    	padding-top: 40px;
    	color: #e2e2e2;
    }
    .my_list > ul
    {
    	list-style-type: none;
    }
    </style>
</head>
<body>
<?php
include_once("template_top.php");
?>

<div class="middle">
<h3>Your chat list</h3>
<div class="my_list"><?php echo $chat_list; ?></div>
</div>

<?php
include_once("template_bottom.php");
?>

</body>
</html>