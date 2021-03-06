<?php

$labels = array(
	'name'                  => _x( 'Art Pieces', 'Post Type General Name', 'inaset-cpt' ),
	'singular_name'         => _x( 'Art Piece', 'Post Type Singular Name', 'inaset-cpt' ),
	'menu_name'             => __( 'Art Pieces', 'inaset-cpt' ),
	'name_admin_bar'        => __( 'Art Pieces', 'inaset-cpt' ),
	'archives'              => __( 'Art Pieces Archives', 'inaset-cpt' ),
	'attributes'            => __( 'Art Pieces Attributes', 'inaset-cpt' ),
	'parent_item_colon'     => __( 'Parent Art Piece:', 'inaset-cpt' ),
	'all_items'             => __( 'All Art Pieces', 'inaset-cpt' ),
	'add_new_item'          => __( 'Add New Art Piece', 'inaset-cpt' ),
	'add_new'               => __( 'Add New', 'inaset-cpt' ),
	'new_item'              => __( 'New Art Piece', 'inaset-cpt' ),
	'edit_item'             => __( 'Edit Art Piece', 'inaset-cpt' ),
	'update_item'           => __( 'Update Art Piece', 'inaset-cpt' ),
	'view_item'             => __( 'View Art Piece', 'inaset-cpt' ),
	'view_items'            => __( 'View Art Pieces', 'inaset-cpt' ),
	'search_items'          => __( 'Search Art Piece', 'inaset-cpt' ),
	'not_found'             => __( 'Not found', 'inaset-cpt' ),
	'not_found_in_trash'    => __( 'Not found in Trash', 'inaset-cpt' ),
	'featured_image'        => __( 'Featured Image', 'inaset-cpt' ),
	'set_featured_image'    => __( 'Set featured image', 'inaset-cpt' ),
	'remove_featured_image' => __( 'Remove featured image', 'inaset-cpt' ),
	'use_featured_image'    => __( 'Use as featured image', 'inaset-cpt' ),
	'insert_into_item'      => __( 'Insert into Art Piece', 'inaset-cpt' ),
	'uploaded_to_this_item' => __( 'Uploaded to this Art Piece', 'inaset-cpt' ),
	'items_list'            => __( 'Art Pieces list', 'inaset-cpt' ),
	'items_list_navigation' => __( 'Art Pieces list navigation', 'inaset-cpt' ),
	'filter_items_list'     => __( 'Filter Art Pieces list', 'inaset-cpt' ),
);
/*$rewrite = array(
	'slug'                  => '',
	'with_front'            => true,
	'pages'                 => true,
	'feeds'                 => true,
);*/
$args = array(
	'label'                 => __( 'Art Pieces', 'inaset-cpt' ),
	'description'           => '',
	'labels'                => $labels,
	'supports'              => array( 'title', 'editor', 'thumbnail', 'reviews' ),
	'taxonomies'            => array( 'art_set'),
	'hierarchical'          => false,
	'public'                => true,
	'show_ui'               => true,
	'show_in_menu'          => true,
	'menu_icon'             => 'dashicons-art',
	'menu_position'         => 22,
	'show_in_admin_bar'     => false,
	'show_in_nav_menus'     => false,
	'can_export'            => true,
	'has_archive'           => false,
	'exclude_from_search'   => true,
	'publicly_queryable'    => false,
	'rewrite'               => false,
	'capability_type'       => 'page',
	'show_in_rest'          => true,
);

register_post_type( 'art', $args );
