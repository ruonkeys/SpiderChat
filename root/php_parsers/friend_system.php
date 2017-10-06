<?php
include_once("../php_includes/check_login_status.php");
if($user_ok != true || $login_username == "") {
	exit();
}
?>
<?php
if (isset($_POST['type']) && isset($_POST['user'])){
	$user = preg_replace('#[^a-z0-9]#i', '', $_POST['user']);
	$sql = "select count(id) from users where username='$user' and activated='1' limit 1";
	$query = mysqli_query($conn, $sql);
	$exist_count = mysqli_fetch_row($query);
	if($exist_count[0] < 1){
		mysqli_close($conn);
		echo "$user does not exist.";
		exit();
	}
	if($_POST['type'] == "friend")
	{
		$sql = "select count(id) from friends where user1='$user' and accepted='1' OR user2='$user' and accepted='1'";
		$query = mysqli_query($conn, $sql);
		$friend_count = mysqli_fetch_row($query);
		$sql = "select count(id) from blockedusers where blocker='$user' and blockee='$login_username' limit 1";
		$query = mysqli_query($conn, $sql);
		$blockcount1 = mysqli_fetch_row($query);
		$sql = "select count(id) from blockedusers where blocker='$login_username' and blockee='$user' limit 1";
		$query = mysqli_query($conn, $sql);
		$blockcount2 = mysqli_fetch_row($query);
		$sql = "select count(id) from friends where user1='$login_username' and user2='$user' and accepted='1' limit 1";
		$query = mysqli_query($conn, $sql);
		$row_count1 = mysqli_fetch_row($query);
		$sql = "select count(id) from friends where user1='$user' and user2='$login_username' and accepted='1' limit 1";
		$query = mysqli_query($conn, $sql);
		$row_count2 = mysqli_fetch_row($query);
		$sql = "select count(id) from friends where user1='$login_username' and user2='$user' and accepted='0' limit 1";
		$query = mysqli_query($conn, $sql);
		$row_count3 = mysqli_fetch_row($query);
		$sql = "select count(id) from friends where user1='$user' and user2='$login_username' and accepted='0' limit 1";
		$query = mysqli_query($conn, $sql);
		$row_count4 = mysqli_fetch_row($query);
	    if($friend_count[0] > 99)
	    {
            mysqli_close($conn);
	        echo "$user currently has the maximum number of friends, and cannot accept more.";
	        exit();
        } 
        else if($blockcount1[0] > 0)
        {
            mysqli_close($conn);
	        echo "$user has you blocked, we cannot proceed.";
	        exit();
        } 
        else if($blockcount2[0] > 0)
        {
            mysqli_close($conn);
	        echo "You must first unblock $user in order to friend with them.";
	        exit();
        } 
        else if ($row_count1[0] > 0 || $row_count2[0] > 0) 
        {
		    mysqli_close($conn);
	        echo "You are already friends with $user.";
	        exit();
	    } 
	    else if ($row_count3[0] > 0) 
	    {
		    mysqli_close($conn);
	        echo "You have a pending friend request already sent to $user.";
	        exit();
	    } 
	    else if ($row_count4[0] > 0) 
	    {
		    mysqli_close($conn);
	        echo "$user has requested to friend with you first. Check your friend requests.";
	        exit();
	    }
	    else 
	    {
	        $sql = "insert into friends(user1, user2, datemade) values('$login_username','$user',now())";
		    $query = mysqli_query($conn, $sql);
			mysqli_close($conn);
	        echo "friend_request_sent";
	        exit();
		}
	} 
	else if($_POST['type'] == "unfriend")
	{
		$sql = "select count(id) from friends where user1='$login_username' and user2='$user' and accepted='1' limit 1";
		$query = mysqli_query($conn, $sql);
		$row_count1 = mysqli_fetch_row($query);
		$sql = "select count(id) from friends where user1='$user' and user2='$login_username' and accepted='1' limit 1";
		$query = mysqli_query($conn, $sql);
		$row_count2 = mysqli_fetch_row($query);
	    if ($row_count1[0] > 0) 
	    {
	        $sql = "delete from friends where user1='$login_username' and user2='$user' and accepted='1' limit 1";
			$query = mysqli_query($conn, $sql);
			mysqli_close($conn);
	        echo "unfriend_ok";
	        exit();
	    }
	    else if ($row_count2[0] > 0) 
	    {
			$sql = "delete from friends where user1='$user' and user2='$login_username' and accepted='1' limit 1";
			$query = mysqli_query($conn, $sql);
			mysqli_close($conn);
	        echo "unfriend_ok";
	        exit();
	    } 
	    else 
	    {
			mysqli_close($conn);
	        echo "No friendship could be found between your account and $user, therefore we cannot unfriend you.";
	        exit();
		}
	}
}
?>
<?php
if (isset($_POST['action']) && isset($_POST['reqid']) && isset($_POST['user1'])){
	$reqid = preg_replace('#[^0-9]#', '', $_POST['reqid']);
	$user = preg_replace('#[^a-z0-9]#i', '', $_POST['user1']);
	$sql = "SELECT COUNT(id) FROM users WHERE username='$user' AND activated='1' LIMIT 1";
	$query = mysqli_query($conn, $sql);
	$exist_count = mysqli_fetch_row($query);
	if($exist_count[0] < 1){
		mysqli_close($conn);
		echo "$user does not exist.";
		exit();
	}
	if($_POST['action'] == "accept"){
		$sql = "SELECT COUNT(id) FROM friends WHERE user1='$login_username' AND user2='$user' AND accepted='1' LIMIT 1";
		$query = mysqli_query($conn, $sql);
		$row_count1 = mysqli_fetch_row($query);
		$sql = "SELECT COUNT(id) FROM friends WHERE user1='$user' AND user2='$login_username' AND accepted='1' LIMIT 1";
		$query = mysqli_query($conn, $sql);
		$row_count2 = mysqli_fetch_row($query);
	    if ($row_count1[0] > 0 || $row_count2[0] > 0) {
		    mysqli_close($conn);
	        echo "You are already friends with $user.";
	        exit();
	    } else {
			$sql = "UPDATE friends SET accepted='1' WHERE id='$reqid' AND user1='$user' AND user2='$login_username' LIMIT 1";
			$query = mysqli_query($conn, $sql);
			mysqli_close($conn);
	        echo "accept_ok";
	        exit();
		}
	} else if($_POST['action'] == "reject"){
		mysqli_query($conn, "DELETE FROM friends WHERE id='$reqid' AND user1='$user' AND user2='$login_username' AND accepted='0' LIMIT 1");
		mysqli_close($conn);
		echo "reject_ok";
		exit();
	}
}
?>