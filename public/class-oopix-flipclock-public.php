<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       www.oopix.co/flipclock
 * @since      1.0.0
 *
 * @package    Oopix_Flipclock
 * @subpackage Oopix_Flipclock/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Oopix_Flipclock
 * @subpackage Oopix_Flipclock/public
 * @author     OOPIX <enquiries@oopix.co>
 */
class Oopix_Flipclock_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

					$this->plugin_name = $plugin_name;
					$this->version = $version;
					/* Retrieve options saved in admin to be used here */
					$this->wp_opfc_options = get_option($this->plugin_name);
					/* Register shortcode */
					add_shortcode( 'oopix_flipclock', array( $this, 'oopix_flipclock_shortcode_function' ) );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

					wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/oopix-flipclock-public.css', array(), $this->version, 'all' );
					wp_enqueue_style('opfc-flipclockjs', plugin_dir_url( __FILE__ ) . 'css/flipclock.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/oopix-flipclock-public.js', array( 'jquery' ), $this->version, false );
		wp_register_script( 'opfc-flipclockjs-js', plugin_dir_url( __FILE__ ) . 'js/flipclock.min.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * OOPIX Flipclock shortcode function.
	 *
	 * @since    1.0.0
	 */
	public function oopix_flipclock_shortcode_function( $atts, $content = null ) {

					// Set default shortcode atrributes.
					// Get user-defined attributes ($atts) of shortcode.
					// Allow filter of the attributes in this shortcode.
					$oopix_flipclock_data = shortcode_atts( array(
														'countdown' => '',
														'date' => ''
														), $atts, 'oopix_flipclock' );
					
					// Set 'countdown' attribute in boolean.
					$opfc_countdown = filter_var(strtolower($oopix_flipclock_data['countdown']), FILTER_VALIDATE_BOOLEAN);
					if ( $opfc_countdown == true ) {
														$opfc_countdown = TRUE;
														$oopix_flipclock_data['countdown'] = $opfc_countdown;
					}
					if ( $opfc_countdown == false ) {
														$opfc_countdown = FALSE;
														$oopix_flipclock_data['countdown'] = $opfc_countdown;
					}

					// Calculate time difference for Countup
					if ( $oopix_flipclock_data['date'] && !$opfc_countdown ) {
														$opfc_date_input = $oopix_flipclock_data['date'];
														$opfc_date_totime = strtotime($opfc_date_input);
														$opfc_current_datetime = date('Y-m-d H:i:s');
														$opfc_current_datetime_totime = strtotime($opfc_current_datetime);
														if ($opfc_current_datetime_totime >= $opfc_date_totime) {
																					$opfc_time_diff = $opfc_current_datetime_totime - $opfc_date_totime;
														}
														elseif ($opfc_current_datetime_totime < $opfc_date_totime) {
																					// Trigger countdown if User's Defined Date is later than Now
																					$oopix_flipclock_data['countdown'] = TRUE; 
																					$opfc_time_diff = $opfc_date_totime - $opfc_current_datetime_totime;
														}
														$oopix_flipclock_data['date'] = $opfc_time_diff;
					}

					// Calculate time difference for Countdown
					elseif ( $oopix_flipclock_data['date'] && $opfc_countdown ) {
												$opfc_date_input = $oopix_flipclock_data['date'];
												$opfc_date_totime = strtotime($opfc_date_input);
												// $opfc_date_rfc2822 = date('r', $opfc_date_totime);
												$opfc_current_datetime = date('Y-m-d H:i:s');
												$opfc_current_datetime_totime = strtotime($opfc_current_datetime);
												if ($opfc_current_datetime_totime > $opfc_date_totime) {
																			// Trigger countup if User's Defined Date is earlier than Now
																			$oopix_flipclock_data['countdown'] = FALSE; 
																			$opfc_time_diff = $opfc_current_datetime_totime - $opfc_date_totime;
												}
												elseif ($opfc_current_datetime_totime <= $opfc_date_totime) {
																			$opfc_time_diff = $opfc_date_totime - $opfc_current_datetime_totime;
												}
												$oopix_flipclock_data['date'] = $opfc_time_diff;
					}
					
					wp_enqueue_script( $this->plugin_name );
					wp_enqueue_script( 'opfc-flipclockjs-js' );
					// Allow use of shortcode attributes in JS
					wp_localize_script('opfc-flipclockjs-js','opfc_shortcode_object1',$oopix_flipclock_data);
	    return $this->display_oopix_flipclock();
	}

	/**
	 * Display the OOPIX flipclock from this plugin.
	 *
	 * @since    1.0.0
	 */

	private function display_oopix_flipclock() {
								include_once( 'partials/oopix-flipclock-public-display.php' );
	}

}
