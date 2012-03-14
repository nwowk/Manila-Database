<?php
session_start();
require_once "db.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
require 'includes/header.ssi';
?>
</head>
<body  id="home">
<h1>Manage Projects</h1>

<?php
$result = mysql_query("SELECT number, name, description, id FROM projects");
?>
<table border="1"><tr>
<td><strong>Project Number</strong></td>
<td><strong>Project Name</strong></td>
<td><strong>Description</strong></td>
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
	echo('<a href="editproject.php?id='.htmlentities($row[3]).'">Edit</a>');
	echo("</td><td>");
	echo('<a href="deleteproject.php?id='.htmlentities($row[3]).'">Delete</a>');
	echo("</td></tr>");
}
	echo("</table>");

?>
<h2><a href="addproject.php">Add New Project</a></h2>
</body>
</html>