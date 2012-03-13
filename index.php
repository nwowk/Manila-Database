<?php
session_start();
require_once "db.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<link href="main.css" rel="stylesheet" type="text/css" />
<style type="text/css">
</style>

<head>
<title>Manila Database</title>
<?php
require 'includes/header.ssi';
?>
</head>
<body  id="home">
<?php

if ( isset($_SESSION ['name']) ) 
{
	$yourname = $_SESSION['name'];
	$yourrole = $_SESSION['role'];
	
	header ('Location: add.php');
}
else 
{
	echo '<h1>Please Login</h1>';
}
?>
</body>
</html>

