<?php
if(isset($_POST['e']))
{
	include_once('php_includes/db_conn.php');
	$e=mysqli_real_escape_string($conn,$_POST['e']);
	$p=$_POST['p'];
	$ip=preg_replace("#[^0-9.]#", "", getenv('REMOTE_ADDR'));

	if($e==""||$p=="")
	{
		echo "login failed";
		exit();
	}
	else
	{
		$sql = "select id,username,password from users where email='$e' limit 1";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_row($result);
		$db_id = $row[0];
		$db_u = $row[1];
		$db_p = $row[2];
		if($p!=$db_p)
		{
			echo "login failed";
			exit();
		}
		else
		{
			//setting session
			$_SESSION['username'] = $db_u;
			$_SESSION['password'] = $db_p;
			$_SESSION['id'] = $db_id;
			//setting cookies
			setcookie("password",$db_p,strtotime("+15 days"),"/");
			setcookie("username",$db_u,strtotime("+15 days"),"/");
			setcookie("id",$db_id,strtotime("+15 days"),"/");

			$sql = "update users set ip='$ip', lastlogin=now() where username='$db_u' limit 1";
			$query = mysqli_query($conn, $sql);
			echo $db_u;
			exit();
		}
	}
	exit();
}
?>