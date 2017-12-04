<?php




function inaset_body_classes( $classes ) {

	if( is_singular( 'product' ) || is_page() ) {
		$post = get_post();
		$classes[] = esc_attr( get_post_meta( $post->ID, 'body_class', true ) );
	} else if( is_404() ) {
		$classes[] = 'page-404';
	}

	return $classes;
}
add_filter( 'body_class', 'inaset_body_classes');




/**
 * Remove the nbsp; on editor when adding shorcodes.
 * @param $content
 *
 * @return mixed
 */
function inaset_remove_buggy_nbsps( $content ) {

	$content = str_replace( '&nbsp;', ' ', $content);
	$content = str_replace( '\xc2\xa0', ' ', $content);

	return $content;

}
add_filter( 'content_save_pre', 'inaset_remove_buggy_nbsps', 99 );
