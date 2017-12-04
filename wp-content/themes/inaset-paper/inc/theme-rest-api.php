<?php



function inaset_rest_add_extra_fields() {

	register_rest_field( array( 'art' ),
		'featured_image',
		array(
			'get_callback'    => 'inaset_rest_add_featured_image',
			'update_callback' => null,
			'schema'          => null,
		)
	);

	register_rest_field( array( 'art' ),
		'art_year',
		array(
			'get_callback'    => 'inaset_rest_add_meta',
			'update_callback' => null,
			'schema'          => null,
		)
	);

	register_rest_field( array( 'art' ),
		'art_author',
		array(
			'get_callback'    => 'inaset_rest_add_meta',
			'update_callback' => null,
			'schema'          => null,
		)
	);

}
add_action( 'rest_api_init', 'inaset_rest_add_extra_fields' );


function inaset_rest_add_meta( $object, $field_name, $request ) {
	$meta = get_post_meta( $object['id'], $field_name, true );
	return $meta ? esc_html( $meta ) : '';
}

function inaset_rest_add_featured_image( $object, $field_name, $request ) {

	$output = array( 'full' => '' );

	if( !has_post_thumbnail( $object['id'] ) ) {
		return $output;
	}

	$output['full'] = get_the_post_thumbnail_url( $object['id'], 'full' );

	return $output;
}






function inaset_rest_pre_get_posts( $query ) {

	if( !defined( 'REST_REQUEST' ) || !REST_REQUEST ) {
		return;
	}

	//error_log( '$query:' . print_r($query  , true ) );

	/*$post_type = $query->get( 'post_type' );

	if( 'service' == $post_type ) {
		$query->set( 'orderby', 'menu_order' );
		$query->set( 'order', 'ASC' );
	}*/
}
add_action( 'pre_get_posts', 'inaset_rest_pre_get_posts' );



/**
 * Contact Form
 */

/**
 * Filters a post before it is inserted via the REST API.
 *
 * The dynamic portion of the hook name, `$this->post_type`, refers to the post type slug.
 *
 * @since 4.7.0
 *
 * @param stdClass        $prepared_post An object representing a single post prepared
 *                                       for inserting or updating the database.
 * @param WP_REST_Request $request       Request object.
 */
function inaset_format_contact_before_insert( $prepared_post, $request  ) {

	if( !empty( $request['contact']['hpot'] )  ) {
		return new WP_Error( 'rest_invalid_content', __( 'Invalid Contact.' ), array( 'status' => 400 ) );
	}

	if( empty( $request['form_type'] ) || !in_array( $request['form_type'], array( 'contact', 'suggestion' ) ) ) {
		return new WP_Error( 'rest_invalid', 'Invalid form', array( 'status' => 400 ) );
	}

	if( !empty( $prepared_post->post_content ) ) {
		return new WP_Error( 'rest_invalid', __( 'Invalid.' ), array( 'status' => 400 ) );
	}

	if( empty( $prepared_post->post_status ) || ( isset( $request['status'] ) && 'unread' != $request['status'] ) ) {
		return new WP_Error( 'rest_invalid_status', __( 'Invalid. ' ), array( 'status' => 400 ) );
	}

	if( empty( $request['contact']['email'] ) || !is_email( $request['contact']['email'] ) ) {
		return new WP_Error( 'rest_invalid_content', __( 'Invalid Contact. Email not defined' ), array( 'status' => 400 ) );
	}

	ob_start();
	include get_template_directory(). '/parts/mail-body-'.$request['form_type'].'.php';
	$content = ob_get_clean();

	$prepared_post->post_content = $content;

	$timestamp = !empty( $request['timestamp'] ) ? $request['timestamp'] : time();
	$prepared_post->post_title = ucfirst( $request['form_type'] ) . ' | '.$prepared_post->post_title . ' | ' . date( 'j.m.Y G:i', intval( $timestamp ) );

	return $prepared_post;

}
add_filter( 'rest_pre_insert_contact', 'inaset_format_contact_before_insert', 10, 2 );



/**
 * Fires after a single post contact is created or updated via the REST API.
 *
 * @since 4.7.0
 *
 * @param WP_Post         $post     Inserted or updated post object.
 * @param WP_REST_Request $request  Request object.
 * @param bool            $creating True when creating a post, false when updating.
 */
function inaset_manage_after_contact_insert( $post, $request, $new = false ) {
	if( !$new ) {
		return;
	}

	if( empty( $post->post_content ) ) {
		return;
	}

	$option_key = 'form_'.$request['form_type'].'_recipients';
	$recipients = inaset_get_theme_option( $option_key );

	$to = explode(',', $recipients );
	$to = array_map( 'trim', $to );
	$to = array_filter( $to, 'is_email' );
	$subject = 'New '. $request['form_type'] .' from Inaset Paper website';
	if( empty( $to ) ) {
		return;
	}

	// from
	$from = $request['contact']['email'];

	$message = apply_filters( 'the_content', $post->post_content );

	// Sending e-mail
	$res = inaset_send_email( $from, $to, $subject, $message );

	update_post_meta( $post->ID, 'inaset_contact_email_result', $res );
}
add_action( 'rest_insert_contact', 'inaset_manage_after_contact_insert', 10, 3 );
