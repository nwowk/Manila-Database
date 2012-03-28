<?php
session_start();
require_once "db.php";
require 'includes/guard23.ssi';
require 'includes/header.ssi';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<?php //prepare the CSV table for the "get all districts" query. ---------------------------------------------------------
$fields="District</th>
		<th>Households</th>
		<th>Population</th>
		<th>AVG Household Size</th>
		<th>Light Materials</th>
		<th>Semi-Concrete</th>
		<th>Concrete</th>
		<th>AVG Stories</th>
		<th>No Foundation</th>
		<th>Slab</th>
		<th>Bamboo</th>
		<th>Wood</th>
		<th>Steel Platform</th>
		<th>Cinder blocks</th>
		<th>Other foundation</th>
		<th>Concrete Roof</th>
		<th>Light materials</th>
		<th>Metal roof</th>
		<th>Mixed roof</th>
		<th>Under 6</th>
		<th>Over 60</th>
		<th>Dependents</th>
		<th>Evac plan</th>
		<th>Training</th>
		<th>Garbage Collector</th>
		<th>Burning</th>
		<th>Dumping public</th>
		<th>Dumping water</th>
		<th>Well</th>
		<th>Faucet</th>
		<th>River</th>
		<th>Pipe</th>
		<th>Seller</th>
		<th>Other water</th>
		<th>SMS</th>
		<th>email</th>
		<th>radio</th>
		<th>TV</th>
		<th>Female HoH</th>
		<th>AVG HoH Age";
$tableheader="<table border='1'><tr>
		<th>$fields</th>
		</tr>";
$csv_output="";
//Query below is to return all districts.
	$query = "SELECT district, COUNT(1) as 'households', 
		ROUND(AVG(stories),1) AS 'avgstories',
		SUM(HHLDsize) as 'population', ROUND(AVG(HHLDsize),1) AS 'avghhldsize',
		SUM(CASE buildingtype_id WHEN 1 THEN '1' ELSE '0' END) AS 'bt1',
		SUM(CASE buildingtype_id WHEN 2 THEN '1' ELSE '0' END) AS 'bt2',
		SUM(CASE buildingtype_id WHEN 3 THEN '1' ELSE '0' END) AS 'bt3',
		SUM(CASE raised_id WHEN 0 THEN '1' ELSE '0' END) AS 'r0',
		SUM(CASE raised_id WHEN 1 THEN '1' ELSE '0' END) AS 'r1',
		SUM(CASE raised_id WHEN 2 THEN '1' ELSE '0' END) AS 'r2',
		SUM(CASE raised_id WHEN 3 THEN '1' ELSE '0' END) AS 'r3',
		SUM(CASE raised_id WHEN 4 THEN '1' ELSE '0' END) AS 'r4',
		SUM(CASE raised_id WHEN 5 THEN '1' ELSE '0' END) AS 'r5',
		SUM(CASE raised_id WHEN 6 THEN '1' ELSE '0' END) AS 'r6',
		SUM(CASE roof_id WHEN 1 THEN '1' ELSE '0' END) AS 'roof1',
		SUM(CASE roof_id WHEN 2 THEN '1' ELSE '0' END) AS 'roof2',
		SUM(CASE roof_id WHEN 3 THEN '1' ELSE '0' END) AS 'roof3',
		SUM(CASE roof_id WHEN 4 THEN '1' ELSE '0' END) AS 'roof4',
		SUM(young) AS 'young', SUM(old) AS 'old', SUM(dependents) AS 'dependents',
		SUM(evacuation) AS 'evacuation', SUM(training) AS 'training',
		SUM(CASE waste_id WHEN 1 THEN '1' ELSE '0' END) AS 'waste1',
		SUM(CASE waste_id WHEN 2 THEN '1' ELSE '0' END) AS 'waste2',
		SUM(CASE waste_id WHEN 3 THEN '1' ELSE '0' END) AS 'waste3',
		SUM(CASE waste_id WHEN 4 THEN '1' ELSE '0' END) AS 'waste4',
		SUM(CASE water_id WHEN 1 THEN '1' ELSE '0' END) AS 'water1',
		SUM(CASE water_id WHEN 2 THEN '1' ELSE '0' END) AS 'water2',
		SUM(CASE water_id WHEN 3 THEN '1' ELSE '0' END) AS 'water3',
		SUM(CASE water_id WHEN 4 THEN '1' ELSE '0' END) AS 'water4',
		SUM(CASE water_id WHEN 5 THEN '1' ELSE '0' END) AS 'water5',
		SUM(CASE water_id WHEN 6 THEN '1' ELSE '0' END) AS 'water6',
		SUM(CASE contact_id WHEN 1 THEN '1' ELSE '0' END) AS 'contact1',
		SUM(CASE contact_id WHEN 2 THEN '1' ELSE '0' END) AS 'contact2',
		SUM(CASE contact_id WHEN 3 THEN '1' ELSE '0' END) AS 'contact3',
		SUM(CASE contact_id WHEN 4 THEN '1' ELSE '0' END) AS 'contact4',
		ROUND(AVG(HOHage),1) AS 'avghohage', SUM(HOHgender) as 'gender'
		FROM households 
		WHERE HHLDsize > 0
		GROUP BY district";
	$result = mysql_query($query);
