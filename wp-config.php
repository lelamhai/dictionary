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
define('FS_METHOD','direct');
// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'dictionary' );

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
define( 'AUTH_KEY',         '/^~:?f$0@@>M=R<i2L1}+H{`a%ct+K(|;?ffy8!as<jy9X.3HI,q71tIYZB0<6^>' );
define( 'SECURE_AUTH_KEY',  'H`Fmtq-? /9haV9{N>E;VrtF;WMcl89{. H9Z9SWz3ZO=]xpBW%?eWXOMfvBLiEO' );
define( 'LOGGED_IN_KEY',    'wJ)[+&*vaCD%#.I6{;ftPldJ=[4FpM2<h:ysr@I<=q]:<#Yb!IL2it/J,V|g[(;M' );
define( 'NONCE_KEY',        '|M,V=lFtTcg:4mVjCLSiR5m7^<>>{n19KtA(Kdj}jBdA>x+cBiQghhm]FhbJp|Fz' );
define( 'AUTH_SALT',        '`YglCuCC8m)/UWI0Z[|:Zw7;u^^wPBWh(2bcto$U[^g21rCs*DpZ`}(n^%^4fvgz' );
define( 'SECURE_AUTH_SALT', '#@:~6.=>XT.S)L35~rDDeMNn3s&M:EPKjl=#nMJKy__3>r!eYJ8ozn-r neTwB]|' );
define( 'LOGGED_IN_SALT',   '.b+eE(NaN)KI1%cbK=;<a<d=Z!cK_R=C7{ba.iU=F]CXvV`ib/>yX;#q6[!6{)k%' );
define( 'NONCE_SALT',       '/9(-3KIAT@5G^#4J=#BEHn[7 IQp,]CMN2gEao0n@ h[Lh;#`C*QxpfQ^`c`TKoc' );

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
