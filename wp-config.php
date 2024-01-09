<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'sql_libofei_com' );

/** Database username */
define( 'DB_USER', 'sql_libofei_com' );

/** Database password */
define( 'DB_PASSWORD', 'd3xRmmfbjdiN6N73' );

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
define( 'AUTH_KEY',         '[1=r5wX.osg8/8%TN k ^|7hQLq-$GZ~r(mm*Dsjns]5)#6HTXG#6x,&R&&SvAw{' );
define( 'SECURE_AUTH_KEY',  'v.RloZL,h@W<k@>{9co+7*V?c;KGs@)BYiWT/,s.SWBuM;QQkmu)GFW0hJj5]Xg~' );
define( 'LOGGED_IN_KEY',    'zxr6E@`.Df%^@HAO(aelM4eAk_*mGyliQYFAWf;93eTC|f.MVB?hc8gl|no(/6HW' );
define( 'NONCE_KEY',        'f8[37LnryF6OQj,Yp4{m8EDhTe#k^gAut,*&&mQYy&!D&&(m_mBAe:K<p.{![-(^' );
define( 'AUTH_SALT',        'gLNOdIr!W.NZh?N3e6kd,T|ImC:`<Rg^cNn8*Ao/?qO1OVe}L9j],B-?PJehM0o+' );
define( 'SECURE_AUTH_SALT', 'MqmQ A3yrCPb,?5Z]JIgl=.$ A^]58E}9b<*f/(G%oE193@j.<+Lmua#1Mrc~ @!' );
define( 'LOGGED_IN_SALT',   ':zUPst&(oX.TlhcBwPA>g6 U,0cV@N`/gXtR/W+=(He9bn[I?s(Ry!MgB,-51Pe`' );
define( 'NONCE_SALT',       'waI,PYv<b8N9Q{35-o)6pp9Snyoq0tdutvZ|`=vf_:],QNs)NP:9$Pe[aII0{4|C' );



/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
// define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */

/**
 * Debug Swith
 */

// Enable WP_DEBUG mode
define( 'WP_DEBUG', true );

// Enable Debug logging to the /wp-content/debug.log file
define( 'WP_DEBUG_LOG', true );

// Disable display of errors and warnings
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 0 );

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define( 'SCRIPT_DEBUG', true );

// define( 'DISALLOW_FILE_EDIT', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
