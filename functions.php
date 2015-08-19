<?php

function forms_suggestion_email( ) {
	
          //Declare $ninja_forms_processing as a global variable.
          global $ninja_forms_processing;
          //Creates object with user information
          $user = get_userdata( $user_id );
	// Send welcome e-mail to new user
	$email_params = array(
		//array( 'name' => 'BLOGNAME', 'content' => $blogname ),
		array( 'name' => 'USER_NAME', 'content' => $ninja_forms_processing->get_field_value(113) ),
                array( 'name' => 'SUGGESTION', 'content' => $ninja_forms_processing->get_field_value(50)),
		//array( 'name' => 'EMAIL', 'content' => $user->user_email  ),
		array( 'name' => 'FIRST_NAME', 'content' => $ninja_forms_processing->get_field_value(55)  ),
		array( 'name' => 'LOGIN_URL', 'content' => wp_login_url() ),
	);
			
	//$template = $ninja_forms_processing->get_field_value(112) ;
        $template = "suggestions";
	$subject = "Suggestions";
			
	$to_name = $user->first_name . " " . $user->last_name;
	mandrill_send_mail( $ninja_forms_processing->get_field_value(99) , $to_name, $template, $subject, $email_params );
        
}
function ninja_forms_register_suggestion() {
    
    add_action('ninja_forms_post_process', 'ninja_forms_suggestion_email_launch');
}

add_action('init', 'ninja_forms_register_suggestion');


function ninja_forms_suggestion_email_launch(){
    global $ninja_forms_processing;
    if(!$ninja_forms_processing->get_field_value(50)==null){
        forms_suggestion_email();
    }
}
