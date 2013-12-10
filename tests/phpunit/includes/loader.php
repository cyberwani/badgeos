<?php
/**
 * BadgeOS Unit Test Loader
 *
 * @package BadgeOS
 * @subpackage Tests
 * @author Credly, LLC
 * @license http://www.gnu.org/licenses/agpl.txt GNU AGPL v3.0
 * @link https://credly.com
 */

// Install BadgeOS
$config_file_path = dirname( __FILE__ ) . '/../../tmp/wordpress-tests/wp-tests-config.php';
$multisite = (int) ( defined( 'WP_TESTS_MULTISITE') && WP_TESTS_MULTISITE );
system( WP_PHP_BINARY . ' ' . escapeshellarg( dirname( __FILE__ ) . '/install.php' ) . ' ' . escapeshellarg( $config_file_path ) . ' ' . $multisite );

// Bootstrap BadgeOS
require dirname( __FILE__ ) . '/../../../badgeos.php';
