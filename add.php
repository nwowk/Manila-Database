<?php
require_once "db.php";
session_start();
require 'includes/guardgeneral.ssi';
require 'includes/header.ssi';
?>
<!DOCTYPE html> 
<html> 
  <head> 
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> 
    
<title>Manila Database</title>
<link href="main.css" rel="stylesheet" type="text/css" />
<style type="text/css">
          #map_canvas 
	  { 
	   width: 90%;
	   height: 500px
	  }
</style>
    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyApkROPBq0A2ouQEFyaSm_xQi0BrENUC20&sensor=false">
    </script>
    <script type="text/javascript">
      function initialize() {
        var myOptions = {
          center: new google.maps.LatLng(14.671171,121.110851),
          zoom: 18,
          mapTypeId: google.maps.MapTypeId.HYBRID
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
            myOptions);
		var layer = new google.maps.FusionTablesLayer({
			query: {
				select: 'geometry',
				from: '3024596'
			}
		});
		layer.setMap(map);	
      }

      function validateForm() {
	var a=document.forms["add"]["district"].value;
	if (a==null || a=="") {
		alert("First district id must be filled out");
  		return false;
  	}
	return true;
	}
    </script> 
<?php
/* This page successfully adds the form to the database. however, the input checks do not work
 (numeric and required fields)
*/
?>
</head> 
<body id="home" onload="initialize()">
<?php
//This part checks to see whether the form has been filled.
if ( isset($_POST['district']) && isset($_POST['buildingtype_id']) 
     && isset($_POST['stories'])
     && isset($_POST['raised'])
     && isset($_POST['HHLDsize'])
     && isset($_POST['age1'])
     && isset($_POST['age2'])   
     && isset($_POST['age3']) 
     && isset($_POST['age4'])  
     && isset($_POST['age5']) 
     && isset($_POST['females'])
     && isset($_POST['prepare_id']) 
     && isset($_POST['ngo_id']) 
     && isset($_POST['contact_id']) 
     && isset($_POST['HOHgender']) 
     && isset($_POST['HOHage'])  
     && isset($_POST['dependents']))
{
//This portion adds the user-entered values into the Households table
   $dis = mysql_real_escape_string($_POST['district']);
   $lat = mysql_real_escape_string($_POST['lat']);
   $lon = mysql_real_escape_string($_POST['lon']);
   $bld = mysql_real_escape_string($_POST['buildingtype_id']);
   $sto = mysql_real_escape_string($_POST['stories']);
   $rsd = mysql_real_escape_string($_POST['raised']);
   $siz = mysql_real_escape_string($_POST['HHLDsize']);
   $ag1 = mysql_real_escape_string($_POST['age1']);
   $ag2 = mysql_real_escape_string($_POST['age2']);
   $ag3 = mysql_real_escape_string($_POST['age3']);
   $ag4 = mysql_real_escape_string($_POST['age4']);
   $ag5 = mysql_real_escape_string($_POST['age5']);
   $fem = mysql_real_escape_string($_POST['females']);
   $inc = mysql_real_escape_string($_POST['income']);
   $pre = mysql_real_escape_string($_POST['prepare_id']);
   $ngo = mysql_real_escape_string($_POST['ngo_id']);
   $con = mysql_real_escape_string($_POST['contact_id']);
   $gen = mysql_real_escape_string($_POST['HOHgender']);
   $age = mysql_real_escape_string($_POST['HOHage']);
   $dep = mysql_real_escape_string($_POST['dependents']);
   $dte = date("Y-m-d");
   $sql = "INSERT INTO Households (district, lat, lon, buildingtype_id, stories, 
	      raised, HHLDsize, age1, age2, age3, age4, age5, females, income, prepare_id, 
	      ngo_id, contact_id, HOHgender, HOHage, dependents, date) VALUES 
	      ('$dis', '$lat', '$lon', '$bld', '$sto', '$rsd', '$siz', '$ag1', '$ag2', 
	       '$ag3', '$ag4', '$ag5', '$fem', '$inc', '$pre', '$ngo', '$con', '$gen', '$age', '$dep', '$dte')";
   mysql_query($sql);
   $_SESSION['success'] = 'Record Added';
   header( 'Location: verify.php' ) ;
   return;	
}
?>
<!--This part is the form where users can enter household information.-->


