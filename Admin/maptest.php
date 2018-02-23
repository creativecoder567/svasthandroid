<?php
require 'dbconnection.php';
   $a= array();
   $i=0;
   $sql= mysqli_query($db,"SELECT * FROM litre where date='05-02-2018' order by delivery_time_m desc");

   while( $row =mysqli_fetch_array($sql)){
     $b=array();
     $loc=array();
// echo $row["address"];

     $b[]=$row["orderid"];
     // $b[]=$row["latitude"];
     // $b[]=$row["longitude"];
      //$b[]=$row["location"];
     $loc=explode(",",$row["delivery_location_e"]);
     $b[]=$loc[0];
     $b[]=$loc[1];
     // echo $loc[0]."<br>";
     // echo $loc[1];
     //print_r (explode(",",$row["location"]));
     //echo $row["location"];
     // $b[]=$row["id"];
     // $b[]=$row["name"];
        $a[$i]=$b;
        $i++;
    }
 ?>
 <!DOCTYPE html>
 <html lang="en-US">
 <head>
 <title>Google Maps with Multiple Markers by CodexWorld</title>
 <style type="text/css">
 #mapContainer {
     height: 650px;
 }

 #mapCanvas {
     width: 100%;
     height: 100%;
 }
 </style>

 </head>
 <body>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4_58r24gd6UZoaSUS0OIeBBnk6ALaSDM"></script>
 <script>
 function initMap() {
     var map;
     var bounds = new google.maps.LatLngBounds();
     var mapOptions = {
         mapTypeId: 'roadmap'
     };

     // Display a map on the web page
     map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
     map.setTilt(50);

     // Multiple markers location, latitude, and longitude
    //  var markers = [
    //      ['Brooklyn Museum, NY', 40.671531, -73.963588],
    //      ['Brooklyn Public Library, NY', 40.672587, -73.968146],
    //      ['Prospect Park Zoo, NY', 40.665588, -73.965336],
 		// ['Barclays Center, Brooklyn, NY', 40.682906, -73.975362]
    //  ];
var markers = <?php echo json_encode($a);?>;
     // Info window content
     // var infoWindowContent = [
     //     ['<div class="info_content">' +
     //     '<h3>Brooklyn Museum</h3>' +
     //     '<p>The Brooklyn Museum is an art museum located in the New York City borough of Brooklyn.</p>' + '</div>'],
     //     ['<div class="info_content">' +
     //     '<h3>Brooklyn Public Library</h3>' +
     //     '<p>The Brooklyn Public Library (BPL) is the public library system of the borough of Brooklyn, in New York City.</p>' +
     //     '</div>'],
     //     ['<div class="info_content">' +
     //     '<h3>Prospect Park Zoo</h3>' +
     //     '<p>The Prospect Park Zoo is a 12-acre (4.9 ha) zoo located off Flatbush Avenue on the eastern side of Prospect Park, Brooklyn, New York City.</p>' +
     //     '</div>']
     // ];

     // Add multiple markers to map
     var infoWindow = new google.maps.InfoWindow(), marker, i;

     // Place each marker on the map
     for( i = 0; i < markers.length; i++ ) {
         var position = new google.maps.LatLng(markers[i][1], markers[i][2]);

         //var position = new google.maps.LatLng(markers[i][3]);
         bounds.extend(position);
         marker = new google.maps.Marker({
             position: position,
             map: map,
             title: markers[i][0]
         });

         // Add info window to marker
         google.maps.event.addListener(marker, 'click', (function(marker, i) {
             return function() {
                 //infoWindow.setContent(infoWindowContent[i][0]);
                 infoWindow.setContent(markers[i][0]);
                 infoWindow.open(map, marker);
             }
         })(marker, i));

         // Center the map to fit all markers on the screen
         map.fitBounds(bounds);
     }

     // Set zoom level
     var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
         this.setZoom(14);
         google.maps.event.removeListener(boundsListener);
     });

 }
 // Load initialize function
 google.maps.event.addDomListener(window, 'load', initMap);
 </script>
 <div id="mapContainer">
     <div id="mapCanvas"></div>
 </div>

 </body>
 </html>
