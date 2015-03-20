<?php

	function cookieConsent_enqueue_scripts_styles()
	{
		wp_enqueue_style("cookieConsent", get_template_directory_uri().'/functions/cookieConsent/css/style.css');

		wp_enqueue_script('jquerycookie', get_template_directory_uri().'/functions/cookieConsent/js/jquery.cookie.js', array('jquery'));
		wp_enqueue_script('cookieConsent', get_template_directory_uri().'/functions/cookieConsent/js/script.js', array('jquery', 'jquerycookie'));
		
		
		
		//creamos el banner html
		/*
		'*/
						
						
		//$content = __('This site uses cookies to improve the services offered. If you continue with this browsing session, we consider that you accept the use. <a>Learn more</a>');
		
		$pageid = get_option("wpboots_pageCookies");
		
		//si está activado el wpml, transformamos la id al de su traducción
		$pageid = ( function_exists('icl_object_id') ) ? icl_object_id($pageid,'page',true) : $pageid;
		
		
		$content = sprintf( __( 'This site uses cookies to improve the services offered. If you continue with this browsing session, we consider that you accept the use. <a href="%s">Learn more</a>', 'wpboots' ), get_the_permalink( $pageid ) );
		
			
		//<!--:es-->Aceptar<!--:--><!--:en-->Accept<!--:--><!--:de-->akzeptieren<!--:--><!--:fr-->Accepter<!--:-->
		$banner = '<div id="cookieConsent-container">
						<div id="cookieConsent-content">
							<div id="cookieConsentText-container">
								'.$content.'
							</div>
							<div id="cookieConsentButton-container">
								<span class="btn btn-primary" id="cookieConsentButton">'
									.__('Accept', 'wpboots').'
								</span>
							</div>
							
							<div style="clear:both"></div>
						</div>
					</div>';
						
		//le pasamos el banner html a javascript
		$scriptData = array(
		    'bannerContent' => $banner
		);
		
		wp_localize_script('cookieConsent', 'wp_cookieConsent', $scriptData);
		
		
	}
		
	
	add_action('wp_enqueue_scripts', 'cookieConsent_enqueue_scripts_styles');


	
?>