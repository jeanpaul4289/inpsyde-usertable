<?php
/**
 * Class Inpsyde_UserTable_Public_Test
 *
 * @link https://github.com/jeanpaul4289
 * @since 1.0.4
 * @package Inpsyde_UserTable
 * @subpackage Inpsyde_UserTable/tests
 */

/**
 * The test class for the class Inpsyde_UserTable_Public.
 *
 * @package Inpsyde_UserTable
 * @subpackage Inpsyde_UserTable/tests
 * @author Jean Paul Demorizi <jeanpaul4289@gmail.com>
 */
class Inpsyde_UserTable_Public_Test extends WP_UnitTestCase {

	/**
	 * Testing the frontend styles for the plugin were enqueued.
	 *
	 * @since 1.0.4
	 * @return void
	 */
	public function test_enqueue_styles() {
		$class_instance  = new Inpsyde_UserTable();
		$public_instance = new Inpsyde_UserTable_Public( $class_instance->get_plugin_name(), $class_instance->get_version(), $class_instance->get_users_url() );
		$public_instance->enqueue_styles();
		global $wp_styles;
		$this->assertEquals( in_array( 'jquery_datatable_style', $wp_styles->queue, true ), 1 );
		$this->assertEquals( in_array( 'bootstrap_datatable_style', $wp_styles->queue, true ), 1 );
		$this->assertEquals( in_array( 'custom_usertable_style', $wp_styles->queue, true ), 1 );
		$this->assertEquals( in_array( 'jquery_style', $wp_styles->queue, true ), 1 );
	}

	/**
	 * Testing the frontend scripts for the plugin were enqueued.
	 *
	 * @since 1.0.4
	 * @return void
	 */
	public function test_enqueue_scripts() {
		$class_instance  = new Inpsyde_UserTable();
		$public_instance = new Inpsyde_UserTable_Public( $class_instance->get_plugin_name(), $class_instance->get_version(), $class_instance->get_users_url() );
		$public_instance->enqueue_scripts();
		global $wp_scripts;
		$this->assertEquals( in_array( 'jquery_script', $wp_scripts->queue, true ), 1 );
		$this->assertEquals( in_array( 'jquery_datatable_script', $wp_scripts->queue, true ), 1 );
		$this->assertEquals( in_array( 'custom_usertable_script', $wp_scripts->queue, true ), 1 );
		$this->assertEquals( in_array( 'jquery_ui_script', $wp_scripts->queue, true ), 1 );
	}
}
