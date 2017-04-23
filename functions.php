<?php
add_action('after_setup_theme', 'new_kibasa_theme_setup');

function new_kibasa_theme_setup() {
    
    load_theme_textdomain('kibasa', get_stylesheet_directory_uri() . '/languages');

    add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

    function theme_enqueue_styles() {
        if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
            #wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

            #wp_register_style('print', get_stylesheet_directory_uri() . '/css/print.min.css', 'style', '1.0', 'print', array('myStyle'));
            #wp_enqueue_style('print');
            //Individual Style
            wp_enqueue_style('kibasa-customs-style', get_stylesheet_directory_uri() . '/css/kibasa-custom.css', 'style', '1.0', 'all', array());
        }
    }
    add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');
    function theme_enqueue_scripts() {
        wp_register_script('kibasa-custom-script', get_stylesheet_directory_uri() . '/js/custom.js', array(), '1.0.0',false, true); // Custom scripts
        wp_enqueue_script('kibasa-custom-script'); // Enqueue it!

    }
    add_action('init', 'my_menus');
    if (!function_exists('my_menus')) {

        function my_menus() {
            register_nav_menus(
                    array(
                        'footer-links' => 'Footer Links'
                    )
            );
        }

    }

}

add_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
if ( ! function_exists( 'woocommerce_simple_add_to_cart' ) ) {

	/**
	 * Output the simple product add to cart area.
	 *
	 * @access public
	 * @subpackage	Product
	 * @return void
	 */
	function woocommerce_simple_add_to_cart() {
		wc_get_template( 'simple_angepasst.php' );
	}
	//_________________________
	//Telefon kein Pflichtfeld
	//______________________________
	add_filter( 'woocommerce_billing_fields', 'kb_no_required_phone', 10, 1 );

function kb_no_required_phone( $address_fields ) {
	$address_fields['billing_phone']['required'] = false;
	return $address_fields;
}
}
//________________________________________
?>
<?php
//____________________________________________
//Uebersetzungen
//_______________________________________________
add_filter('gettext', 'translate_text');
add_filter('ngettext', 'translate_text');
 
function translate_text($translated) {
$translated = str_ireplace('From your account dashboard you manage your %3$sshipping and billing addresses%2$s and %4$sedit your password and account details%2$s.', 'Von deiner Benutzerkonto-Übersicht aus kannst du deine %3$sAdresse hinzufügen oder ändern%2$s, sowie %4$sdein Passwort und Benutzerkontendetails ändern%2$s', $translated);
$translated = str_ireplace('Dashboard', 'Benutzerkonto-Übersicht', $translated);
$translated = str_ireplace('Rechnungsanschrift', 'Adresse', $translated);
return $translated;
}
//_______________________________________________
?>
<?php
/* WC Vendors Disable WooCommerce Password Strength Requirement */
function wcvendors_remove_password_strength() {
	  if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) {
		    wp_dequeue_script( 'wc-password-strength-meter' );
	  }
}
add_action( 'wp_print_scripts', 'wcvendors_remove_password_strength', 100 );
//_____________________________________________________________________________
?>
<?php
/************* Add sorting by attributes **************/
 
/**
 *  Defines the criteria for sorting with options defined in the method below
 */
add_filter('woocommerce_get_catalog_ordering_args', 'custom_woocommerce_get_catalog_ordering_args');
 
function custom_woocommerce_get_catalog_ordering_args( $args ) {
    global $wp_query;
        // Changed the $_SESSION to $_GET
    if (isset($_GET['orderby'])) {
        switch ($_GET['orderby']) :
            case 'wccaf_gre' :
                $args['order'] = 'ASC';
                $args['meta_key'] = 'wccaf_gre';
                $args['orderby'] = 'meta_value_num';
            break;
        endswitch;
    }
    return $args;
}
 
/**
 *  Adds the sorting options to dropdown list .. The logic/criteria is in the method above
 */
add_filter('woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby');
 
function custom_woocommerce_catalog_orderby( $sortby ) {
    $sortby['wccaf_gre'] = 'Sortieren nach Größe';
    return $sortby;
}

/**
 *  Save custom attributes as post's meta data as well so that we can use in sorting and searching
 */
#add_action( 'save_post', 'save_woocommerce_attr_to_meta' );
//function save_woocommerce_attr_to_meta( $post_id ) {
//        // Get the attribute_names .. For each element get the index and the name of the attribute
//        // Then use the index to get the corresponding submitted value from the attribute_values array.
//    foreach( $_REQUEST['attribute_names'] as $index => $value ) {
//        update_post_meta( $post_id, $value, $_REQUEST['attribute_values'][$index] );
//    }
//}
/************ End of Sorting ***************************/

/************ Widgets ***************************/

function kibasa_widgets_init() {

    register_sidebar(array(
        'name' => __('Widget Area for Ads', 'kibasa'),
        'id' => 'ad-custom-sidebar',
        'description' => __('Custom widget area for the header of kibasa', 'kibasa'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
    ));
     register_sidebar(array(
        'name' => __('Widget Area for Ads in Footer', 'kibasa'),
        'id' => 'ad-custom-footer',
        'description' => __('Custom widget area for the footer of kibasa', 'kibasa'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
         'before_title' => '<h1>',
         'after_title' => '</h1>',
    ));
}

add_action( 'widgets_init', 'kibasa_widgets_init' );

/************ end Widgets ***************************/

/************ Custom Posts ***************************/
function my_custom_post_event() {
    $labels = array(
        "name" => "Termine/Börsen",
        "singular_name" => "Termin/Börse",
    );
    $args = array(
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "show_ui" => true,
        "has_archive" => false,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array("slug" => "event-item", "with_front" => true),
        "query_var" => true,
        "menu_position" => 12, 
        "menu_icon" => "http://kibasa.overflow-hillen.de/wp-content/uploads/2017/02/calendar.png", 
        "supports" => array("title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "thumbnail", "author", "page-attributes", "post-formats"), 
        "taxonomies" => array("category"));
    register_post_type("event-item", $args);
}

add_action('init', 'my_custom_post_event');
/************ end Custom Posts ***************************/


/***** ACF Fields ****/
if (function_exists('acf_add_options_page')) {
    $option_page = acf_add_options_page(array(
        'page_title' => __('Call-To-Action Buttons', 'kibasa'),
        'menu_title' => __('Call-To-Action Buttons', 'kibasa'),
        'position' => '63.3',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
}
?>