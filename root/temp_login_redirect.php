<?php
if(isset($_GET['tp']))
{
	include "php_includes/db_conn.php";
	$tp = preg_replace('#[^a-z0-9]#i', '', $_GET['tp']);
	if(strlen($tp)<9)
	{
		exit();
	}
	$sql = "select id from useroptions where temp_pass='$tp' limit 1";
	$query = mysqli_query($conn, $sql);
	$numrows = mysqli_num_rows($query);
	if($numrows == 0){
		header("location: message.php?msg=There is no match for that username with that temporary password in the system. We cannot proceed.");
    	exit();
	} else {
		$row = mysqli_fetch_row($query);
		$id = $row[0];
		$sql = "update users set password='$tp' where id='$id' limit 1";
	    $query = mysqli_query($conn, $sql);
		$sql = "update useroptions set temp_pass='' where id='$id' LIMIT 1";
	    $query = mysqli_query($conn, $sql);
	    header("location: login_test.php");
        exit();
    }
}
?>