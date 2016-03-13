<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.oopix.co/flipclock
 * @since      1.0.0
 *
 * @package    Oopix_Flipclock
 * @subpackage Oopix_Flipclock/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Oopix_Flipclock
 * @subpackage Oopix_Flipclock/admin
 * @author     OOPIX <enquiries@oopix.co>
 */
class Oopix_Flipclock_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
  $this->oopix_flipclock_options = get_option($this->plugin_name);

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		
		if ( 'settings_page_oopix-flipclock' == get_current_screen() -> id ) {
				wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/oopix-flipclock-admin.css', array(), $this->version, 'all' );
				wp_enqueue_style( 'jquery-timepicker-addon-css', plugin_dir_url( __FILE__ ) . 'css/jquery-ui-timepicker-addon.css', array(), $this->version, 'all' );
				wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
				wp_enqueue_style('opfc-flipclockjs', plugin_dir_url( __FILE__ ) . 'css/flipclock.css', array(), $this->version, 'all' );
		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {		

		if ( 'settings_page_oopix-flipclock' == get_current_screen() -> id ) {
				wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/oopix-flipclock-admin.js', array( 'jquery' ), $this->version, false );	
				wp_enqueue_script('jquery-ui-script', 'http://code.jquery.com/ui/1.10.4/jquery-ui.js');
				wp_enqueue_script( 'jquery-timepicker-addon', plugin_dir_url( __FILE__ ) . 'js/jquery-ui-timepicker-addon.js',  array('jquery' ), $this->version, false );	
				wp_enqueue_script( 'jquery-timeslider-addon', plugin_dir_url( __FILE__ ) . 'js/jquery-ui-sliderAccess.js', array( 'jquery' ), $this->version, false );
				wp_enqueue_script( 'opfc-flipclockjs-js', plugin_dir_url( __FILE__ ) . 'js/flipclock.min.js', array( 'jquery' ), $this->version, false );
		}

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	 
	public function add_plugin_admin_menu() {

	    /*
	     * Add a settings page for this plugin to the Settings menu.
	     *
	     * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
	     *
	     * Administration Menus: http://codex.wordpress.org/Administration_Menus
	     *
	     */
	    add_options_page( 'OOPIX Flipclock Options', 'OOPIX Flipclock', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
	    ); //Page Title, Menu Title, Capabilities, Menu Slug, Callback Function
	}

	 /**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	 
	public function add_action_links( $links ) {
	    /*
	    *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
	    */
	   $settings_link = array(
	    '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
	   );
	   return array_merge(  $settings_link, $links );
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	 
	public function display_plugin_setup_page() {
	    include_once( 'partials/oopix-flipclock-admin-display.php' );
	}

	/**
	 * Render flipclock based on shortcode generated.
	 *
	 * @since    1.0.0
	 */
	 
	public function display_admin_oopix_flipclock() {
	    
	}

	/**
	 * Sanitize and save/update values entered in settings page for this plugin.
	 * Included for future development.
	 *
	 * @since    1.0.0
	 */
	public function options_update() {
	    register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate')); //Option group, Option Name, Callback function
	 }
	public function validate($input) {
	    // All checkboxes inputs        
	    $valid = array();

	    //Options
	    if ( strlen( $input['opfc_name'] ) > 10 ) {
	      $message = __( 'Length of Name must not exceed 10 characters', $this->plugin_name );
	      $type = 'error';
	      add_settings_error(
           'opfc_name', // Setting Title
           esc_attr( 'options-opfc-name-error' ), // Error ID
           $message, // Error Message
           $type // Type of Message
       );
	    }
	    else {
	    		$valid['opfc_name'] = esc_attr($input['opfc_name']);
	    }

	    $valid['opfc_countdown'] = (isset($input['opfc_countdown']) && !empty($input['opfc_countdown'])) ? 1 : 0;

	   	if (!empty($input['opfc_start_date'])){
							   	$opfc_input_date = $input['opfc_start_date'];
							   	$opfc_input_year = $date['year'];
							   	echo 'alert("'.$opfc_input_date.'")';
		   }
		   else {
		   						$valid['opfc_start_date'] = "";
		   						$valid['opfc_start_time'] = "";
		   }

	    return $valid;
	}

}
