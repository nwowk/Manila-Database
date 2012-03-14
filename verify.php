<?php
require_once "db.php";
session_start();
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
require 'includes/header.ssi';
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
 
   $sql = "INSERT INTO households (district, lat, lon, buildingtype_id, stories, 
	      raised, HHLDsize, age1, age2, age3, age4, age5, females, income, prepare_id, 
	      ngo_id, contact_id, HOHgender, HOHage, dependents, date) VALUES 
	      ('$dis', '$lat', '$lon', '$bld', '$sto', '$rsd', '$siz', '$ag1', '$ag2', 
	       '$ag3', '$ag4', '$ag5', '$fem', '$inc', '$pre', '$ngo', '$con', '$gen', '$age', '$dep', '$dte')";
   mysql_query($sql);
   $id = mysql_insert_id();
   $_SESSION['success'] = 'Record Updated';
   echo  "here...";
   header( 'Location: verify.php?id=' . $id ) ;
   return;	
}
$id = mysql_real_escape_string($_GET['id']);

$result = mysql_query("SELECT district, lat, lon, buildingtype_id, stories, raised, 
HHLDsize, age1, age2, age3, age4, age5, females, income, prepare_id, ngo_id, contact_id
HOHgender, HOHage, dependents, id FROM households WHERE id=$id");
if ( $result == FALSE ) {
    $_SESSION['error'] = 'Bad value for id';
    return;
}
$row = mysql_fetch_row($result);

   
$dis = htmlentities($row[0]);
$lat = htmlentities($row[1]);
$lon = htmlentities($row[2]);
$bld = htmlentities($row[3]);
$sto = htmlentities($row[4]);
$rsd = htmlentities($row[5]);
$hhldsz = htmlentities($row[6]);
$ag1 = htmlentities($row[7]);
$ag2 = htmlentities($row[8]);
$ag3 = htmlentities($row[9]);
$ag4 = htmlentities($row[10]);
$ag5 = htmlentities($row[11]);
$fem = htmlentities($row[12]);
$inc = htmlentities($row[13]);
$pre = htmlentities($row[14]);
$ngo = htmlentities($row[15]);
$con = htmlentities($row[16]);
$gen = htmlentities($row[17]);
$age = htmlentities($row[18]);
$dep = htmlentities($row[19]);


echo <<< _END


<h1>Confirm Record</h1>
<p>This is your <em>only</em> opportunity to make changes to this entry. If you need to change a field, make the change and click "Update entry." If everything is correct, click "Looks good! I want to add another household."
<form method="post">
<table>
<tr>
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
<td><input type="text" name="raised" value="$rsd"></td>
</tr><tr>
<td>Household Size:</td>
<td><input type="text" name="HHLDsize" value="$hhldsz"></td>
</tr><tr>
<td>Age Under 6:</td>
<td><input type="text" name="age1" value="$ag1"></td>
</tr><tr>
<td>Age 6-15:</td>
<td><input type="text" name="age2" value="$ag2"></td>
</tr><tr>
<td>Age 16-35:</td>
<td><input type="text" name="age3" value="$ag3"></td>
</tr><tr>
<td>Age 36-60:</td>
<td><input type="text" name="age4" value="$ag4"></td>
</tr><tr>
<td>Age Above 60:</td>
<td><input type="text" name="age5" value="$ag5"></td>
</tr><tr>
<td>HOH Female:</td>
<td><input type="text" name="females" value="$fem"></td>
</tr><tr>
<td>Income:</td>
<td><input type="text" name="income" value="$inc"></td>
</tr><tr>
<td>Preparation:</td>
<td><input type="text" name="prepare_id" value="$pre"></td>
</tr><tr>
<td>NGO:</td>
<td><input type="text" name="ngo_id" value="$ngo"></td>
</tr><tr>
<td>Contact:</td>
<td><input type="text" name="contact_id" value="$pre"></td>
</tr><tr>
<td>HOH gender:</td>
<td><input type="text" name="HOHgender" value="$gen"></td>
</tr><tr>
<td>HOH age:</td>
<td><input type="text" name="HOHage" value="$age"></td>
</tr><tr>
<td>Dependents:</td>
<td><input type="text" name="dependents" value="$dep"></td>
</tr><tr>
<input type="hidden" name="id" value="$id">
</tr><tr>
<p><input type="submit" value="Update entry"/>
</p>
</form>
<p><a href="add.php">Looks good! I want to add another household.</a></p>
_END
?>
</body>
</html>
