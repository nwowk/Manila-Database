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
<h1>Edit Project</h1>
<?php
if ( isset($_POST['number']) && isset($_POST['name']) 
	&& isset($_POST['description']) 
	&& isset($_POST['id']) ) 
	{
	$a = mysql_real_escape_string($_POST['number']);
	$b = mysql_real_escape_string($_POST['name']);
	$c = mysql_real_escape_string($_POST['description']);
	if (is_numeric($a)){
	$id = mysql_real_escape_string($_POST['id']);
	$sql = "UPDATE projects SET number='$a', name='$b', description='$c' 
			WHERE id=$id"; 
	mysql_query($sql);
	$_SESSION['success'] = 'Record Updated';
	header( 'Location: manageprojects.php' ) ;
	return;}
/*	else   
		{$_SESSION['error']='Values for Access Level should be numeric';
		header( 'Location: manageusers.php' ) ;
		return;}
*/        
}

if ( ! isset($_GET['id']) ) {
    $_SESSION['error'] = 'Please try again';
    header('Location: manageprojects.php');
    return;
}
$id = mysql_real_escape_string($_GET['id']);
$result = mysql_query("SELECT number, name, description, id 
    FROM projects WHERE id='$id'");
$row = mysql_fetch_row($result);
if ( $row == FALSE ) {
    $_SESSION['error'] = 'Bad value for id: Please try again';
    header('Location: manageprojects.php');
    return;
}
$a = htmlentities($row[0]);
$b = htmlentities($row[1]);
$c = htmlentities($row[2]);

echo <<< _END

<form method="post">
<p>Project Number:
<input type="text" name="number" value="$a"></p>
<p>Project Name:
<input type="text" name="name" value="$b"></p>
<p>Project Description:
<input type="text" name="description" value="$c"></p>
<input type="hidden" name="id" value="$id">
<p><input type="submit" value="Update"/>
<a href="manageprojects.php">Cancel</a></p>
</form>
_END;
?>
</body>
</html>