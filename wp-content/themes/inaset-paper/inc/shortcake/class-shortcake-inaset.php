<?php

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Manages registered shortcodes
 */
class Shortcake_Inaset {

	private static $instance;

	private $internal_shortcode_classes = array(
		'Shortcake_Inaset\Shortcodes\Product_Intro',
		'Shortcake_Inaset\Shortcodes\Product_Feature',
		'Shortcake_Inaset\Shortcodes\Product_Range',
		'Shortcake_Inaset\Shortcodes\Product_Canvas',
		'Shortcake_Inaset\Shortcodes\Product_Print_Selector',
		'Shortcake_Inaset\Shortcodes\Product_Case_Studies',
		'Shortcake_Inaset\Shortcodes\Intro',
		'Shortcake_Inaset\Shortcodes\Intro_Image',
		'Shortcake_Inaset\Shortcodes\Feature',
		'Shortcake_Inaset\Shortcodes\Feature_Full',
		'Shortcake_Inaset\Shortcodes\Feature_Bgcolor',
		'Shortcake_Inaset\Shortcodes\Feature_Did_You_Know',
		'Shortcake_Inaset\Shortcodes\Form_Suggestions',
		'Shortcake_Inaset\Shortcodes\Text_Content'
	);
	private $registered_shortcode_classes = array();
	private $registered_shortcodes = array();

	public static function get_instance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new Shortcake_Inaset();
			self::$instance->setup_actions();
		}

		return self::$instance;
	}

	/**
	 * Set up shortcode actions
	 */
	private function setup_actions() {

		$this->load_dependencies();

		add_action( 'init', array( $this, 'register_shortcodes' ) );

		add_filter( 'wp_kses_allowed_html', array( $this, 'filter_allowed_html_tags' ), 10, 2 );

		/*add_action( 'shortcode_ui_loaded_editor', array( $this, 'admin_enqueue_scripts' ) );*/
	}

	public function load_dependencies() {

		$shortcodes_dir = get_template_directory() .'/inc/shortcake/shortcodes/';

		require_once $shortcodes_dir .'class-shortcode.php';

		foreach( $this->internal_shortcode_classes as $class ) {
			$parts = explode( '\\', $class );
			$tag = array_pop( $parts );
			$tag = strtolower( str_replace( '_', '-', $tag ) );

			$filename  = $shortcodes_dir . 'class-' . $tag . '.php';

			require_once $filename;
		}

	}

	/**
	 * Register all of the shortcodes
	 */
	public function register_shortcodes() {

		$this->registered_shortcode_classes = apply_filters( 'shortcake_ce_shortcode_classes', $this->internal_shortcode_classes );

		foreach ( $this->registered_shortcode_classes as $class ) {
			$shortcode_tag = $class::get_shortcode_tag();
			$this->registered_shortcodes[ $shortcode_tag ] = $class;

			add_shortcode( $shortcode_tag, array( $this, 'do_shortcode_callback' ) );

			$class::setup_actions();

			$ui_args = apply_filters( 'shortcake_ce_shortcode_ui_args', $class::get_shortcode_ui_args(), $shortcode_tag );
			if ( ! empty( $ui_args ) && function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
				shortcode_ui_register_for_shortcode( $shortcode_tag, $ui_args );
			}
		}
	}

	/**
	 * Do the shortcode callback
	 */
	public function do_shortcode_callback( $attrs, $content = '', $shortcode_tag ) {

		if ( empty( $this->registered_shortcodes[ $shortcode_tag ] ) ) {
			return '';
		}


		$class = $this->registered_shortcodes[ $shortcode_tag ];

		// Allow for some action before
		$class::action_before_callback();

		$output = $class::callback( $attrs, $content, $shortcode_tag );

		return apply_filters( 'shortcake_ce_shortcode_callback', $output, $shortcode_tag, $attrs, $content );
	}

	public function admin_enqueue_scripts() {}

	public function filter_allowed_html_tags( $allowedposttags, $context ) {
		$allowedposttags['img']['data-anim'] = true;
		$allowedposttags['img']['data-anim-delay'] = true;
		return $allowedposttags;
	}
}
