<?php


//sizes

add_image_size( 'large2', 1000 ); // (cropped)


//enqueue
add_action('wp_enqueue_scripts', 'slideshow3d_enqueue');


function slideshow3d_enqueue(){
	
	
	//if ( is_page_template( 'template-cv.php' ) ) {
		
		
		wp_enqueue_style( 'slideshow3d', get_bloginfo( 'stylesheet_directory' ).'/functions/slideshow3d/css/slideshow3d.css' );
		
		wp_enqueue_script( 'modernizr', get_bloginfo( 'stylesheet_directory' ).'/functions/slideshow3d/lib/modernizr.js' ); //,  array('jquery') 
		
		wp_enqueue_script( 'imageloader', get_bloginfo( 'stylesheet_directory' ).'/functions/slideshow3d/lib/jquery.imageloader.js' );
		
		wp_enqueue_script( 'slideshow3d', get_bloginfo( 'stylesheet_directory' ).'/functions/slideshow3d/js/slideshow3d.js',  array('jquery','modernizr','imageloader') );
	//}
}

?>