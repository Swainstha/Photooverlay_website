<?php
include('includes_long/database.php');
$longitude=$_GET["long"];
$latitude=$_GET["lati"];
echo $longitude;
echo "br";
echo $latitude;
$query = "INSERT INTO location(longitude,latitude) VALUES('$longitude','$latitude')";
$check = $mysqli->query($query) or die($mysqli->error.__LINE__);
?>
