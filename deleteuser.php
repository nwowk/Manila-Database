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
<h1>Delete User</h1>
<?php
if ( isset($_POST['delete']) && isset($_POST['id']) ) {
    $id = mysql_real_escape_string($_POST['id']);
    $sql = "DELETE FROM users WHERE id = $id";
    echo "<pre>\n$sql\n</pre>\n";
    mysql_query($sql);
    $_SESSION['success'] = 'Record Deleted';
    header('Location: manageusers.php');
    return;
}

if ( ! isset($_GET['id']) ) {
	$_SESSION['error'] = 'Missing value for id';
    header('Location: manageusers.php');
    return;
}

$id = mysql_real_escape_string($_GET['id']);
$result = mysql_query("SELECT name, lname, id FROM users WHERE id='$id'");
$row = mysql_fetch_row($result);
if ( $row == FALSE ) {
	$_SESSION['error'] = 'Bad value for id';
    header('Location: manageusers.php');
    return;
}

echo "<p>Confirm: Deleting ".htmlentities($row[0])." ".htmlentities($row[1])."</p>\n";

echo('<form method="post"><input type="hidden" ');
echo('name="id" value="'.htmlentities($row[2]).'">'."\n");
echo('<input type="submit" value="Delete" name="delete">');
echo('<a href="manageusers.php">Cancel</a>');
echo("\n</form>\n");
?>
 

