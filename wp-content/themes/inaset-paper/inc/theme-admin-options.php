<?php
/**
 * CMB2 Theme Options
 * @version 0.1.0
 */
class Inaset_Admin_Options {

	/**
	 * Option key, and option page slug
	 * @var string
	 */
	protected $key = 'inaset_theme_options';

	/**
	 * Options page metabox id
	 * @var string
	 */
	protected $metabox_id = 'inaset_option_metabox';

	/**
	 * Options Page title
	 * @var string
	 */
	protected $title = '';

	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = '';

	/**
	 * Holds an instance of the object
	 *
	 * @var Inaset_Admin_Options
	 */
	protected static $instance = null;

	/**
	 * Returns the running object
	 *
	 * @return Inaset_Admin_Options
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
			self::$instance->hooks();
		}

		return self::$instance;
	}

	/**
	 * Constructor
	 * @since 0.1.0
	 */
	protected function __construct() {
		// Set our title
		$this->title = 'Config';
	}

	/**
	 * Initiate our hooks
	 * @since 0.1.0
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox' ) );
	}


	/**
	 * Register our setting to WP
	 * @since  0.1.0
	 */
	public function init() {
		register_setting( $this->key, $this->key );
	}

	/**
	 * Add menu options page
	 * @since 0.1.0
	 */
	public function add_options_page() {
		$this->options_page = add_menu_page( $this->title, $this->title, 'edit_others_posts', $this->key, array( $this, 'admin_page_display' ) );

		// Include CMB CSS in the head to avoid FOUC
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	}

	/**
	 * Admin page markup. Mostly handled by CMB2
	 * @since  0.1.0
	 */
	public function admin_page_display() {
		?>
		<div class="wrap cmb2-options-page <?php echo $this->key; ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
		</div>
		<?php
	}

	/**
	 * Add the options metabox to the array of metaboxes
	 * @since  0.1.0
	 */
	function add_options_page_metabox() {

		// hook in our save notices
		add_action( "cmb2_save_options-page_fields_{$this->metabox_id}", array( $this, 'settings_notices' ), 10, 2 );

		$cmb = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key )
			),
		) );

		// email
		$cmb->add_field( array(
			'name' => 'Forms',
			'id'   => 'forms_title',
			'type' => 'title',
		) );

		$cmb->add_field( array(
			'name' => 'Suggestions email recipients',
			'desc' => 'If more than one, separate by comma.',
			'id'   => 'form_suggestion_recipients',
			'type' => 'text',
		) );

		$cmb->add_field( array(
			'name' => 'Contacts email recipients',
			'desc' => 'If more than one, separate by comma.',
			'id'   => 'form_contact_recipients',
			'type' => 'text',
		) );

		$cmb->add_field( array(
			'name' => 'Cookies Page',
			'desc' => '',
			'id'   => 'cookies_title',
			'type' => 'title',
		) );

		$cmb->add_field( array(
			'name'             => 'Select the Cookie Policy page',
			'desc'             => '',
			'id'               => 'cookie_page',
			'type'             => 'select',
			'show_option_none' => true,
			'options_cb'       => array( $this, 'list_pages' ),
		) );


		/*

		$cmb->add_field( array(
			'name' => 'Contact Us Page',
			'desc' => '',
			'id'   => 'contact_title',
			'type' => 'title',
		) );

		$cmb->add_field( array(
			'name'             => 'Select the Contact Us page',
			'desc'             => '',
			'id'               => 'contact_page',
			'type'             => 'select',
			'show_option_none' => true,
			'options_cb'       => array( $this, 'list_pages' ),
		) );*/

	}

	/**
	 * Fill in options for a page selector.
	 *
	 * @param $field_id
	 *
	 * @return array
	 */
	function list_pages( $field_id ) {

		$pages = get_pages();

		if( !$pages ) {
			return array();
		}

		$output = array();

		foreach( $pages as $page ) {
			$output[ $page->ID ] = $page->post_title;
		}

		return $output;
	}


	/**
	 * Register settings notices for display
	 *
	 * @since  0.1.0
	 * @param  int   $object_id Option key
	 * @param  array $updated   Array of updated fields
	 * @return void
	 */
	public function settings_notices( $object_id, $updated ) {
		if ( $object_id !== $this->key || empty( $updated ) ) {
			return;
		}

		add_settings_error( $this->key . '-notices', '', 'Configuração guardada', 'updated' );
		settings_errors( $this->key . '-notices' );
	}

	/**
	 * Public getter method for retrieving protected/private variables
	 * @since  0.1.0
	 * @param  string  $field Field to retrieve
	 * @return mixed          Field value or exception is thrown
	 */
	public function __get( $field ) {
		// Allowed fields to retrieve
		if ( in_array( $field, array( 'key', 'metabox_id', 'title', 'options_page' ), true ) ) {
			return $this->{$field};
		}

		throw new Exception( 'Invalid property: ' . $field );
	}

}

/**
 * Helper function to get/return the Myprefix_Admin object
 * @since  0.1.0
 * @return Inaset_Admin_Options object
 */
function inaset_admin_options() {
	return Inaset_Admin_Options::get_instance();
}

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string $key     Options array key
 * @param  mixed  $default Optional default value
 * @return mixed           Option value
 */
function inaset_get_theme_option( $key = '', $default = null ) {
	if ( function_exists( 'cmb2_get_option' ) ) {
		// Use cmb2_get_option as it passes through some key filters.
		return cmb2_get_option( inaset_admin_options()->key, $key, $default );
	}

	// Fallback to get_option if CMB2 is not loaded yet.
	$opts = get_option( inaset_admin_options()->key, $key, $default );

	$val = $default;

	if ( 'all' == $key ) {
		$val = $opts;
	} elseif ( array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}

	return $val;
}

// Get it started
inaset_admin_options();