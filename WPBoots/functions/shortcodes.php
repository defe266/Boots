<?php





//#################### Line break (BR) ####################

add_shortcode( 'br', 'short_br' );

function short_br() {
    
    $output =  '<br/>';

    return $output;
}



//#################### Rows and columns ####################

add_shortcode( 'row', 'short_row' );
add_shortcode( 'col', 'short_columns' );


function short_row($atts,$content) {

	extract( shortcode_atts( array(), $atts ) );
    
    $output =  '<div class="row">
			        	'.do_shortcode($content).'
				</div>';

    return $output;
}


function short_columns($atts,$content) {

	extract( shortcode_atts( array(
      'number' => '',
      'size' => 'md'
      ), $atts ) );

    
    $output =  '<div class="col-'.$size.'-'.$number.'">
			        	'.do_shortcode($content).'
				</div>';

    return $output;
}



//#################### Buttons ####################

add_shortcode( 'button', 'short_button' );

function short_button($atts,$content) {

	extract( shortcode_atts( array(
      'class' => '',
      'href' => '#',
      'target' => ''
    ), $atts ) );
    
    $output = '';
    
    $output = '<a href="'.$href.'" target="'.$target.'" class="btn btn-default'.$class.'" type="button">'.do_shortcode($content).'</a>';
        
    return $output;
}



//#################### Gallery ####################

//overide wordpress gallery shortcode
add_filter( 'post_gallery', 'wpbootstrap_gallery_shortcode', 10, 2 );


function wpbootstrap_gallery_shortcode($output, $attr) {
	global $post; //$wp_locale; ?

	//load fancybox scripts and styles
	//add_action( 'wp_enqueue_scripts', 'fancybox_enqueue' );
	//fancybox_enqueue();
	photoswipe_enqueue();

	static $instance = 0;
	$instance++;

	// Allow plugins/themes to override the default gallery template.
	/*$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;*/

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = $gallery_div = '';
	if ( apply_filters( 'use_default_gallery_style', true ) )
		/*$gallery_style = "
		<style type='text/css'>
			#{$selector} {
				margin: auto;
			}
			#{$selector} .gallery-item {
				float: {$float};
				margin-top: 10px;
				text-align: center;
				width: {$itemwidth}%;
			}
			#{$selector} img {
				border: 2px solid #cfcfcf;
			}
			#{$selector} .gallery-caption {
				margin-left: 0;
			}
		</style>
		<!-- see gallery_shortcode() in wp-includes/media.php -->";
		*/
	$size_class = sanitize_html_class( $size );
	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
	$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );
	/*
	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

		//$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "<{$itemtag} class='gallery-item span3 Gallery_item'>";
		$output .= "
			<{$icontag} class='gallery-icon'>
				$link
			</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
		if ( $columns > 0 && ++$i % $columns == 0 )
			$output .= '<br style="clear: both" />';
	}

	$output .= "
			<br style='clear: both;' />
		</div>\n";
	*/
	
	
	//Columns output	
	

	//divisible
	if(($columns < 5) || ($columns == 12))
	{
		$span_cols = 12/$columns;
	}
	else
	{
		$span_cols = 2;
		$columns = 6;
	}
	
	
	$size = 'thumb'.$span_cols;	
	$max_col = $columns;
	$col = -1;
	//$mes_en_curso = 0;
	
	foreach ( $attachments as $id => $attachment ) {								
			
			//$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
			
	  		$img = wp_get_attachment_image_src($id, $size);
		  	
		  	$img_full = wp_get_attachment_image_src($id, "full");
		  	//$img_full = $img_full[0];
		  	
		  	$link = '<a class="fancybox" data-fancybox-group="'.$selector.'" href="'.$img_full[0].'" data-img-width="'.$img_full[1].'" data-img-height="'.$img_full[2].'">
				  		<img class="attachment-Gallery-thumb " src="'.$img[0].'" alt="img-Gallery">
					</a>';
		  	
		  	$elm = '<div class="Gallery_item col-md-'.$span_cols.'">
						<div class="img-borders-container">
							<div class="img-borders img-polaroid">'. $link. '</div>
						</div>
						<span class="Gallery-quote">' .$attachment->post_excerpt . '</span>
					</div>';

			//If its the first
			if($col == -1)
			{
				$col = 1;
				
				$output .= '<div class="row">';
				$output .= $elm;
			}
			else
			{
				//if columns exceeded
				if($col == $max_col)
				{
					$col=1;
					
					$output .= '</div>';
					$output .= '<div class="row">';
					$output .= $elm;
				}
				else
				{
					$col++;
					
					$output .= $elm;
				}
			}
	}
			
		
	//if the last isn't closed
	$output .= '</div>';
	
	
	
	//end gallery container
	$output .= '</div>';
	

	return $output;
}



