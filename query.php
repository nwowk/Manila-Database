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
	$query = "SELECT district, COUNT(1) as 'households', 
		SUM(stories), AVG(stories), 
		SUM(HHLDsize) as 'population', AVG(HHLDsize),
		SUM(females), AVG(HOHage)
		FROM households 
		WHERE HHLDsize > 0 AND district='$district'
		GROUP BY district";
	$result = mysql_query($query);
	if ( $result == FALSE ) {
    		$_SESSION['error'] = 'Bad value for id';
    		header( 'Location: query.php' ) ;
    		return;
	}
	echo '<table border="1"><tr>
		<th>District</th>
		<th>Households</th>
		<th>Population</th>
		<th>AVG Household Size</th>
		<th>% Female</th>
		<th>AVG HoH Age</th>
		<th>AVG Stories</th>
		<th>SUM stories</th>
		</tr>';
while($row = mysql_fetch_array($result)){
	echo "<tr><td>". $row['district']. 
	"</td><td>". $row['households'].
	"</td><td>". $row['population'].
	"</td><td>". $row['AVG(HHLDsize)'].
	"</td><td>". ($row['SUM(females)']/$row['population']*100).
	"</td><td>". $row['AVG(HOHage)'].
	"</td><td>". $row['AVG(stories)'].
	"</td><td>". ($row['SUM(stories)']/$row['households']).
	"</td></tr>";
}
}
if ( isset($_POST['project'])) {
	$query = 'SELECT district, COUNT(1) as "households", 
		SUM(stories), AVG(stories), 
		SUM(HHLDsize) as "population", AVG(HHLDsize),
		SUM(females), AVG(HOHage)
		FROM households 
		WHERE HHLDsize > 0
		GROUP BY district';
	$result = mysql_query($query);
	echo '<table border="1"><tr>
		<th>District</th>
		<th>Households</th>
		<th>Population</th>
		<th>AVG Household Size</th>
		<th>% Female</th>
		<th>AVG HoH Age</th>
		<th>AVG Stories</th>
		<th>SUM stories</th>
		</tr>';
while($row = mysql_fetch_array($result)){
	echo "<tr><td>". $row['district']. 
	"</td><td>". $row['households'].
	"</td><td>". $row['population'].
	"</td><td>". $row['AVG(HHLDsize)'].
	"</td><td>". ($row['SUM(females)']/$row['population']*100).
	"</td><td>". $row['AVG(HOHage)'].
	"</td><td>". $row['AVG(stories)'].
	"</td><td>". ($row['SUM(stories)']/$row['households']).
	"</td></tr>";
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
<br>
<form method="post">
<p>Get all districts.
<input type="hidden" name="project" value="all">
<input type="submit" value="Go"/>
</form>
</body>
</html>
