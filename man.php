<?php
require_once "db.php";
session_start();
require 'includes/guardgeneral.ssi';
require 'includes/header.ssi';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

</head>
<body  id="home">
<h1>Manage Projects</h1>

<?php
$result = mysql_query("SELECT number, name, description, id FROM projects");
?>
<table><tr>
<td><strong>Project Number</strong></td>
<td><strong>Project Name</strong></td>
<td><strong>Description</strong></td>
</tr>

<?php
while ( $row = mysql_fetch_row($result) ) {
    echo "<tr><td>";
    echo(htmlentities($row[0]));
    echo("</td><td>");
	echo(htmlentities($row[1]));
    echo("</td><td>");
	echo(htmlentities($row[2]));
	echo("</td></tr>");
}
	echo("</table>");

?>
<h2><a href="addproject.php">Add New Project</a></h2>
</body>
</html>
