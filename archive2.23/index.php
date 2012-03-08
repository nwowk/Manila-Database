<?php
session_start();
require_once "db.php";

if ( isset($_SESSION ['name']) ) 
{
	$yourname = $_SESSION['name'];
	$yourrole = $_SESSION['role'];
	if ($yourrole == "1")
	{
	echo "<p>Welcome ".htmlentities($yourname)."</p>";
	echo "Your are role 1";
	echo('<p><a href="logout.php">Logout</a></p>'."\n");
	}
	if ($yourrole == "2")
	{
	echo "<p>Welcome ".htmlentities($yourname)."</p>";
	echo "Your are role 2";
	echo('<p><a href="logout.php">Logout</a></p>'."\n");
	}
	if ($yourrole == "3")
	{
	echo "<p>Welcome ".htmlentities($yourname)."</p>";
	echo "Your are role 3";
	echo('<p><a href="logout.php">Logout</a></p>'."\n");
	}
}
else 
{
	header ( 'Location: login.php'); 
}


?>
