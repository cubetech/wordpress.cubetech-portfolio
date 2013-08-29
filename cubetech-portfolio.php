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

wp_enqueue_script('jquery');
wp_register_script('cubetech_portfolio_js', plugins_url('assets/js/cubetech-portfolio.js', __FILE__), 'jquery');
wp_enqueue_script('cubetech_portfolio_js');

add_action('wp_enqueue_scripts', 'cubetech_portfolio_add_styles');

function cubetech_portfolio_add_styles() {
	wp_register_style('cubetech-portfolio-css', plugins_url('assets/css/cubetech-portfolio.css', __FILE__) );
	wp_enqueue_style('cubetech-portfolio-css');
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

/* Add button to TinyMCE */
function cubetech_portfolio_addbuttons() {

	if ( (! current_user_can('edit_posts') && ! current_user_can('edit_pages')) )
		return;
	
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "add_cubetech_portfolio_tinymce_plugin");
		add_filter('mce_buttons', 'register_cubetech_portfolio_button');
		add_action( 'admin_footer', 'cubetech_portfolio_dialog' );
	}
}
 
function register_cubetech_portfolio_button($buttons) {
   array_push($buttons, "|", "cubetech_portfolio_button");
   return $buttons;
}
 
function add_cubetech_portfolio_tinymce_plugin($plugin_array) {
	$plugin_array['cubetech_portfolio'] = plugins_url('assets/js/cubetech-portfolio-tinymce.js', __FILE__);
	return $plugin_array;
}

add_action('init', 'cubetech_portfolio_addbuttons');

function cubetech_portfolio_dialog() { 

	$args=array(
		'hide_empty' => false,
		'orderby' => 'name',
		'order' => 'ASC'
	);
	$taxonomies = get_terms('cubetech_portfolio_group', $args);
	
	?>
	<style type="text/css">
		#cubetech_portfolio_dialog { padding: 10px 30px 15px; }
	</style>
	<div style="display:none;" id="cubetech_portfolio_dialog">
		<div>
			<p>Wählen Sie bitte die einzufügende Referenzengruppe:</p>
			<p><select name="cubetech_portfolio_taxonomy" id="cubetech_portfolio_taxonomy">
				<option value="">Bitte Gruppe auswählen</option>
				<option value="all">Alle Kategorien anzeigen</option>
				<?php
				foreach($taxonomies as $tax) :
					echo '<option value="' . $tax->term_id . '">' . $tax->name . '</option>';
				endforeach;
				?>
			</select></p>
		</div>
		<div>
			<p><input type="submit" class="button-primary" value="Blockgruppe einfügen" onClick="if ( cubetech_portfolio_taxonomy.value != '' && cubetech_portfolio_taxonomy.value != 'undefined' ) { tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[cubetech-portfolio group=' + cubetech_portfolio_taxonomy.value + ']'); tinyMCEPopup.close(); }" /></p>
		</div>
	</div>
	<?php
}

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
