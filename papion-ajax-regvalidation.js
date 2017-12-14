jQuery(document).ready(function(){
	jQuery('#registerform').on('submit',function(e){
		var $form = jQuery('#registerform');
		e.preventDefault();
		jQuery('#login_error').remove();
		if(!$form.hasClass('validated')){
			$form.append('<input name="validation_test" class="validation_test" value="1" type="hidden">');
	        var datastring = $form.serialize();
	        jQuery.ajax({
	            type: "POST",
	            url: $form.attr('action'),
	            data: datastring,
	            dataType: "json",
	            success: function(data) {
	                if(data.errors && data.errors.validation_status){
						if(data.errors.validation_status[0] === 1){
							$form.addClass('validated');
							$form.off().submit();
	                    } else {
							$form.before('<div id="login_error"></div>');
							var htmlErrors = '';
							for(var k in data.errors) {
								if(k !== 'validation_status') {
									htmlErrors += data.errors[k] + '<br>';
								}
							}
							jQuery('#login_error').html(htmlErrors);
	                    }
	                }
	            },
	            error: function() {
	                alert('error handing here');
	            }
	        });
			$form.find('.validation_test').remove();
	    }
	});	
});
