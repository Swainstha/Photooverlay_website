<?php
session_start();

if($_SERVER['REQUEST_METHOD']=='POST') {
  $name = $_POST['name'];
  $name2="pictures/merged/".$name.".jpg";
  unlink($name2);
}
?>
