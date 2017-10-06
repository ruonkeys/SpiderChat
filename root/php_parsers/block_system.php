<?php
include_once("../php_includes/check_login_status.php");
if($user_ok != true || $login_username == "") 
{
	exit();
}
?>
<?php
if (isset($_POST['type']) && isset($_POST['blockee']))
{
	$blockee = preg_replace('#[^a-z0-9]#i', '', $_POST['blockee']);
	$sql = "select COUNT(id) from users where username='$blockee' and activated='1' limit 1";
	$query = mysqli_query($conn, $sql);
	$exist_count = mysqli_fetch_row($query);
	if($exist_count[0] < 1)
	{
		mysqli_close($conn);
		echo "$blockee does not exist.";
		exit();
	}
	$sql = "select id from blockedusers where blocker='$login_username' and blockee='$blockee' limit 1";
	$query = mysqli_query($conn, $sql);
	$numrows = mysqli_num_rows($query);
	if($_POST['type'] == "block")
	{
	    if ($numrows > 0) 
	    {
			mysqli_close($conn);
	        echo "You already have this member blocked.";
	        exit();
	    } 
	    else 
	    {
			$sql = "insert into blockedusers(blocker, blockee, blockdate) values('$login_username','$blockee',now())";
			$query = mysqli_query($conn, $sql);
			mysqli_close($conn);
	        echo "blocked_ok";
	        exit();
		}
	} 
	else if($_POST['type'] == "unblock")
	{
	    if ($numrows == 0) 
	    {
		    mysqli_close($conn);
	        echo "You do not have this user blocked, therefore we cannot unblock them.";
	        exit();
	    } 
	    else 
	    {
			$sql = "delete from blockedusers where blocker='$login_username' and blockee='$blockee' limit 1";
			$query = mysqli_query($conn, $sql);
			mysqli_close($conn);
	        echo "unblocked_ok";
	        exit();
		}
	}
}
?>