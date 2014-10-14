<?php

/*Custom post*/
$args_labels = array(
	  'name' => __('Banners', 'wpboots'),
	  'singular_name' => __('Banner', 'wpboots'),
	  'add_new' => __('Add banner', 'wpboots'),
	  'add_new_item' => __('Add banner', 'wpboots'),
	  'edit_item' => __('Edit banner', 'wpboots'),
	  'new_item' => __('Add banner', 'wpboots'),
	  'view_item' => __('See proyecto', 'wpboots'),
	  'search_items' => __('Find banner', 'wpboots'),
	  'not_found' =>  __('No banners', 'wpboots'),
	  'not_found_in_trash' => __('No banners', 'wpboots'),
	  'parent_item_colon' => ''
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
	    'supports' => array('title','editor','thumbnail', 'page-attributes'),//thumbnail editor
	  'rewrite' => array(
	    'slug' => 'banner',
	    'with_front' => FALSE
	  )
	);

register_post_type('banner',$args);


/*Custom taxonomy*/
register_taxonomy("banner-type", array("banner"), array("hierarchical" => true, "label" => __("banner types", 'wpboots'), "singular_label" => __("banner type", 'wpboots'), "rewrite" => true)); 



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