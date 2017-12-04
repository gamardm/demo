<?php

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'SHORTCAKE_INASET_URL_ROOT', plugin_dir_url( __FILE__ ) );


// Mother Load Class
require_once( get_template_directory()  . '/inc/shortcake/class-shortcake-inaset.php' );


/**
 * Load the Shortcake Bakery
 */
function shortcode_inaset_launch() {
	return Shortcake_Inaset::get_instance( __FILE__ );
}
shortcode_inaset_launch();