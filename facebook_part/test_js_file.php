<?php
include('includes_long/database.php');
$query ="SELECT longitude,latitude,timee FROM location ORDER BY timee DESC";
$check = $mysqli->query($query) or die($mysqli->error.__LINE__);
$row=$check->fetch_assoc();
$long = $row["longitude"];
$lat = $row["latitude"];
while($row=$check->fetch_assoc()){
	$a=$a+1;
	if($a>=10){
		$query1 ="DELETE FROM location WHERE timee='$row[timee]'";
		$check1 = $mysqli->query($query1) or die($mysqli->error.__LINE__);
	}
}
$result=$lat.",lng:".$long;
echo $result;
?>