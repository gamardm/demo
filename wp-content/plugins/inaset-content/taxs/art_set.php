<?php

$labels = array(
	'name'                       => _x( 'Art Sets', 'taxonomy general name', 'inaset-cpt' ),
	'singular_name'              => _x( 'Art Set', 'taxonomy singular name', 'inaset-cpt' ),
	'search_items'               => __( 'Search Art Sets', 'inaset-cpt' ),
	'popular_items'              => __( 'Popular Art Sets', 'inaset-cpt' ),
	'all_items'                  => __( 'All Art Sets', 'inaset-cpt' ),
	'parent_item'                => null,
	'parent_item_colon'          => null,
	'edit_item'                  => __( 'Edit Art Set', 'inaset-cpt' ),
	'update_item'                => __( 'Update Art Set', 'inaset-cpt' ),
	'add_new_item'               => __( 'Add New Art Set', 'inaset-cpt' ),
	'new_item_name'              => __( 'New Art Set Name', 'inaset-cpt' ),
	'separate_items_with_commas' => __( 'Separate Art Sets with commas', 'inaset-cpt' ),
	'add_or_remove_items'        => __( 'Add or remove Art Sets', 'inaset-cpt' ),
	'choose_from_most_used'      => __( 'Choose from the most used Art Sets', 'inaset-cpt' ),
	'not_found'                  => __( 'No Art Sets found.', 'inaset-cpt' ),
	'menu_name'                  => __( 'Art Sets', 'inaset-cpt' ),
);

$args = array(
	'labels'                     => $labels,
	'hierarchical'               => false,
	'public'                     => true,
	'show_ui'                    => true,
	'meta_box_cb'                => false, //hide metabox
	'show_admin_column'          => true,
	'show_in_menu'               => true,
	'show_in_nav_menus'          => false,
	'show_tagcloud'              => false,
	'show_in_quick_edit'         => false,
	'rewrite'                    => false,
	'show_in_rest'               => true,
);
register_taxonomy( 'art_set', array( 'art' ), $args );

