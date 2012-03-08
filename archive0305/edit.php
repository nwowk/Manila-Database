<?php
require_once "db.php";
session_start();

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
     ) {
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
    
	if (is_numeric($p) 
		&&is_numeric($r)
		
		) {
   		$sql = "UPDATE households SET district='$dis', lat='$lat', lon='$lon', buildingtype_id='$bld',
              stories='$sto', raised='$rsd', HHLDsize='$hhldsz', age1='$ag1', age2='$ag2', age3='$ag3',
              age4='$ag4', age5='$ag5', females='$fem', income='inc', prepared_id='$pre', ngo_id='$ngo',
              contact_id='$con', HOHgender='$gen', HOHage='$age', dependents='$dep' WHERE id=$id"; 
   		mysql_query($sql);
 	 	 $_SESSION['success'] = 'Record Updated';
  		 header( 'Location: index.php' ) ;
  	 	return;
  	}

    $_SESSION['error'] = 'Entry not recorded. Value for district and Rating must be numeric.';
    header( 'Location: index.php' ) ;
    return;
}

$id = mysql_real_escape_string($_GET['id']);
$result = mysql_query("SELECT district, play_count, rating, id 
    FROM tracks WHERE id='$id'");
$row = mysql_fetch_row($result);
if ( $row == FALSE ) {
    $_SESSION['error'] = 'Bad value for id';
    header( 'Location: index.php' ) ;
    return;
}

$t = htmlentities($row[0]);
$p = htmlentities($row[1]);
$r = htmlentities($row[2]);
$id = htmlentities($row[3]);

echo <<< _END
<p>Edit Track</p>
<form method="post">
<p>Title:
<input type="text" name="title" value="$t"></p>
<p>Plays:
<input type="text" name="play_count" value="$p"></p>
<p>Rating:
<input type="text" name="rating" value="$r"></p>
<input type="hidden" name="id" value="$id">
<p><input type="submit" value="Update"/>
<a href="index.php">Cancel</a></p>
</form>
_END
?>

