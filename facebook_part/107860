<!DOCTYPE html>
<?php 
include('includes/database.php');
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
	  <?php 
	  if(isset($_POST['lat']))
	  {
	  $lat=$_POST['lat'];
	  $lng=$_POST['lng'];
	  }
	  else
	  {
		  $lat=27.7172;
	  $lng=85.3240;
	  }
	  ?>
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>

      function initMap() {
        var myLatLng = {lat: <?php echo $lat ?>, lng: <?php echo $lng ?>};
console.log(<?php echo $lat ?>);
console.log(<?php echo $lng ?>);
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
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