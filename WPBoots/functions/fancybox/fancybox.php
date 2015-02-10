<?php

	function fancybox_enqueue()
	{
	
				wp_enqueue_style("fancybox", get_template_directory_uri().'/functions/fancybox/source/jquery.fancybox.css');
				
				wp_enqueue_script("mousewheel", get_template_directory_uri().'/functions/fancybox/lib/jquery.mousewheel-3.0.6.pack.js', array('jquery'));
				wp_enqueue_script("fancybox", get_template_directory_uri().'/functions/fancybox/source/jquery.fancybox.pack.js', array('jquery'));
				wp_enqueue_script("fancybox_init", get_template_directory_uri().'/functions/fancybox/init.js', array('jquery', 'fancybox') );
				
				/*
				<!-- Add Button helper (this is optional) -->
				<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/functions/fancybox/helpers/jquery.fancybox-buttons.css" />
				<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/functions/fancybox/helpers/jquery.fancybox-buttons.js"></script>
			
				<!-- Add Thumbnail helper (this is optional) -->
				<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/functions/fancybox/helpers/jquery.fancybox-thumbs.css" />
				<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/functions/fancybox/helpers/jquery.fancybox-thumbs.js"></script>
			
				<!-- Add Media helper (this is optional) -->
				<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/functions/fancybox/helpers/jquery.fancybox-media.js"></script>
				*/
	}
//dirname(__FILE__)
?>