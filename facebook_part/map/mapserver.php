<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

include('includes_long/database.php');
$query ="SELECT longitude,latitude,timee FROM location ORDER BY timee DESC";
$check = $mysqli->query($query) or die($mysqli->error.__LINE__);
$row=$check->fetch_assoc();
$long = $row["longitude"];
$lat = $row["latitude"];
echo "data:{$lat},{$long}\n\n";
flush();
?>
