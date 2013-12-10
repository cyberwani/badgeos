<?php
/**
 * BadgeOS Unit Test Installer
 *
 * @package BadgeOS
 * @subpackage Tests
 * @author Credly, LLC
 * @license http://www.gnu.org/licenses/agpl.txt GNU AGPL v3.0
 * @link https://credly.com
 */

error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT );

echo "Welcome to the BadgeOS Suite" . PHP_EOL;
echo "Version: 1.0" . PHP_EOL;
echo "Authors: Brian Richards" . PHP_EOL;

$config_file_path = $argv[1];
$multisite = ! empty( $argv[2] );

require_once $config_file_path;
require_once dirname( $config_file_path ) . '/includes/functions.php';

// Force WP_ADMIN to be true
define( 'WP_ADMIN', true );

// Load BadgeOS
function _load_badgeos() {
	require dirname( dirname( dirname( __FILE__ ) ) ) . '/badgeos.php';
}
tests_add_filter( 'muplugins_loaded', '_load_badgeos' );

// Always load admin bar
tests_add_filter( 'show_admin_bar', '__return_true' );

$_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.1';
$_SERVER['HTTP_HOST'] = WP_TESTS_DOMAIN;
$PHP_SELF = $GLOBALS['PHP_SELF'] = $_SERVER['PHP_SELF'] = '/index.php';

require_once ABSPATH . '/wp-settings.php';

global $current_user;
$current_user = new WP_User(1);
$current_user->set_role('administrator');
