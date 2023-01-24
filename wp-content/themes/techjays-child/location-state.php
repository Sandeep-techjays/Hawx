<style>
  .locationContainer {
    width: 100%;
    display: flex;
}
.locationFinder {
    width: 50%;
    padding: 8% 5% 8% 15%;
    background: #F6F6F6;
}
.mapContainer {
    width: 50%;
}
input#findLocation {
    padding: 5% 6% 5% 2%;
    border: none;
    flex: 20;
}
.locationList {
    padding-top: 4%;
}
li.item {
    list-style: none;
    border-bottom: 1.5px solid #CCCCCC;
    padding-top: 6%;
    padding-bottom: 6%;
}
.itemName {
    display: flex;
}
p.location {
    width: 70%;
    font-weight: 700;
}
.locationFinder p {
    margin-bottom: 5px;
}
p.website {
    float: right;
    padding-right: -4%;
    text-decoration: underline;
    font-size: 12px;
    font-weight: 600;
}
p.address {
    color: #909090;
}
p.website a {
    color: #333333 !important;
}
p.phone {
    color: #EAB749;
    font-size: 14px;
    font-weight: 600;
}
.phone i.fa.fa-phone {
    font-size: 12px;
    margin-right: 8px;
}
.locationFinder #searchForm{
    display: flex;
    border-radius: 10px;
    box-shadow: 2px 4px 8px 2px #efefef;
    background-color: #fafafa;
    align-items: center;
}
i.fa.fa-search {
    padding: 23px;
    color: #888888;
    flex: 1;
}
i.fa.fa-times {
    text-align: center;
    padding: 18px;
    color: #363636;
    font-size: 20px;
    font-weight: 600;
    flex: 1;
    cursor: pointer;
}
p.website a:hover {
    color: #F16666 !important;
}
</style>
<?php
/* Template Name: Location State */
/* Template Post Type: locations */
get_header();

$state_lat = get_field('latitude', $post->ID);
$state_long = get_field('longitude', $post->ID);

$args = array(
    'post_type'      => 'locations',
    'posts_per_page' => -1,
    'post_parent'    => $post->ID,
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
);

$childPosts = new WP_Query( $args );
$cities = $childPosts->found_posts;
$map_pointers = array();
$marker_id = 0;
?>
<div class="locationContainer">
    <div class="locationFinder">
        <form method="POST" id="searchForm">
          <i class="fa fa-search submit_search" aria-hidden="true"></i>
          <input type="text" id="findLocation" class="searchLocation inputSearch" placeholder="City or State or Zip code">
          <i class="fa fa-times reset_search" aria-hidden="true"></i>          
        </form>
        <div class="error"></div>
        <div class="locationList">
        <?php if ( $childPosts-> have_posts() ) :
                echo '<ul>'; 
                while ( $childPosts->have_posts() ) : $childPosts->the_post();       
                  $pointers = array();
                  $city = get_the_title();
                  $phone = get_field('phone_number');
                  $address = get_field('address');
                  $pincode = get_field('pincode');
                  $latitude = get_field('latitude');
                  $longitude = get_field('longitude');
                  $state_code = get_field('state_code');
                  $city1 = get_field('city');
                  $link = get_permalink();
                  $pointers[] = $link;
                  $pointers[] = (float)$latitude;
                  $pointers[] = (float)$longitude;
                  $pointers[] = (int)$marker_id; ?>
                  <li class="item">
                    <div class="itemName">
                      <p class="location city_name" pointer_id="<?php echo $marker_id; ?>"><?php echo $city; ?></p>
                      <p class="website"><a href="<?php echo get_permalink( get_the_ID() ); ?>">visit website</a></p>
                    </div>
                    <p class="phone"><a href="tel:<?php echo $phone; ?>"><i class="fa fa-phone fa-rotate-90" aria-hidden="true"></i><?php echo $phone; ?></a></p>
                    <p class="address"><?php echo $address.', '.$city1.', '.$state_code.' '.$pincode; ?></p>                
                  </li>
               <?php 
               $map_pointers[] = $pointers;
               $marker_id++;
                endwhile;
                echo '</ul>';
            endif;
            wp_reset_postdata(); ?>
        </div>
    </div>
    <div class="mapContainer">
    <div id="map" style="width: 100%; height: 100%;"></div>
    </div>
</div>
<?php 
get_footer(); ?>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyCuIEmzBSoIpdfc2zU6g5mQmzBddEYQEE0" type="text/javascript"></script>
<?php
if($cities > 1){
    $zoom = 3;
}else{
    $zoom = 6;
}
?>
<script>
    var map_pointers = <?php echo json_encode($map_pointers, true); ?>;
    var state_lat = <?php echo $state_lat ?>;
    var state_long = <?php echo $state_long ?>;
    var zoom_val = <?php echo $zoom ?>;
    console.log(map_pointers);
    var locations = map_pointers;
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: zoom_val,
      center: new google.maps.LatLng(state_lat, state_long),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    
    var infowindow = new google.maps.InfoWindow();

    var marker, i;
    var markers = [];
    var j= 1;
    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon : '/wp-content/uploads/2022/06/hawx2020.png'
      });
      marker.metadata = {type: "point", id: j};
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
        //   infowindow.setContent(locations[i][0]);
        //   infowindow.open(map, marker);
            var currentLocation = window.location;
            var cityPage = locations[i][0];
            window.location.replace(cityPage);
        }
      })(marker, i));
      j++;
      markers.push(marker);
    }
    jQuery('.city_name').on('click', function(){
        var marker_id = jQuery(this).attr('pointer_id');
        for(var k=0; k<markers.length; k++){
            console.log(k + '-' + marker_id);
            if(k == marker_id){
                var iconUrl = "/wp-content/uploads/2022/06/hawx3535.png";
            }else{
                var iconUrl = "/wp-content/uploads/2022/06/hawx2020.png";
            }
            markers[k].setIcon(iconUrl);
        }
    });
  </script>