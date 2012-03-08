
<!DOCTYPE html> 
<html> 
  <head> 
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> 
    <style type="text/css"> 
      <html { height: 100% }
      body 
	  { 
	  height: 100%; margin: 0; padding: 0; 
	  background-image: linear-gradient(bottom, rgb(69,173,81) 0%, rgb(214,202,141) 0%, rgb(255,255,255) 80%);
	  background-image: -o-linear-gradient(bottom, rgb(69,173,81) 0%, rgb(214,202,141) 0%, rgb(255,255,255) 80%);
 	  background-image: -moz-linear-gradient(bottom, rgb(69,173,81) 0%, rgb(214,202,141) 0%, rgb(255,255,255) 80%);
	  background-image: -webkit-linear-gradient(bottom, rgb(69,173,81) 0%, rgb(214,202,141) 0%, rgb(255,255,255) 80 );
	  background-image: -ms-linear-gradient(bottom, rgb(69,173,81) 0%, rgb(214,202,141) 0%, rgb(255,255,255) 80%);
 
	  background-image: -webkit-gradient(
		linear,
		left bottom,
		left top,
		color-stop(0, rgb(69,173,81)),
		color-stop(0, rgb(214,202,141)),
		color-stop(0.8, rgb(255,255,255))
	  );
	  }
	  h1
	  {
	  font-family: verdana;
	  margin-left: 5%
	  }
	  p
	  {
	  font-family: verdana;
	  margin-left: 5%
	  }
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
require_once "db.php";
session_start();
/* This page successfully adds the form to the database. however, the input checks do not work
 (numeric and required fields)
*/
?>
</head> 
<body onload="initialize()">
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
<p>What is the district ID?
<input type="text" name="district"></p>
<p>Latitude (optional):
<input type="text" name="lat"></p>
<p>Longitude (optional):
<input type="text" name="lon"></p>
<p>What is the building type? Choose one from the following list:
<select name="buildingtype_id">
<option value="1">Wooden walls/concrete floor</option>
<option value="2">Concrete or masonry construction</option>
<option value="3">Wood and metal, dirt floor</option>
<option value="4">Mixed materials</option></p>
</select></p>
<p>How many stories does the building have?
<input type="text" name="stories"></p>
<p>Has the building been elevated from the ground through the use of stilts, cinder blocks, or some other platform?
<select name="raised">
<option value="Y">Yes</option>
<option value="N">No</option>
</select></p>
<p>How many people are a part of this household?
<input type="text" name="HHLDsize"></p>
<p>How many people are under the age of 6?
<input type="text" name="age1"></p>
<p>How many people are between the ages of 6 and 15, inclusive?
<input type="text" name="age2"></p>
<p>How many people are between the ages of 16 and 35, inclusive?
<input type="text" name="age3"></p>
<p>How many people are between the ages of 36 and 60, inclusive?
<input type="text" name="age4"></p>
<p>How many people are over the age of 60?
<input type="text" name="age5"></p>
<p>Of the people in your household, how many are females?
<input type="text" name="females"></p>
<p>What is your estimated household income PER MONTH? (optional)
<input type="text" name="income"></p>
<p>What has your household done to prepare for disaster? If more than one, choose the one you think is most important.
<select name="prepare_id">
<option value="1">Participated in an early warning system or other emergency drill</option>
<option value="2">Participated in a community mapping session or other non-drill disaster related education</option>
<option value="3">Option 3 goes here</option>
<option value="4">Option 4 goes here</option>
<option value="5">Option 5 goes here</option>
</select></p>
<p>Is your household an active member of any of these organizations? Again, choose the one you most often visit or participate in. 
<select name="ngo_id">
<option value="1">Buklod Tao</option>
<option value="2">Tao Pilipinas</option>
<option value="3">Center for Disaster Preparedness</option>
<option value="4">NGO 4</option>
<option value="5">NGO 5</option>
</select></p>
<p>What is the best way to get your attention during a crisis?
<select name="contact_id">
<option value="1">sms/text</option>
<option value="2">email/facebook</option>
<option value="3">radio</option>
<option value="4">TV</option>
</select></p>
<p>What is the gender of the head of household? [offer definition]
<select name="HOHgender">
<option value="M">Male</option>
<option value="F">Female</option>
</select></p>
<p>What is the age of the head of household?
<input type="text" name="HOHage"></p>
<p>Of the adults in your household, that is, everyone older than 16, how many of them are dependent? That is, they are unable to earn income because of a physical or mental disability or age.
<input type="text" name="dependents"></p>
<p><input type="submit" value="Add New"/>
<a href="add.php">Cancel</a></p>
</form>
</td>
<td><div id="map_canvas" style="width:100% height:100%"></div></td>
</tr>
</table>

