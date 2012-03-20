<?php
require_once "db.php";
session_start();
require 'includes/guard23.ssi';
require 'includes/header.ssi';

//If the user has selected a valid id, this part deletes that record.
if ( isset($_POST['delete']) && isset($_POST['id']) ) {
    $id = $_POST['id'];
    $sql = "DELETE FROM Households WHERE id = $id";
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
$result = mysql_query("SELECT * FROM Households WHERE id='$id'");
$row = mysql_fetch_row($result);
if ( $row == FALSE ) {
    $_SESSION['error'] = 'Bad value for id';
    header( 'Location: index.php' ) ;
    return;
}

echo "<p>Confirm: Deleting Household.</p>\n";
echo('<form method="post"><input type="hidden" ');
echo('name="id" value="'.$row[0].'">'."\n");
echo('<input type="submit" value="Delete" name="delete">');
echo('<a href="index.php">Cancel</a>');
echo("\n</form>\n");
?>
