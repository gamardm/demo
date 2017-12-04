<?php

/**
 * Register navigation
 */
function inaset_theme_navigation() {
	register_nav_menus( array(
		'main' => esc_html__('Main Menu', 'inaset' ),
		'products' => esc_html__('Products Menu', 'inaset' ),
		'secondary' => esc_html__('Secondary Menu', 'inaset' ),
		'footer' => esc_html__('Footer Menu', 'inaset' ),
	));
}

add_action( 'after_setup_theme', 'inaset_theme_navigation' );


/**
 * Render Menu HTML
 *
 * @param string $theme_location
 *
 * @return
 */
function inaset_render_navigation( $theme_location = '' ) {

	/*$cache_key = 'menu_'. md5( $theme_location );*/

	/*if( false === ( $output = wp_cache_get( $cache_key, 'inaset' ) ) ) {*/
	// this code runs when there is no valid transient set

	$args = array(
		'theme_location'  => $theme_location,
		'menu'            => '',
		'container'       => '',
		'container_class' => '',
		'container_id'    => '',
		'menu_class'      => '',
		'menu_id'         => '',
		'echo'            => false,
		'fallback_cb'     => false, //default function to list links for pages
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '%3$s',
		'depth'           => 0,
		//'walker'          => new vc_Menu_Walker()
	);

	$output = wp_nav_menu( $args );

	/*wp_cache_set( $cache_key, $output, 'inaset', DAY_IN_SECONDS );*/

	/*}*/

	return $output;

}

/**
 * Flush Menu Cache
 */
function inaset_update_menu() {

	$menus = get_registered_nav_menus();

	foreach( $menus as $location => $desc ) {
		$cache_key = 'menu_'. md5( $location );
		wp_cache_delete( $cache_key, 'inaset' );
	}

}
add_action( 'wp_update_nav_menu', 'inaset_update_menu' );