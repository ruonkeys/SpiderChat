<?php
if(isset($_POST['e']))
{
	include "php_includes/db_conn.php";
	$e = $_POST['e'];
	$sql = "select id,username from users where email='$e' and activated='1' limit 1";
	$query = mysqli_query($conn,$sql);
	$num = mysqli_num_rows($query);
	if($num > 0)
	{
		while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
		{
			$id=$row['id'];
			$u=$row['username'];
		}
		$emailcut = substr($e, 0, 4);
		$randNum = rand(10000,99999);
		$temp_pass = $emailcut.$randNum;
		$sql = "update useroptions set temp_pass='$temp_pass' where username='$u' LIMIT 1";
	    $query = mysqli_query($conn, $sql);

	    echo "success,".$temp_pass;
	}
	else
	{
		echo "no_exist";
	}
	exit();
}
?>