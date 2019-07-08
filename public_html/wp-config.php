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
define( 'DB_NAME', 'amazingcollege' );

/** MySQL database username */
define( 'DB_USER', 'homestead' );

/** MySQL database password */
define( 'DB_PASSWORD', 'secret' );

/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1:3306' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'WS$*Z@rRwO5g1^P?xX_](o`M*<6{tgq^EB8PNhW>x;=O)`&;=d(Z`B^@xIlB8W~x' );
define( 'SECURE_AUTH_KEY',  'Cg8TtRyO)1@&X1[Okr%^@aTmc`H+Iz9T~+DL3m5Ot+T}.]Z~0rzPLDP:!7!fSUw3' );
define( 'LOGGED_IN_KEY',    'BlYfN*03Odh%NW90i>AX9enW03IOU~xX7sxuez@)p[uv[Q7-@y_SiS?,k$[`iO8g' );
define( 'NONCE_KEY',        'piD8[Q0 bIfGH&e$|w`{r}i<g8S,OIFe2AqVxu-cAN)r3Oi%:cwEVMRFc!C7@S2&' );
define( 'AUTH_SALT',        'eO}kPikUe[JW`a~1z|8h1zf+`OQKSOJ*Gp@0/KbP dYbTN=-#s#,GXu&m}mzFX0q' );
define( 'SECURE_AUTH_SALT', 'K6mBYk>7YB4eoV*0bG[|?gQEO1mXhZ3kGr)&Ipeo@&M|TmR&ul_(on$hS]rTJjCH' );
define( 'LOGGED_IN_SALT',   '4#j*r^S>dKXaaN~|T--2{]A_P9!:G+Kpc,>)[i$m@+<*A;{iBxx18zNL0Wx_G<{>' );
define( 'NONCE_SALT',       '28PVqLc%-vRssk1TK!25($l?GBe7Hk3]q0QQeZ^Y4(mb6+XO?9)GaE1LED)X:i $' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
