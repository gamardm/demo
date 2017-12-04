<?php

/**
 * LOGIN screen
 */

function inaset_login_logo() {
	?>
	<style type="text/css">
		body.login div#login h1 a {
			background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/logo-inaset.png);
			padding-bottom: 10px;
			background-size: 200px 80px;
			margin: 0 auto 0;
			height: 80px;
			width: 200px;
		}
	</style>
	<?php
}
add_action( 'login_enqueue_scripts', 'inaset_login_logo' );


function inaset_login_logo_url() {
	return home_url();
}
add_filter( 'login_headerurl', 'inaset_login_logo_url' );


function inaset_login_logo_url_title() {
	return 'INASET paper';
}
add_filter( 'login_headertitle', 'inaset_login_logo_url_title' );


/**
 * Dashboard widgets add theme widgets // removing defaults  @todo: REVIEW
 */
// Remove default widgets

remove_action( 'welcome_panel', 'wp_welcome_panel' );


function inaset_remove_dashboard_widgets() {
	//main:
	remove_meta_box( 'dashboard_browser_nag', 'dashboard', 'normal' );
	//remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );

	//side:
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );

}
add_action( 'wp_dashboard_setup', 'inaset_remove_dashboard_widgets' );


// remove menus from admin
function inaset_remove_admin_menu() {
	remove_menu_page( 'edit.php' ); // remove posts
	remove_menu_page( 'link-manager.php' ); // remove links
	remove_menu_page( 'edit-comments.php' ); // remove comments

	if( !current_user_can('manage_options') ) {
		global $submenu;
	    unset( $submenu['themes.php'][6] ); // Customize link*/
		remove_menu_page( 'tools.php' ); // remove tools
		remove_submenu_page( 'themes.php', 'themes.php' ); // hide the theme selection submenu
		remove_submenu_page( 'themes.php', 'widgets.php' ); // hide the widgets submenu
	}
}
add_action( 'admin_menu', 'inaset_remove_admin_menu', 999 ); //remove parts of admin menu



function inaset_manage_roles_caps() {


	$editor = get_role( 'editor' );

	// Give access to the menus
	if (!$editor->has_cap( 'edit_theme_options' ) ) {
		$editor->add_cap( 'edit_theme_options' );
	}

}
add_action( 'admin_init', 'inaset_manage_roles_caps' );



/**
 * Mime types - prevent gif's and some other formats
 */
function inaset_mime_types( $mimes ) {

	unset( $mimes['gif'] );
	unset( $mimes['bmp'] );
	unset( $mimes['tiff|tif'] );
	unset( $mimes['ico'] );

	$mimes['svg'] = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	/*$mimes['epub'] = 'application/octet-stream';*/

	return $mimes;
}
add_filter( 'upload_mimes', 'inaset_mime_types' );


/**
 * Do not allow to reduce quality of jpeg
 * @param $quality
 *
 * @return int
 */
function inaset_set_jpeg_quality( $quality ) {
	return 100;
}
add_filter( 'jpeg_quality', 'inaset_set_jpeg_quality', 10, 1 );

/**
 * Customize the content editor
 */

/**
 * Remove non used headings and formats h2 h3 h4 h5
 *
 * @return mixed
 */
function inaset_remove_style_formats_options( $settings ) {
	$settings['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;';
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'inaset_remove_style_formats_options', 10, 1 );

function inaset_tinymce_buttons( $buttons ) {
	//$mce_buttons = array( 'formatselect', 'bold', 'italic', 'bullist', 'numlist', 'blockquote', 'alignleft', 'aligncenter', 'alignright', 'link', 'unlink', 'wp_more', 'spellchecker' );
	$remove = array( 'blockquote', 'alignleft', 'aligncenter', 'alignright' );
	return array_diff( $buttons, $remove );
}
add_filter( 'mce_buttons', 'inaset_tinymce_buttons' );

function inaset_tinymce_buttons2( $buttons ) {
	//$mce_buttons_2 = array( 'strikethrough', 'hr', 'forecolor', 'pastetext', 'removeformat', 'charmap', 'outdent', 'indent', 'undo', 'redo' );
	$remove = array( 'strikethrough', 'hr', 'forecolor', 'charmap', 'outdent', 'indent' );
	return array_diff( $buttons, $remove );
}
add_filter( 'mce_buttons_2', 'inaset_tinymce_buttons2' );


/**
 * Editor Styles
 */
function inaset_add_editor_styles() {
	add_editor_style( get_template_directory_uri() . '/editor-style.css' );
}
add_action( 'admin_init', 'inaset_add_editor_styles' );