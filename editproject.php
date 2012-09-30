<?php
require_once "db.php";
session_start();
require 'includes/guard23.ssi';

//-updates the project data in the database with the values from the user-----------------------------------------
if ( isset($_POST['name']) 
	&& isset($_POST['description']) 
	&& isset($_POST['startdate'])
	&& isset($_POST['enddate'])
	&& isset($_POST['id']) ) {
	$b = mysql_real_escape_string($_POST['name']);
	$c = mysql_real_escape_string($_POST['description']);
	$d = mysql_real_escape_string($_POST['startdate']);
	$e = mysql_real_escape_string($_POST['enddate']);
	$id = mysql_real_escape_string($_POST['id']);
	$sql = "UPDATE projects SET name='$b', description='$c', 
			startdate='$d', enddate='$e' WHERE id=$id"; 
	mysql_query($sql);
	$_SESSION['success'] = 'Record Updated';
	header( 'Location: manageprojects.php' ) ;
	return;
}

if ( ! isset($_GET['id']) ) {
    $_SESSION['error'] = 'Please try again';
    header('Location: manageprojects.php');
    return;
}
//retrieve existing project data from the database using the GET--------------------------------------------
$id = mysql_real_escape_string($_GET['id']);
$result = mysql_query("SELECT name, description, startdate, enddate, id 
    FROM projects WHERE id='$id'");
$row = mysql_fetch_row($result);
if ( $row == FALSE ) {
    $_SESSION['error'] = 'Bad value for id: Please try again';
    header('Location: manageprojects.php');
    return;
}
$b = htmlentities($row[0]);
$c = htmlentities($row[1]);
$d = htmlentities($row[2]);
$e = htmlentities($row[3]);

require 'includes/header.ssi';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


</head>

<!---here's the form------------------------------------------------------------------------------------------->
<body  id="home">
<h1>Edit Project</h1>

<?php
echo <<< _END
<form method="post">
<p>Project Name:
<input type="text" name="name" value="$b"></p>
<p>Project Description:</p><p>
<textarea type="text" name="description" rows="6">$c</textarea></p>
<p>Start Date:
<input type="text" name="startdate" value="$d"><font color="gray"> YYYY-MM-DD</font></p>
<p>End Date:
<input type="text" name="enddate" value="$e"><font color="gray"> YYYY-MM-DD</font></p>
<input type="hidden" name="id" value="$id">
<p><input type="submit" value="Update"/>
<a href="manageprojects.php">Cancel</a></p>
</form>
_END;
?>
</body>
</html>
