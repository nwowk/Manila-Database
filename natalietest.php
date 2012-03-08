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
echo '<tr>
    <th>District</th>
    <th>Date</th>
    <th>Latitude</th>
    <th>Longitude</th>
    <th>Building<br>Type</th>
    <th>Stories</th>
    <th>Raised</th>
    <th>Household<br>Size</th>
    <th>Under 6</th>
    <th>6-15</th>
    <th>16-35</th>
    <th>36-60</th>
    <th>Over 60</th>
    <th>Females</th>
    <th>Income</th>
    <th>Preparedeness</th>
    <th>Organizations</th>
    <th>Contact</th>
    <th>HOH gender</th>
    <th>HOH age</th>
    <th>Depdents</th>
    </tr>';
$result = mysql_query("SELECT * FROM Households ORDER BY id DESC LIMIT 1");
$row = mysql_fetch_row($result);
$i=1;
echo "<tr><td>";
while ($i < 22) {
    echo(htmlentities($row[$i]));
    echo("</td><td>");
    $i = $i +1;
    }

    echo("</td><td>\n");
    echo('<a href="edit.php?id='.htmlentities($row[0]).'">Edit</a> / ');
    echo('<a href="delete.php?id='.htmlentities($row[0]).'">Delete</a>');
    echo("</td></tr>\n");

?>
<!--Link for adding new records-->
</table>
<a href="add.php">Add New</a>
