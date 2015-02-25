<?php

	function bootstrap_enqueue(){
	
		wp_enqueue_style("bootstrap", get_template_directory_uri().'/functions/bootstrap/css/bootstrap.min.css');
		//wp_enqueue_style("bootstrap-responsive", get_template_directory_uri().'/functions/bootstrap/css/bootstrap-responsive.min.css');
		
		wp_enqueue_script("bootstrap", get_template_directory_uri().'/functions/bootstrap/js/bootstrap.min.js', array("jquery"));
	}



	
	/*
	function bootstrap_backend_enqueue(){

		wp_enqueue_style("bootstrap-wpadmin", get_template_directory_uri().'/functions/bootstrap/backend/css/bootstrap-wpadmin.css');
		wp_enqueue_style("bootstrap-wpadmin-fixes", get_template_directory_uri().'/functions/bootstrap/backend/css/bootstrap-wpadmin-fixes.css');
		wp_enqueue_style("bootstrap-wpadmin-fixes-2", get_template_directory_uri().'/functions/bootstrap/backend/css/bootstrap-wpadmin-fixes-2.css');

		wp_enqueue_script("bootstrap", get_template_directory_uri().'/functions/bootstrap/js/bootstrap.min.js', array("jquery"));
		
	}*/
	

	function bootstrap_backend_enqueue(){
		wp_enqueue_style("bootstrap_backend", get_template_directory_uri().'/functions/bootstrap/backend/css/bootstrap_wrap.css');
		//wp_enqueue_script("bootstrap_backend", get_template_directory_uri().'/functions/bootstrap/backend/js/bootstrap.min.js', array("jquery"));
		
		wp_enqueue_script("bootstrap_backend", get_template_directory_uri().'/functions/bootstrap/backend/js/bootstrap.js', array("jquery"));
	}
?>