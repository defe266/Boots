<?php

	function menu_lateral_enqueue()
	{
	
		wp_enqueue_style("side_menu", get_bloginfo("template_url").'/functions/side_menu/css/menu_lateral.css');
		
		//wp_enqueue_script("hammer", get_bloginfo("stylesheet_directory").'/functions/menu_lateral/js/jquery.hammer.min.js', array('jquery'));
		wp_enqueue_script("side_menu", get_bloginfo("template_url").'/functions/side_menu/js/init.js', array('jquery') );//, 'hammer'

	}
	
	add_action( 'wp_enqueue_scripts', 'menu_lateral_enqueue' );
?>