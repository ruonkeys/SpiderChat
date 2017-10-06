<?php
include_once("../php_includes/check_login_status.php");
if($user_ok != true || $login_username=="")
{
	exit();
}
?>
<?php
if(isset($_POST['action']) && isset($_POST['buddy']) && isset($_POST['msg']) && $_POST['action'] == "send_msg")
{
	$buddy = $_POST['buddy'];
	$msg = htmlentities($_POST['msg']);
	if(strlen($msg)<1)
	{
		echo "message empty";
		mysqli_close($conn);
		exit();
	}
	$sql = "select id from users where username='$buddy' limit 1";
	$query = mysqli_query($conn,$sql);
	$num = mysqli_num_rows($query);
	if($num < 1)
	{
		echo "account_not_exist";
		mysqli_close($conn);
		exit();
	}
	$sql = "insert into chat (account_owner,buddy,date_time,message) values ('$login_username','$buddy',now(),'$msg')";
	mysqli_query($conn,$sql);
	$sql = "select id from chat where account_owner='$login_username' and buddy='$buddy' order by date_time asc limit 1";
	$query = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($query);
	$id = $row[0];
	echo "send_ok|$id";
}
?>