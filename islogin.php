<?php
session_start();
require_once "db.php";
//check for correct login, otherwise redirects
//if (isset($_SESSION['name']) && $_SESSION['name']) {
//    header('Location: login.php' . $_SESSION['name']); 
//    exit; //header redirect
//}

if (!isset($_SESSION['name'])) || $_SESSION['name'] != "granted") {
  header('Location: index.php');
  exit();
}
//if loginin
//redirect
//return
//if(!$session->'name'()){
//    redirect_to("index.php"); }
//
?>
