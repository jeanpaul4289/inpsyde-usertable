<?php
/**
 * The class bootstrap file test.
 *
 * @link https://github.com/jeanpaul4289
 * @since 1.0.4
 * @package Inpsyde_UserTable
 * @subpackage Inpsyde_UserTable/tests
 */

/**
 * The test class to test the plugin bootstrap file.
 *
 * @package Inpsyde_UserTable
 * @subpackage Inpsyde_UserTable/tests
 * @author Jean Paul Demorizi <jeanpaul4289@gmail.com>
 */
class Boostrap_File_Test extends WP_UnitTestCase {

	/**
	 * Test basic functions are available.
	 *
	 * @since 1.0.4
	 * @return void
	 */
	public function test_basic_functions_are_available() {
		$this->assertTrue( function_exists( 'run_inpsyde_usertable' ) );
	}
}
