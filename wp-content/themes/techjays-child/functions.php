<?php

/**
 * Techjays Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Techjays
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define('CHILD_THEME_TECHJAYS_VERSION', '1.0.0');

/**
 * Enqueue styles
 */
function child_enqueue_styles()
{
   wp_enqueue_style('techjays-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_TECHJAYS_VERSION, 'all');
}
add_action('wp_enqueue_scripts', 'child_enqueue_styles', 15);

add_filter('wpcf7_form_elements', function ($content) {
   $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
   return $content;
});

// disable for posts
add_filter('use_block_editor_for_post', '__return_false', 10);
// disable for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);

/* Custom excerpt for post */
function kumarpostexcerpt($limit)
{
   return wp_trim_words(get_the_excerpt(), $limit, '&nbsp;&hellip;');
}
/* End of the custom excerpt */

/* Blog post view count */
function count_post_visits()
{
   if (is_single()) {
      global $post;
      $views = get_post_meta($post->ID, 'hawx_post_viewed', true);
      if ($views == '') {
         update_post_meta($post->ID, 'hawx_post_viewed', '1');
      } else {
         $views_no = intval($views);
         update_post_meta($post->ID, 'hawx_post_viewed', ++$views_no);
      }
   }
}
add_action('wp_head', 'count_post_visits');
/* Blog post view count end */

/* Location CPT Creation */
function post_type_locations()
{
   $supports = array(
      'title', // post title   
      'author', // post author   
      'revisions', // post revisions   
   );
   $labels = array(
      'name' => _x('Locations', 'plural'),
      'singular_name' => _x('location', 'singular'),
      'menu_name' => _x('Locations', 'admin menu'),
      'name_admin_bar' => _x('locations', 'admin bar'),
      'add_new' => _x('Add New', 'add new'),
      'add_new_item' => __('Add New Location'),
      'new_item' => __('New Location'),
      'edit_item' => __('Edit Location'),
      'view_item' => __('View Location'),
      'all_items' => __('All Locations'),
      'search_items' => __('Search Location'),
      'not_found' => __('No location found.'),
   );
   $args = array(
      'supports' => $supports,
      'labels' => $labels,
      'menu_icon' => 'dashicons-location',
      'public' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'locations'),
      'has_archive' => true,
      'hierarchical' => true,
      'taxonomies' => array('post_tag')
   );
   register_post_type('locations', $args);
}
add_action('init', 'post_type_locations');
/* End of Location Post Type Creation*/
/* Change logo and a tag links (location) */
function posttypefind($url)
{
   global $post;
   $posttye = $post->post_type;
   $currentPageTile = get_the_title();
   if ($posttye == "locations") {
      $locationHomelink = get_permalink($post->ID);
      if (is_post_type_archive('locations')) {
         $archiveLocation = 1;
      }
      $locationHomelink1 = get_permalink($post->ID);
      $homeLinkparts = explode('/', $locationHomelink);
      $locServiceParent = wp_get_post_parent_id($post->ID);
      $locServicechildParent = wp_get_post_parent_id($locServiceParent);
      $locPostTitle = get_the_title($post->ID);
      if ((strlen($homeLinkparts[3]) > 3) && ($homeLinkparts[3] != "locations") && (empty($homeLinkparts[4]))) { // For city page 
?>
         <script>
            jQuery(function($) {
               console.log('Techjays1');
               $(".locationLogo a").attr("href", "<?php echo $locationHomelink; ?>");
               $(".home.menu-item a").attr("href", "<?php echo $locationHomelink; ?>");
               $(".locHeadCall a").attr("href", "tel:<?php the_field('phone_number', $post->ID); ?>");
               $(".locFootCall a").attr("href", "tel:<?php the_field('phone_number', $post->ID); ?>");
               $(".locHeadCall .elementor-icon-list-text").text("<?php the_field('phone_number', $post->ID); ?>");
               $(".locFootCall a").text("<?php the_field('phone_number', $post->ID); ?>");
               $(".locFootAddress .elementor-heading-title").html("<?php echo $locPostTitle; ?> Pest Control,<br><?php the_field('address', $post->ID); ?>,<br><?php the_field('city', $post->ID); ?>, <?php the_field('state_code', $post->ID); ?> <?php the_field('pincode', $post->ID); ?>");
               var oldNav = $(".locservices.ants a").attr('href');
               var oldNavSp = oldNav.split("/");
               var oldNavSpFind = oldNavSp[oldNavSp.length - 3];
               $(".locservices a").each(function() {
                  var newMenuURL = $(this).attr('href').replace(oldNavSpFind, "<?php echo $homeLinkparts[3]; ?>");
                  $(this).attr('href', newMenuURL);

               });
               var footerHome = $(".footerHome a").attr('href').replace(oldNavSpFind, "<?php echo $homeLinkparts[3]; ?>");
               $(".footerHome a").attr('href', footerHome);
               var footerResident = $(".footerResident a").attr('href').replace(oldNavSpFind, "<?php echo $homeLinkparts[3]; ?>");
               $(".footerResident a").attr('href', footerResident);
               var footerCommer = $(".footerCommer a").attr('href').replace(oldNavSpFind, "<?php echo $homeLinkparts[3]; ?>");
               $(".footerCommer a").attr('href', footerCommer);
            });
         </script>
      <?php } elseif ((strlen($homeLinkparts[3]) > 3) && ($homeLinkparts[3] != "locations") && ($archiveLocation != 1) && (empty($homeLinkparts[5]))) { // For services page         
         $locationHomelink = explode('/', $locationHomelink);
         $locationHomelink =  array_slice($locationHomelink, 0, 4);
         $locationHomelink = implode('/', $locationHomelink);
         //print_r($homeLinkparts);
      ?>
         <script>
            jQuery(function($) {
               console.log('Techjays2');
               $(".locationLogo a").attr("href", "<?php echo $locationHomelink; ?>");
               $(".home.menu-item a").attr("href", "<?php echo $locationHomelink; ?>");
               $(".locHeadCall a").attr("href", "tel:<?php the_field('phone_number', $locServiceParent); ?>");
               $(".locFootCall a").attr("href", "tel:<?php the_field('phone_number', $locServiceParent); ?>");
               $(".locHeadCall .elementor-icon-list-text").text("<?php the_field('phone_number', $locServiceParent); ?>");
               $(".locFootCall a").text("<?php the_field('phone_number', $locServiceParent); ?>");
               $(".locFootAddress .elementor-heading-title").html("<?php echo get_the_title($locServiceParent); ?> Pest Control,<br><?php the_field('address', $locServiceParent); ?>,<br><?php the_field('city', $locServiceParent); ?>, <?php the_field('state_code', $locServiceParent); ?> <?php the_field('pincode', $locServiceParent); ?>");
               var oldNav = $(".locservices.ants a").attr('href');
               var oldNavSp = oldNav.split("/");
               var oldNavSpFind = oldNavSp[oldNavSp.length - 3];
               $(".locservices a").each(function() {
                  var newMenuURL = $(this).attr('href').replace(oldNavSpFind, "<?php echo $homeLinkparts[3]; ?>");
                  $(this).attr('href', newMenuURL);
               });
               var footerHome = $(".footerHome a").attr('href').replace(oldNavSpFind, "<?php echo $homeLinkparts[3]; ?>");
               $(".footerHome a").attr('href', footerHome);
               var footerResident = $(".footerResident a").attr('href').replace(oldNavSpFind, "<?php echo $homeLinkparts[3]; ?>");
               $(".footerResident a").attr('href', footerResident);
               var footerCommer = $(".footerCommer a").attr('href').replace(oldNavSpFind, "<?php echo $homeLinkparts[3]; ?>");
               $(".footerCommer a").attr('href', footerCommer);
            });
         </script>
      <?php } elseif ((strlen($homeLinkparts[3]) > 3) && ($homeLinkparts[3] != "locations") && (strlen($homeLinkparts[5]) > 1)) {
         $locationHomelink = explode('/', $locationHomelink);
         $locationHomelink =  array_slice($locationHomelink, 0, 4);
         $locationHomelink = implode('/', $locationHomelink); ?>
         <script>
            jQuery(function($) {
               console.log('Techjays3');
               $(".locationLogo a").attr("href", "<?php echo $locationHomelink; ?>");
               $(".home.menu-item a").attr("href", "<?php echo $locationHomelink; ?>");
               $(".locHeadCall a").attr("href", "tel:<?php the_field('phone_number', $locServicechildParent); ?>");
               $(".locFootCall a").attr("href", "tel:<?php the_field('phone_number', $locServicechildParent); ?>");
               $(".locHeadCall .elementor-icon-list-text").text("<?php the_field('phone_number', $locServicechildParent); ?>");
               $(".locFootCall a").text("<?php the_field('phone_number', $locServicechildParent); ?>");
               $(".locFootAddress .elementor-heading-title").html("<?php echo get_the_title($locServicechildParent); ?> Pest Control,<br><?php the_field('address', $locServicechildParent); ?>,<br><?php the_field('city', $locServicechildParent); ?>, <?php the_field('state_code', $locServicechildParent); ?> <?php the_field('pincode', $locServicechildParent); ?>");
               var oldNav = $(".locservices.ants a").attr('href');
               var oldNavSp = oldNav.split("/");
               var oldNavSpFind = oldNavSp[oldNavSp.length - 3];
               $(".locservices a").each(function() {
                  var newMenuURL = $(this).attr('href').replace(oldNavSpFind, "<?php echo $homeLinkparts[3]; ?>");
                  $(this).attr('href', newMenuURL);
               });
               var footerHome = $(".footerHome a").attr('href').replace(oldNavSpFind, "<?php echo $homeLinkparts[3]; ?>");
               $(".footerHome a").attr('href', footerHome);
               var footerResident = $(".footerResident a").attr('href').replace(oldNavSpFind, "<?php echo $homeLinkparts[3]; ?>");
               $(".footerResident a").attr('href', footerResident);
               var footerCommer = $(".footerCommer a").attr('href').replace(oldNavSpFind, "<?php echo $homeLinkparts[3]; ?>");
               $(".footerCommer a").attr('href', footerCommer);
            });
         </script><?php
               } ?>
      <script>
         jQuery(function($) {
            var currentPageTile = '<?php echo  $currentPageTile; ?>';
            $(".locHeadNav .menu-item a").each(function() {
               var currentMenuLink = $(this).attr('href');
               var currentMenuActive = '<?php echo $locationHomelink1; ?>';
               if (currentMenuActive == currentMenuLink) {
                  //alert(currentMenuLink + 'tick');
                  $(this).parent().addClass('current-menu-item');
                  $(this).parent().parent().parent().addClass('current-menu-item');
                  //$('.locservices.menu-item-has-children').addClass('current-menu-item 1');
               };
               if (currentPageTile == "Rats" || currentPageTile == "Mice") {
                  $('.rodents.menu-item').addClass('current-menu-item');
                  $('.locservices.menu-item-has-children').addClass('current-menu-item');
               }
            });
            if ($('body').hasClass('post-type-archive-locations')) {
               $('.main-service-areas').addClass('current_page_item');
            }
         });
      </script><?php
            }
         }
         add_action('wp_head', 'posttypefind');
         /* End of the link update */

         // Shortcode to convert button links for locations page
         function locationbtn_change_shortcode($atts)
         {
            $locationResBtn = get_permalink($post->ID);
            $locationResBtnspt = explode('/', $locationResBtn);
            //echo $locationResBtnspt[3]; 
               ?>
   <script>
      jQuery(function($) {
         $("#locationResidentialBtn a").attr("href", "/<?php echo $locationResBtnspt[3]; ?>/residential/");
         $("#locationCommercialBtn a").attr("href", "/<?php echo $locationResBtnspt[3]; ?>/commercial/");
      });
   </script><?php
         }
         add_shortcode('locationbtn_replace_shortcode', 'locationbtn_change_shortcode');

         // Career Page -  Filer Functionality
         add_action("wp_ajax_mobile_filter", "mobile_filter");
         add_action("wp_ajax_nopriv_mobile_filter", "mobile_filter");

         function mobile_filter()
         {
            global $wpdb;
            $response = array();
            $dataAsArr = array();
            $html_content = '';
            $stateValue = $_POST['stateVal'];
            $catValue = $_POST['catVal'];
            $stateValString = implode("','", $stateValue);
            $catValString = implode("','", $catValue);
            $query_data = "SELECT * FROM hawxwp_career";
            if (isset($stateValue) || isset($catValue)) {
               $query_data .= " " . "WHERE ";
               if ($stateValue != '') {
                  $query_data .= " " . "Country_sub_name IN" . " ('" . $stateValString . "')";
               }
               if (($stateValue != '') && ($catValue != '')) {
                  $query_data .= " AND ";
               }
               if ($catValue != '') {
                  $query_data .= "Dept_name" . " IN " . "('" . $catValString . "')";
               }
            }
            $table_data = $wpdb->get_results(" $query_data ");
            $html_loadMore = "<div class='careers-loadmore-section' style='display:none'>
            <a id='loadMore' class='careers-loadmore-button'><span>Load More</span></a>
          </div>";
            if (count($table_data) > 0) {
               foreach ($table_data as $result) {
                  $postDescription = $result->Description;
                  $postDescription = str_replace(array("â€™","â€˜"), "'", $postDescription);
                  $postDescription = str_replace(array("â€”", "â€“"), "-", $postDescription);
                  $postDescription = str_replace(array("&nbsp;","<br>","<p>","</p>","<strong>","</strong>"), " ", $postDescription);
                  $html_content .= "<div class='careers-job-list-data'>"
                     . "<div class='careers-job-post'>"
                     . "<h2 class='careers-job-post-heading'><a href='/careers/job-listing/career-post/?id=" . $result->Id . "'>" . $result->Position_title . "</a></h2>"
                     . "<div class='careers-job-post-address'>"
                     . "<svg width='25' height='40' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                  <path d='M12 12C10.9 12 10 11.1 10 10C10 8.9 10.9 8 12 8C13.1 8 14 8.9 14 10C14 11.1 13.1 12 12 12ZM18 10.2C18 6.57 15.35 4 12 4C8.65 4 6 6.57 6 10.2C6 12.54 7.95 15.64 12 19.34C16.05 15.64 18 12.54 18 10.2ZM12 2C16.2 2 20 5.22 20 10.2C20 13.52 17.33 17.45 12 22C6.67 17.45 4 13.52 4 10.2C4 5.22 7.8 2 12 2Z' fill='black' />
                </svg>"
                     . "<p>" . $result->City . ", " . $result->Country_sub_name . "</p>" . "</div>"

                     . "<div class='careers-job-post-description'>" . substr($postDescription, 0, 400) . "...</div>"
                     . "</div>"
                     . "</div>";
               }$html_content .= $html_loadMore;
            } else {
               $html_content = "<div class='not-found-text-loadmore'>" . "No Jobs Found" . "</div>";
            }
            $response['status'] = 'success';
            $response['message'] = $html_content;
            // $response['loadDa'] = $dataAsArr;
            // echo $query_data;
            echo json_encode($response);
            exit;
         }
