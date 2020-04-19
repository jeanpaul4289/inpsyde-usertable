<?php
/**
 * The admin-panel-specific functionality of the plugin.
 *
 * @link https://github.com/jeanpaul4289
 * @since 1.0.0
 *
 * @package Inpsyde_UserTable
 * @subpackage Inpsyde_UserTable/admin
 */

/**
 * The admin-panel-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and adds the menu and settings to the admin panel in Wordpress.
 *
 * @package Inpsyde_UserTable
 * @subpackage Inpsyde_UserTable/admin
 * @author Jean Paul Demorizi <jeanpaul4289@gmail.com>
 */
class Inpsyde_UserTable_Admin {

	/**
	 * The plugin options.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $options The plugin options.
	 */
	private $options;

	/**
	 * The ID of this plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		$this->set_options();

	}

	/**
	 * Adds a settings page link to a menu
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function add_menu() {

		// Main Menu Item.
		add_menu_page(
			'Inpsyde Settings',
			'Inpsyde Settings',
			'manage_options',
			'inpsyde-endpoint-customization',
			[ $this, 'page_options' ],
			'dashicons-groups',
			1
		);

	}

	/**
	 * Creates the options page
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function page_options() {

		include plugin_dir_path( __FILE__ ) . 'partials/inpsyde-usertable-admin-page-settings.php';

	}

	/**
	 * Registers settings fields with WordPress
	 * 
	 * @since 1.0.0
	 * @return void
	 */
	public function register_fields() {

		add_settings_field(
			'ce', // Custom Endpoint Field ID.
			'Custom Endpoint', // Title.
			[ $this, 'field_text' ], // Callback.
			'ce_admin', // Page.
			'ce_section' // Section.
		);

	}

	/**
	 * Creates a text field
	 *
	 * @since 1.0.0
	 * @return void The HTML field
	 */
	public function field_text() {

		printf(
			'<input type="text" id="ce" name="ce_name[ce]" value="%s" placeholder="usertable" />
            <p class="description">This is not a REST endpoint.</p>',
			isset( $this->options['ce'] ) ? esc_attr( $this->options['ce'] ) : ''
		);

	}

	/**
	 * Registers settings sections with WordPress
	 * 
	 * @since 1.0.0
	 * @return void
	 */
	public function register_sections() {

		add_settings_section(
			'ce_section', // Custom Endpoint Section ID.
			'Custom Endpoint Customization', // Title.
			[ $this, 'field_label' ], // Callback.
			'ce_admin' // Page.
		);

	}

	/**
	 * Render instructions for our plugin's custom endpoint section.
	 *
	 * @since 1.0.0
	 * @return void The label field
	 */
	public function field_label() {
		print 'Enter an arbitrary URL not recognized by WP as a standard URL, like a permalink or 
        so below: ';
	}

	/**
	 * Registers plugin settings
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function register_settings() {

		register_setting(
			'ce_group', // Custom Endpoint Option group.
			'ce_name', // Custom Endpoint Option name.
			[ $this, 'sanitize' ] // Sanitize.
		);

	}

	/**
	 * Sanitize setting field as needed
	 *
	 * @param array $input Contains setting field as array keys.
	 * @return array $new_input
	 */
	public function sanitize( array $input ) {
		$new_input = [];
		if ( isset( $input['ce'] ) ) {
			$input['ce']     = preg_replace( '/[^A-Za-z0-9\-\_]/', '', $input['ce'] );
			$new_input['ce'] = sanitize_text_field( $input['ce'] );
		}
		return $new_input;
	}

	/**
	 * Sets the class variable $options
	 * 
	 * @since 1.0.0
	 * @return void
	 */
	private function set_options() {

		$this->options = get_option( $this->plugin_name . '-options' );

	}


}
