<?php

$labels = array(
	'name'                  => _x( 'Contacts', 'Post Type General Name', 'inaset-cpt' ),
	'singular_name'         => _x( 'Contact', 'Post Type Singular Name', 'inaset-cpt' ),
	'menu_name'             => __( 'Contacts', 'inaset-cpt' ),
	'name_admin_bar'        => __( 'Contacts', 'inaset-cpt' ),
	'archives'              => __( 'Contacts Archives', 'inaset-cpt' ),
	'attributes'            => __( 'Contacts Attributes', 'inaset-cpt' ),
	'parent_item_colon'     => __( 'Parent Contact:', 'inaset-cpt' ),
	'all_items'             => __( 'All Contacts', 'inaset-cpt' ),
	'add_new_item'          => __( 'Add New Contact', 'inaset-cpt' ),
	'add_new'               => __( 'Add New', 'inaset-cpt' ),
	'new_item'              => __( 'New Contact', 'inaset-cpt' ),
	'edit_item'             => __( 'Edit Contact', 'inaset-cpt' ),
	'update_item'           => __( 'Update Contact', 'inaset-cpt' ),
	'view_item'             => __( 'View Contact', 'inaset-cpt' ),
	'view_items'            => __( 'View Contacts', 'inaset-cpt' ),
	'search_items'          => __( 'Search Contact', 'inaset-cpt' ),
	'not_found'             => __( 'Not found', 'inaset-cpt' ),
	'not_found_in_trash'    => __( 'Not found in Trash', 'inaset-cpt' ),
	'featured_image'        => __( 'Featured Image', 'inaset-cpt' ),
	'set_featured_image'    => __( 'Set featured image', 'inaset-cpt' ),
	'remove_featured_image' => __( 'Remove featured image', 'inaset-cpt' ),
	'use_featured_image'    => __( 'Use as featured image', 'inaset-cpt' ),
	'insert_into_item'      => __( 'Insert into Contact', 'inaset-cpt' ),
	'uploaded_to_this_item' => __( 'Uploaded to this Contact', 'inaset-cpt' ),
	'items_list'            => __( 'Contacts list', 'inaset-cpt' ),
	'items_list_navigation' => __( 'Contacts list navigation', 'inaset-cpt' ),
	'filter_items_list'     => __( 'Filter Contacts list', 'inaset-cpt' ),
);

$rewrite = false;

$args = array(
	'label'                 => __( 'Contacts', 'inaset-cpt' ),
	'description'           => '',
	'labels'                => $labels,
	'supports'              => array( 'title', 'editor', 'custom-fields' ),
	'taxonomies'            => array( '' ),
	'hierarchical'          => false,
	'public'                => false,
	'show_ui'               => true,
	'show_in_menu'          => true,
	'menu_icon'             => 'dashicons-feedback',
	'menu_position'         => 25,
	'show_in_admin_bar'     => false,
	'show_in_nav_menus'     => false,
	'can_export'            => true,
	'has_archive'           => false,
	'exclude_from_search'   => true,
	'publicly_queryable'    => false,
	'rewrite'               => $rewrite,
	'capability_type'       => 'page',
	'show_in_rest'          => true,
	'rest_controller_class' => 'Inaset_Contact_Form_Endpoint',
	'capabilities'			=> array(
		'create_posts'        => false,
		'publish_posts'       => 'publish_pages',
		'edit_posts'          => 'edit_pages',
		'edit_others_posts'   => 'edit_others_pages',
		'delete_posts'        => 'delete_pages',
		'delete_others_posts' => 'delete_others_pages',
		'read_private_posts'  => 'read_private_pages',
		'edit_post'           => 'edit_page',
		'delete_post'         => 'delete_page',
		'read_post'           => 'read_page',
	),
	'map_meta_cap'			=> true,
);

register_post_type( 'contact', $args );


register_post_status( 'unread', array(
	'label'                     => __( 'Unread', 'inaset-cpt'),
	'public'                    => true,
	'exclude_from_search'       => true,
	'show_in_admin_all_list'    => true,
	'show_in_admin_status_list' => true,
	'label_count'               => _n_noop( 'Unread <span class="count">(%s)</span>', 'Unread <span class="count">(%s)</span>' ),
) );


