<?php

	//General Metaboxes

	$prefix = 'wpbootstrap_';
	
	$custom_meta_fields = array(
		array(
			'label'	=> 'Slider',
			'desc'	=> 'Header slider of the page.',
			'id'	=> $prefix.'slider',
			'type'	=> 'post_list',
			'post_type' => array('slider')
		),
		array(
			'label'	=> 'Hide title',
			'desc'	=> 'Hide the title of the page',
			'id'	=> $prefix.'hide_title',
			'type'	=> 'checkbox'
		)
	);
	
	$My_meta_box = new My_meta_box('1','Page options', 'page','normal','high',$custom_meta_fields);
	$My_meta_box = new My_meta_box('2','Page options', 'post','normal','high',$custom_meta_fields);
	
?>