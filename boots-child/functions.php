<?php


function afterParentTheme(){


	//add_image_size( 'thumb-tour', 480);
	
	//show_admin_bar(false);
	
	
	/*
	register_nav_menus( array(
		'user' => __( 'User Menu', 'wpboots' )
	) );*/
	
	
	/*
	//change login logo
	function my_login_logo() { ?>
	    <style type="text/css">
	        body.login div#login h1 a {

	            display: none;
	        }
	        
	        #wp-submit{
	        	background: #FD7B24;
			    border: medium none;
			    border-radius: 0;
			    box-shadow: none;
			    font-size: 16px;
			    height: 43px;
			    line-height: 40px;
			    width: 100%;
	        }
	    </style>
	<?php }
	add_action( 'login_enqueue_scripts', 'my_login_logo' );
*/
	
	
	load_child_theme_textdomain("wpboots", get_stylesheet_directory(). '/lang'); // 
	
	// LOCALIZE

	/*add_action( 'after_setup_theme', 'child_theme_language' );
	function child_theme_language() {
		load_child_theme_textdomain("MYTEXTDOMAIN", get_stylesheet_directory() . '/lang');
		*/

}

add_action( 'after_setup_theme', 'afterParentTheme', 10 );//wp_loaded
	
	//add_action( 'after_setup_theme', 'onepage_metaboxes', 20 );
	


?>