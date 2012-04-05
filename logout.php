<?php
session_start();
//unset ($_SESSION['name']);

session_regenerate_id();
session_destroy();
unset($_SESSION);

header ( 'Location: success.php'); 

?>