<?php
require_once "db.php";
session_start();
require 'includes/guard3.ssi';
require 'includes/header.ssi';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

</head>
<body  id="home">
<h1>Manage Users</h1>

<?php
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
    unset($_SESSION['success']);
}

$result = mysql_query("SELECT name, lname, email, password, role, id FROM users");
?>
<table><tr>
<td><strong>First Name</strong></td>
<td><strong>Last Name</strong></td>
<td><strong>Email</strong></td>
<td><strong>Access Level</strong></td>
<td><strong>Edit</strong></td>
<td><strong>Delete</strong></td>
</tr>

<?php
while ( $row = mysql_fetch_row($result) ) {
    echo "<tr><td>";
    echo(htmlentities($row[0]));
    echo("</td><td>");
	echo(htmlentities($row[1]));
    echo("</td><td>");
	echo(htmlentities($row[2]));
    echo("</td><td>");
    echo(htmlentities($row[4]));
    echo("</td><td>");
	echo('<a href="edituser.php?id='.htmlentities($row[5]).'">Edit</a>');
	echo("</td><td>");
	echo('<a href="deleteuser.php?id='.htmlentities($row[5]).'">Delete</a>');
	echo("</td></tr>");
}
	echo("</table>");

if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
    unset($_SESSION['success']);
}
?>
<h2><a href="adduser.php">Add New User</a></h2>
</body>
</html>
