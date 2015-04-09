<?php

/*Custom post*/

	  $args = array(
	    //'labels' => $args_labels,
	    'label' => 'Banners',// ocultamos de front y back -> con show_ui la reactivamos para el admin
	    'public' => false,
	    //'publicly_queryable' => true,
	    'show_ui' => true,
	    'query_var' => true,
	    'rewrite' => true,
	    'capability_type' => 'post',
	    'hierarchical' => true,
	    'menu_position' => 20, // 5 - below Posts, 10 - below Media, 20 - below Pages, 60 - below first separator, 100 - below second separator
	    'supports' => array('title','editor','thumbnail', 'page-attributes'),//thumbnail editor
	);

register_post_type('banner',$args);


/*Custom taxonomy*/
register_taxonomy("banner-type", array("banner"), array("hierarchical" => true, "label" => "banner types", 'wpboots', "singular_label" => "banner type", 'wpboots', "rewrite" => true)); 



$prefix = 'wpb_banners_';
	
$custom_meta_fields = array(
	array(
		'label'	=> 'Hide title',
		'desc'	=> 'Hide the title below the thumbnail',
		'id'	=> $prefix.'title',
		'type'	=> 'checkbox'
	),
	array(
		'label'	=> 'Subtitle',
		'desc'	=> 'Text to display below the main title.',
		'id'	=> $prefix.'subtitle',
		'type'	=> 'text'
	),
	array(
		'label'	=> 'URL',
		'desc'	=> 'Banner destination URL.',
		'id'	=> $prefix.'url',
		'type'	=> 'text'
	)/*,
	array( //! prueba a quitar
		'label'	=> 'File',
		'desc'	=> 'file description',
		'id'	=> $prefix.'file',
		'type'	=> 'file'
	)*/
);

$My_meta_box = new My_meta_box('wpb_banners_1','Banner options', 'banner','normal','high',$custom_meta_fields);



/*
function portfolio_load_fancybox()
{
	if(is_page_template('template-portfolio.php') || is_tax( "project-type" ))
	{
		fancybox_enqueue();
	}
}

add_action('wp_enqueue_scripts', 'portfolio_load_fancybox');
*/

?>