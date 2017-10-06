<?php
include_once("php_includes/check_login_status.php");
?>
<!doctype html>
<html>
<head>
<title>SpiderChat-HomePage</title>
<link rel="stylesheet" type="text/css" href="styles/font-awesome.css" />
<link rel="stylesheet" href="styles/style.css" />
</head>
<body>

<?php
include 'template_top.php'; 
?>

<div class="middle">
<h1 style="color: #880e4f; font-family: \"Comic Sans MS\", cursive, sans-serif">Welcome To SpiderChat</h1>
<?php
include_once("php_includes/db_conn.php");
$sql = "select id,username from users where activated='1' order by rand()";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
if($num > 0)
{
	$mem_list = "<ul>";
	while($row = mysqli_fetch_row($result))
	{
		$mem_list .= "<li><a href=\"user.php?u=$row[1]\">$row[1]</a></li>";
	}
	$mem_list .= "</ul>";
	echo "<h3>Users in System</h3>";
	echo $mem_list;
}
else
{
	echo "No users in our system";
}
?>
</div>

<?php
include 'template_bottom.php';
?>
</body>
</html>