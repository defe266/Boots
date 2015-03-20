<?php

/*Custom post*/
$args_labels = array(
	  'name' => 'Proyectos',
	  'singular_name' => 'Proyecto'
	  );
	  
	  $args = array(
	    'labels' => $args_labels,
	    'public' => true,
	    'publicly_queryable' => true,
	    'show_ui' => true,
	    'query_var' => true,
	    'rewrite' => true,
	    'capability_type' => 'post',
	    'hierarchical' => true,
	    'menu_position' => 20, // 5 - below Posts, 10 - below Media, 20 - below Pages, 60 - below first separator, 100 - below second separator
	    'supports' => array('title','editor','thumbnail', 'comments', 'page-attributes'),//thumbnail editor
	  'rewrite' => array(
	    'slug' => 'project',
	    'with_front' => FALSE
	  )
	);

register_post_type('project',$args);


/*Custom taxonomy*/
register_taxonomy("project-type", array("project"), array("hierarchical" => true, "label" => __("Project types", 'wpboots'), "singular_label" => __("Project type", 'wpboots'), "rewrite" => true)); 



$prefix = 'wpb_portfolio_';
	
$custom_meta_fields = array(
	array(
		'label'	=> 'Youtube video',
		'desc'	=> 'Copy & paste the youtube URL',
		'id'	=> $prefix.'youtube',
		'type'	=> 'text'
	),
	array(
		'label'	=> 'Hide excerpt',
		'desc'	=> 'Hide the excerpt below the thumbnail',
		'id'	=> $prefix.'excerpt',
		'type'	=> 'checkbox'
	),
	
	array(
		'label'	=> 'Galería',
		'desc'	=> '',
		'id'	=> $prefix.'gallery',
		'type'	=> 'gallery'
	),
	
	
	
);

$My_meta_box = new My_meta_box('wpb_portfolio_1','Project options', 'project','normal','high',$custom_meta_fields);




function portfolio_load_fancybox()
{
	if(is_page_template('template-portfolio.php') || is_tax( "project-type" ))
	{
		fancybox_enqueue();
	}
}

add_action('wp_enqueue_scripts', 'portfolio_load_fancybox');

?>