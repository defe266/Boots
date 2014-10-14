<?php

	//## funciones auxiliares
	
	
	function BootsAPI_pushError(&$errors, $code, $msg){

		if( is_array( $errors[$code] ) ){
			
			
			array_push($errors[$code], $msg);
				
		}else{
			
			$errors[$code] = array($msg);
		}
	}


	//## enqueue
	function BootsAPI_enqueue(){

		wp_enqueue_script("BootsAPI", get_template_directory_uri().'/functions/BootsAPI/js/BootsAPI.js', array("jquery","bootstrap"));
		
		wp_localize_script(
			'BootsAPI',
			'BootsAPI_wp',
			array(
				'site_url' => site_url(),
				'home_url' => home_url(),
				'lang' => get_bloginfo("language")
			)
		);	
	}

	BootsAPI_enqueue();
	
	
	
	
	//## AJAX API
	
	
	add_action( 'wp_ajax_BootsAPI_login', 'BootsAPI_login' );
	add_action('wp_ajax_nopriv_BootsAPI_login', 'BootsAPI_login');
	
	add_action( 'wp_ajax_BootsAPI_register', 'BootsAPI_register' );
	add_action('wp_ajax_nopriv_BootsAPI_register', 'BootsAPI_register');
	
	
	
	function BootsAPI_login() {

		//check_ajax_referer( 'ajax-login-nonce', 'security' ); //no va, xk security está anidado
		
		
		//recojo los datos
		$data = $_REQUEST['data'];
		
		//var_dump($_REQUEST);
		//var_dump(wp_verify_nonce($data['security'], "ajax-login-nonce"));
		
		
		if( !isset($data['security']) || !wp_verify_nonce($data['security'], "ajax-login-nonce") ){
		 
		 	http_response_code(403);
			$response = array("general" => array("Error de seguridad"));

		}else{
		
		
			//## Validate
			$errors = array();
			
		
			if($data['user_login'] == '')
				BootsAPI_pushError($errors, 'user_login', __('Required.','BootsAPI') );
				
			if($data['user_password'] == '')
				BootsAPI_pushError($errors, 'user_password', __('Required.','BootsAPI') );

			
			
			//## Test Validate
			if( count($errors) == 0 ){

				$credentials = array(
				
					"user_login" => $data['user_login'],
					"user_password" => $data['user_password'],
					"remember" => true
				);
			
			    $user_signon = wp_signon( $credentials, false );
			    
			    if ( is_wp_error($user_signon) ){
			    
			    	http_response_code(400);
			    	$response = array(
			    		"user_login" => array( __('Wrong username or password.','BootsAPI') ), //__('Wrong username or password.')
			    		"user_password" => array("")
			    	);
			    	//var_dump($user_signon->get_error_message());
			    } else {
			    
			    	$response = array("general" => "ok");
			    }
		    
		    }else{//si hay errores de validacion
			
				http_response_code(400);
		    	$response = $errors;
			}
		}
		
		
		//envío la respuesta
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($response);
		
		//var_dump($cats);
		
	    die();
	}
	
	
	
	
	
	
	function BootsAPI_register() {

		//check_ajax_referer( 'ajax-login-nonce', 'security' ); //no va, xk security está anidado
		
		
		//recojo los datos
		$data = $_REQUEST['data'];
		
		//var_dump($_REQUEST);
		//var_dump(wp_verify_nonce($data['security'], "ajax-login-nonce"));
		
		
		if( !isset($data['security']) || !wp_verify_nonce($data['security'], "ajax-register-nonce") ){
		 
		 	http_response_code(403);
			$response = array("general" => array("Error de seguridad"));

		}else{
		
			//## Validate
			$errors = array();
			
		
			if($data['user_login'] == '')
				BootsAPI_pushError($errors, 'user_login', __('Required.','BootsAPI') );
				
			if($data['user_email'] == '')
				BootsAPI_pushError($errors, 'user_email', __('Required.','BootsAPI') );
				
			if($data['user_password'] == '')
				BootsAPI_pushError($errors, 'user_password', __('Required.','BootsAPI') );
			
			if(username_exists( $data['user_login'] ) )
				BootsAPI_pushError($errors, 'user_login', __('Username in use.','BootsAPI') );
			
			if(!is_email( $data['user_email'] ) )
				BootsAPI_pushError($errors, 'user_email', __('Invalid email.','BootsAPI') );
				
			if(email_exists( $data['user_email'] ) )
				BootsAPI_pushError($errors, 'user_email', __('Email in use.','BootsAPI') );
			
			
			
			//## Test Validate
			if( count($errors) == 0 ){
			
				$userdata = array(
				    'user_login'  =>  $data['user_login'],
				    'user_email'  =>  $data['user_email'],
				    'user_pass'   =>  $data['user_password'],
				    'first_name'   =>  $data['first_name'],
				    'last_name'   =>  $data['last_name']
				);
				
				$user_id = wp_insert_user( $userdata ) ;
				
				//On success
				if( !is_wp_error($user_id) ) {
				
					//logueamos tras registro si lo pidió
					if($data['autologin'] == 'true'){
						
						$credentials = array(
			
							"user_login" => $data['user_login'],
							"user_password" => $data['user_password'],
							"remember" => true
						);
					
					    $user_signon = wp_signon( $credentials, false );
					}
				
					$response = array("general" => "ok");
				 
				}else{//errores desconocidos

					http_response_code(403);
					$response = array("general" => array("Error al crear el usuario"));
				}
			
			
			}else{//si hay errores de validacion
			
				http_response_code(400);
		    	$response = $errors;
			}

		}
		
		
		//envío la respuesta
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($response);

		
	    die();
	}

?>