//#################### Code ####################

add_shortcode( 'code', 'short_code' );

function short_code($atts,$content) {

	extract( shortcode_atts( array(
      'inline' => false,
      'numbers' => false,
      'scroll' => false
    ), $atts ) );
    
    $output = '';
    
    if($inline)
    {
    	$output .= '<code>'.$content.'</code>';
    }
    else
    {
    	//enqueue google code prettify scripts and styles
    	//add_action( 'wp_enqueue_scripts', 'google_code_prettify_enqueue' );
    	
    	google_code_prettify_enqueue();
    	
    	$class = "";
    	
    	if($numbers)
    	{
    		$class .= " linenums";
    	}

    	if($scroll)
    	{
    		$class .= " pre-scrollable";
    	}
    	
    	$output .= '<pre class="prettyprint'.$class.'">'.$content.'</pre>';
    }
    
    return $output;
}




//#################### Banners display ####################

add_shortcode( 'banners', 'short_banners' );

function short_banners($atts,$content) {

	//global $wpdb, $post, $table_prefix;
	global $post;

	extract( shortcode_atts( array(
      'columns' => 3,
      'size' => '',
      'category' => ''
    ), $atts ) );


    
    //divisible?
	if(($columns < 5) || ($columns == 12))
	{
		$span_cols = 12/$columns;
	}
	else
	{
		$span_cols = 2;
		$columns = 6;
	}
	
	
	
	//thumb size
	
	if($size == '')
	{
		$size = 'thumb'.$span_cols;
	}

	
    
    
    
    $output = '';
    
    
    $output .= '<section id="banners_section" class="row">';
					

		query_posts( array( 'post_type' => 'banner', 'banner-type' => $category, 'posts_per_page' => $columns, 'orderby' => 'menu_order', 'order' => 'DESC') );
		
		while ( have_posts() ) : the_post();
		
		
			$bannerURL = get_post_meta($post->ID, 'wpb_banners_url', true);


			$output .= '<div class="col-sm-'.$span_cols.' col-md-'.$span_cols.'">
							<div class="banner">
								<div class="img-borders-container">
										<div class="img-borders img-polaroid">
											<a href="'.$bannerURL.'">'.get_the_post_thumbnail($post->ID,$size).'</a>
										</div>
								</div>';
								
								//if title are not hide
								if(get_post_meta($post->ID, 'wpb_banners_title',true) != 'on'){
								
									if($bannerURL != ''){
									
										$output .= '<a href="'.$bannerURL.'"><h2>'.get_the_title().'</h2></a>';
										
									}else{
									
										$output .= '<h2>'.get_the_title().'</h2>';
									}
								} 
								
								
					$output .= '<h5>'.get_post_meta($post->ID, 'wpb_banners_subtitle', true).'</h5>
								<div class="banner_content">
									'.get_the_content().'
								</div>
							</div>
						</div>';
						
			/*
			$content = $queried_post->post_content;
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]&gt;', $content);

			*/
	

		endWhile;
		
		wp_reset_query();

	
	$output .= '</section>';
    
    
    
    
    return $output;
}
   
   
//#################### Last news display ####################

add_shortcode( 'news', 'short_news' );

function short_news($atts,$content) {

	global $post;

	extract( shortcode_atts( array(
      'columns' => 3,
      'thumbs' => false,
      'size' => '',
      'category' => ''
    ), $atts ) );

	//if($thumbs == 'false') $thumbs = false;
	//else if($thumbs || $thumbs == 'true') $thumbs = true;

    
    //divisible?
	if(($columns < 5) || ($columns == 12))
	{
		$span_cols = 12/$columns;
	}
	else
	{
		$span_cols = 2;
		$columns = 6;
	}
	
	
	
	//thumb size
	
	if($size == '')
	{
		$size = 'thumb'.$span_cols;
	}

    
    
    $output = '';
    
    
    $output .= '<section id="news_section" class="row">';
					

		query_posts( array( 'post_type' => 'post', 'category_name' => $category, 'posts_per_page' => $columns, 'ignore_sticky_posts' => 1, 'orderby' => 'date', 'order' => 'DESC') );
		
		
		
		while ( have_posts() ) : the_post();
		
		
			$bannerURL = get_post_meta($post->ID, 'wpb_banners_url', true);


			$output .= '<div class="col-md-'.$span_cols.'">
							<div class="new">';
							
					if($thumbs)
					{
						$output .= '<div class="img-borders-container">
										<div class="img-borders img-polaroid">
											<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID,$size).'</a>
										</div>
									</div>';
					}

					$output .= '<a href="'.get_permalink().'"><h2>'.get_the_title().'</h2></a>';
								
								
					$output .= '<div class="new_content">
									'.get_the_excerpt().'
								</div>
							</div>
						</div>';
	

		endWhile;
		
		wp_reset_query();

	
	$output .= '</section>';
    
    
    
    
    return $output;
}



