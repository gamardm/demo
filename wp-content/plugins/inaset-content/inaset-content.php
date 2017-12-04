<?php
/*
Plugin Name: Inaset Paper Content
Version: 1.0.0
Description: Register the custom post types and taxonomies
Author: wearegomo,luistinygod
Author URI: https://www.gomo.pt/
Plugin URI: https://www.gomo.pt/
Text Domain: inaset-cpt
Domain Path: /languages
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Register Custom Post Types and Custom Taxonomies
 */
function inasetc_register_content() {

	require_once 'inc/class-contact-form-endpoint.php';

	/** Custom Post Types */
	require_once 'cpts/product.php';
	require_once 'cpts/art.php';
	require_once 'cpts/contact.php';

	/** Taxonomies */
	require_once 'taxs/art_set.php';

}
add_action( 'init', 'inasetc_register_content', 0 );


function inasetc_register_metas() {
	require_once 'cmb2/product.php';
	require_once 'cmb2/page.php';
	require_once 'cmb2/art.php';
}
add_action( 'cmb2_admin_init', 'inasetc_register_metas' );

function inasetc_get_pages_list( $f ) {
	$pages = get_pages();
	$output = array();
	foreach( $pages as $page ) {
		$output[ $page->ID ] = $page->post_title;
	}
	return $output;
}

/**
 * On save post, calculate the product app grammages list
 * @param $post_id
 */
function inasetc_on_save_post( $post_id ) {

	if ( wp_is_post_revision( $post_id ) ) { return; }

	$post_type = get_post_type( $post_id );

	if ( 'product' != $post_type ) { return; }

	$product_app_list  = get_post_meta( $post_id, 'product_app_list', true );

	if( empty( $product_app_list ) || !is_array( $product_app_list ) ) {
		return;
	}

	$grammages = array();
	foreach ( $product_app_list as $item ) {
		if( empty( $item['grammages'] ) ) { continue; }
		$grammages[] = $item['grammages'];
	}
	$grammages = implode(',', $grammages );
	$grammages = explode( ',', $grammages );
	$grammages = array_unique( $grammages );
	sort( $grammages, SORT_NUMERIC );

	update_post_meta( $post_id, 'product_app_grammages', $grammages );

}
add_action( 'save_post', 'inasetc_on_save_post', 10, 1 );