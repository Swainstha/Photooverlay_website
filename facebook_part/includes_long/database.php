<?php
//connect to database
$db_host = 'localhost';
$db_name = 'swain_cordinates';
$db_user = 'swain';
$db_pass = 'Pj9ld"jkHa8f';

//create mysqli object
$mysqli = new mysqli($db_host,$db_user,$db_pass,$db_name);

//error handler
if(mysqli_connect_errno()){
	echo 'This Connection Failed'. mysqli_connect_error();
	die();
}
?>