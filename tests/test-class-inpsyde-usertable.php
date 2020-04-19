<?php
/**
 * Class Inpsyde_UserTable_Test
 *
 * @link https://github.com/jeanpaul4289
 * @since 1.0.4
 * @package Inpsyde_UserTable
 * @subpackage Inpsyde_UserTable/tests
 */

/**
 * The test class for the class Inpsyde_UserTable.
 *
 * @package Inpsyde_UserTable
 * @subpackage Inpsyde_UserTable/tests
 * @author Jean Paul Demorizi <jeanpaul4289@gmail.com>
 */
class Inpsyde_UserTable_Test extends WP_UnitTestCase {

	/**
	 * Testing the proper instance is being used.
	 *
	 * @since 1.0.4
	 * @return void
	 */
	public function test_instanceOf() {
		$class_instance = new Inpsyde_UserTable();
		$this->assertInstanceOf( 'Inpsyde_UserTable', $class_instance );
	}

	/**
	 * Test the admin hooks were defined.
	 *
	 * @since 1.0.4
	 * @return void
	 */
	public function test_define_admin_hooks() {
		$class_instance = new Inpsyde_UserTable();
		$class_instance->run();
		$admin_instance = $class_instance->get_admin_instance();
		$this->assertEquals( 10, has_action( 'admin_menu', [ $admin_instance, 'add_menu' ] ) );
		$this->assertEquals( 10, has_action( 'admin_init', [ $admin_instance, 'register_fields' ] ) );
		$this->assertEquals( 10, has_action( 'admin_init', [ $admin_instance, 'register_sections' ] ) );
		$this->assertEquals( 10, has_action( 'admin_init', [ $admin_instance, 'register_settings' ] ) );
	}

	/**
	 * Test the public hooks were defined.
	 *
	 * @since 1.0.4
	 * @return void
	 */
	public function test_define_public_hooks() {
		$class_instance = new Inpsyde_UserTable();
		$class_instance->run();
		$public_instance = $class_instance->get_public_instance();
		$this->assertEquals( 19, has_action( 'wp_enqueue_scripts', [ $public_instance, 'remove_enqueued_scripts_styles' ] ) );
		$this->assertEquals( 20, has_action( 'wp_enqueue_scripts', [ $public_instance, 'enqueue_styles' ] ) );
		$this->assertEquals( 20, has_action( 'wp_enqueue_scripts', [ $public_instance, 'enqueue_scripts' ] ) );
		$this->assertEquals( 10, has_action( 'wp_ajax_get_users', [ $public_instance, 'get_users' ] ) );
		$this->assertEquals( 10, has_action( 'wp_ajax_nopriv_get_users', [ $public_instance, 'get_users' ] ) );
		$this->assertEquals( 10, has_action( 'wp_ajax_get_user', [ $public_instance, 'get_user' ] ) );
		$this->assertEquals( 10, has_action( 'wp_ajax_nopriv_get_user', [ $public_instance, 'get_user' ] ) );
		$this->assertEquals( 10, has_action( 'template_include', [ $public_instance, 'render_user_table' ] ) );
	}

	/**
	 * Testing the plugin has the proper name.
	 *
	 * @since 1.0.4
	 * @return void
	 */
	public function test_get_plugin_name() {
		$class_instance = new Inpsyde_UserTable();
		$this->assertEquals( 'inpsyde-usertable', $class_instance->get_plugin_name() );

	}

	/**
	 *  Testing the plugin has the proper version.
	 *
	 * @since 1.0.4
	 * @return void
	 */
	public function test_get_plugin_version() {
		$class_instance = new Inpsyde_UserTable();
		$this->assertEquals( '1.0.6', $class_instance->get_version() );
	}

	/**
	 *  Testing the plugin is using the proper endpoint.
	 *
	 * @since 1.0.4
	 * @return void
	 */
	public function test_get_users_url() {
		$class_instance = new Inpsyde_UserTable();
		$this->assertEquals( 'http://jsonplaceholder.typicode.com/users/', $class_instance->get_users_url() );
	}
}
