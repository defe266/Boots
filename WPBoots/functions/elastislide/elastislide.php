<?php

	function elastislide_enqueue(){
	
				wp_enqueue_style("elastislide", get_template_directory_uri().'/functions/elastislide/css/elastislide.css');
				wp_enqueue_style("elastislide_custom", get_template_directory_uri().'/functions/elastislide/css/custom.css');
				
				
				wp_enqueue_script("modernizr", get_template_directory_uri().'/functions/elastislide/js/modernizr.custom.17475.js');
				wp_enqueue_script("jquerypp", get_template_directory_uri().'/functions/elastislide/js/jquerypp.custom.js', array('jquery'));
				wp_enqueue_script("elastislide", get_template_directory_uri().'/functions/elastislide/js/jquery.elastislide.js', array('jquery', 'jquerypp', 'modernizr'));
				wp_enqueue_script("elastislide_init", get_template_directory_uri().'/functions/elastislide/js/init.js', array('jquery', 'jquerypp', 'modernizr', 'elastislide'));
	}

/*
<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/elastislide.css" />
		<link rel="stylesheet" type="text/css" href="css/custom.css" />
		
		
		<script src="js/modernizr.custom.17475.js"></script>
		
		<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>-->
		<script type="text/javascript" src="js/jquerypp.custom.js"></script>
		<script type="text/javascript" src="js/jquery.elastislide.js"></script>
		<script type="text/javascript">
			
			$( '#carousel' ).elastislide();
			
		</script>

*/


?>