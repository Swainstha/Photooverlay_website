<meta http-equiv="Refresh" content="5">
<?php
include('includes_long/database.php');
$query ="SELECT longitude,latitude,timee FROM location ORDER BY timee DESC";
$check = $mysqli->query($query) or die($mysqli->error.__LINE__);
$row=$check->fetch_assoc();
echo $row["longitude"];
echo "<br>";
echo $row["latitude"];
$long = $row["longitude"];
$lat = $row["latitude"];
while($row=$check->fetch_assoc()){
	$a=$a+1;
	if($a>=10){
		$query1 ="DELETE FROM location WHERE timee='$row[timee]'";
		$check1 = $mysqli->query($query1) or die($mysqli->error.__LINE__);
	}
}
?>


<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple markers</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
	  
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>

      function initMap() {
        var myLatLng = {lat: <?php echo $lat ?>, lng: <?php echo $long ?>};
console.log(<?php echo $lat ?>);
console.log(<?php echo $long ?>);
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 18,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Hello World!'
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlP1PwU_o7Kmn_fNBjqNwd4pYA2bI9Rn0&callback=initMap">
    </script>
  </body>
</html>