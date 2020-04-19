<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link https://github.com/jeanpaul4289
 * @since 1.0.0
 *
 * @package Inpsyde_UserTable
 * @subpackage Inpsyde_UserTable/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package Inpsyde_UserTable
 * @subpackage Inpsyde_UserTable/public
 * @author Jean Paul Demorizi <jeanpaul4289@gmail.com>
 */
class Inpsyde_UserTable_Public {

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
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version The version of this plugin.
	 * @param string $users_url The user url endpoint this plugin.
	 */
	public function __construct( $plugin_name, $version, $users_url ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		$this->users_url   = $users_url;
		$this->page_title  = "Inpsyde UserTable - Custom Page";

		$this->set_options();

	}

	/**
	 * Removed the enqueued scripts and stylesheets for the public-facing side of the site.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function remove_enqueued_scripts_styles() {

		if ( $this->options ) {
			$pagename = get_query_var( 'pagename' );
			if ( $pagename === $this->options['ce'] || ( ! $this->options['ce'] && 'usertable' === $pagename ) ) {
				global $wp_scripts;
				global $wp_styles;
				$wp_scripts->queue = array();
				$wp_styles->queue  = array();
			}
		}

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'jquery_datatable_style', 'https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css' );
		wp_enqueue_style( 'bootstrap_datatable_style', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
		wp_enqueue_style( 'custom_usertable_style', plugin_dir_url( __FILE__ ) . '/css/usertable.css' );
		wp_enqueue_style( 'jquery_style', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'jquery_script', 'http://code.jquery.com/jquery-1.11.2.min.js' );
		wp_enqueue_script( 'jquery_datatable_script', 'http://cdn.datatables.net/1.10.20/js/jquery.dataTables.js' );
		wp_enqueue_script( 'custom_usertable_script', plugin_dir_url( __FILE__ ) . 'js/usertable.js' );
		wp_localize_script(
			'custom_usertable_script', 'my_script_object', array(
				'ajax_url'   => admin_url( 'admin-ajax.php' ),
				'user_nonce' => wp_create_nonce( 'user_nonce' ),
			)
		);
		wp_enqueue_script( 'jquery_ui_script', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js' );

	}

	/**
	 * Render the user table in a custom endpoint (not api)
	 *
	 * @param string $original_template original template send by theme.
	 * @return string
	 */
	public function render_user_table( $original_template ) {

		$this->options = get_option( 'ce_name' );
		$pagename      = get_query_var( 'pagename' );

		if ( $pagename === $this->options['ce'] || ( ! $this->options['ce'] && 'usertable' === $pagename ) ) {
			return plugin_dir_path( __FILE__ ) . 'templates/usertable.php';
		} else {
			return $original_template;
		}

	}

	/**
	 * Getting all the users
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function get_users() {

		echo wp_kses( $this->remote_response_handler( $this->users_url ), [] );
		exit();

	}

	/**
	 * Getting an specific user.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function get_user() {

		if ( ! empty( $_POST ) ) {
			$post       = $_POST; // WPCS: CSRF ok.
			$user_id    = $post['user_id'];
			$action     = $post['action'];
			$user_nonce = $post['user_nonce'];

			if ( ! empty( $user_id ) && ! empty( $action ) && ! empty( $user_nonce ) ) {
				if ( wp_verify_nonce( sanitize_text_field( wp_unslash( $user_nonce ) ), 'user_nonce' ) ) {
					$user_id = sanitize_text_field( wp_unslash( $user_id ) ); // input var okay.
					$action  = sanitize_text_field( wp_unslash( $action ) ); // input var okay.
					echo wp_kses( $this->remote_response_handler( $this->users_url . $user_id ), [] );
				}
			}
		}
		exit();

	}

	/**
	 * Change page title
	 *
	 * @since 1.0.7
	 * @return string;
	 */
	public function get_page_title () {

		return $this->page_title;

	}

	/**
	 * Remote response handler for the API endpoint
	 *
	 * @since 1.0.0
	 * @param string $url endpoint url.
	 * @return string $body response body.
	 */
	public function remote_response_handler( $url ) {

		$response = wp_remote_request( $url );
		$code     = wp_remote_retrieve_response_code( $response );
		$body     = wp_remote_retrieve_body( $response );
		if ( 200 !== $code ) {
			$body = 'An error has ocurred.';
		}
		return $body;

	}

	/**
	 * Sets the class variable $options
	 *
	 * @since 1.0.0
	 * @return void
	 */
	private function set_options() {

		$this->options = get_option( 'ce_name' );

	}

}
