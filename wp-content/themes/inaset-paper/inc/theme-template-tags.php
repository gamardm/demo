<?php

function inaset_get_contact_us_subject() {
	return array(
		'buy_paper' => __( 'I want to buy your paper', 'inaset' ),
	);
}


function inaset_get_contact_topic_label( $topic = '' ) {
	if( empty( $topic ) ) {
		return '';
	}

	$topics = inaset_get_contact_us_subject();

	if( array_key_exists( $topic, $topics ) ) {
		return $topics[ $topic ];
	}
	return '';
}

function inaset_get_page_template() {
	$template = get_page_template_slug();
	return empty( $template ) ? 'default' : str_replace( array( '.php' ), '', $template );
}