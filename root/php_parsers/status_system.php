<?php
include_once("../php_includes/check_login_status.php");
if($user_ok != true || $login_username == "") {
	exit();
}
?><?php
if (isset($_POST['action']) && $_POST['action'] == "status_post"){
	// Make sure post data is not empty
	if(strlen($_POST['data']) < 1){
		mysqli_close($conn);
	    echo "data_empty";
	    exit();
	}
	// Make sure type is either a or c
	if($_POST['type'] != "a" && $_POST['type'] != "c"){
		mysqli_close($conn);
	    echo "type_unknown";
	    exit();
	}
	// Clean all of the $_POST vars that will interact with the database
	$type = preg_replace('#[^a-z]#', '', $_POST['type']);
	$account_name = preg_replace('#[^a-z0-9]#i', '', $_POST['user']);
	$data = htmlentities($_POST['data']);
	$data = mysqli_real_escape_string($conn, $data);
	// Make sure account name exists (the profile being posted on)
	$sql = "SELECT COUNT(id) FROM users WHERE username='$account_name' AND activated='1' LIMIT 1";
	$query = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($query);
	if($row[0] < 1){
		mysqli_close($conn);
		echo "account_not_exist";
		exit();
	}
	// Insert the status post into the database now
	$sql = "INSERT INTO status(account_name, author, type, data, postdate) 
			VALUES('$account_name','$login_username','$type','$data',now())";
	$query = mysqli_query($conn, $sql);
	$id = mysqli_insert_id($conn);
	mysqli_query($conn, "UPDATE status SET osid='$id' WHERE id='$id' LIMIT 1");
	// Count posts of type "a" for the person posting and evaluate the count
	$sql = "SELECT COUNT(id) FROM status WHERE author='$login_username' AND type='a'";
    $query = mysqli_query($conn, $sql); 
	$row = mysqli_fetch_row($query);
	if ($row[0] > 9) { // If they have 10 or more posts of type a
		// Delete their oldest post if you want a system that auto flushes the oldest
		// (you can auto flush for post types c and b if you wish to also)
		$sql = "SELECT id FROM status WHERE author='$login_username' AND type='a' ORDER BY id ASC LIMIT 1";
    	$query = mysqli_query($conn, $sql); 
		$row = mysqli_fetch_row($query);
		$oldest = $row[0];
		mysqli_query($conn, "DELETE FROM status WHERE osid='$oldest'");
	}
	// Insert notifications to all friends of the post author
	$friends = array();
	$query = mysqli_query($conn, "SELECT user1 FROM friends WHERE user2='$login_username' AND accepted='1'");
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) { array_push($friends, $row["user1"]); }
	$query = mysqli_query($conn, "SELECT user2 FROM friends WHERE user1='$login_username' AND accepted='1'");
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) { array_push($friends, $row["user2"]); }
	for($i = 0; $i < count($friends); $i++){
		$friend = $friends[$i];
		$app = "Status Post";
		$note = $login_username.' posted on: <br /><a href="user.php?u='.$account_name.'#status_'.$id.'">'.$account_name.'&#39;s Profile</a>';
		mysqli_query($conn, "INSERT INTO notifications(username, initiator, app, note, date_time) VALUES('$friend','$login_username','$app','$note',now())");			
	}
	mysqli_close($conn);
	echo "post_ok|$id";
	exit();
}
?><?php 
//action=status_reply&osid="+osid+"&user="+user+"&data="+data
if (isset($_POST['action']) && $_POST['action'] == "status_reply"){
	// Make sure data is not empty
	if(strlen($_POST['data']) < 1){
		mysqli_close($conn);
	    echo "data_empty";
	    exit();
	}
	// Clean the posted variables
	$osid = preg_replace('#[^0-9]#', '', $_POST['sid']);
	$account_name = preg_replace('#[^a-z0-9]#i', '', $_POST['user']);
	$data = htmlentities($_POST['data']);
	$data = mysqli_real_escape_string($conn, $data);
	// Make sure account name exists (the profile being posted on)
	$sql = "SELECT COUNT(id) FROM users WHERE username='$account_name' AND activated='1' LIMIT 1";
	$query = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($query);
	if($row[0] < 1){
		mysqli_close($conn);
		echo "account_not_exist";
		exit();
	}
	// Insert the status reply post into the database now
	$sql = "INSERT INTO status(osid, account_name, author, type, data, postdate)
	        VALUES('$osid','$account_name','$login_username','b','$data',now())";
	$query = mysqli_query($conn, $sql);
	$id = mysqli_insert_id($conn);
	// Insert notifications for everybody in the conversation except this author
	$sql = "SELECT author FROM status WHERE osid='$osid' AND author!='$login_username' GROUP BY author";
	$query = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$participant = $row["author"];
		$app = "Status Reply";
		$note = $login_username.' commented here:<br /><a href="user.php?u='.$account_name.'#status_'.$osid.'">Click here to view the conversation</a>';
		mysqli_query($conn, "INSERT INTO notifications(username, initiator, app, note, date_time) 
		             VALUES('$participant','$login_username','$app','$note',now())");
	}
	mysqli_close($conn);
	echo "reply_ok|$id";
	exit();
}
?>
<?php 
if (isset($_POST['action']) && $_POST['action'] == "delete_status"){
	if(!isset($_POST['statusid']) || $_POST['statusid'] == ""){
		mysqli_close($conn);
		echo "status id is missing";
		exit();
	}
	$statusid = preg_replace('#[^0-9]#', '', $_POST['statusid']);
	// Check to make sure this logged in user actually owns that comment
	$query = mysqli_query($conn, "SELECT account_name, author FROM status WHERE id='$statusid' LIMIT 1");
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$account_name = $row["account_name"]; 
		$author = $row["author"];
	}
    if ($author == $login_username || $account_name == $login_username) {
		mysqli_query($conn, "DELETE FROM status WHERE osid='$statusid'");
		mysqli_close($conn);
	    echo "delete_ok";
		exit();
	}
}
?>
<?php 
if (isset($_POST['action']) && $_POST['action'] == "delete_reply"){
	if(!isset($_POST['replyid']) || $_POST['replyid'] == ""){
		mysqli_close($conn);
		exit();
	}
	$replyid = preg_replace('#[^0-9]#', '', $_POST['replyid']);
	// Check to make sure the person deleting this reply is either the account owner or the person who wrote it
	$query = mysqli_query($conn, "SELECT osid, account_name, author FROM status WHERE id='$replyid' LIMIT 1");
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$osid = $row["osid"];
		$account_name = $row["account_name"];
		$author = $row["author"];
	}
    if ($author == $login_username || $account_name == $login_username) {
		mysqli_query($conn, "DELETE FROM status WHERE id='$replyid'");
		mysqli_close($conn);
	    echo "delete_ok";
		exit();
	}
}
?>