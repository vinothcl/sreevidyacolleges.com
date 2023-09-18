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
define('DB_NAME', 'vivaabku_sreevidyacolleges');

/** MySQL database username */
define('DB_USER', 'vivaabku_sreevidyacolleges');

/** MySQL database password */
define('DB_PASSWORD', 'sreevidyacolleges');

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
define('AUTH_KEY',         '!J1Fy;6O@ls8MuR~v2-R$pQww>QAPd+2(`|)M^5J;kEj/PC]2,*;9:=iVY%=#b3Q');
define('SECURE_AUTH_KEY',  'wd4 Dg(E,i(wK}S^?DXlV0&e^7g}oow )52^IZ69LRDwj*G<T)d G`Ryfa=Bje# ');
define('LOGGED_IN_KEY',    'KXW=;1f_/r@`$jjY?>ew;Kq{RZbE(h$T_2bL^&oFFcX> 0cJ{vGqEj4d|8}Ea0X,');
define('NONCE_KEY',        'F9@Tx +L4n>Y~7V6a}[]=`i68h-VNKPr!Lc*/Dvp=c&1&X`^3dv&Q4-$^sZJ8km{');
define('AUTH_SALT',        '.sUajSh:h3%NeJ8_UQ|M1=i6_Ei~fqu[6!V<*6[6 ImuWrCVtzWhJa;?od(z=H}-');
define('SECURE_AUTH_SALT', ';K/2a#DO7VKbAu<+R|N[`C3wGZ)NQ$?eJOa_YupoA8/cB@E%fP!)>5|;v/11bWz3');
define('LOGGED_IN_SALT',   'XY0}&U#vIv[H&uxotpXtGtItkIn2iepjn]?gZW56y[i~.7Z-#aDO YvxSPU{O$*J');
define('NONCE_SALT',       'I+L+:5R:F$:Fe[i+6;)!)%t.fVo-|,Oq#Mye>#i!aC$p>Z0G{$1~S=Jw{I%zz7!!');

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
