<?php
require_once "db.php";
session_start();
require 'includes/guard23.ssi';


if ( isset($_POST['name']) 
	&& isset($_POST['description'])
	&& isset($_POST['startdate'])
	&& isset($_POST['enddate'])) 
	{
	$b = mysql_real_escape_string($_POST['name']);
	$c = mysql_real_escape_string($_POST['description']);
	$d = mysql_real_escape_string($_POST['startdate']);
	$e = mysql_real_escape_string($_POST['enddate']);
	$sql = "INSERT INTO projects (name, description, startdate, enddate) 
		VALUES ('$b', '$c', '$d', '$e')";
	mysql_query($sql);
	$_SESSION['success'] = 'Project added.';
	header( 'Location: manageprojects.php' ) ;
	return;       
}
require 'includes/header.ssi';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="includes/gen_validatorv4.js" type="text/javascript"></script>
</head>

<body  id="home">
<h1>Add Project</h1>



<form method="post" name="addproject">
<table>
<div id='addproject_number_errorloc' class='error_strings'></div>
<tr><td>Project Name:</td><td> <input type="text" name="name"/></td></tr>
<tr><td>Project Description:</td><td> <textarea type="text" name="description" rows="6"></textarea></td></tr>
<tr><td>Start Date:</td><td> <input type="text" name="startdate"/><font color="gray"> YYYY-MM-DD</font></td></tr>
<tr><td>End Date:</td><td> <input type="text" name="enddate"/><font color="gray"> YYYY-MM-DD</font></td>
</td>
	<td align="right"><input type="submit" value="Add New"/>&nbsp;&nbsp;&nbsp;<a href="manageprojects.php">Cancel</a></td></tr>
</table>
</form>

<script language="JavaScript" type="text/javascript">
    var frmvalidator = new Validator("addproject");
 frmvalidator.EnableOnPageErrorDisplay();
 frmvalidator.EnableMsgsTogether();

</script>

</body>
</html>
