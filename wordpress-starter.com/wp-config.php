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
define( 'DB_NAME', 'wpstarter' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'N6L`|GC):A[^)P6k4VB3TH$1iGPyv>EB915/{(^c#n!$uri3*N1Gv=_}=_Mxkvi1' );
define( 'SECURE_AUTH_KEY',   '|KySIH|TD![/tWY5^]jm[ap/Q$qoj`CMVi-HN.;+]XhnL3zu{TSMiH*8UYSwwi[[' );
define( 'LOGGED_IN_KEY',     'Pl~(s$]hmLrD`w[s|l~9$_R>Qx&A!,XyDW~pSt[QiM(o)d#Q?ZTWGcLW./fvMih:' );
define( 'NONCE_KEY',         ',4M0MZ,+cG&1rHB&HD.q/{:pg[Ej)t/*1-BacX<r.9yYofvyeDKG*M8OxwK[NE9b' );
define( 'AUTH_SALT',         '<f<:=M(<&eQhC5> vq, GhtN*Y;ow)UUO^4]%mr4XCdyq9W[a7fa{v5RmQzl`*E6' );
define( 'SECURE_AUTH_SALT',  '*439W>)^=pxE(`k)Im*PM |xY[uSfgh9V->^*?cS9#}bZA<F$$Z3xj2wj#-<:E(q' );
define( 'LOGGED_IN_SALT',    '(k?BF$_R+;:|*5kI{u]q/U^Az<O?fV-{g-0;#VzNb`!<P6SU,sktT[c8}R+]Sc1_' );
define( 'NONCE_SALT',        'y.;7a{oE?uqAYdgE tE&U$S74?1Quo&`ELLv5&-O%`NT$Z+rP!9gPs C)bx1M)_h' );
define( 'WP_CACHE_KEY_SALT', '/vP/OIShvWW!;m$[8-Z#Blr*-%h}5)PN0OWVXb0C=oiACQI;iNAtP}9)Lw6;Smx?' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

/** Enable WP_DEBUG */
define( 'WP_DEBUG', true );

/** Enable Theme Check */
define( 'TC_POST', 'Feel free to make use of the contact details below if you have any questions,
comments, or feedback:[[br]]
[[br]]
* Leave a comment on this ticket[[br]]
* Send an email to the Theme Review email list[[br]]
* Use the #wordpress-themes IRC channel on Freenode.' );

