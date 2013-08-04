<?php
function cubetech_portfolio_shortcode($atts)
{
	extract(shortcode_atts(array(
		'group'			=> false,
		'orderby' 		=> 'menu_order',
		'order'			=> 'asc',
		'numberposts'	=> 999,
		'offset'		=> 0,
		'poststatus'	=> 'publish',
	), $atts));
	
	if ( $group == false )
		return "Keine Gruppe angegeben";
		
	if ( $group == 'all' )
		$tax_query = false;
	else {
		$tax_query = array(
		    array(
		        'taxonomy' => 'cubetech_portfolio_group',
		        'terms' => $group,
		        'field' => 'id',
		    )
		);
	}
	
	$args = array(
		'posts_per_page'  	=> 999,
		'numberposts'     	=> $numberposts,
		'offset'          	=> $offset,
		'orderby'         	=> $orderby,
		'order'           	=> $order,
		'post_type'       	=> 'cubetech_portfolio',
		'post_status'     	=> $poststatus,
		'suppress_filters' 	=> true,
		'tax_query'			=> $tax_query,
	);
		
	$posts = get_posts($args);
	$class = '';
	$return = '';
	
	$return .= '<div class="cubetech-portfolio-container">';
	
	foreach ($posts as $post) {
	
		$post_meta_data = get_post_custom($post->ID);
		$terms = wp_get_post_terms($post->ID, 'cubetech_portfolio_group');
		$link = '';
		
		if(isset($post_meta_data['cubetech_portfolio_externallink'][0]) && $post_meta_data['cubetech_portfolio_externallink'][0] != '')
			$link = '<span class="cubetech-portfolio-link"><a href="' . $post_meta_data['cubetech_portfolio_externallink'][0] . '" target="_blank">&raquo; MEHR</a></span>';
		elseif ( $post_meta_data['cubetech_portfolio_links'][0] != '' && $post_meta_data['cubetech_portfolio_links'][0] != 'nope' && $post_meta_data['cubetech_portfolio_links'][0] > 0 )
			$link = '<span class="cubetech-portfolio-link"><a href="' . get_permalink( $post_meta_data['cubetech_portfolio_links'][0] ) . '">&raquo; MEHR</a></span>';
		
		$return .= '
		<div class="cubetech-portfolio">
			<div class="cubetech-portfolio-content">
				<h2 class="cubetech-portfolio-title">' . $post->post_title . '</h2>
				<div class="cubetech-portfolio-content-container">' . get_the_post_thumbnail( $post->ID, 'cubetech-portfolio-thumb', array('class' => 'cubetech-portfolio-thumb') ) . $post->post_content . '</div>
			</div>
		</div>';

	}

	return $return . '</div>';

}
add_shortcode('cubetech-portfolio', 'cubetech_portfolio_shortcode');
?>