<h1>Add a household to the database.</h1>
<table width="100%" border="0">
<tr>
<td colspan="2">
<tr valign="top">
<td style="width: 50%;text-align:top;">
<p>All fields are required unless otherwise indicated. </p>
<form name = "add" action="add.php" onsubmit="return validateform();" method="post">
<table border="1">
<tr>
<td width="50%">What is the district ID?</td>
<td width="50%"><input type="text" name="district"></td></tr> 
<tr><td>Latitude (optional):</td>
<td><input type="text" name="lat"></p></td></tr>
<tr><td>Longitude (optional):</td>
<td><input type="text" name="lon"></td></tr>
<tr><td>What is the building type? Choose one from the following list:</td>
<td>
<input type="radio" name="buildingtype_id" value="1">Light materials</br>
<input type="radio" name="buildingtype_id" value="2">Semi-concrete</br>
<input type="radio" name="buildingtype_id" value="3">All concrete</br>
</td></tr>
<tr><td>How many stories does the building have?</td>
<td><input type="text" name="stories"></td></tr>
<tr><td>Has the building been elevated or raised up from the ground?</td>
<td>
<input type="radio" name="raised_id" value="0">No</br>
<input type="radio" name="raised_id" value="1">Yes, with a concrete slab</br>
<input type="radio" name="raised_id" value="2">Yes, with bamboo</br>
<input type="radio" name="raised_id" value="3">Yes, with wood</br>
<input type="radio" name="raised_id" value="4">Yes, with a steel platform</br>
<input type="radio" name="raised_id" value="5">Yes, with cinder blocks</br>
<input type="radio" name="raised_id" value="6">Yes, with something else not listed here</br>
</td></tr>
<tr><td>What is the roof made of?</td>
<td>
<input type="radio" name="roof_id" value="1">Concrete</br>
<input type="radio" name="roof_id" value="2">Light Materials</br>
<input type="radio" name="roof_id" value="3">Metal</br>
<input type="radio" name="roof_id" value="4">Mixed</br>
</td></tr>
<tr><td>How many people live in this house?</td>
<td><input type="text" name="HHLDsize"></td></tr>
<tr><td>How many people are under the age of 6?</td>
<td><input type="text" name="young"></td></tr>
<tr><td>How many people are over the age of 60?</td>
<td><input type="text" name="old"></td>
<tr><td>How many adults in your household need help dressing, eating, or moving around?</td>
<td><input type="text" name="dependents"></td></tr>
<tr><td>What is your estimated household income PER MONTH?</td>
<td>
<input type="radio" name="income_id" value="1">0-4,999 pesos</br>
<input type="radio" name="income_id" value="2">5,000-9,999 pesos</br>
<input type="radio" name="income_id" value="3">10,000-14,999 pesos</br>
<input type="radio" name="income_id" value="4">15,000-19,999 pesos</br>
<input type="radio" name="income_id" value="5">20,000 and above</br>
<input type="radio" name="income_id" value="6">Don't know or no answer</br>
</td></tr>
<tr><td>Are you aware of whether your community organization has a disaster evacuation plan?</td>
<td>
<input type="radio" name="evacuation" value="1">Yes, I am aware</br>
<input type="radio" name="evacuation" value="0">No, I do not know</br>
</td></tr>
<tr><td>Have you ever participated in any disaster preparation training?</td>
<td>
<input type="radio" name="training" value="1">Yes</br>
<input type="radio" name="training" value="0">No</br>
</td></tr>
<tr><td>How does your household dispose of waste?</td>
<td>
<input type="radio" name="waste_id" value="1">garbage collector</br>
<input type="radio" name="waste_id" value="2">burning</br>
<input type="radio" name="waste_id" value="3">dumping in a public place</br>
<input type="radio" name="waste_id" value="4">dumping in water or vicinity</br>
</td></tr>
<tr><td>What is your primary source of water?</td>
<td>
<input type="radio" name="water_id" value="1">communal well</br>
<input type="radio" name="water_id" value="2">private faucet</br>
<input type="radio" name="water_id" value="3">river/stream</br>
<input type="radio" name="water_id" value="4">communal water pipe</br>
<input type="radio" name="water_id" value="5">private water seller</br>
<input type="radio" name="water_id" value="6">other</br>
</td></tr>
<tr><td>What is the best way to get your attention during a crisis?</td>
<td>
<input type="radio" name="contact_id" value="1">sms/text</br>
<input type="radio" name="contact_id" value="2">email/facebook</br>
<input type="radio" name="contact_id" value="3">radio</br>
<input type="radio" name="contact_id" value="4">TV</br>
</td></tr>
<tr><td>What is the gender of the head of household? [offer definition]</td>
<td>
<input type="radio" name="HOHgender" value="0">male</br>
<input type="radio" name="HOHgender" value="1">female</br>
</td></tr>
<tr><td>What is the age of the head of household?</td>
<td><input type="text" name="HOHage"></td></tr>
<tr><td><a href="add.php">Cancel</a></td>
<td><input type="submit" value="Add New"/></td></tr></table>
</form>
</td>
<td><div id="map_canvas" style="width:100% height:100%"></div></td>
</tr>
</table>

