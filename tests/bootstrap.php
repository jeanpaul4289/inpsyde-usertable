<?php
/**
 * PHPUnit bootstrap file
 *
 * @link https://github.com/jeanpaul4289
 * @since 1.0.4
 * @package Inpsyde_UserTable
 * @subpackage Inpsyde_UserTable/tests
 */

/**
 * The bootstrap file for the PHPUNIT.
 *
 * @package Inpsyde_UserTable
 * @subpackage Inpsyde_UserTable/tests
 * @author Jean Paul Demorizi <jeanpaul4289@gmail.com>
 */
require_once 'wordpress-tests-lib/includes/functions.php';

/**
 * Manually load the plugin being tested.
 */
function _manually_load_plugin() {
	require dirname( dirname( __FILE__ ) ) . '/inpsyde-usertable.php';
}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

// Start up the WP testing environment.
require 'wordpress-tests-lib/includes/bootstrap.php';
