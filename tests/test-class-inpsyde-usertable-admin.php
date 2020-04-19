<?php
/**
 * Class Inpsyde_UserTable_Admin_Test
 *
 * @link https://github.com/jeanpaul4289
 * @since 1.0.4
 * @package Inpsyde_UserTable
 * @subpackage Inpsyde_UserTable/tests
 */

/**
 * The test class for the class Inpsyde_UserTable_Admin.
 *
 * @package Inpsyde_UserTable
 * @subpackage Inpsyde_UserTable/tests
 * @author Jean Paul Demorizi <jeanpaul4289@gmail.com>
 */
class Inpsyde_UserTable_Admin_Test extends WP_UnitTestCase {

	/**
	 * Testing the inputs are sanatized properly in the admin panel.
	 *
	 * @since 1.0.4
	 * @return void
	 */
	public function test_sanitize() {
		$class_instance = new Inpsyde_UserTable();
		$admin_instance = new Inpsyde_UserTable_Admin( $class_instance->get_plugin_name(), $class_instance->get_version() );

		$original_input = array( 'ce' => 'testing' );
		$wrong_input    = array( 'ce' => 'te"st/ing' );
		$this->assertEquals( $original_input, $admin_instance->sanitize( $original_input ) );
		$this->assertEquals( $original_input, $admin_instance->sanitize( $wrong_input ) );
	}

}
