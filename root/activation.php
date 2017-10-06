<?php
if(isset($_GET['u']) && isset($_GET['e']) && isset($_GET['p']) && isset($_GET['g']) && isset($_GET['c']))
{
	include_once("php_includes/db_conn.php");
	$u = preg_replace('#[^a-z 0-9]#i','',$_GET['u']);
	$e = mysqli_real_escape_string($conn,$_GET['e']);
	$p = mysqli_real_escape_string($conn,$_GET['p']);
	
        if(strlen($u)<3||strlen($u)>16)
        {
            header("location:message.php?msg=string_length_issues");
            exit();
        }
        $sql = "select * from users where username='$u' and email='$e'";
        $query = mysqli_query($conn, $sql);
        $num_chk = mysqli_num_rows($query);
        
        if($num_chk==0)
        {
            header("location:message.php?msg=Your credentials do not match");
        }
        
        $sql = "update users set activated='1' where username='$u'";
        mysqli_query($conn,$sql);
        
        $sql = "select * from users where username='$u' and activated='1'";
        $query = mysqli_query($conn,$sql);
        $num =  mysqli_num_rows($query);
        if($num==0)
        {
            header("location:message.php?msg=activation failed");
            exit();
        }
        else if($num==1)
        {
            header("location:message.php?msg=activation successful");
            exit();
        }
}
else
{
    header("location:message.php?msg=missing get variables");
    exit();
}
?>