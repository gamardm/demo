<?php
/**
 * E-mail related functions
 */

function inaset_send_email( $from, $to, $subject = '', $message = '', $attachments = array() ) {

	if( !empty( $to ) && is_array( $to ) ) {
		$to = array_filter( $to, 'is_email' );
	}

	if( empty( $to ) ) {
		return false;
	}

	$from = sanitize_email( $from );

	if( !is_email( $from ) ) {
		return false;
	}

	$headers[] = 'From: Inaset Paper <noreply@example.com>';
	$headers[] = 'Reply-to: '. $from;

	add_filter( 'wp_mail_content_type', 'inaset_mail_content_type' );

	$result = wp_mail( $to, $subject, $message, $headers, $attachments );

	remove_filter( 'wp_mail_content_type', 'inaset_mail_content_type' );

	return $result;
}

function inaset_mail_content_type() {
	return 'text/html';
}