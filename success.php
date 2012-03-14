<?php
session_start();
require_once "db.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="verify-v1" content="3MgGfMT/t0qC3+Qf9+cNxGNU8ehk9JEfhDHIdhQEQu4=" />
<title>Manila Database</title>
<link href="main.css" rel="stylesheet" type="text/css" />
<style type="text/css">
</style>
</head>
<body id="home">
<?php

if ( isset($_SESSION ['name']) ) 
{
	$yourname = $_SESSION['name'];
	$yourrole = $_SESSION['role'];
	if ($yourrole == "1")
	{
	echo "<p>Welcome ".htmlentities($yourname)."</br>";
	echo "Your are role 1</p>";
	echo('<p align="right"><a href="logout.php">Logout</a></p>'."\n");
	}
	if ($yourrole == "2")
	{
	echo "<p>Welcome ".htmlentities($yourname)."</br>";
	echo "Your are role 2</p>";
	echo('<p align="right"><a href="logout.php">Logout</a></p>'."\n");
	}
	if ($yourrole == "3")
	{
	echo "<p>Welcome ".htmlentities($yourname)."</br>";
	echo "Your are role 3</p>";
	echo('<p align="right"><a href="logout.php">Logout</a></p>'."\n");
	}
}
else 
{
	header ( 'Location: login.php'); 
}

?>
</body>
</html>

