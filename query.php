<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
require_once "db.php";
session_start();
?>
<head>
<?php
require 'includes/header.ssi';

if ( isset($_POST['district'])) {
	$district = mysql_real_escape_string($_POST['district']);
	$query = "SELECT * FROM households WHERE district=$district";
	$result = mysql_query($query);
	if ( $result == FALSE ) {
        	$_SESSION['error'] = 'No data for the district you entered.';
        	return;
		}
//This part is where we calculate all the general stats for the district.
	$hhlds = mysql_num_rows($result);

//display profile information
	echo ('<h2>Profile for District '.$district.':</h2>');
	echo ('<p>There are '.$hhlds.' household entries in this district.</p>');

	$query = 'SELECT district, SUM(stories) FROM households GROUP BY district';
	$result = mysql_query($query);
while($row = mysql_fetch_array($result)){
	echo "District ". $row['district']. " has ". $row['SUM(stories)']." stories.";
	echo "<br />";
}
}
?>
</head>
<body id="home">
<h1>Search</h1>
<p>This page will have functionalities to query the database, but is not complete at this time.
    We hope to allow a variety of queries that allow multiple options for display of data.</p>
<form method="post">
<p>For which district would you like a profile?
<input type="text" name="district">
<input type="submit" value="Go"/>
</form>
</body>
</html>
