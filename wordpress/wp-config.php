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
define( 'DB_NAME', 'mysite_web' );

/** Database username */
define( 'DB_USER', 'tpss' );

/** Database password */
define( 'DB_PASSWORD', '1' );

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
define( 'AUTH_KEY',         'hi{R<iJVy,Z7*?_ht>bpvj7VBKY^be#NNBL*f0+:h}0G9Q4+>@4u1o9+t+:(I1e+' );
define( 'SECURE_AUTH_KEY',  '{0n>e4vVpLH0&?qf1_(FL;kFriG;S.7Y#UWOc]:H*8Jh;ZK6,pi9oXUwxyf[0Vxj' );
define( 'LOGGED_IN_KEY',    'llTUwxvGX=S]-`)`j]Pfo=cV-Vg/#BR>}CEz7c`tc:G+l5dI/uZXaIgI1_D+EB2L' );
define( 'NONCE_KEY',        '(6.^TWgBc~[G17KZH;_7,0J|lZ:^tiBiisXhi]n7:DeUycwd2Ke;};08(w+-g R^' );
define( 'AUTH_SALT',        'd{->7Ntaa!n?B==vNW1[K:SU>+PdnV&zknD(O[rqE?S$g(BKU!ZQ^Lp5VkHmcO3:' );
define( 'SECURE_AUTH_SALT', '24r{S+cOn|g)FiwD6dfSxKCaI>[`,V4/Yzo!4EW;95T%=G|Byd:-ndwjb&0 CG:I' );
define( 'LOGGED_IN_SALT',   '!#KW1!|;=nz-ll/a^(]cM.?74Jp690kdziKa2^B+l?rbb]BXKi:.F!t?w}>Zr2+0' );
define( 'NONCE_SALT',       '4^M4Zls(>jSQ}6!U!1X=iv2m,M8j*G#02kN!X#Mn&3^CECPUJKn[fOCHjd*!thc~' );

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
