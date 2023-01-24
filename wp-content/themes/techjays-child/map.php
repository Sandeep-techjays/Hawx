<style>
.mapContainer {
    width: 50%;
}
</style>
<?php
/* Template Name: Map Template */
/* Template Post Type: locations */
get_header(); 
$latitude = 33.4206139;
$longitude = -112.0061377;
echo "test";
?>

<div class="mapContainer">
    <div id="map" style="width: 100%; height: 100%;"></div>
</div>
<?php get_footer(); ?>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyCuIEmzBSoIpdfc2zU6g5mQmzBddEYQEE0" type="text/javascript"></script>
<script>
    console.log('test');
    var state_lat = 33.4206139;
    var state_long = -112.0061377;
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 6,
      center: new google.maps.LatLng(state_lat, state_long),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    // var infowindow = new google.maps.InfoWindow();
    // var marker;
    // marker = new google.maps.Marker({
    //     position: new google.maps.LatLng(state_lat, state_long),
    //     map: map,
    //     icon : 'http://3.135.99.242/wp-content/uploads/2022/05/hawx2020.png'
    //   });