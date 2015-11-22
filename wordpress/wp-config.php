<?php
/**
* The base configurations of the WordPress.
*
* This file has the following configurations: MySQL settings, Table Prefix,
* Secret Keys, WordPress Language, and ABSPATH. You can find more information
* by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
* wp-config.php} Codex page. You can get the MySQL settings from your web host.
*
* This file is used by the wp-config.php creation script during the
* installation. You don't have to use the web site, you can just copy this file
* to "wp-config.php" and fill in the values.
*
* @package WordPress
*/

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wdsc015_dev');

/** MySQL database username */
define('DB_USER', 'labfellows');

/** MySQL database password */
define('DB_PASSWORD', 'w2EIN1Vl99nd');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'E_pb<%Z)l,F3oS[XfP9zd2>P=p5{AJ4Cp_M6%@3))k8Y|kf<rB`j~F0(~~OE6[>w');

define('SECURE_AUTH_KEY',  '+t|:^)E]YO2F4`szI/`G5l#Ir`TSueMX>(.|#4iCj0c{@,3A;UVp>ju,~-Ys5UBA');

define('LOGGED_IN_KEY',    '1/6=(>X)NcGkgvdFZSj Oc^8eI>3TZ#gv;euuX%FCeIwn#-DM+~LlH%X+&cN@vCY');

define('NONCE_KEY',        'HM)os/5sG:UMrl-fSO^VFv<0f+Ar2*8X7aMm+^b#?pt%ai~XTt%$y/VWYTfK.V|>');

define('AUTH_SALT',        'e}SN-wlN)M<E|0t0-Jp48j#u#6tL1S-&uO;VY|b]+[*f||tpzX#{c_icCs& YkN5');

define('SECURE_AUTH_SALT', '/>fA{yU6C5+);T+]8(<GMxww+P}IyZBgAB)ms`Z:&|+`P2[(^g0DN@[ZS6Fh^ZE2');

define('LOGGED_IN_SALT',   '.0Pq^>#&k>y+t+3=F. WZxN$fj+&i03WsE>@*YzvNa_1#Ep(OJ=|QkLrNu[N,;Sx');

define('NONCE_SALT',       'j~=)=z x>D%y3&[J,XUT-P8A-[P*:4zk|DT96;jE-*c,z^qktm^b=XJ-. &<yfB3');

/**#@-*/

/**
* WordPress Database Table prefix.
*
* You can have multiple installations in one database if you give each a unique
* prefix. Only numbers, letters, and underscores please!
*/
$table_prefix  = 'wp_';

/**
* WordPress Localized Language, defaults to English.
*
* Change this to localize WordPress. A corresponding MO file for the chosen
* language must be installed to wp-content/languages. For example, install
* de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
* language support.
*/
define('WPLANG', '');

/**
* For developers: WordPress debugging mode.
*
* Change this to true to enable the display of notices during development.
* It is strongly recommended that plugin and theme developers use WP_DEBUG
* in their development environments.
*/
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

# Enable direct filesystem access
define( 'FS_METHOD', 'direct' );