//#################### Projects display ####################

add_shortcode( 'projects', 'short_projects' );

function short_projects($atts,$content) {

	//global $wpdb, $post, $table_prefix;
	global $post;

	extract( shortcode_atts( array(
      'columns' => 3,
      'size' => 'thumb-standar',
      'category' => '',
      'orderby' => 'date',
      'order' => 'DESC',
      'slideshow' => false
    ), $atts ) );


	if($slideshow) fancybox_enqueue();

    
    //divisible?
	if(($columns < 5) || ($columns == 12))
	{
		$span_cols = 12/$columns;
	}
	else
	{
		$span_cols = 2;
		$columns = 6;
	}
	
	
	//thumb size
	/*
	if($size == '')
	{
		$size = 'thumb'.$span_cols;
	}*/

	
    
    
    
    $output = '';
    
    
    $output .= '<section id="projects_section" class="row">';
					
		
		$r = new WP_Query(array( 'post_type' => 'project', 'project-type' => $category, 'posts_per_page' => $columns, 'orderby' => $orderby, 'order' => $order));
		
		while ($r->have_posts()) : $r->the_post();
		
		
			$video = get_post_meta($r->post->ID, 'wpb_portfolio_youtube',true);

  	
		  	//if its a video
		  	if($video != '')
		  	{
		  		$youtube = new YoutubeParser;
				$youtube->set('source', $video);
				
				$youtube_data = $youtube->getall();
				
		
				$youtube_thumb = $youtube_data[0]["hqthumb"];
				$youtube_src = $youtube_data[0]["embed_src"];
				
		  		
		  		//if has thumbnail
		  		if(get_post_thumbnail_id($r->post->ID))
		  		{
		  			$thumb = '<div class="img-borders-container">
		  						<div class="img-borders img-polaroid">';
		  						
		  							if($slideshow)
		  								$thumb .= '<a class="fancybox fancybox.iframe" data-fancybox-group="gallery-shortcode" href="'.$youtube_src.'" >';
		  								
				  			 		$thumb .= get_the_post_thumbnail($r->post->ID, $size);
				  			 		
				  			 		if($slideshow)
		  								$thumb .= '</a>';
		  								
				  	  $thumb .='</div>
				  			 </div>';
		  		}
		  		else
		  		{
		  			$thumb = '<div class="img-borders-container">
		  						<div class="img-borders img-polaroid">';
		  						
			  						if($slideshow)
		  								$thumb .= '<a class="fancybox fancybox.iframe" data-fancybox-group="gallery-shortcode" href="'.$youtube_src.'" >';
		  							
				  			 		$thumb .= '<img class="wp-post-image" src="'.$youtube_thumb.'" />';
				  			 			
				  			 		if($slideshow)
		  								$thumb .= '</a>';
		  								
				  	 $thumb .= '</div>
				  			 </div>';
		  		}
		  	}
		  	else// its a image
		  	{
		  		//if has thumbnail
		  		if(get_post_thumbnail_id($r->post->ID))
		  		{
		  			$large_img = wp_get_attachment_image_src(get_post_thumbnail_id($r->post->ID),"full");
		
			  		$thumb = '<div class="img-borders-container">
		  						<div class="img-borders img-polaroid">';
		  						
		  							if($slideshow)
		  								$thumb .= '<a class="fancybox" data-fancybox-group="gallery-shortcode" href="'.$large_img[0].'" >';
		  								
				  			 		$thumb .= get_the_post_thumbnail($r->post->ID, $size);
				  			 		
				  			 		if($slideshow)
		  								$thumb .= '</a>';
		  								
				  	 $thumb .= '</div>
				  			 </div>';
		  		}
		  		else
		  		{
		  			$thumb = "";
		  		}
		  	}
		  	
		  	
		  	//##### Generate element #####
		
		  	$elm = '<article id="post-'.$r->post->ID.'" class="project post format-standard hentry">
		  			 	'.$thumb.'
		  			 	<header class="project-header">
			  			 	<h4 class="project-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h4>
			  			</header>';
			  			 
			  			//if excepts are not hide
						if(get_post_meta($r->post->ID, 'wpb_portfolio_excerpt',true) != 'on') $elm .= '<div class="project-excerpt">'.get_the_excerpt().'</div>'; 
		  			 	
		  	$elm .=		'<a rel="bookmark" class="btn" title="'.get_the_title().'" href="'.get_permalink().'">'.__('Read more', 'wpboots').'</a>
		  			 </article>';
		  			 
		  		
		  		
		  	
		  			 
		  	$output .= '<div class="col-md'.$span_cols.'">'.$elm.'</div>';
		
		
		
		/*
			$bannerURL = get_post_meta($r->post->ID, 'wpb_banners_url', true);


			$output .= '<div class="span'.$span_cols.'">
							<div class="banner">
								<div class="img-borders-container">
										<div class="img-borders img-polaroid">
											<a href="'.$bannerURL.'">'.get_the_post_thumbnail($r->post->ID,$size).'</a>
										</div>
								</div>';
								
								//if title are not hide
								if(get_post_meta($r->post->ID, 'wpb_banners_title',true) != 'on') $output .= '<a href="'.$bannerURL.'"><h2>'.get_the_title().'</h2></a>';
								
								
					$output .= '<h5>'.get_post_meta($r->post->ID, 'wpb_banners_subtitle', true).'</h5>
								<div class="banner_content">
									'.get_the_content().'
								</div>
							</div>
						</div>';
			*/			
			/*
			$content = $queried_post->post_content;
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]&gt;', $content);

			*/
	

		endWhile;
		
		wp_reset_query();

	
	$output .= '</section>';
    
    
    
    
    return $output;
}