//table headers
//loop to generate table values. 
while($row = mysql_fetch_array($result)){
	$resultrow= $row['district']. 
	"</td><td>". $row['households'].
	"</td><td>". $row['population'].
	"</td><td>". $row['avghhldsize'].
	"</td><td>". round($row['bt1']/$row['households']*100)."%".
	"</td><td>". round($row['bt2']/$row['households']*100)."%".
	"</td><td>". round($row['bt3']/$row['households']*100)."%".
	"</td><td>". $row['avgstories'].
	"</td><td>". round($row['r0']/$row['households']*100)."%".
	"</td><td>". round($row['r1']/$row['households']*100)."%".
	"</td><td>". round($row['r2']/$row['households']*100)."%".
	"</td><td>". round($row['r3']/$row['households']*100)."%".
	"</td><td>". round($row['r4']/$row['households']*100)."%".
	"</td><td>". round($row['r5']/$row['households']*100)."%".
	"</td><td>". round($row['r6']/$row['households']*100)."%".
	"</td><td>". round($row['roof1']/$row['households']*100)."%".
	"</td><td>". round($row['roof2']/$row['households']*100)."%".
	"</td><td>". round($row['roof3']/$row['households']*100)."%".
	"</td><td>". round($row['roof4']/$row['households']*100)."%".
	"</td><td>". round($row['young']/$row['population']*100)."%".
	"</td><td>". round($row['old']/$row['population']*100)."%".
	"</td><td>". round($row['dependents']/$row['population']*100)."%".
	"</td><td>". round($row['evacuation']/$row['households']*100)."%".
	"</td><td>". round($row['training']/$row['households']*100)."%".
	"</td><td>". round($row['waste1']/$row['households']*100)."%".
	"</td><td>". round($row['waste2']/$row['households']*100)."%".
	"</td><td>". round($row['waste3']/$row['households']*100)."%".
	"</td><td>". round($row['waste4']/$row['households']*100)."%".
	"</td><td>". round($row['water1']/$row['households']*100)."%".
	"</td><td>". round($row['water2']/$row['households']*100)."%".
	"</td><td>". round($row['water3']/$row['households']*100)."%".
	"</td><td>". round($row['water4']/$row['households']*100)."%".
	"</td><td>". round($row['water5']/$row['households']*100)."%".
	"</td><td>". round($row['water6']/$row['households']*100)."%".
	"</td><td>". round($row['contact1']/$row['households']*100)."%".
	"</td><td>". round($row['contact2']/$row['households']*100)."%".
	"</td><td>". round($row['contact3']/$row['households']*100)."%".
	"</td><td>". round($row['contact4']/$row['households']*100)."%".
	"</td><td>". round($row['gender']/$row['households']*100)."%".
	"</td><td>". $row['avghohage'];
//add the table results to a .csv file output variable
	$csv_output.= str_replace("</td><td>",", ",$resultrow)."\n";

}//closes while loop that moves through query results rows------------------------------------------------------------------
?>
</head>
<body id="home">
<h1>Search</h1>
<?php
//Checks to see if there are any error or success messages to display-------------------------------------------------------
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
    unset($_SESSION['success']);
}
?>
<p>Choose your query below. </p>
<form action = "result.php" target ="_blank" method="post">
<p>For which district would you like a profile?
<input type="text" name="district">
<input type="submit" value="Go"/>
</form>
<form action = "result.php" target ="_blank" method="post">
<p>For which project would you like a profile?
<input type="text" name="project">
<input type="submit" value="Go"/>
</form>
<br>
<form name="export" action="export.php" method="post">
    <button type="submit" value="getall">Get all districts in a .csv file</button> 
    <input type="hidden" value="<? echo $csv_output; ?>" name="csv_output">
</form>
</body>
</html>
