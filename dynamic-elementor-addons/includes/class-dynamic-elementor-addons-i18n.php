<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://jonmendoza.ph
 * @since      1.0.0
 *
 * @package    Dynamic_Elementor_Addons
 * @subpackage Dynamic_Elementor_Addons/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Dynamic_Elementor_Addons
 * @subpackage Dynamic_Elementor_Addons/includes
 * @author     Jon Vincent Mendoza <jonazodnem26@gmail.com>
 */
class Dynamic_Elementor_Addons_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'dynamic-elementor-addons',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
