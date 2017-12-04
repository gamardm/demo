<?php

$cmb = new_cmb2_box( array(
	'id'           => 'header',
	'title'        => __( 'Page header', 'inaset-cpt' ),
	'object_types' => array( 'product' ), // post type
	'context'      => 'advanced', //  'normal', 'advanced', or 'side'
	'priority'     => 'high',  //  'high', 'core', 'default' or 'low'
	'show_names'   => true, // Show field names on the left
) );

$cmb->add_field( array(
	'name'    => __( 'Video', 'inaset-cpt' ),
	'desc'    => __( 'Leave empty to default to featured image', 'inaset-cpt' ),
	'id'      => 'header_video',
	'type'    => 'file',
	// Optional:
	'options' => array(
		'url' => false, // Hide the text input for the url
	),
	'query_args' => array(
		'type' => 'video/mp4',
	),
));

$cmb->add_field( array(
	'name'    => __( 'Subtitle', 'inaset-cpt' ),
	'desc'    => __( 'Appears after page title', 'inaset-cpt' ),
	'id'      => 'header_subtitle',
	'type'    => 'textarea_small',
	'attributes'  => array(
		'rows'        => 1,
	),
) );

$cmb->add_field( array(
	'name'    => __( 'Paper weight range', 'inaset-cpt' ),
	'desc'    => __( 'Appears after subtitle', 'inaset-cpt' ),
	'id'      => 'header_paper_range',
	'type'    => 'textarea_small',
	'attributes'  => array(
		'rows'        => 1,
	),
) );

$cmb->add_field( array(
	'name'    => __( 'Page HTML class', 'inaset-cpt' ),
	'id'      => 'body_class',
	'type'    => 'text_medium',
) );




$cmb = new_cmb2_box( array(
	'id'           => 'homepage_product',
	'title'        => __( 'Homepage', 'inaset-cpt' ),
	'object_types' => array( 'product' ), // post type
	'context'      => 'side', //  'normal', 'advanced', or 'side'
	'priority'     => 'default',  //  'high', 'core', 'default' or 'low'
	'show_names'   => true, // Show field names on the left
) );

$cmb->add_field( array(
	'name'    => __( 'Title', 'inaset-cpt' ),
	'id'      => 'home_title',
	'type'    => 'text_medium',
) );

$cmb->add_field( array(
	'name'    => __( 'Keyword', 'inaset-cpt' ),
	'id'      => 'home_keyword',
	'type'    => 'text_medium',
) );


$cmb->add_field( array(
	'name'    => __( 'Background Image', 'inaset-cpt' ),
	'id'      => 'home_bg',
	'type'    => 'file',
	// Optional:
	'options' => array(
		'url' => false, // Hide the text input for the url
	),
	'query_args' => array(
		'type' => 'image/jpeg',
	),
));




$cmb = new_cmb2_box( array(
	'id'           => 'product_range',
	'title'        => __( 'Product Range', 'inaset-cpt' ),
	'object_types' => array( 'product' ), // post type
	'context'      => 'normal', //  'normal', 'advanced', or 'side'
	'priority'     => 'default',  //  'high', 'core', 'default' or 'low'
	'show_names'   => true, // Show field names on the left
) );

$cmb->add_field( array(
	'name'    => __( 'Table Grammages', 'inaset-cpt' ),
	'desc'    => __( 'Separate each row by comma. (e.g. g/m2,60,70,80,90)', 'inaset-cpt' ),
	'id'      => 'product_range_grammages',
	'type'    => 'textarea_small',
	'attributes'  => array(
		'rows'        => 1,
	),
) );

$cmb->add_field( array(
	'name'    => __( 'Paper Sizes', 'inaset-cpt' ),
	'desc'    => __( 'Separate each cell by comma, use y = Yes, n = No, last option repeates until the end. (e.g. 32x45,y,y,y,y,y,n)', 'inaset-cpt' ),
	'id'      => 'product_range_columns',
	'type'    => 'text',
	'repeatable' => true,
) );


