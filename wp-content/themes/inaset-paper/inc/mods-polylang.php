<?php

/**
 * Output current lang prefix
 */
function inaset_the_lang() {
	echo inaset_get_lang();
}

/**
 * Return current lang prefix
 * @return string
 */
function inaset_get_lang() {
	return function_exists('pll_current_language') ? pll_current_language() : 'en';
}

function inaset_get_langs( $hide_if_empty = 0 ) {

	/*
	 * dropdown               => displays a dropdown if set to 1, defaults to 0
	 * echo                   => echoes the the switcher if set to 1 ( default )
	 * hide_if_empty          => hides languages with no posts ( or pages ) if set to 1 ( default )
	 * show_flags             => shows flags if set to 1, defaults to 0
	 * show_names             => shows languages names if set to 1 ( default )
	 * display_names_as       => whether to display the language name or code. valid options are 'slug' and 'name'
	 * force_home             => forces linking to the home page is set to 1, defaults to 0
	 * hide_if_no_translation => hides the link if there is no translation if set to 1, defaults to 0
	 * hide_current           => hides the current language if set to 1, defaults to 0
	 * post_id                => if not null, link to translations of post defined by post_id, defaults to null
	 * raw                    => set this to true to build your own custom language switcher, defaults to 0
	 */

	$args = array(
		'echo' => 0,
		'hide_if_empty' => $hide_if_empty,
		'raw' => 1
	);

	$langs = function_exists( 'pll_the_languages' ) ? pll_the_languages( $args ) : '';

	return $langs;
}


function inaset_get_current_lang_link() {
	$langs = inaset_get_langs();
	foreach( $langs as $lang ) {
		if( $lang['current_lang'] ) {
			return $lang['url'];
		}
	}
}

/**
 * Render the permalink of certain page id, for the current language
 */
function inaset_get_post_link( $page_id = '' ) {
	if( empty( $page_id ) ) {
		return;
	}
	$curr = function_exists( 'pll_current_language' ) ? pll_current_language() : 'en';
	$post_id = $curr == 'en' || !function_exists('pll_get_post') ? $page_id : pll_get_post( $page_id, $curr );
	return esc_url( get_permalink( $post_id ) );
}