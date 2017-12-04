<?php

$cmb = new_cmb2_box( array(
	'id'           => 'details_art',
	'title'        => __( 'Art details', 'inaset-cpt' ),
	'object_types' => array( 'art' ), // post type
	'context'      => 'normal', //  'normal', 'advanced', or 'side'
	'priority'     => 'default',  //  'high', 'core', 'default' or 'low'
	'show_names'   => true, // Show field names on the left
) );

$cmb->add_field( array(
	'name'           => __( 'Year', 'inaset-cpt' ),
	'desc'           => '',
	'id'             => 'art_year',
	'type'           => 'text_small',
) );

$cmb->add_field( array(
	'name'           => __( 'Artist Name', 'inaset-cpt' ),
	'desc'           => '',
	'id'             => 'art_author',
	'type'           => 'text',
) );

$cmb->add_field( array(
	'name'           => __( 'Art Set', 'inaset-cpt' ),
	'id'             => 'art_set_alt',
	'taxonomy'       => 'art_set', //Enter Taxonomy Slug
	'type'           => 'taxonomy_select',
	'show_option_none' => false,
	'remove_default' => 'true' // Removes the default metabox provided by WP core. Pending release as of Aug-10-16
) );