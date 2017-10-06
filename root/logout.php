<?php
session_start();

$_SESSION = array();

if(isset($_COOKIE['id']) || isset($_COOKIE['username']) || isset($_COOKIE['password']))
{
	setcookie("id","",strtotime("-5 days"),"/");
	setcookie("username","",strtotime("-5 days"),"/");
	setcookie("password","",strtotime("-5 days"),"/");
}

session_destroy();

if(isset($_SESSION['username']))
{
	header("location: message.php?msg=ERROR_log out failed");
}
else
{
	header("location: index.php");
	exit();
}
?>