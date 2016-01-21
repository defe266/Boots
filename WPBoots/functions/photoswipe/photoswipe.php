<?php

	function photoswipe_enqueue(){
	
		wp_enqueue_style("photoswipe", get_template_directory_uri().'/functions/photoswipe/lib/photoswipe.css');
		wp_enqueue_style("photoswipe-skin", get_template_directory_uri().'/functions/photoswipe/lib/default-skin/default-skin.css');
		
		wp_enqueue_script("photoswipe", get_template_directory_uri().'/functions/photoswipe/lib/photoswipe.min.js');
		wp_enqueue_script("photoswipe-ui", get_template_directory_uri().'/functions/photoswipe/lib/photoswipe-ui-default.min.js');
		
		wp_enqueue_script("photoswipe-init", get_template_directory_uri().'/functions/photoswipe/init.js', array('photoswipe', 'photoswipe-ui') );
				
	}

?>