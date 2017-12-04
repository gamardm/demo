<?php
/**
 * Theme INASET paper © 2017
 *
 * @author: GOMOCRIATIVO,LDA https://gomo.pt
 *
 * General functions file - It all starts here!
 */


// theme setup
require_once( get_template_directory() . '/inc/theme-setup.php' );

// Rest API mods
require_once( get_template_directory()  . '/inc/theme-rest-api.php' );

// Email out related functions
require_once( get_template_directory()  . '/inc/theme-mail.php' );

// Theme Navigation functions
require_once( get_template_directory()  . '/inc/theme-navigation.php' );

// Admin functions
require_once( get_template_directory()  . '/inc/theme-admin.php' );
require_once( get_template_directory()  . '/inc/theme-admin-options.php' );

// general hooks
require_once( get_template_directory()  . '/inc/theme-hooks.php' );

// template tags and extras functions
require_once( get_template_directory()  . '/inc/theme-template-tags.php' );

// Shortcake (Shortcode UI) Mods & functions
require_once( get_template_directory()  . '/inc/mods-shortcake.php' );
require_once( get_template_directory() . '/inc/mods-polylang.php' );