<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://ainaaRawaida.com
 * @since             1.0.0
 * @package           Qr_Restoran
 *
 * @wordpress-plugin
 * Plugin Name:       qr-restoran
 * Plugin URI:        https://ainaaRawaida.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            luqman
 * Author URI:        https://ainaaRawaida.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       qr-restoran
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'QR_RESTORAN_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-qr-restoran-activator.php
 */
function activate_qr_restoran() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-qr-restoran-activator.php';
	Qr_Restoran_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-qr-restoran-deactivator.php
 */
function deactivate_qr_restoran() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-qr-restoran-deactivator.php';
	Qr_Restoran_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_qr_restoran' );
register_deactivation_hook( __FILE__, 'deactivate_qr_restoran' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-qr-restoran.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_qr_restoran() {

	$plugin = new Qr_Restoran();
	$plugin->run();

}
run_qr_restoran();



function deb($data){
 print_r ("<pre>") ;
 print_r ($data) ;
 print_r ("</pre>") ;

}
