(function( $ ) {
	'use strict';

	/**
	 * When the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 */
	 
	 $(function() {

	 					// Display Flipclock at wherever the shortcode is inserted
	 					var clock;
	 					clock = $('.clock').FlipClock({
	 				        clockFace: 'DailyCounter',
	 				        autoStart: false,
	 				        callbacks: {
	 				        	stop: function() {
	 				        		$('.message').html('The clock has stopped!')
	 				        	}
	 				        }
	 				 });
	 				 var opfc_time = parseInt(opfc_shortcode_object1.date, 10); // Should we use Date.parse?
	 				 var opfc_countdown = opfc_shortcode_object1.countdown;
	 				 clock.setTime(opfc_time); //input time in seconds
	 	    clock.setCountdown(opfc_countdown); //input true or false
	 	    clock.start();

	 });

})( jQuery );
