<?php

	function stacktable_enqueue(){
	
		wp_enqueue_style("stacktable", get_template_directory_uri().'/functions/stacktable/css/stacktable.css');
		
		wp_enqueue_script("stacktable", get_template_directory_uri().'/functions/stacktable/js/stacktable.js', array('jquery'));
	}
	
	function stacktable_initialized_Enqueue(){
	
		wp_enqueue_style("stacktable", get_template_directory_uri().'/functions/stacktable/css/stacktable.css');
		
		wp_enqueue_script("stacktable", get_template_directory_uri().'/functions/stacktable/js/stacktable.js', array('jquery'));
		wp_enqueue_script("stacktable_init", get_template_directory_uri().'/functions/stacktable/js/init.js', array('stacktable') );
	}

?>