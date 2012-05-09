<?php
require_once "db.php";
session_start();
require 'includes/guardgeneral.ssi';

$id = mysql_real_escape_string($_SESSION['lasthhld']);

$query= "SELECT projects.name, households.district, households.lat, households.lon, 
          buildingtype.value, households.stories, raised.value, roof.value, households.HHLDsize, 
          households.young, households.old, households.dependents, income.value, households.evacuation, 
          households.training, waste.value, water.value, contact.value, households.HOHgender, 
          households.HOHage, households.familyname, households.zone FROM households 
	  JOIN projects JOIN buildingtype JOIN raised JOIN roof JOIN income
          JOIN waste JOIN water JOIN contact on households.project_id = projects.id and households.buildingtype_id =    
          buildingtype.id and
          households.raised_id = raised.id and households.roof_id = roof.id and households.income_id = 
          income.id and households.waste_id =  waste.id and households.water_id = water.id and 
          households.contact_id = contact.id WHERE households.id = '$id'";
$result = mysql_query($query);
if ( $result == FALSE ) {
    $_SESSION['error'] = 'Bad value for id';
    header( 'Location: add.php' ) ;
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
$name = htmlentities($row[20]);
$zone = htmlentities($row[21]);

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
<p>This is your <em>only</em> opportunity to review this entry. If everything is correct, click "Looks good! I want to add another household." Otherwise, delete the entry and start over.
<table>
<tr>
<td>Project Name:</td>
<td>$pid</td>
</tr><tr>
<td>District:</td>
<td>$dis</td>
</tr><tr>
<td>Zone:</td>
<td>$zone</td>
</tr><tr>
<td>Lat:</td>
<td>$lat</td>
</tr><tr>
<td>Lon:</td>
<td>$lon</td>
</tr><tr>
<td>Family Name:</td>
<td>$name</td>
</tr><tr>
<td>Building Type:</td>
<td>$bld</td>
</tr><tr>
<td>Stories:</td>
<td>$sto</td>
</tr><tr>
<td>Raised:</td>
<td>$rsd</td>
</tr><tr>
<td>Roof Type:</td>
<td>$rof</td>
</tr><tr>
<td>Household Size:</td>
<td>$siz</td>
</tr><tr>
<td>Age Under 6:</td>
<td>$yng</td>
</tr><tr>
<td>Age Over 60:</td>
<td>$old</td>
</tr><tr>
<td>Adult Dependents:</td>
<td>$dep</td>
</tr><tr>
<td>Income:</td>
<td>$inc</td>
</tr>
_END;
?>

<tr>
<td>Evacuation:</td>
<td> <?php if ($eva = 1)
 echo "Yes, I am aware" ;
if ($eva=0)
echo "No, I do not know" ; ?> </td>
</tr><tr>
<td>Training:</td>
<td><?php if ($tra = 1)
 echo "Yes" ;
if ($tra=0)
echo "No"  ?> </td>
</tr>

<?php
echo <<< _END
<tr>
<td>Waste Disposal:</td>
<td>$was</td>
</tr><tr>
<td>Water Source:</td>
<td>$wtr</td>
</tr><tr>
<td>Contact:</td>
<td>$con</td>
</tr>
_END;
?>
<tr>
<td>HOH gender:</td>
<td> <?php if ($eva = 0)
 echo "Male" ;
if ($eva=1)
echo "Female" ?> </td>
</tr><tr>
<td>HOH age:</td>
<td><?php echo($age) ?> </td>
</tr>
<form method="post" name="add">
<tr>
<input type="hidden" name="id" value="$id">
</tr>
<!-- <p><input type="submit" name="btnupdate" value="Update entry"/>
</p> -->
</form>
<p><a href="add.php">Looks good! I want to add another household.</a></p>
<?php
echo("<p><a href='delete.php?id=".$id."'>No, I want to delete this entry and start over.</a><p>");
?>
</body>
</html>
