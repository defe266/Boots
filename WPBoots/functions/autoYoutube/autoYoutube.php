<?php


	
function autoYoutube_enqueue(){

		wp_enqueue_script( 'autoYoutube', get_template_directory_uri().'/functions/autoYoutube/js/script.js' );
}

//add_action('wp_enqueue_scripts', 'autoYoutube_enqueue');
	
?>