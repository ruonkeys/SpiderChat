<!DOCTYPE html>
<html>
<head>
	<title>test purpose</title>
	<style>
	.ht
	{
		background-color: red;
		height: 100px;
		overflow-x: scroll;
	}
	.align_test
	{
		background-color: green;
		width: 70%;
		margin-left: 20px;

	}
	</style>
</head>
<script>
function test()
{
	alert("ONCLICK EVENT");
}
function fun()
{
	document.getElementById("demo").innerHTML="mouse down event";
}
</script>
<body>
<button onclick="test()" onmousedown="fun()">click to test</button>
<p id="demo"></p>
<?php
$num=5;
if($num>0)
{
$n="john"; // what is the scope of this variable, is it not local to if block
echo "name set<br>";
}
?>
<?php
echo $n;
?>
<script>
document.getElementById("demo").innerHTML="<?php echo $n; ?>";//i am able to use variable $n here
</script>
<?php
echo "<br><h2>String Split</h2><br>";
$arr = str_split("Hello",3);
echo $arr[1];
?>

<div class="ht">
	testing div height 
	<br><br>
	In PHP there are two basic ways to get output: echo and print.

In this tutorial we use echo (and print) in almost every example. So, this chapter contains a little more info about those two output statements.
PHP echo and print Statements

echo and print are more or less the same. They are both used to output data to the screen.

The differences are small: echo has no return value while print has a return value of 1 so it can be used in expressions. echo can take multiple parameters (although such usage is rare) while print can take one argument. echo is marginally faster than print.
In PHP there are two basic ways to get output: echo and print.

In this tutorial we use echo (and print) in almost every example. So, this chapter contains a little more info about those two output statements.
PHP echo and print Statements

echo and print are more or less the same. They are both used to output data to the screen.

The differences are small: echo has no return value while print has a return value of 1 so it can be used in expressions. echo can take multiple parameters (although such usage is rare) while print can take one argument. echo is marginally faster than print.
</div>

<div class="align_test">
 testing alignment
</div>
</body>
</html>