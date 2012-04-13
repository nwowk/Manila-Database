<?php
require_once "db.php";
session_start();
require 'includes/guardgeneral.ssi';

//This part checks to see whether the form has been filled.
	$userid = $_SESSION ['name'];
	$sqlthree = "SELECT id FROM users
			WHERE name = '$userid'";
	$resultthree = mysql_query ($sqlthree);
	$rolesetthree = mysql_fetch_row($resultthree);
	$_SESSION ['userid'] = $rolesetthree[0];

if ( isset($_POST['project_id']) 
     && isset($_POST['district'])
     && isset($_POST['buildingtype_id']) 
     && isset($_POST['stories'])
     && isset($_POST['raised_id'])
     && isset($_POST['roof_id'])
     && isset($_POST['HHLDsize'])
     && isset($_POST['young'])   
     && isset($_POST['old']) 
     && isset($_POST['dependents'])  
     && isset($_POST['income_id']) 
     && isset($_POST['evacuation'])
     && isset($_POST['training']) 
     && isset($_POST['waste_id']) 
     && isset($_POST['water_id']) 
     && isset($_POST['contact_id']) 
     && isset($_POST['HOHgender']) 
//   && isset($_POST['users_id']) 
     && isset($_POST['HOHage']))
{
//This portion adds the user-entered values into the Households table
   $pid = mysql_real_escape_string($_POST['project_id']);
   $dis = mysql_real_escape_string($_POST['district']);
   $lat = mysql_real_escape_string($_POST['lat']);
   $lon = mysql_real_escape_string($_POST['lon']);
   $bld = mysql_real_escape_string($_POST['buildingtype_id']);
   $sto = mysql_real_escape_string($_POST['stories']);
   $rsd = mysql_real_escape_string($_POST['raised_id']);
   $rof = mysql_real_escape_string($_POST['roof_id']);
   $siz = mysql_real_escape_string($_POST['HHLDsize']);
   $yng = mysql_real_escape_string($_POST['young']);
   $old = mysql_real_escape_string($_POST['old']);
   $dep = mysql_real_escape_string($_POST['dependents']);
   $inc = mysql_real_escape_string($_POST['income_id']);
   $eva = mysql_real_escape_string($_POST['evacuation']);
   $tra = mysql_real_escape_string($_POST['training']);
   $was = mysql_real_escape_string($_POST['waste_id']);
   $wtr = mysql_real_escape_string($_POST['water_id']);
   $con = mysql_real_escape_string($_POST['contact_id']);
   $gen = mysql_real_escape_string($_POST['HOHgender']);
   $age = mysql_real_escape_string($_POST['HOHage']);
   $dte = date("Y-m-d");
   $usr = $_SESSION['userid'];

   $sql = "INSERT INTO households (project_id, district, lat, lon, buildingtype_id, stories, 
	      raised_id, roof_id, HHLDsize, young, old, dependents, income_id, evacuation, training, waste_id, 
	      water_id, contact_id, HOHgender, HOHage, date, users_id) VALUES
	      ('$pid', '$dis', '$lat', '$lon', '$bld', '$sto', '$rsd', '$rof', '$siz', '$yng', 
	       '$old', '$dep', '$inc', '$eva', '$tra', '$was', '$wtr', '$con', '$gen', '$age', '$dte', '$usr')";
   mysql_query($sql);
   $_SESSION['success'] = 'Record Added';
   $id = mysql_insert_id();
   $_SESSION ['lasthhld'] = $id;
   //echo $sql;
   header( 'Location: verify.php' ) ;
   return;
}

require 'includes/header.ssi';
?>

<!DOCTYPE html> 
<html> 
  <head> 
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> 
    <script src="includes/gen_validatorv4.js" type="text/javascript"></script>

<title>Manila Database</title>
<style type="text/css">
      
</style>
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
</head> 
<body id="homewide" onload="initialize()">


<!--This part is the form where users can enter household information.-->


<h1>Add a household to the database.</h1>
<table width="100%" border="0" class="float">
<tr>
<td colspan="2">
<tr valign="top">
<td style="width: 50%;text-align:top;">
<p>All fields are required unless otherwise indicated. </p>
<form name = "add" action="add.php" onsubmit="return validateform();" method="post">
<table border="0">

