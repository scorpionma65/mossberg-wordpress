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

/** WP super Cache **/
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/data/mossberg/public_html/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'mossberg_wp00');

/** MySQL database username */
define('DB_USER', 'admin');

/** MySQL database password */
define('DB_PASSWORD', 'MyiRu@pure');

/** MySQL hostname */
define('DB_HOST', 'DBMM');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'O|(f<EEnF$uKn%3e+s+`F-jUL@R#yLbPz`T`X2x*mOS%`c}j=^Z6S]F+j#I)mt5&');
define('SECURE_AUTH_KEY',  ';Py(^<Rtvo8UtF$H++dlS2x;lt9<tLy&yPMQjBl:d)6{XA+mEx-dF<|YeS5<9N<F');
define('LOGGED_IN_KEY',    'YKM!c(%$=kNc[iQX:CxixrYS{Z10X#h9moW_+B:AkW^%aL:y-D;@c~>-1bpA~2Nr');
define('NONCE_KEY',        '^|G#.@kU{(M!M^rKP7(,JUTm^vtn)jBr=$]G`HJlL|*gCeF!mL_+A~R (uf8ris&');
define('AUTH_SALT',        '-KpK^e`N-:/}LX}Ue=+R4(+|VcIC-:nA=JI#~=.9hM+]6Iz!%geT v+`5aXgLgz+');
define('SECURE_AUTH_SALT', 'qX53n$|nPf$irVq7ycCFyaO}beS*T;qVQ4Qr.Ut*>CYowR[$+rm<*{YPb_Un-Lv@');
define('LOGGED_IN_SALT',   'y1bZc&+eT/;bCg}*{b;)D{e|)=7Tza9#:Rh&;V2hkfh8zm+UH/>|Muo%In[NTGu[');
define('NONCE_SALT',       '=D4^bao>6hTL/Qnx)mP$[hLb|UF yA|k],kg2p?tT67pw52O|1 ;LNhjjMC[kBY!');

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

/* MIME Filter */
define( 'ALLOW_UNFILTERED_UPLOADS', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
