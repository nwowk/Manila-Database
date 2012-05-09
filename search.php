<?php
session_start();
require_once "db.php";
require 'includes/guard23.ssi';
require 'includes/header.ssi';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Manila Database</title>
<link href="main.css" rel="stylesheet" type="text/css" />
<style type="text/css">
      
</style>
<!-- Google maps scripts----------------------------------------------------------------------------------------->
   <meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> 
    <script src="includes/gen_validatorv4.js" type="text/javascript"></script>
   <div id="map"> <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyApkROPBq0A2ouQEFyaSm_xQi0BrENUC20&sensor=false">
    </script>
    <script type="text/javascript">
      function initialize() {
		var element = document.getElementById("map_canvas");
            var mapTypeIds = [];
            for(var type in google.maps.MapTypeId) {
                mapTypeIds.push(google.maps.MapTypeId[type]);
            }
            mapTypeIds.push("OSM");
 
            var map = new google.maps.Map(element, {
                center: new google.maps.LatLng(14.671171,121.110851),
                zoom: 16,
                mapTypeId: "OSM",
                mapTypeControlOptions: {
                    mapTypeIds: mapTypeIds
                }
            });
 
            map.mapTypes.set("OSM", new google.maps.ImageMapType({
                getTileUrl: function(coord, zoom) {
                    return "http://tile.openstreetmap.org/" + zoom + "/" + coord.x + "/" + coord.y + ".png";
                },
                tileSize: new google.maps.Size(256, 256),
                name: "OpenStreetMap",
                maxZoom: 18
            }));
					var layer = new google.maps.FusionTablesLayer({
			query: {
				select: 'geometry',
				from: '3024596'
			}
		});
		layer.setMap(map);	
	}
    </script> </div>
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
		SUM(CASE income_id WHEN 1 THEN '1' ELSE '0' END) AS 'income1',
		SUM(CASE income_id WHEN 2 THEN '1' ELSE '0' END) AS 'income2',
		SUM(CASE income_id WHEN 3 THEN '1' ELSE '0' END) AS 'income3',
		SUM(CASE income_id WHEN 4 THEN '1' ELSE '0' END) AS 'income4',
		SUM(CASE income_id WHEN 5 THEN '1' ELSE '0' END) AS 'income5',
		SUM(CASE income_id WHEN 6 THEN '1' ELSE '0' END) AS 'income6',
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
//add the table results to a .csv file output variable
	$csv_output.= str_replace("</td><td>",", ",$resultrow)."\n";

}//closes while loop that moves through query results rows------------------------------------------------------------------
?>
</head>
<body id="homewide" onload="initialize()">
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
<table width="100%" border="0" class="float">
<tr><td>
<p>Choose your search below. You may search the database only in aggregate form, that is you will see summary 
statistics for survey answers aggregated by district. You may limit your results to a particular district or profile. </p>
<p>View a guide for the summary data <a href="images/Summary_Data_Guide.pdf" target="_blank">here</a>. You will need <a href="http://get.adobe.com/reader/" target="_blank">Adobe Reader </a> to view this file.</p>
<form action = "result.php" target ="_blank" method="post">
<p>Get summary for 
<select name ='geography' id = 'geography'>
<option value ='zone'>zone</option>
<option value ='district'>district</option>
</select>
<input type="text" name="geovalue">
<input type="submit" value="Go"/>.
</form>
<form action = "result.php" target ="_blank" method="post">
<p>Get summary for project
<select name = 'project' id = 'project'>
<?php
    $p_result = mysql_query("SELECT name, id FROM projects ORDER BY name");
    while ( $row = mysql_fetch_row($p_result) ) {
	echo ("<option value = '" . $row['1'] . "'>" . $row['0'] . "</option>");
    }
?>
</select>
<input type="submit" value="Go"/>
</form>
<form action = "result_households.php" target ="_blank" method="post">
<p>Get family list for 
<select name ='geography' id = 'geography'>
<option value ='zone'>zone</option>
<option value ='district'>district</option>
</select>
<input type="text" name="geovalue">
<input type="submit" value="Go"/>.
</form>
<br>
<p> Alternatively, you may view the entire database, aggregated by district. Due to the potential size of this file, you must download this information in the form of a <em>.csv</em> file, which can be opened in many spreadsheet programs such as Excel. Open Office is an open-source, free alternative application set that includes a spreadsheet program which can also open these files. You can download Open Office <a href="http://www.openoffice.org/download/index.html" target="_blank">here</a>. </p>
<form name="export" action="export.php" method="post">
    <button type="submit" value="getall">Get all districts in a .csv file</button> 
    <input type="hidden" value="<? echo $csv_output; ?>" name="csv_output">
</form>
</td><td>
<div id="map_canvas" style="width:100% height:100%"></div>
</td></tr></table>
<h1>Analysis</h1>
<p>Download the district grid shapefile <a href="images/districtgrid_.zip">here</a>. You can open this file with ArcGIS or an open-source GIS such as <a href="http://hub.qgis.org/projects/quantum-gis/wiki/Download">QGIS</a>. </p>
<p>Download this <a href="images/grid.kmz">kmz file</a> of the grid, which can be opened in Google Earth.
</body>
</html>
