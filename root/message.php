<?php
$message="";
$msg=preg_replace('#[^a-z 0-9.:_()]#i','',$_GET['msg']);
if($msg=="activation failed")
{
    $message="<h2>There seems to be some error with your activation</h2>";
}
else if($msg=="activation successful")
{
    $message="<h2>Activation successful </h2><a href=\"login_test.php\">click here</a> to logIn";
}
else
{
    $message=$msg;
}
echo "<div>$message</div>";
?>