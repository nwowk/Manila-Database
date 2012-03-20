<?php
session_start();
//require 'guard.php';
require_once "db.php";

if ( isset($_SESSION ['name']) ) 
{
	$yourname = $_SESSION['name'];
	$yourrole = $_SESSION['role'];
	
	header ('Location: add.php');
	return;
}
else 
{
	 header('Location: login.php');
	 return;
}
require 'includes/header.ssi';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<link href="main.css" rel="stylesheet" type="text/css" />
<style type="text/css">
</style>

<head>
<title>Manila Database</title>

</head>
<body  id="home">

</body>
</html>

