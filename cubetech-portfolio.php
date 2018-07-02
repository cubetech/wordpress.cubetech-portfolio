<?php
/**
 * Plugin Name: cubetech Portfolio
 * Plugin URI: http://www.cubetech.ch
 * Description: cubetech Portfolio - simple portfolio plugin
 * Version: 1.1
 * Author: cubetech GmbH
 * Author URI: http://www.cubetech.ch
 */

include_once('lib/cubetech-post-type.php');
include_once('lib/cubetech-shortcode.php');
include_once('lib/cubetech-group.php');

add_image_size( 'cubetech-portfolio-thumb', 150, 75 );
add_image_size( 'cubetech-portfolio-widget', 100, 50 );

add_action('wp_enqueue_scripts', 'cubetech_portfolio_add_styles');

function cubetech_portfolio_add_styles() {
	wp_register_style('cubetech-portfolio-css', plugins_url('assets/css/cubetech-portfolio.css', __FILE__) );
	wp_enqueue_style('cubetech-portfolio-css');
	wp_enqueue_script('cubetech_portfolio_js', plugins_url('assets/js/cubetech-portfolio.js', __FILE__), array('jquery'));
}

add_filter('nav_menu_css_class', 'cubetech_portfolio_current_type_nav_class', 10, 2 );
function cubetech_portfolio_current_type_nav_class($classes, $item) {
    $post_type = get_query_var('post_type');
    if(($key = array_search('current_page_parent', $classes)) !== false) {
	    unset($classes[$key]);
	}
    if ($item->attr_title != '' && $item->attr_title == $post_type) {
        array_push($classes, 'current-menu-item');
    }
    return $classes;
}

function cubetech_portfolio_custom_colors() {
   echo '<style type="text/css">
           th#year { width: 10%; }
         </style>';
}

add_action('admin_head', 'cubetech_portfolio_custom_colors');

add_filter( 'template_include', 'cubetech_portfolio_template', 1 );

function cubetech_portfolio_template($template_path) {
    if ( get_post_type() == 'cubetech_portfolio' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single-cubetech_portfolio.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . '/templates/single.php';
            }
        }
    }
    return $template_path;
}

?>
