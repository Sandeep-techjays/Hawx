<style>
  .locationContainer {
    width: 100%;
    display: flex;
}
.locationFinder {
    width: 50%;
    padding: 8% 5% 8% 12%;
    background: #F6F6F6;
}
.mapContainer {
    width: 50%;
}
input#findLocation {
    padding: 5% 6% 5% 0%;
    flex: 16;
    border: none;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}
input#findLocation:focus-visible{
    outline: none;
}
input#findLocation:focus{
    background: #fafafa;
}
.locationList {
    padding-top: 4%;
}
.locationContainer li.item {
    list-style: none;
    border-bottom: 1.5px solid #CCCCCC;
    padding-top: 6%;
    padding-bottom: 6%;
}
.locationContainer .itemName {
    display: flex;
}
.locationContainer p.location {
    width: 70%;
    font-weight: 700;
}
.locationFinder p {
    margin-bottom: 5px;
}
.locationContainer p.website {
    float: right;
    padding-right: -4%;
    text-decoration: underline;
    font-size: 12px;
    font-weight: 600;
}
.locationContainer p.address {
    color: #909090;
}
.locationContainer p.website a {
    color: #333333 !important;
}
.locationContainer p.phone {
    color: #EAB749;
    font-size: 14px;
    font-weight: 600;
}
.locationContainer .phone i.fa.fa-phone {
    font-size: 12px;
    margin-right:8px;
}
.locationContainer form#searchForm{
    display: flex;
    align-items: center;
    border-radius: 10px;
    box-shadow: 2px 4px 8px 2px #efefef;
    background: #fafafa;
}
.locationContainer i.fa.fa-search {
    padding: 23px;
    color: #888888;
    width: 16%;
}
.locationContainer i.fa.fa-times {
    padding: 18px;
    color: #363636;
    font-size: 20px;
    font-weight: 600;
    width: 14%;
    cursor: pointer;
}
.locationContainer p.website a:hover {
    color: #F16666 !important;
}
</style>
<?php
/* Template Name: Results */
get_header();
if(isset($_GET['q']) && $_GET['q'] != ''){
    $city_count = 0;
    $queryString =  $_GET['q'];
    global $wpdb;
    if(is_numeric($queryString)) {     
        //echo "SELECT * FROM hawxwp_pincodes WHERE JSON_CONTAINS(pincodes, $queryString , '$')";
        $resultRows = $wpdb->get_results("SELECT * FROM hawxwp_pincodes WHERE JSON_CONTAINS(pincodes, $queryString , '$')");
        $city_id = $resultRows[0]->city_id;
        $args = array(
            'post_type'      => 'locations',
            'posts_per_page' => -1,
            'post__in' => array($city_id)
        );      
        $childPosts = new WP_Query( $args );
    }else{
        $queryString = urldecode($queryString);
        $queryString1 = ucwords($queryString);
        $cities = array();
        //echo "SELECT * FROM hawxwp_pincodes WHERE JSON_CONTAINS(cities, '[\"$queryString1\"]')";
        $resultRows = $wpdb->get_results("SELECT * FROM hawxwp_pincodes WHERE JSON_CONTAINS(cities, '[\"$queryString1\"]')");
        $city_count = count($resultRows);
        if(!empty($resultRows)){
            foreach($resultRows as $rows){
                $cities[] = $rows->city_id;
            }
        }
        $results = $wpdb->get_results("SELECT * FROM hawxwp_posts WHERE post_type = 'locations' AND post_status = 'publish' AND post_title LIKE '%".$queryString1."%'");
        if(!empty($results)){
            foreach($results as $result){
                $cities[] = $result->ID;
            }
        }
        $city_args = array(
            'post_type'      => 'locations',
            'posts_per_page' => -1,
            'order'          => 'ASC',
            'orderby'        => 'menu_order',
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key'     => 'state',
                    'value'   => $queryString,
                    'compare' => 'LIKE',
                ),
                array(
                    'key'     => 'city',
                    'value'   => $queryString,
                    'compare' => 'LIKE',
                )
            )
        );
        $city_posts = get_posts( $city_args );
        foreach($city_posts as $city_post){
            array_push($cities, $city_post->ID);
        }  
        $cities1 =  array_unique($cities);
        if(!empty($cities)){
            $args = array(
                'post_type'      => 'locations',
                'posts_per_page' => -1,
                'post__in' => $cities1,
                'post_parent__not_in' => array(0),
                'meta_query' => array(
                    array(
                        'key' => '_wp_page_template',
                        'value' => 'location-city.php', // folder + template name as stored in the dB
                    )
                )
            ); 
           
        } else{
            $args = array();
        } 
        $childPosts = new WP_Query( $args );  
       
    }
}
// $state_lat = get_field('latitude', $post->ID);
// $state_long = get_field('longitude', $post->ID);

// echo '<pre>';
// print_r($childPosts);
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
            <?php 
    if(!empty($childPosts)){
         if ( $childPosts-> have_posts() ) :
                echo '<ul>'; 
                while ( $childPosts->have_posts() ) : $childPosts->the_post();     
                  $parent_id = wp_get_post_parent_id();  
                  $pointers = array();
                  $city = get_the_title();
                  $phone = get_field('phone_number');
                  $address = get_field('address');
                  $state = get_field('state');
                  $city1 = get_field('city');
                  $pincode = get_field('pincode');
                  $latitude = get_field('latitude');
                  $longitude = get_field('longitude');
                  $state_code = get_field('state_code');
                  $state_latitude = get_field('latitude', $parent_id);
                  $state_longitude = get_field('longitude', $parent_id);
                  $link = get_permalink();
                  $pointers[] = $link;
                  $pointers[] = (float)$latitude;
                  $pointers[] = (float)$longitude;
                  $pointers[] = (int)$marker_id;
                  $center_lat = $state_latitude;
                  $center_long = $state_longitude; ?>
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
            else:
                echo '<p>No Result Found</p>';
            endif;
            wp_reset_postdata();
         }else{
            echo '<p>No Result Found</p>';
         } ?>
        </div>
    </div>
    <div class="mapContainer">
    <div id="map" style="width: 100%; height: 100%;"></div>
    </div>
</div>
<?php  get_footer(); 
if(count($cities1) > 1){
    $zoom = 3;
}else{
    $zoom = 5;
}
?>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyCuIEmzBSoIpdfc2zU6g5mQmzBddEYQEE0" type="text/javascript"></script>

<script>
    var map_pointers = <?php echo json_encode($map_pointers, true); ?>;
    var state_lat = <?php echo $center_lat ?>;
    var state_long = <?php echo $center_long ?>;
    console.log('lat-'+ state_lat, 'long-' + state_long);
    var zoom_val = <?php echo $zoom ?>;
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
        icon : 'https://staging.hawxpestcontrol.com/wp-content/uploads/2022/06/hawx2020.png'
      });
      marker.metadata = {type: "point", id: j};
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
        //   infowindow.setContent(locations[i][0]);
        //   infowindow.open(map, marker);
            var currentLocation = window.location;
            var cityPage =  locations[i][0];
            console.log(cityPage);
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
                var iconUrl = "https://staging.hawxpestcontrol.com/wp-content/uploads/2022/06/hawx3535.png";
            }else{
                var iconUrl = "https://staging.hawxpestcontrol.com/wp-content/uploads/2022/06/hawx2020.png";
            }
            markers[k].setIcon(iconUrl);
        }
    });
  </script>