<?php
include_once("php_includes/check_login_status.php");
if($user_ok != true)
{
	header("location: index.php");
	exit();
}
?>
<?php
$friends = "";
$friends_name = array();
$sql = "select id from friends where user2='$login_username' or user1='$login_username'";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows($query);
if($num < 1)
{
	$friends = "You have no friends";
}
else
{
	$sql = "select user1 from friends where user2='$login_username'";
	$query = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_row($query))
	{
		array_push($friends_name, $row[0]);
	}
	$sql = "select user2 from friends where user1 = '$login_username'";
	$query = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_row($query))
	{
		array_push($friends_name, $row[0]);
	}
	$friends_count = count($friends_name);
	$friends .= "<ul>";
	foreach($friends_name as $name)
	{
		$sql = "select * from users where username = '$name' limit 1";
		$query = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
		{
			$username = $row["username"];
			$avatar = $row["avatar"];
			if($avatar!="")
			{
				$pic_path = "user/$username/$avatar";
			}
			else
			{
				$pic_path = "images/avatarDefault.JPG";
			}
			$friends .= 
			"<li>
				<span>
				   <a href='user.php?u=$username'><img src='$pic_path' height='30px' width='30px' /></a>
				</span>
				<span class='my_info'>
				   <a href='user.php?u=$username' class='userName'>$username</a>
				</span>
				<span class='info'>
				   <a href='chat.php?buddy=$username'><i class='fa fa-comment'></i></a>
				</span>
			</li>";
		}
	}
	$friends .= "</ul>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Friends</title>
	<link rel="stylesheet" type="text/css" href="styles/font-awesome.css" />
    <link rel="stylesheet" href="styles/style.css" />
    <style>
      .friend_list > ul
      {
      	list-style-type: none;
      }
      .friend_list > ul > li
      {
      	margin-top: 10px;
      }
      .friend_list > ul > li > span
      {
      	margin-left: 5px;
      	margin-right: 5px;
      }
      .userName:link
      {
      	text-decoration: none;
      	color:#777;
      }
      .userName:hover
      {
      	text-decoration: none;
      	color:#777;
      }
      .userName:visited
      {
      	text-decoration: none;
      	color:#777;
      }
      .my_info
      {
      }
    </style>
</head>
<body>
<?php
include 'template_top.php'; 
?>
   <div class="middle">
     <div class="friend_list">
      <?php echo $friends ?>
     </div>
   </div>

<?php
include 'template_bottom.php';
?>
</body>
</html>