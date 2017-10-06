<?php
if(isset($_POST['usernamecheck']))
{
	include_once("php_includes/db_conn.php");
	$username = preg_replace('#[^a-z 0-9]#i', '', $_POST['usernamecheck']);
	$sql = "select id from users where username='$username' limit 1";
	$query = mysqli_query($conn, $sql);
	$uname_check = mysqli_num_rows($query);
	if(strlen($username)<3||strlen($username)>16)
	{
		echo "<strong style='color:#f00'>3-16 characters please</strong>";
		exit();
	}
	if(is_numeric($username[0]))
	{
		echo "<strong style='color:#f00'>Username must begin with a letter</strong>";
		exit();
	}
	if($uname_check<1)
	{
		echo "<strong style='color:#f00'>Username ".$username." is OK</strong>";
		exit();
	}
	else
	{
		echo "<strong style='color:#f00'>Username ".$username." is taken</strong>";
		exit();
	}
}
?>

