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
define('DB_NAME', 'learnwp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'W&Z5(RA~-)r?uId8:sAOysRLI9Xp$MXHF*d4!`b>FN]G6Z%s0,):><=;j[!2!h~7');
define('SECURE_AUTH_KEY',  'mO*-XNS]{A;srS>7mS>pl95`v>ksQ$~Q(v!i8kGb&!6GyrvLpb@Hb;YhU2tV|[~G');
define('LOGGED_IN_KEY',    'L) ).8xT:nVay6VN]G>PfZN6=fMh@>,O7g64{N/kPG.Rk!{]DYAV9CJ=RKm`B#tO');
define('NONCE_KEY',        'vKk1E8o5-s[C/&IGNLASJOp6a%a&xT$/#9_/E`sL<a$R?x4).%J=EOv<nFP<E?74');
define('AUTH_SALT',        '>gifIT6=eft4RuA;Oo<CT@TXy hn.JRLp[U1.ZxMZ(9msg0f%Z-qrk[`)6TP%bHh');
define('SECURE_AUTH_SALT', 'Sav?7$M[f{b+3lUu<o7if1e!D_lJpw-c:cRS$R?$_iiIa5OOKwhAA6|$||A|&->&');
define('LOGGED_IN_SALT',   'MN=fwwD%sd,U@Z7L[WA6ayC}>v jF&!<7%>EE.LpDk9Bzs 8CL~Wh$wGuuz7xrkq');
define('NONCE_SALT',       'Nj(L)qNrH:{!6NCo}QH+W%z{AZG,aVxx^czET*wtw8t!#?9}SRnclF1H&2wE>|}t');

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
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true);
define('SCRIPT_DEBUG', true);
define( 'SAVEQUERIES', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
