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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'C-mC[IhpY~#xHpb}}=/e`iN;.?9V!39*]S)!d,$8zMrU/RrDDcYZsX6Dz$wB&^xW' );
define( 'SECURE_AUTH_KEY',   '}SKjHvX8mT <5xr6=S<dvifQ<{e^F}I-JGfJ+qh3)os,pee8]DkB[`+bwO*{Ry2c' );
define( 'LOGGED_IN_KEY',     'upjZED;8cTu`r|NX#yu4@SM)k4n i|8}sh/R2R5D(8C#LX#F?6l}FjKFU,.,13d)' );
define( 'NONCE_KEY',         'l>M20!E!|G,.S,Ry2s6q%0{nR3-)vt*;%YUrU$=M/7XXi3lAlMIHYaSY39uvBun&' );
define( 'AUTH_SALT',         '-yh![jB`J[(X9LwoE/r 5J^l|al]/Cib)V7|rT6GQ@n,$Q<tg:G}&y=&oit#TWRd' );
define( 'SECURE_AUTH_SALT',  'r!mXf+YUptSB{e7XtFtW,A@[%5we<[B.Q{h936O,A%{FhlFj=_HP&#REX6(YCdNP' );
define( 'LOGGED_IN_SALT',    'UTK9ilA~s]~Sl-KQvi0a4DE-w6-DnL1[3m:0<za)]BNA@Nh?doE7vJoy>J=pbCMQ' );
define( 'NONCE_SALT',        'PIfdaULqR@!8M%~-!_M*AtIRg*YO/[>qABM@2E[TX_yE11y}j}cB@T^BSm,HJ<K<' );
define( 'WP_CACHE_KEY_SALT', 'Od{s5nDi5}_mu,oU(AueO)I&>>|fz,X]A08U|qi>MZrkK[k+O(^k7B]4QVL$XNE9' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
