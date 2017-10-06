<?php
if(isset($_POST['u']))
{
	include_once('php_includes/db_conn.php');
	$u = preg_replace('#[^a-z0-9]#i', '', $_POST['u']);
	$e = mysqli_real_escape_string($conn, $_POST['e']);
	$p = $_POST['p'];
	$c = preg_replace('#[^a-z ]#i', '', $_POST['c']);
	$g = preg_replace('#[^a-z]#', '', $_POST['g']);

	// GET USER IP ADDRESS
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	
	$sql="select id from users where username='$u' limit 1";
	$query1=mysqli_query($conn,$sql);
	$u_check=mysqli_num_rows($query1);
	//////////////////////////////////////////////////////////////////
	$sql = "select id from users where email='$e' limit 1";
    $query2 = mysqli_query($conn, $sql); 
	$e_check = mysqli_num_rows($query2);
	
	if($u == "" || $e == "" || $p == "" || $g == "" || $c == ""){
		echo "The form submission is missing values.";
        exit();
	} else if($u_check>0){ 
        echo "The username you entered is alreay taken";
        exit();
	} else if($e_check>0){ 
        echo "That email address is already in use in the system";
        exit();
	} else if(strlen($u) < 3 || strlen($u) > 16) {
        echo "Username must be between 3 and 16 characters";
        exit(); 
    } else if(is_numeric($u[0])) {
        echo 'Username cannot begin with a number';
        exit();
    } 
    else if(filter_var($e, FILTER_VALIDATE_EMAIL)==false)
    {
    	echo 'Invalid email address';
    }
    else
    {
		$sql = "insert into users (username, email, password, gender, country, ip, signup, lastlogin, notescheck) values ('$u','$e','$p','$g','$c','$ip',now(),now(),now())";
		$query1 = mysqli_query($conn,$sql);
		$uid = mysqli_insert_id($conn);
		$sql = "insert into useroptions (id, username, background) values ('$uid','$u','original')";
		$query2 = mysqli_query($conn, $sql);
		
		if (!file_exists("user/$u")) {
			mkdir("user/$u", 0755);
		}
		//echo "before success check";
		if($query1==TRUE && $query2 == true)
		{
		echo "signUp success";
		}
	}
}
?>