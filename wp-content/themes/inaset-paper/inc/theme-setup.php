<?php
/**
 * INASET Paper - Theme Setup functions
 */

// Remove admin bar
add_filter( 'show_admin_bar', '__return_false');
/*
function inaset_content_width() {
	$GLOBALS['content_width'] = 960;
}
add_action( 'after_setup_theme', 'inaset_content_width', 0 );*/


/** Theme setup */
function inaset_theme_setup() {

	/** Load translation files for the theme */
	load_theme_textdomain( 'inaset', get_template_directory() . '/languages' );

	// Add Menu Support
	add_theme_support( 'menus' );

	// Add Thumbnail Theme Support
	add_theme_support( 'post-thumbnails' );

	// Enables post and comment RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );


	if ( function_exists( 'add_image_size' ) ) {
/*
		add_image_size( 'cell-box', 394, 400, true );
		add_image_size( 'cell-wine', 99999, 200, false );*/

		// core medium size -> used for the producer image,
		// core large size -> used for the home hero image,

	}


}
add_action( 'after_setup_theme', 'inaset_theme_setup' );



/** Styles and Scripts */
function inaset_scripts() {

    // main style
	wp_enqueue_style( 'inaset-css', get_template_directory_uri() . '/style.css' );

	// main script
	wp_enqueue_script( 'inaset-js', get_template_directory_uri() . '/assets/js/public.min.js', array(), '20170307', true );

	// slider script
   /* if( is_front_page() || is_home() ) {
	    wp_enqueue_script( 'inaset-slider-js', get_template_directory_uri() . '/assets/js/slider.min.js', array(), '20170307', true );
    }*/

	// localize script
	$loc = array(
        'api_route' => home_url( '/wp-json/wp/v2/' ),
		'nonce_rest'        => wp_create_nonce( 'wp_rest' ),
	);
	wp_localize_script( 'inaset-js', 'INASET_JS', $loc );


	// Where To Buy template
	if( is_page() && 'tpl-where-to-buy' === inaset_get_page_template() ) {

		// main script
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'where-to-buy', get_template_directory_uri() . '/assets/js/whereToBuy.js', array('jquery'), '20170307', true );

		// load google maps
		$lang = inaset_get_lang();
		wp_enqueue_script( 'inaset-gmaps-js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyA87qaNljcTvPeoWjx6-YrhHoGYC8UkSy0&callback=initMap&language='. $lang, array(), null, true );

	}

}
add_action( 'wp_enqueue_scripts', 'inaset_scripts' );


function inaset_fonts_on_footer() {
	?>
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i|Work+Sans:300,400,700" rel="stylesheet">
	<?php
    if( is_page_template( array( 'tpl-awards.php', 'tpl-homepage.php' ) ) ): ?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,600,900|Neuton:700">
    <?php endif;
}

add_action( 'wp_footer', 'inaset_fonts_on_footer', 30 );
