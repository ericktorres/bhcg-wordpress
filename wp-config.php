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
define('DB_NAME', 'pixelar2_bhcg');

/** MySQL database username */
define('DB_USER', 'pixelar2_bhcg');

/** MySQL database password */
define('DB_PASSWORD', 'Co(1(Sgp99');

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
define('AUTH_KEY',         '6w9vgjbfe7fotqk3snbr5eztyr52h64zxn8crzve5sawu5rawukumhqdxzcxbzw9');
define('SECURE_AUTH_KEY',  'inycfgbo5eqbd52kshc3macnufgqkuag3tblk9qwftsxbieqezhlpqhfmq3rzxn7');
define('LOGGED_IN_KEY',    '88chgm9pqbiclocdtzkayt94nuu3o5v7m2pnrbsqru7scpyeohsisni6esvldvsx');
define('NONCE_KEY',        'w0bmtpcl8fiaxpnxgegm3ph6wlulwjsyeemvwjocieo88imjmhqsxnupmkyznhhc');
define('AUTH_SALT',        'ftxpfdkheehsn9rrit94ikbstsg007wz7sh39ecuflgp1fbmigmde06qdziv0vc2');
define('SECURE_AUTH_SALT', 'r7owkytbyrwdsbkapmz4puz6i8c3irdtd4a5gmy4t0y8awkmqf6bn2m1hw9iwu8p');
define('LOGGED_IN_SALT',   '2udo6acy8tgfytpv0dskovsowigabpkix0czz9gd5eeadesskmoxudtnnrooclvu');
define('NONCE_SALT',       'joedb6xuv8o1wqujurtwrlxbcqxl5fzwoolourkbcuktbzwup0c7d4v6snzgguqj');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpvi_';

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
define( 'WP_MEMORY_LIMIT', '128M' );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

# Disables all core updates. Added by SiteGround Autoupdate:
define( 'WP_AUTO_UPDATE_CORE', false );
