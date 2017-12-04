<?php


$cmb = new_cmb2_box( array(
	'id'           => 'header_page_awards',
	'title'        => __( 'Awards Paga Content', 'inaset-cpt' ),
	'object_types' => array( 'page' ), // post type
	'show_on'      => array( 'key' => 'page-template', 'value' => array( 'tpl-awards.php' ) ),
	'context'      => 'normal', //  'normal', 'advanced', or 'side'
	'priority'     => 'high',  //  'high', 'core', 'default' or 'low'
	'show_names'   => true, // Show field names on the left
) );

$cmb->add_field( array(
	'name'    => __( 'Header Logo', 'inaset-cpt' ),
	'id'      => 'header_logo',
	'type'    => 'file',
	// Optional:
	'options' => array(
		'url' => false, // Hide the text input for the url
	),
	'query_args' => array(
		'type' => 'image/svg',
	),
));


$cmb->add_field( array(
	'name'    => __( 'Sub heading', 'inaset-cpt' ),
	'desc'    => __( 'hidden title', 'inaset-cpt' ),
	'id'      => 'header_subheading',
	'type'    => 'textarea_small',
	'attributes'  => array(
		'rows'        => 1,
	),
) );


$cmb->add_field( array(
	'name'    => __( 'Title', 'inaset-cpt' ),
	'id'      => 'header_title',
	'type'    => 'text',
) );


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
	'name'    => __( 'Intro', 'inaset-cpt' ),
	'id'      => 'header_intro',
	'type'    => 'textarea_small',
) );


$cmb->add_field( array(
	'name'    => __( 'Apply Now CTA Link', 'inaset-cpt' ),
	'id'      => 'header_cta_link',
	'type'    => 'text_url',
) );


$cmb->add_field( array(
	'name'    => __( 'Prizes Subtitle', 'inaset-cpt' ),
	'id'      => 'prizes_title',
	'type'    => 'text',
) );


$cmb->add_field( array(
	'name'    => __( 'Prizes Intro', 'inaset-cpt' ),
	'id'      => 'prizes_intro',
	'type'    => 'textarea_small',
) );


$cmb->add_field( array(
	'name'    => __( 'Prizes CTA Link', 'inaset-cpt' ),
	'id'      => 'prizes_cta_link',
	'type'    => 'text_url',
) );















$cmb = new_cmb2_box( array(
	'id'           => 'header_page',
	'title'        => __( 'Page header', 'inaset-cpt' ),
	'object_types' => array( 'page' ), // post type
	'show_on'      => array( 'key' => 'page-template', 'value' => array( 'default', 'tpl-art-gallery.php' ) ),
	'context'      => 'normal', //  'normal', 'advanced', or 'side'
	'priority'     => 'high',  //  'high', 'core', 'default' or 'low'
	'show_names'   => true, // Show field names on the left
) );

$cmb->add_field( array(
	'name'    => __( 'Sub heading', 'inaset-cpt' ),
	'desc'    => __( 'Appears after page title', 'inaset-cpt' ),
	'id'      => 'header_subheading',
	'type'    => 'textarea_small',
	'attributes'  => array(
		'rows'        => 1,
	),
) );

$cmb->add_field( array(
	'name'    => __( 'Subtitle', 'inaset-cpt' ),
	'desc'    => __( 'Appears after page sub heading', 'inaset-cpt' ),
	'id'      => 'header_subtitle',
	'type'    => 'textarea_small',
	'attributes'  => array(
		'rows'        => 1,
	),
) );

$cmb->add_field( array(
	'name'    => __( 'Button Read More Label', 'inaset-cpt' ),
	'desc'    => __( 'Leave empty for default.', 'inaset-cpt' ),
	'id'      => 'header_button_label',
	'type'    => 'text',
) );






$cmb = new_cmb2_box( array(
	'id'           => 'page_body_details',
	'title'        => __( 'Page details', 'inaset-cpt' ),
	'object_types' => array( 'page' ), // post type
	'context'      => 'side', //  'normal', 'advanced', or 'side'
	'priority'     => 'default',  //  'high', 'core', 'default' or 'low'
	'show_names'   => true, // Show field names on the left
) );

$cmb->add_field( array(
	'name'    => __( 'Page HTML class', 'inaset-cpt' ),
	'id'      => 'body_class',
	'type'    => 'text_medium',
) );






$cmb = new_cmb2_box( array(
	'id'           => 'page_config',
	'title'        => __( 'Config', 'inaset-cpt' ),
	'object_types' => array( 'page' ), // post type
	'show_on'      => array( 'key' => 'page-template', 'value' => array( 'tpl-homepage.php', 'tpl-contact-us.php' ) ),
	'context'      => 'normal', //  'normal', 'advanced', or 'side'
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
	'name'             => __( 'CTA link', 'inaset' ),
	'id'               => 'home_cta_post',
	'type'             => 'select',
	'show_option_none' => true,
	'options_cb'       => 'inasetc_get_pages_list'
) );

$cmb->add_field( array(
	'name'    => __( 'CTA label', 'inaset-cpt' ),
	'desc'    => __( 'Leave empty for default.', 'inaset-cpt' ),
	'id'      => 'home_cta_label',
	'type'    => 'text',
) );