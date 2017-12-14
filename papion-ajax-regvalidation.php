<?php
/*
   Plugin Name: Papion Ajax RegValidation
   Plugin URI: https://papion.it
   Version: 0.9
   Author: <a href="https://diegobetto.com">Diego Betto</a>
   Description: Wordpress Ajax Registration Form Validation
   Text Domain: papion-plugins
   License: GPLv3
  */

   defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function papion_validate( $errors, $sanitized_user_login, $user_email ) {
	if(isset($_POST['validation_test'])){

		if($errors && count($errors->errors) > 0) {
			$errors->add( 'validation_status', -1);
			wp_send_json($errors);
		} else {
			$errors->add( 'validation_status', 1);
			wp_send_json($errors);
		}		
	} 
    
    return $errors;
}

add_filter( 'registration_errors', 'papion_validate', 10, 3 );

add_action( 'login_enqueue_scripts', function(){
	wp_enqueue_script('jquery-core');
	wp_register_script( 'reg-ajax', plugins_url( '/papion-ajax-regvalidation.js', __FILE__ ), array ('jquery'));
    wp_enqueue_script('reg-ajax');
} );

