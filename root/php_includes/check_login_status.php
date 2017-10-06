<?php
session_start();
include_once('db_conn.php');

$user_ok = false;
$login_id = "";
$login_username = "";
$login_password = "";

function eval_user($e_id,$e_username,$e_password,$e_conn)
{
	$sql = "select ip from users where id='$e_id' and username='$e_username' and password='$e_password' and activated='1' limit 1";
	$query = mysqli_query($e_conn,$sql);
	$num = mysqli_num_rows($query);
	if($num > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

if(isset($_SESSION['username']) || isset($_SESSION['id']) || isset($_SESSION['password']))
{
	$login_id = preg_replace("#[^0-9]#", "", $_SESSION['id']);
	$login_username = preg_replace('#[^0-9a-z]#i', "", $_SESSION['username']);
	$login_password = preg_replace('#[^0-9a-z./@$]#', "", $_SESSION['password']);
	$user_ok = eval_user($login_id,$login_username,$login_password,$conn);
}
else if(isset($_COOKIE['username']) || isset($_COOKIE['password']) || isset($_COOKIE['id']))
{
	$_SESSION['id'] = preg_replace("#[^0-9]#", "", $_COOKIE['id']);
	$_SESSION['username'] = preg_replace('#[^0-9a-z]#i', "", $_COOKIE['username']);
	$_SESSION['password'] = preg_replace('#[^0-9a-z./@$]#', "", $_COOKIE['password']);

	$login_id = $_SESSION['id'];
	$login_username = $_SESSION['username'];
	$login_password = $_SESSION['password'];

	$user_ok = eval_user($login_id,$login_username,$login_password,$conn);
}
if($user_ok == true)
{
	$sql = "update users set lastlogin = now() where id='$login_id' limit 1";
	$query = mysqli_query($conn, $sql);
}
?>