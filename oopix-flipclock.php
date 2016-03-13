<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.oopix.co/flipclock
 * @since             1.0.0
 * @package           Oopix_Flipclock
 *
 * @wordpress-plugin
 * Plugin Name:       OOPIX Flipclock
 * Plugin URI:        www.oopix.co/flipclock
 * Description:       Display a flipclock countdown/countup timer anywhere on your website with a shortcode generated for you.
 * Version:           1.0.0
 * Author:            OOPIX
 * Author URI:        www.oopix.co/flipclock
 * License:           GPLv2 or later (For FlipClock.js's license, see License section below)
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       oopix-flipclock
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
				die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-oopix-flipclock-activator.php
 */
function activate_oopix_flipclock() {
				require_once plugin_dir_path( __FILE__ ) . 'includes/class-oopix-flipclock-activator.php';
				Oopix_Flipclock_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-oopix-flipclock-deactivator.php
 */
function deactivate_oopix_flipclock() {
				require_once plugin_dir_path( __FILE__ ) . 'includes/class-oopix-flipclock-deactivator.php';
				Oopix_Flipclock_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_oopix_flipclock' );
register_deactivation_hook( __FILE__, 'deactivate_oopix_flipclock' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-oopix-flipclock.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_oopix_flipclock() {

	$plugin = new Oopix_Flipclock();
	$plugin->run();

}
run_oopix_flipclock();
