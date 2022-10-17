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
define( 'DB_NAME', 'game' );

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
define( 'AUTH_KEY',         '|1AX?t9!]OyK.i;BLcml)ng$;zcNJQgnC2i#a_mXV=asy4mhMd.`?4Szl%1z<aHO' );
define( 'SECURE_AUTH_KEY',  'N($f3&bH1GaYk@5seLw3mw{4R%AT<a# r>>J0uZ6$yeLC>|e=5MUwbmt{&<ph.%Q' );
define( 'LOGGED_IN_KEY',    'gYM?p5Nm6y)DM1gsM@lSBLRxdUU7EcQRaXc$RR6!ML!!TrwW:F[R1ZnZB}E-t575' );
define( 'NONCE_KEY',        'c+hNLdP=?hB&]mf=*;_y.B ngr4D31}`2I2WrdT%G3{sOmaT3Y)oUvwE_]ipi}t~' );
define( 'AUTH_SALT',        'EoZ04*DL++_0 ?lw|!&s%RSX{j8 L F5Kb-E[(d@hu:XQb1N?1E]G{4{l77p:78:' );
define( 'SECURE_AUTH_SALT', 'S=h^RzFgBvG+Ly/I^$`K#W3mi>bd<7REdP&nF=M&cgrkTU+){},x3&;t~Tw6J]9y' );
define( 'LOGGED_IN_SALT',   '0V#c/KLD:FsW%BuX!q%EwqXn:cEpDK!L1$?aGi+wqK^&a[hd:_$Me;`7_yMZEWH:' );
define( 'NONCE_SALT',       'CNage0;Km.n{U;{7z=Q7@B[aFn;j+/_fK,KXInBV*LE~^)pvO:5_.-N/f:7]6wVX' );

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
