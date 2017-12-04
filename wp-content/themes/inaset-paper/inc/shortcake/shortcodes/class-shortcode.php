<?php

namespace Shortcake_Inaset\Shortcodes;

/**
 * Base class for all shortcodes to extend
 * Ensures each shortcode implements a consistent pattern
 */
abstract class Shortcode {

	/**
	 * Get the "tag" used for the shortcode. This will be stored in post_content
	 *
	 * @return string
	 */
	public static function get_shortcode_tag() {
		$parts = explode( '\\', get_called_class() );
		$shortcode_tag = array_pop( $parts );
		$shortcode_tag = strtolower( str_replace( '_', '-', $shortcode_tag ) );
		return apply_filters( 'shortcake_uw_shortcode_tag', $shortcode_tag, get_called_class() );
	}

	/**
	 * Allow subclasses to register their own action
	 * Fires after the shortcode has been registered on init
	 *
	 * @return null
	 */
	public static function setup_actions() {
		// No base actions are necessary
	}

	public static function get_shortcode_ui_args() {
		return array();
	}

	/**
	 * Render the shortcode. Remember to always return, not echo
	 *
	 * @param array $attrs Shortcode attributes
	 * @param string $content Any inner content for the shortcode (optional)
	 * @return string
	 */
	public static function callback( $attrs, $content = '', $shortcode_tag = '' ) {
		return '';
	}

	/**
	 * Opportunity to do something before shortcode callback
	 */
	public static function action_before_callback() {
		// do something like adding scripts
	}

	/**
	 * @param string $input String to transform
	 * @param array $bold_index Array of words index to transform to bold (starting on 0)
	 *
	 * @return string
	 */
	protected static function string_to_bold_parts( $input = '', $bold_index = array( 1 ) ) {

		$input = preg_replace('/\s+/', ' ', trim( $input ) );
		$parts = explode(' ', $input );

		foreach( $bold_index as $i ) {
			if( isset( $parts[ $i ] ) ) {
				$parts[ $i ] = '<strong>' . $parts[ $i ] . '</strong>';
			}
		}
		return implode( ' ', $parts );
	}


	public static function google_maps_enqueue_scritps() {
		$lang = 'pt';
		wp_enqueue_script( 'shortcake-inaset-gmaps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCBgQd5BdsBYMlm_8e0x8fzYot3xZV0E_0&callback=launchMaps&language='.$lang, array(), null, true );
	}


}
