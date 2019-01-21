<?php
include('navBar.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="CSS/style.css">


     <script>
function myMap() {
  var myCenter = new google.maps.LatLng(52.487342, -1.888082);
  var mapCanvas = document.getElementById("map");
  var mapOptions = {center: myCenter, zoom: 15};
  var map = new google.maps.Map(mapCanvas, mapOptions);
  var marker = new google.maps.Marker({position:myCenter});
  marker.setMap(map);

}
</script>


</head>
<body>
<div class="container">
  <p>Aston Takeaway can be located within Aston University</p>

<div id="map" style="width:100%;height:500px"></div>

</div>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-GSws6plNjdx6lpZy37MOg8Y3bkz11D4&callback=myMap"></script>
</body>
</html>
