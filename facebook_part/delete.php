<meta http-equiv="Refresh" content="5">
<?php
include('includes_long/database.php');
$query1 ="DELETE FROM location";
$check1 = $mysqli->query($query1) or die($mysqli->error.__LINE__);
?>