$cmb = new_cmb2_box( array(
	'id'           => 'product_print_selector',
	'title'        => __( 'Product Applications', 'inaset-cpt' ),
	'object_types' => array( 'product' ), // post type
	'context'      => 'normal', //  'normal', 'advanced', or 'side'
	'priority'     => 'default',  //  'high', 'core', 'default' or 'low'
	'show_names'   => true, // Show field names on the left
) );


$group_field_id = $cmb->add_field( array(
	'id'          => 'product_app_list',
	'type'        => 'group',
	'options'     => array(
		'group_title'   => __( 'Application {#}', 'inaset-cpt' ), // since version 1.1.4, {#} gets replaced by row number
		'add_button'    => __( 'Add Application', 'inaset-cpt' ),
		'remove_button' => __( 'Remove Application', 'inaset-cpt' ),
		'sortable'      => true, // beta
		'closed'     => true, // true to have the groups closed by default
	),
) );

// Id's for group's fields only need to be unique for the group. Prefix is not needed.
$cmb->add_group_field( $group_field_id, array(
	'name' => __( 'Application Name', 'inaset-cpt' ),
	'id'   => 'title',
	'type' => 'text',
) );

$cmb->add_group_field( $group_field_id, array(
	'name' => __( 'Application Grammage', 'inaset-cpt' ),
	'id'   => 'grammages',
	'desc'    => __( 'Separate each grammage by comma (e.g. 80,90,110)', 'inaset-cpt' ),
	'type' => 'text',
) );

$cmb->add_group_field( $group_field_id, array(
	'name' => __( 'Description', 'inaset-cpt' ),
	'id'   => 'description',
	'type' => 'textarea_small',
) );


/** Product Slider */

$cmb = new_cmb2_box( array(
	'id'           => 'product_case_studies',
	'title'        => __( 'Case Studies slider', 'inaset-cpt' ),
	'object_types' => array( 'product' ), // post type
	'context'      => 'normal', //  'normal', 'advanced', or 'side'
	'priority'     => 'default',  //  'high', 'core', 'default' or 'low'
	'show_names'   => true, // Show field names on the left
) );


$group_field_id = $cmb->add_field( array(
	'id'          => 'slides',
	'type'        => 'group',
	'options'     => array(
		'group_title'   => __( 'Slide {#}', 'inaset-cpt' ), // since version 1.1.4, {#} gets replaced by row number
		'add_button'    => __( 'Add Slide', 'inaset-cpt' ),
		'remove_button' => __( 'Remove Slide', 'inaset-cpt' ),
		'sortable'      => true, // beta
		'closed'     => true, // true to have the groups closed by default
	),
) );

// Id's for group's fields only need to be unique for the group. Prefix is not needed.
$cmb->add_group_field( $group_field_id, array(
	'name' => __( 'Title', 'inaset-cpt' ),
	'id'   => 'title',
	'type' => 'text',
) );

$cmb->add_group_field( $group_field_id, array(
	'name' => __( 'Description', 'inaset-cpt' ),
	'id'   => 'description',
	'type' => 'textarea_small',
) );

$cmb->add_group_field( $group_field_id, array(
	'name' => __( 'Overlay image', 'inaset-cpt' ),
	'desc'    => __( 'Small image to overlap slide', 'inaset-cpt' ),
	'id'      => 'overlay',
	'type'    => 'file',
	'options' => array(
		'url' => false, // Hide the text input for the url
	),
	'query_args' => array(
		'type' => array( 'image/jpeg', 'image/png' ),
	),
) );

$cmb->add_group_field( $group_field_id, array(
	'name' => __( 'Background image', 'inaset-cpt' ),
	'id'      => 'background',
	'type'    => 'file',
	'options' => array(
		'url' => false, // Hide the text input for the url
	),
	'query_args' => array(
		'type' => 'image/jpeg',
	),
) );

