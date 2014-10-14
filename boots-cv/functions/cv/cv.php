<?php


//sizes


add_image_size('230-crop', 230, 230, array( 'left', 'top' ));
add_image_size('500-crop', 500, 500, array( 'left', 'top' ));



//enqueue
add_action('wp_enqueue_scripts', 'cv_enqueue');


function cv_enqueue(){
	
	
	if ( is_page_template( 'template-cv.php' ) ) {
		
		
		
		wp_enqueue_script( 'masonry', get_bloginfo( 'stylesheet_directory' ).'/functions/cv/lib/masonry.pkgd.min.js'); //,  array('jquery') 
		
		
		wp_enqueue_script( 'tour_myBooking', get_bloginfo( 'stylesheet_directory' ).'/functions/cv/js/cv.js',  array('jquery','masonry') );
	}
}

?>