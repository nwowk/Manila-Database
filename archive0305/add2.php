<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
require_once "db.php";
session_start();
/* This page successfully adds the form to the database. however, the input checks do not work
 (numeric and required fields)
*/

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
/*if the optional variables are not set, they are given missing codes
   if ( ! isset($_POST['lat'])) {
        $_POST['lat'] = 99;
        }
   if ( ! isset($_POST['lon'])) {
        $_POST['lon'] = 99;
        }
   if ( ! isset($_POST['income'])) {
        $_POST['income'] = 9999;
        }
*/
//delivers error message if the numeric variables do not contain numbers
   if ( ! is_numeric($_POST['stories']) && is_numeric($_POST['age1'])
      && is_numeric($_POST['age2'])
      && is_numeric($_POST['age3'])
      && is_numeric($_POST['age4'])
      && is_numeric($_POST['age5'])
      && is_numeric($_POST['females'])
      && is_numeric($_POST['HOHage'])
      && is_numeric($_POST['dependents'])
      && is_numeric($_POST['district'])
      //or ! is_numeric($_POST['lat'])
      //or ! is_numeric($_POST['lon'])
      ){
      $_SESSION['error'] = 'Values for district, latitude, longitude, number of stories, ages, number 
	of females, income, head of household age, and number of adult dependents 
	must be numeric.';
      header( 'Location: index.php' ) ;
      return;
      }
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
   header( 'Location: index.php' ) ;
   return;	
}
$_POST['lat']=0;
$_POST['lon']=0;
$_POST['income']=0;
?>
<head>
<?php
require 'includes/header.ssi';
?>
</head>
<body id="home">
<?php
if ( isset($_SESSION ['name']) ) 
{
	$yourname = $_SESSION['name'];
	$yourrole = $_SESSION['role'];
?>
<!--This part is the form where users can enter household information.-->
<h1>Add a household to the database.</h1>
<h2>All fields are required unless otherwise indicated. </h2>
<form method="post">
<table>
<tr>
<td width="500px">What is the district ID?</td>
<td width="200px"><input type="text" name="district"></td></tr> 
<? if(isset($_POST['district']))	{?><p style="color:red">Incorrect entry. Value must be numeric.</p><?}?>
<tr><td>Latitude (optional):></td>
<td><input type="text" name="lat"></p></td></tr>
<tr><td>Longitude (optional):</td>
<td><input type="text" name="lon"></td></tr>
<tr><td>What is the building type? Choose one from the following list:</td>
<td><select name="buildingtype_id">
<option value="1">Wooden walls/concrete floor</option>
<option value="2">Concrete or masonry construction</option>
<option value="3">Wood and metal, dirt floor</option>
<option value="4">Mixed materials</option></p>
</select></td></tr>
<tr><td>How many stories does the building have?</td>
<td><input type="text" name="stories"></td></tr>
<? if(isset($_POST['stories']))	{?><p style="color:red">Incorrect entry. Value must be numeric.</p><?}?>
<tr><td>Has the building been elevated from the ground through the use of stilts, cinder blocks, or some other platform?</td>
<td><select name="raised">
<option value="Y">Yes</option>
<option value="N">No</option>
</select></td></tr>
<tr><td>How many people are a part of this household?</td>
<td><input type="text" name="HHLDsize"></td></tr>
<? if(isset($_POST['HHLDsize']))	{?><p style="color:red">Incorrect entry. Value must be numeric or incorrect total number of members.</p><?}?>
<tr><td>How many people are under the age of 6?</td>
<td><input type="text" name="age1"></td></tr>
<? if(isset($_POST['age1']))	{?><p style="color:red">Incorrect entry. Value must be numeric.</p><?}?>
<tr><td>How many people are between the ages of 6 and 15, inclusive?</td>
<td><input type="text" name="age2"></p></td></tr>
<?php if(isset($_POST['age2']))	{?><p style="color:red">Incorrect entry. Value must be numeric.</p><?}?>
<tr><td>How many people are between the ages of 16 ond 35, inclusive?</td>
<td><input type="text" name="age3"></td></tr>
<?php if(isset($_POST['age3']))	{?><p style="color:red">Incorrect entry. Value must be numeric.</p><?}?>
<tr><td>How many people are between the ages of 36 ond 60, inclusive?</td>
<td><input type="text" name="age4"></p></td></tr>
<?php if(isset($_POST['age4']))	{?><p style="color:red">Incorrect entry. Value must be numeric.</p><?}?>
<tr><td>How many people are over the age of 60?</td>
<td><input type="text" name="age5"></td>
<?php if(isset($_POST['age5']))	{?><p style="color:red">Incorrect entry. Value must be numeric.</p><?}?>
<tr><td>Of the people in your household, how many are females?</td>
<td><input type="text" name="females"></td></tr>
<?php if(isset($_POST['females']))	{?><p style="color:red">Incorrect entry. Value must be numeric.</p><?}?>
<tr><td>What is your estimated household income PER MONTH? (optional)</td>
<td><input type="text" name="income"></td></tr>
<tr><td>What has your household done to prepare for disaster? If more than one, choose the one you think is most important.</td>
<td><select name="prepare_id">
<option value="1">Participated in an early warning system or other emergency drill</option>
<option value="2">Participated in a community mapping session or other non-drill disaster related education</option>
<option value="3">Option 3 goes here</option>
<option value="4">Option 4 goes here</option>
<option value="5">Option 5 goes here</option>
</select></td></tr>
<tr><td>Is your household an active member of any of these organizations? Again, choose the one you most often visit or participate in. </td>
<td><select name="ngo_id">
<option value="1">Buklod Tao</option>
<option value="2">Tao Pilipinas</option>
<option value="3">Center for Disaster Preparedness</option>
<option value="4">NGO 4</option>
<option value="5">NGO 5</option>
</select></td></tr>
<tr><td>What is the best way to get your attention during a crisis?</td>
<td><select name="contact_id">
<option value="1">sms/text</option>
<option value="2">email/facebook</option>
<option value="3">radio</option>
<option value="4">TV</option>
</select></td></tr>
<tr><td>What is the gender of the head of household? [offer definition]</td>
<td><select name="HOHgender">
<? if(isset($_POST['HOHage']))	{?><p style="color:red">Incorrect entry. Value must be numeric.</p><?}?>
<option value="M">Male</option>
<option value="F">Female</option>
</select></td></tr>
<tr><td>What is the age of the head of household?</td>
<td><input type="text" name="HOHage"></td></tr>
<tr><td>Of the adults in your household, that is, everyone older than 16, how many of them are dependent? That is, they are unable to earn income because of a physical or mental disability or age.</td>
<td><input type="text" name="dependents"></td></tr>
<tr><td><input type="submit" value="Add New"/></td>
<td><a href="index.php">Cancel</a></td></tr></table>
</form>
<?php
}
else 
{
	echo '<h1>Please Login</h1>';
}
?>
</body>
</html>