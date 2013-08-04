<?php
function cubetech_portfolio_create_taxonomy() {
	
	$labels = array(
		'name'                => __( 'Referenzengruppen'),
		'singular_name'       => __( 'Referenzengruppe' ),
		'search_items'        => __( 'Gruppen durchsuchen' ),
		'all_items'           => __( 'Alle Referenzengruppen' ),
		'edit_item'           => __( 'Referenzengruppe bearbeiten' ), 
		'update_item'         => __( 'Referenzengruppe aktualisiseren' ),
		'add_new_item'        => __( 'Neue Referenzengruppe hinzufügen' ),
		'new_item_name'       => __( 'Gruppenname' ),
		'menu_name'           => __( 'Referenzengruppe' )
	);

	$args = array(
		'hierarchical'        => true,
		'labels'              => $labels,
		'show_ui'             => true,
		'show_admin_column'   => true,
		'query_var'           => true,
		'rewrite'             => array( 'slug' => 'cubetech_portfolio' ),
		'sortable'			  => true,
		'sort'				  => true,
	);

	register_taxonomy( 'cubetech_portfolio_group', array( 'cubetech_portfolio' ), $args );
	flush_rewrite_rules();
}

add_action('init', 'cubetech_portfolio_create_taxonomy');

?>
