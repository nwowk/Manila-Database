<?php
require_once "db.php";
session_start();

if ( isset($_POST['email']) && isset($_POST['password']) ) 
{
	$e = mysql_real_escape_string($_POST['email']);
	$p = mysql_real_escape_string ($_POST['password']);
	$sql = "SELECT name FROM users
			WHERE email = '$e' AND password = '$p'";
	$result = mysql_query ($sql);
	
	$sqltwo = "SELECT role FROM users
			WHERE email = '$e' AND password = '$p'";
	$resulttwo = mysql_query ($sqltwo);
	$roleset = mysql_fetch_row($resulttwo);
	$_SESSION ['role'] = $roleset[0];

	if ( $result === FALSE )
	{
		echo "<p>Login incorrect.</p>\n";
		unset ($_SESSION['name']);
	}
	else
	{
		$row = mysql_fetch_row($result);
		$_SESSION ['name'] = $row[0];
		header ( 'Location: add.php'); 
	}
	return;
}
if ( isset($_SESSION ['name']) ) 
{
	header ( 'Location: add.php'); 
}

require 'includes/header.ssi';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

</head>
<body  id="home">

<h2>Login</h2>
<form method="post">
<table>
<tr><td><b>Email:</b></td><td> <input type="text" name="email"></td></tr>
<tr><td><b>Password:</b></td><td><input type="password" name ="password"></td><tr>
<tr><td><input type="submit" value="Login"/></td>
<td><a href="index.php">Refresh</a></td></tr></table>
</form>
</body>
</html>