<tr>
<tr>
<tr><td>What is the project name?</td>
<td>
<select name = 'project_id' id = 'project_id'>
<?php
    $p_result = mysql_query("SELECT name, id FROM projects ORDER BY name");
    while ( $row = mysql_fetch_row($p_result) ) {
	echo ("<option value = '" . $row['1'] . "'>" . $row['0'] . "</option>");
    }
?>
</select>

</td></tr>
<td width="50%">What is the district ID?</td>
<td width="50%"><div id='add_district_errorloc' class='error_strings'></div>
<input type="text" name="district"></td></tr> 
<tr><td>Latitude (optional):</td>
<td><input type="text" name="lat"></p></td></tr>
<tr><td>Longitude (optional):</td>
<td><input type="text" name="lon"></td></tr>
<tr><td>What is the building type? Choose one from the following list:</td>
<td><div id='add_buildingtype_id_errorloc' class='error_strings'></div>
<input type="radio" name="buildingtype_id" value="1">Light materials</br>
<input type="radio" name="buildingtype_id" value="2">Semi-concrete</br>
<input type="radio" name="buildingtype_id" value="3">All concrete</br>
</td></tr>
<tr><td>How many stories does the building have?</td>
<td><div id='add_stories_errorloc' class='error_strings'></div>
<input type="text" name="stories"></td></tr>
<tr><td>Has the building been elevated or raised up from the ground?</td>
<td><div id='add_raised_id_errorloc' class='error_strings'></div>
<input type="radio" name="raised_id" value="1">No</br>
<input type="radio" name="raised_id" value="2">Yes, with a concrete slab</br>
<input type="radio" name="raised_id" value="3">Yes, with bamboo</br>
<input type="radio" name="raised_id" value="4">Yes, with wood</br>
<input type="radio" name="raised_id" value="5">Yes, with a steel platform</br>
<input type="radio" name="raised_id" value="6">Yes, with cinder blocks</br>
<input type="radio" name="raised_id" value="7">Yes, with something else not listed here</br>
</td></tr>
<tr><td>What is the roof made of?</td>
<td><div id='add_roof_id_errorloc' class='error_strings'></div>
<input type="radio" name="roof_id" value="1">Concrete</br>
<input type="radio" name="roof_id" value="2">Light Materials</br>
<input type="radio" name="roof_id" value="3">Metal</br>
<input type="radio" name="roof_id" value="4">Mixed</br>
</td></tr>
<tr><td>How many people live in this house?</td>
<td><div id='add_HHLDsize_errorloc' class='error_strings'></div>
<input type="text" name="HHLDsize"></td></tr>
<tr><td>How many people are under the age of 6?</td>
<td><div id='add_young_errorloc' class='error_strings'></div>
<input type="text" name="young"></td></tr>
<tr><td>How many people are over the age of 60?</td>
<td><div id='add_old_errorloc' class='error_strings'></div>
<input type="text" name="old"></td>
<tr><td>How many adults in your household need help dressing, eating, or moving around?</td>
<td><div id='add_dependents_errorloc' class='error_strings'></div>
<input type="text" name="dependents"></td></tr>
<tr><td>What is your estimated household income PER MONTH?</td>
<td><div id='add_income_id_errorloc' class='error_strings'></div>
<input type="radio" name="income_id" value="1">under 2,000 pesos</br>
<input type="radio" name="income_id" value="2">2,001-3,000 pesos</br>
<input type="radio" name="income_id" value="3">3,001-5,000 pesos</br>
<input type="radio" name="income_id" value="4">5,001-10,000</br>
<input type="radio" name="income_id" value="5">more than 10,000</br>
<input type="radio" name="income_id" value="6">Don't know or no answer</br>
</td></tr>
<tr><td>Are you aware of whether your community organization has a disaster evacuation plan?</td>
<td><div id='add_evacuation_errorloc' class='error_strings'></div>
<input type="radio" name="evacuation" value="1">Yes, I am aware</br>
<input type="radio" name="evacuation" value="0">No, I do not know</br>
</td></tr>
<tr><td>Have you ever participated in any disaster preparation training?</td>
<td><div id='add_training_errorloc' class='error_strings'></div>
<input type="radio" name="training" value="1">Yes</br>
<input type="radio" name="training" value="0">No</br>
</td></tr>
<tr><td>How does your household dispose of waste?</td>
<td><div id='add_waste_id_errorloc' class='error_strings'></div>
<input type="radio" name="waste_id" value="1">garbage collector</br>
<input type="radio" name="waste_id" value="2">burning</br>
<input type="radio" name="waste_id" value="3">dumping in a public place</br>
<input type="radio" name="waste_id" value="4">dumping in water or vicinity</br>
</td></tr>
<tr><td>What is your primary source of water?</td>
<td><div id='add_water_id_errorloc' class='error_strings'></div>
<input type="radio" name="water_id" value="1">communal well</br>
<input type="radio" name="water_id" value="2">private faucet</br>
<input type="radio" name="water_id" value="3">river/stream</br>
<input type="radio" name="water_id" value="4">communal water pipe</br>
<input type="radio" name="water_id" value="5">private water seller</br>
<input type="radio" name="water_id" value="6">other</br>
</td></tr>
<tr><td>What is the best way to get your attention during a crisis?</td>
<td><div id='add_contact_id_errorloc' class='error_strings'></div>
<input type="radio" name="contact_id" value="1">sms/text</br>
<input type="radio" name="contact_id" value="2">email/facebook</br>
<input type="radio" name="contact_id" value="3">radio</br>
<input type="radio" name="contact_id" value="4">TV</br>
</td></tr>
<tr><td>What is the gender of the head of household?</td>
<td><div id='add_HOHgender_errorloc' class='error_strings'></div>
<input type="radio" name="HOHgender" value="0">male</br>
<input type="radio" name="HOHgender" value="1">female</br>
</td></tr>
<tr><td>What is the age of the head of household?</td>
<td><div id='add_HOHage_errorloc' class='error_strings'></div>
<input type="text" name="HOHage"></td></tr>
<tr><td><a href="add.php">Cancel</a></td>
<td><input type="submit" value="Add New"/></td></tr></table>
</form>
<script language="JavaScript" type="text/javascript">
    var frmvalidator = new Validator("add");
 frmvalidator.EnableOnPageErrorDisplay();
 frmvalidator.EnableMsgsTogether();
  
 frmvalidator.addValidation("district","numeric","District ID must be a number");
 frmvalidator.addValidation("district","req","This field is required");
 
 frmvalidator.addValidation("buildingtype_id","selone_radio","Please select an option");
 
 frmvalidator.addValidation("stories","numeric","This field must be a number");
 frmvalidator.addValidation("stories","req","This field is required");
 
 frmvalidator.addValidation("raised_id","selone_radio","Please select an option")
 frmvalidator.addValidation("roof_id","selone_radio","Please select an option");
 
 frmvalidator.addValidation("HHLDsize","numeric","This field must be a number");
 frmvalidator.addValidation("HHLDsize","req","This field is required");
 
 frmvalidator.addValidation("young","numeric","This field must be a number");
 frmvalidator.addValidation("young","req","This field is required");
 
 frmvalidator.addValidation("old","numeric","This field must be a number");
 frmvalidator.addValidation("old","req","This field is required");
 
 frmvalidator.addValidation("dependents","numeric","This field must be a number");
 frmvalidator.addValidation("dependents","req","This field is required");
 
 frmvalidator.addValidation("income_id","selone_radio","Please select an option");
 frmvalidator.addValidation("evacuation","selone_radio","Please select an option");
 frmvalidator.addValidation("training","selone_radio","Please select an option");
 frmvalidator.addValidation("waste_id","selone_radio","Please select an option");
 frmvalidator.addValidation("water_id","selone_radio","Please select an option");
 frmvalidator.addValidation("contact_id","selone_radio","Please select an option");
 frmvalidator.addValidation("HOHgender","selone_radio","Please select an option");
 
 frmvalidator.addValidation("HOHage","numeric","Age must be a number");
 frmvalidator.addValidation("HOHage","req","This field is required");

</script>
</td>
<td><div id="map_canvas" style="width:100% height:100%"></div></td>
</tr>
</table>
<p>&nbsp;</p>