<?php
#Cron jobs to automate site maintenance

require_once("../php_includes/db_conn.php");
//this block deletes all accounts that do not activate after 3 days 
$sql = "select id,username from users where signup<=CURRENT_DATE - INTERVAL 3 DAY and activated='0'";
$query = mysqli_query($conn,$sql);
$num = mysqli_num_rows($query);
if($num > 0)
{
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
	{
		$id = $row['id'];
		$username = $row['username'];
		// $userFolder = "../user/$username";
		// if(is_dir($userFolder))
		// {
		// 	rmdir($userFolder);
		// }

		$sql = "delete from users where id='$id' and username='$username' and activated='0' limit 1";
		mysqli_query($conn, $sql);
		$sql = "delete from useroptions where username='$username' limit 1";
		mysqli_query($conn, $sql);
	}
}
?>