<?php
require_once "db.php";
session_start();
require 'includes/guard23.ssi';

//If the user has selected a valid id, this part deletes that record.
if ( isset($_POST['delete']) && isset($_POST['id']) ) {
    $id = $_POST['id'];
    $sql = "DELETE FROM households WHERE id = $id";
    mysql_query($sql);
    $_SESSION['success'] = 'Record deleted.';
    header( 'Location: index.php' ) ;
    return;
}
//This part kills the page if there is no GET data for the id
if ( ! isset($_GET['id']) ) {
    $_SESSION['error'] = 'Missing value for id';
    header( 'Location: index.php' ) ;
    return;
}

//This part uses the GET data to get the track data out of the database
$id = $_GET['id'];
$result = mysql_query("SELECT * FROM households WHERE id='$id'");
$row = mysql_fetch_row($result);
if ( $row == FALSE ) {
    $_SESSION['error'] = 'Bad value for id';
    header( 'Location: index.php' ) ;
    return;
}
require 'includes/header.ssi';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

</head>
<body  id="home">
<h1>Delete Entry</h1>
<?php

echo "<p>Confirm: You want to delete this record and start over by entering a new record.</p>\n";
echo('<form method="post"><input type="hidden" ');
echo('name="id" value="'.$row[0].'">'."\n");
echo('<input type="submit" value="Delete" name="delete">');
echo('<a href="index.php">Cancel</a>');
echo("\n</form>\n");
?>
