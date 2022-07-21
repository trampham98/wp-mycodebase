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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'loca_mywordpress' );

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
define( 'AUTH_KEY',         'CZi 3$$[|.7qJ{zign[ FMZ}0H #2?_7L1lUVC-m:eMyM7`{,fq&KMAcmJVrK%w(' );
define( 'SECURE_AUTH_KEY',  'KqkvQ|Jmz&leg0t{[}KIz0naaN<~5V,nKnGf] {JGb!FPYRxIo3`%(H}j{R8Mnx2' );
define( 'LOGGED_IN_KEY',    'jr:aZmFec WJ:[R.Ym(;HwRnt3 Gi8P[^[`@/bd]})T%P[FV,ZR]o(VJ:pGRNR^s' );
define( 'NONCE_KEY',        '(FAf,zU_#;+MY<Om?1VRu{6_nlA.DYJUw5Q[FcJrJk_}4r>qW~+RkF.z#,9QRlv ' );
define( 'AUTH_SALT',        'lio7$C?ewWy1hED(pOp[D)o$>qUGa.KbhjP@R%$.gXPTsvdc5v7yMt5xiE(.jKpp' );
define( 'SECURE_AUTH_SALT', '_z?ka7O$y k?attq.!W[dxzueY!r7&a(nE )Omh^U|u,^`-z=m0.=fLW?>Zst`jp' );
define( 'LOGGED_IN_SALT',   'bC&5HUIKN7|ion>OohH1i%1L=N!D{w+](}URYd6|h@)+;&?=[oy 2eg^K6(4E==%' );
define( 'NONCE_SALT',       '=3S;y&FO6Yp8y1Knb8!Aoxq3H:pT##b;^t*3WwPC!zM:[yxF~z>MIEZw!`/075ks' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
