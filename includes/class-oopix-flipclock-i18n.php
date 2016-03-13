<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       www.oopix.co/flipclock
 * @since      1.0.0
 *
 * @package    Oopix_Flipclock
 * @subpackage Oopix_Flipclock/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Oopix_Flipclock
 * @subpackage Oopix_Flipclock/includes
 * @author     OOPIX <enquries@oopix.co>
 */
class Oopix_Flipclock_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'oopix-flipclock',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}


}
