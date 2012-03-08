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
session_start();
require_once "db.php";




//Checks to see if there are any error or success messages to display
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
    unset($_SESSION['success']);
}


//Displays the full table
echo '<table border="1">'."\n";
$result = mysql_query("SELECT make, model, year, miles, price, id 
FROM car");
echo <<< _END
<form method="post">
<table>
<tr>
<td>District</td>
<td><input type="text" name="district" value="$a"></p>
</tr><tr>
<td>Date
<td>
</tr><tr>
<td>Latitude</td>
<td>
</tr><tr>
<td>Longitude</td>
<td></td>
</tr><tr>
<td>Building Type</td>
<td></td>
</tr><tr>
<td>Stories</td>
<td>    </td>
</tr><tr>
<td>Raised</td>
<td>  </td>
</tr><tr>
<td>Household Size</td>
<td>  </td>
</tr><tr>
<td>Under 6</td>
</tr><tr>
<td>6-15</td>
</tr><tr>
<td>16-35</td>
</tr><tr>
<td>36-60</td>
</tr><tr>
<td>Over 60</td>
</tr><tr>
<td>Females</td>
</tr><tr>
<td>Income</td>
</tr><tr>
<td>Preparedeness</td>
</tr><tr>
<td>Organizations</td>
</tr><tr>
<td>Contact</td>
</tr><tr>
<td>HOH gender</td>
</tr><tr>
<td>HOH age</td>
</tr><tr>
<td>Depedents</td>
<td> 
</tr>

    echo('<a href="edit.php?id='.htmlentities($row[0]).'">Edit</a> / ');
    echo('<a href="delete.php?id='.htmlentities($row[0]).'">Delete</a>');
    echo("</td></tr>\n");
</table>	
</form>
_END;
?>
</table>
</body>
</html>