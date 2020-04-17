<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @author Jean Paul Demorizi
 * @link https://github.com/jeanpaul4289
 * @since 1.0.0
 * @package Inpsyde_UserTable
 *
 * @wordpress-plugin
 * Plugin Name: Inpsyde UserTable
 * Plugin URI: https://github.com/jeanpaul4289/plugins/inpsyde-usertable/
 * Description: WordPress Plugin that shows a custom html table in an arbitrary URL.
 * Version: 1.0.0
 * Author: Jean Paul Demorizi
 * Author URI: https://github.com/jeanpaul4289/
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain: inpsyde-usertable
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Used for referring to the plugin file or basename.
if ( ! defined( 'INPSYDE_USERTABLE_FILE' ) ) {
	define( 'INPSYDE_USERTABLE_FILE', plugin_basename( __FILE__ ) );
}

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-inpsyde-usertable.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 1.0.0
 */
function run_inpsyde_usertable() {

	$plugin = new Inpsyde_UserTable();
	$plugin->run();

}
run_inpsyde_usertable();
