<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'inaset-paper');

/** MySQL database username */
define('DB_USER', 'inaset-paper');

/** MySQL database password */
define('DB_PASSWORD', 'inasetStep2017');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'nk^qUV6GG)fS6^ K`HfO]FUTS#BL(MGu)aE71b;Q*]s)X1cV`xpE<}U `1gR.:S$');
define('SECURE_AUTH_KEY',  'Si,SH,r82<#(,tL>ZZ-=V4Y5i8y8%|!O:*co|;v-]=?LWITTW`&,LJWa@o,zeL?n');
define('LOGGED_IN_KEY',    'NRtP#QcL|Y33/}F)F>=t_c@Qa,@%`.TBo8b~x!zs#pKXpBp7rRL.!ctaVDmFaYi8');
define('NONCE_KEY',        ';SG}3S^dyr,^@Jx~^/c8`2iO7w 66TJ^O ~]36,cu9Qe)+q&?n_qX,K~UtiQNiaw');
define('AUTH_SALT',        'r;?O{>xakeDNyX8`>rJN0QFVCQl9G7ec3&{JG.]0Eb)TMe)O>P*vs..MM_r,,9tL');
define('SECURE_AUTH_SALT', ',dZ,kdoOW3Okcz:g:B!2|T<*yq:.ifr]=oBo.zGc}aoZqZK%&C^`KDOw&oM.1)5P');
define('LOGGED_IN_SALT',   'sNd#8N-/VWZ(|?MP7Vk:gUf!|oB:[#al]@npQ5MHE#!]l<XC;FVX#tIi;dpwzXUz');
define('NONCE_SALT',       'C6Z*9VUw`5(tn;[05R AOCZ7nuUn&KLxe#`Y2u 3yDSd UU/0T;BK68VgqpE.K<;');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
