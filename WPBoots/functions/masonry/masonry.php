<?php


	
function masonry_enqueue(){

		wp_enqueue_script( 'masonry', get_template_directory_uri().'/functions/masonry/lib/masonry.pkgd.min.js', array('jquery') );
		
		wp_enqueue_script( 'masonry_init', get_template_directory_uri().'/functions/masonry/js/masonry_init.js', array('jquery') );
}

//add_action('wp_enqueue_scripts', 'mosaic_archive_enqueue');
	
?>