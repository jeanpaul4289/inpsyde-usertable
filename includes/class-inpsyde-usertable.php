<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the dashboard.
 *
 * @link https://github.com/jeanpaul4289
 * @since 1.0.0
 *
 * @package Inpsyde_UserTable
 * @subpackage Inpsyde_UserTable/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, dashboard-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since 1.0.0
 * @package Inpsyde_UserTable
 * @subpackage Inpsyde_UserTable/includes
 * @author Jean Paul Demorizi <jeanpaul4289@gmail.com>
 */
class Inpsyde_UserTable {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var Inpsyde_UserTable_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var string  $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var string  $version The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the Dashboard and
	 * the public-facing side of the site.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'inpsyde-usertable';
		$this->version     = '1.0.0';
		$this->users_url   = 'http://jsonplaceholder.typicode.com/users/';

		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Inpsyde_UserTable_Loader. Orchestrates the hooks of the plugin.
	 * - Inpsyde_UserTable_Admin. Defines all hooks for the dashboard.
	 * - Inpsyde_UserTable_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-inpsyde-usertable-loader.php';

		/**
		 * The class responsible for defining all actions that occur in the Dashboard.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-inpsyde-usertable-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-inpsyde-usertable-public.php';

		$this->loader = new Inpsyde_UserTable_Loader();

	}

	/**
	 * Register all of the hooks related to the dashboard functionality
	 * of the plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Inpsyde_UserTable_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_menu' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_fields' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_sections' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_settings' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function define_public_hooks() {

		$plugin_public = new Inpsyde_UserTable_Public( $this->get_plugin_name(), $this->get_version(), $this->get_users_url() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'remove_enqueued_scripts_styles', 19 );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles', 20 );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts', 20 );
		$this->loader->add_action( 'wp_ajax_get_users', $plugin_public, 'get_users' );
		$this->loader->add_action( 'wp_ajax_nopriv_get_users', $plugin_public, 'get_users' );
		$this->loader->add_action( 'wp_ajax_get_user', $plugin_public, 'get_user' );
		$this->loader->add_action( 'wp_ajax_nopriv_get_user', $plugin_public, 'get_user' );
		$this->loader->add_action( 'template_include', $plugin_public, 'render_user_table' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since 1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since 1.0.0
	 * @return string  The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since 1.0.0
	 * @return Inpsyde_UserTable_Loader Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since 1.0.0
	 * @return string  The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Retrieve the users url of the plugin.
	 *
	 * @since 1.0.0
	 * @return string  The users url of the plugin..
	 */
	public function get_users_url() {
		return $this->users_url;
	}

}
