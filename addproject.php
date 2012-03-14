<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
require_once "db.php";
session_start();
?>
<head>
<?php
require 'includes/header.ssi';
?>
</head>
<body  id="home">
<h1>Add Project</h1>
<?php
if ( isset($_POST['number']) && isset($_POST['name']) 
	&& isset($_POST['description'])) 
	{
	$a = mysql_real_escape_string($_POST['number']);
	$b = mysql_real_escape_string($_POST['name']);
	$c = mysql_real_escape_string($_POST['description']);
	if (is_numeric($a)){
	$sql = "INSERT INTO projects (number, name, description) 
		VALUES ('$a', '$b', '$c')";
	mysql_query($sql);
	$_SESSION['success'] = 'Record Added';
	header( 'Location: manageprojects.php' ) ;
	return; }
/*	else   
		{$_SESSION['error']='All values are required. Values for Access Level should be numeric';
		header( 'Location: manageprojects.php' ) ;
		return;}
*/        
}
?>
<form method="post">
<table>
<tr><td>Project Number:</td><td> <input type="text" name="number"/></td></tr>
<tr><td>Project Name:</td><td> <input type="text" name="name"/></td></tr>
<tr><td>Project Description:</td><td> <input type="text" name="description"/></td></tr>
<tr><td><a href="manageprojects.php">Cancel</a></td>
	<td align="right"><input type="submit" value="Add New"/></td></tr>
</table>
</form>
</body>
</html>