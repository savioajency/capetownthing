<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
        wp_enqueue_script('app-script', get_stylesheet_directory_uri() . '/js/theme.js', array('jquery'),rand(2,2000), true);

        wp_localize_script( 'app-script', 'adminajax', array(
          'ajax_url' => admin_url( 'admin-ajax.php' ),
        ));
}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

add_action("wp_footer",function(){
 ?>
    <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bookingModal">Book artist</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo do_shortcode('[contact-form-7 id="12131" title="Booking"]');?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
});

//if page visted is single listing post type then redirect to its external website
//if external website link not there then redirect to homepage
add_action('template_redirect', function() {
  if (is_singular('listing')){      
    $post_id = get_queried_object_id();
    $website_link = fetch_website_link_by_id($post_id);
    
    if(empty($website_link)){
        $website_link = get_site_url();
    }
    
    wp_redirect($website_link);
    exit;
  }
});

function fetch_website_link_by_id($post_id){
    global $wpdb;
    $website_link="";
    $query = "SELECT value FROM pantheon.wp_ulisting_listing_attribute_relationships where listing_id=".$post_id." and attribute='website_link'";
    
    $result = $wpdb->get_results($query,ARRAY_A);
    if(!empty($result)){
        $website_link = $result[0]['value'];
    }
    
    return $website_link;
}

//exclude single listing post type from sitemap
add_filter('wp_sitemaps_posts_query_args', 'disable_sitemap_for_listing_cpt', 10, 2);
function disable_sitemap_for_listing_cpt($args, $post_type) {
    
    if ($post_type !== 'listing') {
        return $args; 
    }
}


add_action('wp_head', 'noindex_for_listing');
function noindex_for_listing(){
    if ( is_singular( 'listing' ) ) {
        echo '<meta name="robots" content="noindex, follow">';
    }
}

