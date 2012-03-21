<?php
require_once "db.php";
session_start();
require 'includes/guard23.ssi';


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
<tr><td>Project Number:</td><td> <input type="text" name="number"/></td></tr>
<tr><td>Project Name:</td><td> <input type="text" name="name"/></td></tr>
<tr><td>Project Description:</td><td> <input type="text" name="description"/></td></tr>
<tr><td><a href="manageprojects.php">Cancel</a></td>
	<td align="right"><input type="submit" value="Add New"/></td></tr>
</table>
</form>

<script language="JavaScript" type="text/javascript">
    var frmvalidator = new Validator("addproject");
 frmvalidator.EnableOnPageErrorDisplay();
 frmvalidator.EnableMsgsTogether();

  frmvalidator.addValidation("number","numeric","Project Number must be a number");
</script>

</body>
</html>