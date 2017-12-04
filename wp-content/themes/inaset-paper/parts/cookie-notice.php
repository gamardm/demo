<?php
$page_id = function_exists('inaset_get_theme_option' ) ? inaset_get_theme_option( 'cookie_page' ) : '';

if( !$page_id ) {
	return;
}

$link = inaset_get_post_link( $page_id );

?>
<div class="cookie-notice js-vue-cookie-notice" v-if="showCookieNotice" v-cloak>
    <p><a @click.prevent="closeCookieNotice" href="#" class="close-cookie-notice">x</a> <?php printf( esc_html__( 'By continuing to browse this site you are agreeing to our use of cookies. Review our %scookies policy%s for details or change your cookies preferences.', 'inaset' ), '<a href="'. $link .'"><strong>', '</strong></a>'  ); ?>.</p>
</div>