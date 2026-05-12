<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db_wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '+}[Ii=Pud!!#{l6?:<JVD9!HmQgC}!e|vmGZ(K5x}wn!D}22Pux(v.Pkn/KZ[&*B' );
define( 'SECURE_AUTH_KEY',  '#OggL;oc3k^mkw>+/RfZ~>g;t*JX?>80FH2rpLHmEA{pca4&u//C+z7Tee{y(3lk' );
define( 'LOGGED_IN_KEY',    'eU2mhRW#X0fjI.Fe#K9;>%%eJJbe$Hc+vQwSU7,5IptL*(:r@EGJc:M|Alvk uGe' );
define( 'NONCE_KEY',        'xqaFMrDBdIh2_DF+]RF^aDc2qwK|*K6M?.Rayx@`w@FULBXz^c Z1OZQkhUOr_tc' );
define( 'AUTH_SALT',        'X >CQh;SLsg<Y eQ1nY+p-(VE$[XB]:<.ybH@RK+8Dj@p03{wR7|7Bm-^W#-?m}&' );
define( 'SECURE_AUTH_SALT', '.o,ShL}tw443@a]Vymy5S{(GJ!RSvI|9.8n3>DZ#Gi,c}geh.an!{/C<cCt.D=&7' );
define( 'LOGGED_IN_SALT',   'js<<8k ~A@)[w63Rc9p+mfb]:Hl(GuQx;xwB-)E$6D$oRe9$YgxlNHX.l@1&&s:U' );
define( 'NONCE_SALT',       'wj@~*MRs:5*IfiUL&|cm5 b^dszvj{-;d?~HAnwNB:$:+_}d O=2BYBSt.J]AY=_' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
