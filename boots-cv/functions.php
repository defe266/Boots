<?php


	register_nav_menus( array(
		'left' => __( 'Left Menu', 'wpboots' ),
		'right' => __( 'Right Menu', 'wpboots' )
	) );

	



function afterParentTheme(){



	include_once(get_stylesheet_directory().'/functions/slideshow3d/slideshow3d.php');

	include_once(get_stylesheet_directory().'/functions/cv/cv.php');

}

add_action( 'after_setup_theme', 'afterParentTheme', 10 );//wp_loaded
	
	//add_action( 'after_setup_theme', 'onepage_metaboxes', 20 );
	


?>