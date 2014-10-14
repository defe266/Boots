<?php

	function google_code_prettify_enqueue()
	{
		wp_enqueue_style("prettify", get_template_directory_uri().'/functions/google-code-prettify/prettify.css');
		
		wp_enqueue_script("prettify", get_template_directory_uri().'/functions/google-code-prettify/prettify.js');
		wp_enqueue_script("prettify_init", get_template_directory_uri().'/functions/google-code-prettify/init.js', array('jquery'));
	}

?>