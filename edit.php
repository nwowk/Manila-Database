<?php
require_once "db.php";
session_start();
require 'includes/guard23.ssi';
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
<h1>Edit Record</h1>

<?php
if ( isset($_POST['district']) && isset($_POST['date']) 
     && isset($_POST['lat']) && isset($_POST['lon']) 
     && isset($_POST['buildingtype_id']) && isset($_POST['stories']) 
     && isset($_POST['raised']) && isset($_POST['HHLDsize']) 
     && isset($_POST['age1']) && isset($_POST['age2']) 
     && isset($_POST['age3']) && isset($_POST['age4']) 
     && isset($_POST['age5']) && isset($_POST['females'])
     && isset($_POST['income']) && isset($_POST['prepare_id']) 
     && isset($_POST['ngo_id']) && isset($_POST['contact_id']) 
     && isset($_POST['HOHgender']) && isset($_POST['HOHage']) 
     && isset($_POST['dependents']) && isset($_POST['users_id']) 
     ) 
    $id = mysql_real_escape_string($_POST['id']);
    $dis = mysql_real_escape_string($_POST['district']);
    $date = mysql_real_escape_string($_POST['date']);
    $lat = mysql_real_escape_string($_POST['lat']);
    $lon = mysql_real_escape_string($_POST['lon']);
    $bld = mysql_real_escape_string($_POST['buildingtype_id']);
    $sto = mysql_real_escape_string($_POST['stories']);
    $rsd = mysql_real_escape_string($_POST['raised']);
    $hhldsz = mysql_real_escape_string($_POST['HHLDsize']); 
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
    

$id = mysql_real_escape_string($_GET['id']);
$result = mysql_query("SELECT district, lat, lon, buildingtype_id, stories, raised, 
HHLDsize, age1, age2, age3, age4, age5, females, prepare_id, ngo_id, contact_id
HOHgender, HOHage, dependents, id FROM manila WHERE id='$id'");
$row = mysql_fetch_row($result);
if ( $row == FALSE ) {
    $_SESSION['error'] = 'Bad value for id';
    header( 'Location: index.php' ) ;
    return;
}
   
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
$id = htmlentities($row[20]);

echo <<< _END
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
<input type="hidden" name="id" value="$id">
<p><input type="submit" value="Update"/>
<a href="index.php">Cancel</a></p>
</form>
_END
?>
</body>
</html>
