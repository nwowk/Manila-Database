<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
require_once "db.php";
session_start();
require 'includes/guard3.ssi';
require 'includes/header.ssi';
?>
<head>

</head>
<body  id="home">
<h1>Add User</h1>
<?php
if ( isset($_POST['name']) && isset($_POST['lname']) 
	&& isset($_POST['email']) && isset($_POST['password'])&& isset($_POST['role'])) 
	{
	$a = mysql_real_escape_string($_POST['name']);
	$b = mysql_real_escape_string($_POST['lname']);
	$c = mysql_real_escape_string($_POST['email']);
	$d = mysql_real_escape_string($_POST['password']);
	$e = mysql_real_escape_string($_POST['role']);
	if (is_numeric($d)){
	$sql = "INSERT INTO users (name, lname, email, password, role) 
		VALUES ('$a', '$b', '$c', '$d', '$e')";
	mysql_query($sql);
	$_SESSION['success'] = 'Record Added';
	header( 'Location: manageusers.php' ) ;
	return;}
	else   
		{$_SESSION['error']='All values are required. Values for Access Level should be numeric';
		header( 'Location: manageusers.php' ) ;
		return;}
}
?>
<form method="post">
<table>
<tr><td>First Name:</td><td> <input type="text" name="name"></td></tr>
<tr><td>Last Name:</td><td> <input type="text" name="lname"></td></tr>
<tr><td>Email:</td><td> <input type="text" name="email"></td></tr>
<tr><td>Password:</td><td> <input type="password" name="password"></td></tr>
<tr><td>Access Level:</td><td> <input type="text" name="role"></td></tr>
<tr><td><a href="manageusers.php">Cancel</a></td>
	<td align="right"><input type="submit" value="Add New"/></td></tr>
</table>
</form>
</body>
</html>