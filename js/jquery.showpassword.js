/*
*	@name							Show Password
*	@descripton						
*	@version						1.3
*	@requires						Jquery 1.5
*
*	@author							Jan Jarfalk
*	@author-email					jan.jarfalk@unwrongest.com
*	@author-website					http://www.unwrongest.com
*
*	@special-thanks					Michel Gratton
*
*	@licens							MIT License - http://www.opensource.org/licenses/mit-license.php
*/
(function($){
     $.fn.extend({
         showPassword: function(c) {	
            
            // Setup callback object
			var callback 	= {'fn':null,'args':{}}
				callback.fn = c;
			
			// Clones passwords and turn the clones into text inputs
			var cloneElement = function( element ) {
				
				var $element = $(element);
					
				$clone = $("<input />");
					
				// Name added for JQuery Validation compatibility
				// Element name is required to avoid script warning.
				$clone.attr({
					'type'		:	'text',
					'class'		:	$element.attr('class'),
					'style'		:	$element.attr('style'),
					'size'		:	$element.attr('size'),
					'name'		:	$element.attr('name')+'-clone',
					'tabindex' 	:	$element.attr('tabindex')
				});
					
				return $clone;
			
			};
			
			// Transfers values between two elements
			var update = function(a,b){
				b.val(a.val());
			};
			
			// Shows a or b depending on checkbox
			var setState = function( checkbox, a, b ){
			
				if(checkbox.is(':checked')){
					update(a,b);
					b.show();
					a.hide();
				} else {
					update(b,a);
					b.hide();
					a.show();
				}
				
			};
            
            return this.each(function() {
            	
            	var $input					= $(this),
            		$checkbox 				= $($input.data('typetoggle'));
            	
            	// Create clone
				var $clone = cloneElement($input);
					$clone.insertAfter($input);
				
				// Set callback arguments
            	if(callback.fn){	
            		callback.args.input		= $input;
            		callback.args.checkbox	= $checkbox;
					callback.args.clone 	= $clone;
            	}
				

				
				$checkbox.live('click', function() {
					setState( $checkbox, $input, $clone );
				});
				
				$input.live('keyup', function() {
					update( $input, $clone )
				});
				
				$clone.live('keyup', function(){ 
					update( $clone, $input );
					
					// Added for JQuery Validation compatibility
					// This will trigger validation if it's ON for keyup event
					$input.trigger('keyup');
					
				});
				
				// Added for JQuery Validation compatibility
				// This will trigger validation if it's ON for blur event
				$clone.live('blur', function() { $input.trigger('focusout'); });
				
				setState( $checkbox, $input, $clone );
				
				if( callback.fn ){
					callback.fn( callback.args );
				}

            });
        }
    });
})(jQuery);
