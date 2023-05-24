<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://jonmendoza.ph
 * @since             1.0.0
 * @package           Dynamic_Elementor_Addons
 *
 * @wordpress-plugin
 * Plugin Name:       Dynamic Elementor Addons
 * Plugin URI:        https://api.wordpress.org/secret-key/1.1/salt
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Jon Vincent Mendoza
 * Author URI:        https://jonmendoza.ph
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dynamic-elementor-addons
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
define( 'DYNAMIC_ELEMENTOR_ADDONS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dynamic-elementor-addons-activator.php
 */
function activate_dynamic_elementor_addons() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dynamic-elementor-addons-activator.php';
	Dynamic_Elementor_Addons_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dynamic-elementor-addons-deactivator.php
 */
function deactivate_dynamic_elementor_addons() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dynamic-elementor-addons-deactivator.php';
	Dynamic_Elementor_Addons_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dynamic_elementor_addons' );
register_deactivation_hook( __FILE__, 'deactivate_dynamic_elementor_addons' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-dynamic-elementor-addons.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_dynamic_elementor_addons() {

	$plugin = new Dynamic_Elementor_Addons();
	$plugin->run();

}
run_dynamic_elementor_addons();