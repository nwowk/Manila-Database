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
<h1>Edit User</h1>
<?php
if ( isset($_POST['name']) && isset($_POST['lname']) 
	&& isset($_POST['email']) && isset($_POST['role']) 
	&& isset($_POST['id']) ) 
	{
	$a = mysql_real_escape_string($_POST['name']);
	$b = mysql_real_escape_string($_POST['lname']);
	$c = mysql_real_escape_string($_POST['email']);
	$d = mysql_real_escape_string($_POST['role']);
	if (is_numeric($d)){
	$id = mysql_real_escape_string($_POST['id']);
	$sql = "UPDATE users SET name='$a', lname='$b', email='$c', 
			role='$d' WHERE id=$id"; 
	mysql_query($sql);
	$_SESSION['success'] = 'Record Updated';
	header( 'Location: manageusers.php' ) ;
	return;}
	else   
		{$_SESSION['error']='Values for Access Level should be numeric';
		header( 'Location: manageusers.php' ) ;
		return;}
}

if ( ! isset($_GET['id']) ) {
    $_SESSION['error'] = 'Please try again';
    header('Location: manageusers.php');
    return;
}
$id = mysql_real_escape_string($_GET['id']);
$result = mysql_query("SELECT name, lname, email, role, id 
    FROM users WHERE id='$id'");
$row = mysql_fetch_row($result);
if ( $row == FALSE ) {
    $_SESSION['error'] = 'Bad value for id: Please try again';
    header('Location: manageusers.php');
    return;
}
$a = htmlentities($row[0]);
$b = htmlentities($row[1]);
$c = htmlentities($row[2]);
$d = htmlentities($row[3]);

echo <<< _END

<form method="post">
<p>First Name:
<input type="text" name="name" value="$a"></p>
<p>Last Name:
<input type="text" name="lname" value="$b"></p>
<p>Email:
<input type="text" name="email" value="$c"></p>
<p>Role:
<input type="text" name="role" value="$d"></p>
<input type="hidden" name="id" value="$id">
<p><input type="submit" value="Update"/>
<a href="manageusers.php">Cancel</a></p>
</form>
_END;
?>
</body>
</html>