//#################### elastislide ####################

add_shortcode( 'elastislide', 'short_elastislide' );

function short_elastislide($atts) {
    
    extract( shortcode_atts( array(
      'columns' => -1,
      'post_type' => 'post',
      'size' => 'thumb-standar',
      'orderby' => 'date',
      'order' => 'DESC',
    ), $atts ) );
    
    
    
    
    elastislide_enqueue();
    
	$r = new WP_Query(array( 'post_type' => $post_type, 'posts_per_page' => $columns, 'ignore_sticky_posts' => 1, 'orderby' => $orderby, 'order' => $order));
	
    $output =  '';
    
    $output .=  '<div class="elastislideContainer demo-1">';
	    $output .=  '<ul id="carousel" class="elastislide-list">';
				
			//while ( have_posts() ) : the_post();
			while ($r->have_posts()) : $r->the_post();
			
				$thumb = '';
				
				
				$video = get_post_meta($r->post->ID, 'wpb_portfolio_youtube',true);

			  	//if its a video
			  	if($video != '' && $size == 'thumb-standar'){

			  		$youtube = new YoutubeParser;
					$youtube->set('source', $video);
					
					$youtube_data = $youtube->getall();
					
					$youtube_thumb = $youtube_data[0]["hqthumb"];
					$youtube_src = $youtube_data[0]["embed_src"];
					
					$thumb .= '<img class="wp-post-image" src="'.$youtube_thumb.'" />';
					
					//if has thumbnail
			  		if(has_post_thumbnail($r->post->ID)){

			  			$thumb = get_the_post_thumbnail($r->post->ID, $size);
			  		}
			  	}
			  	else{

					if(has_post_thumbnail($r->post->ID)){
			  			$thumb = get_the_post_thumbnail($r->post->ID, $size);
			  		}
			  	}

			
		
				if($thumb != ''){
					$output .= '<li><a href="'.get_permalink().'">';
		
						$output .= $thumb;//get_the_post_thumbnail($r->post->ID, 'thumb-standar');//$size);  array(150,150));
						
						$output .= '</a>';
						$output .= '<h4 class="project-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
					$output .= '</li>';
				}
		
			endWhile;
	
		$output .=  '</ul>';
	$output .=  '</div>';
   
	wp_reset_query();

    return $output;
}

?>