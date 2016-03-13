<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       www.oopix.co/flipclock
 * @since      1.0.0
 *
 * @package    Oopix_Flipclock
 * @subpackage Oopix_Flipclock/admin/partials
 */
?>

<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
    
    <form method="post" name="oopix-flipclock-options" action="options.php">
    
    <?php
        //Grab all options (included for future development) 
        //$options = get_option($this->plugin_name);

        // Flipclock Options (included for future development) 
        //$opfc_name = $options['opfc_name'];
        //$opfc_countdown = $options['opfc_countdown'];
        //$opfc_start_date = $options['opfc_start_date'];
        //$opfc_start_time = $options['opfc_start_time'];
    ?>

    <?php
        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);
    ?>
        
        <!-- Name Flipclock (included for future development) -->
        <!-- <fieldset>
            <p class="option-title"><?php //_e('Name your flipclocks (not more than 10 characters, optional if you only use one)', $this->plugin_name);?></p>
            <legend class="screen-reader-text"><span><?php //_e('Name your flipclocks.', $this->plugin_name); ?></span></legend>
            <input type="text" class="regular-text" id="<?php //echo $this->plugin_name; ?>-name" name="<?php //echo $this->plugin_name; ?>[opfc_name]" value="<?php //if(!empty($opfc_name)) echo $opfc_name; ?>"  maxlength="10"/>
        </fieldset> -->

        <!-- Start Date -->
        <fieldset>
            <p class="option-title">Set the target date and time of your flipclock</p>
            <fieldset>
                <legend class="screen-reader-text"><span><?php _e('Date and Time', $this->plugin_name);?></span></legend>
                <label for="<?php echo $this->plugin_name; ?>-date">
                    <span class="option-title"><?php esc_attr_e('Date and Time', $this->plugin_name); ?></span>
                    <input type="text" id="<?php echo $this->plugin_name; ?>-date" name="<?php echo $this->plugin_name; ?> [opfc_date]" value="" class="opfc-datetimepicker"/>
                    <!-- If need to separate date and time in two different form fields: -->
                    <!-- <input type="text" id="<?php //echo $this->plugin_name; ?>-time" name="<?php //echo $this->plugin_name; ?> [opfc_time]" value="<?php //if(!empty($opfc_time)) echo $opfc_time; ?>" class="opfc-datetimepicker-alt"/> -->
                </label>
            </fieldset>
        </fieldset>

        <!-- Countdown -->
        <fieldset>
            <legend class="screen-reader-text"><span><?php _e('Countdown', $this->plugin_name); ?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-countdown">
                <span class="option-title"><?php esc_attr_e('Countdown', $this->plugin_name); ?></span>
                <input type="checkbox"  id="<?php echo $this->plugin_name; ?>-countdown" name="<?php echo $this->plugin_name; ?>[opfc_countdown]" value="1" />
                <span><?php esc_attr_e('(Do not tick if you are counting up)', $this->plugin_name); ?></span>
            </label>
        </fieldset>

        <input type="button" id="opfc-generate-shortcode" value="Generate Shortcode" />

        <div id="opfc-admin-shortcode" class="opfc-half-width"><span><?php _e('Copy this shortcode and paste in pages/posts:', $this->plugin_name);?></span><p id="opfc-shortcode-display"></p></div>

        <!-- Preview of shortcode (included for future development) -->
        <!-- <div class="clock" style="margin:2em;"></div>
        <div class="message"></div> -->

        <?php //submit_button(__('Save all changes', $this->plugin_name), 'primary','submit', TRUE); ?>

    </form>

</div>