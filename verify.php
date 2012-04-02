<?php
require_once "db.php";
session_start();
require 'includes/guardgeneral.ssi';

//This part checks to see whether the form has been filled.
$id = mysql_real_escape_string($_SESSION['lasthhld']);
if ( isset($_POST['btnupdate']) 
/*   && isset($_POST['district']) 
//   && isset($_POST['lat']) 
//   && isset($_POST['lon']) 
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
     && isset($_POST['HOHage'])
     && isset($_POST['date']) */
     )     
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
// $usr = mysql_real_escape_string($_POST['user_id']);
   $dte = date("Y-m-d");
  
   $sql = "UPDATE households 
		   SET project_id='$pid', district='$dis', lat='$lat', lon='$lon', 
		   buildingtype_id='$bld', stories='$sto', raised_id='$rsd', roof_id='$rof', 
		   HHLDsize='$siz', young='$yng', old='$old', dependents='$dep', 
		   income_id='$inc', evacuation='$eva', training='$tra', waste_id='$was', 
		   water_id='$wtr', contact_id='$con', HOHgender='$gen', HOHage='$age', date='$dte' 
		   where id=$id";
	  
	  /* (project_id, district, lat, lon, buildingtype_id, stories, 
	      raised_id, roof_id, HHLDsize, young, old, dependents, income_id, evacuation, training, waste_id, 
	      water_id, contact_id, HOHgender, HOHage, date) VALUES 
	      ('$pid','$dis', '$lat', '$lon', '$bld', '$sto', '$rsd', '$rof', '$siz', '$yng', 
	       '$old', '$dep', '$inc', '$eva', '$tra', '$was', '$wtr', '$con', '$gen', '$age','$dte')";
	       */
   mysql_query($sql);
   $_SESSION['success'] = 'Record Updated';
//   echo  "here...";
   $_SESSION ['lasthhld'] = $id;
   header( 'Location: verify.php' ) ;
   return;	
}


$result = mysql_query("SELECT project_id, district, lat, lon, buildingtype_id, stories, raised_id, 
		  roof_id, HHLDsize, young, old, dependents, income_id, evacuation, training, waste_id, 
	      water_id, contact_id, HOHgender, HOHage, id FROM households WHERE id='$id'");
if ( $result == FALSE ) {
    $_SESSION['error'] = 'Bad value for id';
    return;    
}
$row = mysql_fetch_row($result);

$pid = htmlentities($row[0]);
$dis = htmlentities($row[1]);
$lat = htmlentities($row[2]);
$lon = htmlentities($row[3]);
$bld = htmlentities($row[4]);
$sto = htmlentities($row[5]);
$rsd = htmlentities($row[6]);
$rof = htmlentities($row[7]);
$siz = htmlentities($row[8]);
$yng = htmlentities($row[9]);
$old = htmlentities($row[10]);
$dep = htmlentities($row[11]);
$inc = htmlentities($row[12]);
$eva = htmlentities($row[13]);
$tra = htmlentities($row[14]);
$was = htmlentities($row[15]);
$wtr = htmlentities($row[16]);
$con = htmlentities($row[17]);
$gen = htmlentities($row[18]);
$age = htmlentities($row[19]);

require 'includes/header.ssi';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="verify-v1" content="3MgGfMT/t0qC3+Qf9+cNxGNU8ehk9JEfhDHIdhQEQu4=" />
<title>Manila Database</title>
<link href="main.css" rel="stylesheet" type="text/css" />
<style type="text/css">
</style>
</head>
<body id="home">

<?php
echo <<< _END

<h1>Confirm Record</h1>
<p>This is your <em>only</em> opportunity to make changes to this entry. If you need to change a field, make the change and click "Update entry." If everything is correct, click "Looks good! I want to add another household."
<form method="post">
<table>
<tr>
<td>Project #</td>
<td><input type="text" name="project_id" value="$pid"></td>
</tr><tr>
<td>District:</td>
<td><input type="text" name="district" value="$dis"></td>
</tr><tr>
<td>Lat:</td>
<td><input type="text" name="lat" value="$lat"></td>
</tr><tr>
<td>Lon:</td>
<td><input type="text" name="lon" value="$lon"></td>
</tr><tr>
<td>Building Type:</td>
<td><input type="text" name="buildingtype_id" value="$bld"></td>
</tr><tr>
<td>Stories:</td>
<td><input type="text" name="stories" value="$sto"></td>
</tr><tr>
<td>Raised:</td>
<td><input type="text" name="raised_id" value="$rsd"></td>
</tr><tr>
<td>Roof Type:</td>
<td><input type="text" name="roof_id" value="$rof"></td>
</tr><tr>
<td>Household Size:</td>
<td><input type="text" name="HHLDsize" value="$siz"></td>
</tr><tr>
<td>Age Under 6:</td>
<td><input type="text" name="young" value="$yng"></td>
</tr><tr>
<td>Age Over 60:</td>
<td><input type="text" name="old" value="$old"></td>
</tr><tr>
<td>Adult Dependents:</td>
<td><input type="text" name="dependents" value="$dep"></td>
</tr><tr>
<td>Income:</td>
<td><input type="text" name="income_id" value="$inc"></td>
</tr><tr>
<td>Evacuation:</td>
<td><input type="text" name="evacuation" value="$eva"></td>
</tr><tr>
<td>Training:</td>
<td><input type="text" name="training" value="$tra"></td>
</tr><tr>
<td>Waste Disposal:</td>
<td><input type="text" name="waste_id" value="$was"></td>
</tr><tr>
<td>Water Source:</td>
<td><input type="text" name="water_id" value="$wtr"></td>
</tr><tr>
<td>Contact:</td>
<td><input type="text" name="contact_id" value="$con"></td>
</tr><tr>
<td>HOH gender:</td>
<td><input type="text" name="HOHgender" value="$gen"></td>
</tr><tr>
<td>HOH age:</td>
<td><input type="text" name="HOHage" value="$age"></td>
</tr><tr>
<input type="hidden" name="id" value="$id">
</tr><tr>
<p><input type="submit" name="btnupdate" value="Update entry"/>
</p>
</form>
<p><a href="add.php">Looks good! I want to add another household.</a></p>
_END;
?>
</body>
</html>
