<?php
$server_name="localhost";
$user_name="root";
$password="";
$db_name="spiderchat";
$conn=mysqli_connect($server_name,$user_name,$password,$db_name);
if(mysqli_connect_errno())
{
	echo mysqli_connect_error();
}
?>