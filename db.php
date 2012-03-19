<?php
//This script connects to the database.
$db = mysql_connect("localhost","gisis", "cool")
   or die('Fail message');
mysql_select_db("manila") or die("Fail message");
?>
