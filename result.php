<?php
session_start();
require_once "db.php";
require 'includes/guard23.ssi';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<style type="text/css">
table, td, th
{
border-collapse:collapse;
border:1px solid green;
}
th
{
background-color:#CDDDC2;
}
body{font-family:Arial,Helvetica,sans-serif;}
button {
  color: forestgreen;
  font-weight: bold;
  font-size: 150%;
  text-transform: uppercase;
}
</style>
</head>
<body>
<?php
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
		<th>Under 6*</th>
		<th>Over 60*</th>
		<th>Dependents*</th>
		<th>Income 1</th>
		<th>Income 2</th>
		<th>Income 3</th>
		<th>Income 4</th>
		<th>Income 5</th>
		<th>Income N/A</th>
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
// Begin district query. -------------------------------------------------------------------------------------------------
if ( isset($_POST['district'])) {
	$district = mysql_real_escape_string($_POST['district']);
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
		SUM(CASE income_id WHEN 1 THEN '1' ELSE '0' END) AS 'income1',
		SUM(CASE income_id WHEN 2 THEN '1' ELSE '0' END) AS 'income2',
		SUM(CASE income_id WHEN 3 THEN '1' ELSE '0' END) AS 'income3',
		SUM(CASE income_id WHEN 4 THEN '1' ELSE '0' END) AS 'income4',
		SUM(CASE income_id WHEN 5 THEN '1' ELSE '0' END) AS 'income5',
		SUM(CASE income_id WHEN 6 THEN '1' ELSE '0' END) AS 'income6',
		ROUND(AVG(HOHage),1) AS 'avghohage', SUM(HOHgender) as 'gender'
		FROM households
		WHERE HHLDsize > 0 AND district='$district'
		GROUP BY district";
	$result = mysql_query($query);
	if ( $result == FALSE ) {
    		$_SESSION['error'] = 'Search by district failed. Please try again.';
    		header( 'Location: search.php' ) ;
    		return;
	}
	echo $tableheader;


while($row = mysql_fetch_array($result)){
	echo "<tr><td>";
	echo $resultrow= $row['district']. 
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
	"</td><td>". round($row['income1']/$row['households']*100)."%".
	"</td><td>". round($row['income2']/$row['households']*100)."%".
	"</td><td>". round($row['income3']/$row['households']*100)."%".
	"</td><td>". round($row['income4']/$row['households']*100)."%".
	"</td><td>". round($row['income5']/$row['households']*100)."%".
	"</td><td>". round($row['income6']/$row['households']*100)."%".
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
	echo "</td></tr>";
//add the table results to a .csv file output variable
	$csv_output.= str_replace("</td><td>",", ",$resultrow)."\n";

}//closes while loop that moves through query results rows
}//ends the "one district" loop. --------------------------------------------------------------------------------------------
// Begin project query. -------------------------------------------------------------------------------------------------
if ( isset($_POST['project'])) {
	$project = mysql_real_escape_string($_POST['project']);
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
		SUM(CASE income_id WHEN 1 THEN '1' ELSE '0' END) AS 'income1',
		SUM(CASE income_id WHEN 2 THEN '1' ELSE '0' END) AS 'income2',
		SUM(CASE income_id WHEN 3 THEN '1' ELSE '0' END) AS 'income3',
		SUM(CASE income_id WHEN 4 THEN '1' ELSE '0' END) AS 'income4',
		SUM(CASE income_id WHEN 5 THEN '1' ELSE '0' END) AS 'income5',
		SUM(CASE income_id WHEN 6 THEN '1' ELSE '0' END) AS 'income6',
		ROUND(AVG(HOHage),1) AS 'avghohage', SUM(HOHgender) as 'gender'
		FROM households
		WHERE HHLDsize > 0 AND project_id='$project'
		GROUP BY district";
	$result = mysql_query($query);
	if ( $result == FALSE ) {
    		$_SESSION['error'] = 'Search by project failed. Please try again.';
    		header( 'Location: search.php' ) ;
    		return;
	}
	echo $tableheader;


while($row = mysql_fetch_array($result)){
	echo "<tr><td>";
	echo $resultrow= $row['district']. 
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
	"</td><td>". round($row['income1']/$row['households']*100)."%".
	"</td><td>". round($row['income2']/$row['households']*100)."%".
	"</td><td>". round($row['income3']/$row['households']*100)."%".
	"</td><td>". round($row['income4']/$row['households']*100)."%".
	"</td><td>". round($row['income5']/$row['households']*100)."%".
	"</td><td>". round($row['income6']/$row['households']*100)."%".
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
	echo "</td></tr>";
//add the table results to a .csv file output variable
	$csv_output.= str_replace("</td><td>",", ",$resultrow)."\n";

}//closes while loop that moves through query results rows
}//ends the "one project" loop. ------------------------------------------------------------------------------------------
?>
<p>
<form name="export" action="export.php" method="post">
    <button type="submit" value="Export table to CSV">Export table to CSV</button> 
    <input type="hidden" value="<? echo $csv_output; ?>" name="csv_output">
</form></p>
<p>*Percentages marked with this symbol represent percent of district <em>population</em>.</p>
<p>The other percentages represent percent of district <em>households</em>.</p>

</body>
</html>
