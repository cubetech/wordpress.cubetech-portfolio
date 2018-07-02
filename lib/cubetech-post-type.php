<?php
function cubetech_portfolio_create_post_type() {
	register_post_type('cubetech_portfolio',
		array(
			'labels' => array(
				'name' => __('Referenzen'),
				'singular_name' => __('Referenz'),
				'add_new' => __('Referenz hinzufügen'),
				'add_new_item' => __('Neue Referenz hinzufügen'),
				'edit_item' => __('Referenzen bearbeiten'),
				'new_item' => __('Neue Referenz'),
				'view_item' => __('Referenz betrachten'),
				'search_items' => __('Referenzen durchsuchen'),
				'not_found' => __('Keine Referenzen gefunden.'),
				'not_found_in_trash' => __('Keine Referenzen gefunden.')
			),
			'capability_type' => 'post',
			'taxonomies' => array('cubetech_portfolio_group'),
			'public' => true,
			'has_archive' => false,
			'rewrite' => array('slug' => 'portfolio', 'with_front' => false),
			'show_ui' => true,
			'menu_position' => '20',
			'menu_icon' => null,
			'hierarchical' => true,
			'supports' => array('title', 'editor', 'thumbnail')
		)
	);
}
add_action('init', 'cubetech_portfolio_create_post_type');
?>
