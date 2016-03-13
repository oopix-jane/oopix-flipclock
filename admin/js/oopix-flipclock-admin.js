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
  				$( ".opfc-datetimepicker" ).datetimepicker({
  								changeMonth: true,
						    changeYear: true,
          yearRange: "-25:+25",
  								dateFormat : "dd-mm-yy",
										timeFormat: "hh:mm tt z",
										addSliderAccess: true,
										sliderAccessArgs: { touchonly: false }
  				});
  				$.extend($.datepicker,{
  								_checkOffset:function(inst,offset,isFixed){
  											return offset
  								}
  				});

  				// Reflect inputs realtime in shortcode box
  				function opfc_generate_shortcode() {
  								var opfc_date = document.getElementById('oopix-flipclock-date').value;
  								var opfc_coundown = document.getElementById('oopix-flipclock-countdown').checked;
  								var generated_shortcode = '[oopix_flipclock date="' + opfc_date + '" countdown="' + opfc_coundown + '"]';
  								document.getElementById('opfc-shortcode-display').innerHTML = generated_shortcode;
  				}

  				function testing(){
  				  		console.log(document.getElementById('oopix-flipclock-date').value);
  				    console.log(document.getElementById('oopix-flipclock-time').value);
  				}

  				document.getElementById('opfc-generate-shortcode').onclick = function() {
  				    // testing();
  				    opfc_generate_shortcode();
  				}
  				
						// Flipclock Preview in Admin (included for future development)
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
		    clock.setTime(220880);
		    clock.setCountdown(true);
		    clock.start();

  });

})( jQuery );
