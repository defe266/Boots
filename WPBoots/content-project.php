<?php
/**
 * @package WPboots
 */
?>

<?php

	$size = 'thumb-standar';


//##### Generate thumbnail #####
									  	
  	$video = get_post_meta($post->ID, 'wpb_portfolio_youtube',true);

  	
  	//if its a video
  	if($video != '')
  	{
  		$youtube = new YoutubeParser;
		$youtube->set('source', $video);
		
		$youtube_data = $youtube->getall();
		

		$youtube_thumb = $youtube_data[0]["hqthumb"];
		$youtube_src = $youtube_data[0]["embed_src"];
		
  		
  		//if has thumbnail
  		if(get_post_thumbnail_id($post->ID))
  		{
  			$thumb = '<div class="img-borders-container">
  						<div class="img-borders img-polaroid">
  							<a class="" href="'.get_permalink($post->ID).'" >
		  			 		'.get_the_post_thumbnail($post->ID, $size).'
		  			 		</a>
		  			 	</div>
		  			 </div>';
  		}
  		else
  		{
  			$thumb = '<div class="img-borders-container">
  						<div class="img-borders img-polaroid">
  							<a class="" href="'.get_permalink($post->ID).'" >
		  			 			<img class="wp-post-image" src="'.$youtube_thumb.'" />
		  			 		</a>
		  			 	</div>
		  			 </div>';
  		}
  	}
  	else// its a image
  	{
  		//if has thumbnail
  		if(get_post_thumbnail_id($post->ID))
  		{
  			$large_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),"full");

	  		$thumb = '<div class="img-borders-container">
  						<div class="img-borders img-polaroid">
  							<a class="" href="'.get_permalink($post->ID).'" >
		  			 		'.get_the_post_thumbnail($post->ID, $size).'
		  			 		</a>
		  			 	</div>
		  			 </div>';
  		}
  		else
  		{
  			$thumb = "";
  		}
  	}
  	
  	
  	//##### Generate element #####

  	$elm = '<article id="post-'.$post->ID.'" class="project post format-standard hentry">
  			 	'.$thumb.'
  			 	<header class="project-header">
	  			 	<h4 class="project-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h4>
            <h5 class="project-subtitle">'.get_post_meta($post->ID, 'wpb_portfolio_subtitle', true).'</h5>
	  			</header>';
	  			 
	  			//if excepts are not hide
				if(get_post_meta($post->ID, 'wpb_portfolio_excerpt',true) != 'on') $elm .= '<div class="project-excerpt">'.get_the_excerpt().'</div>'; 
  			 	
  	$elm .=		'<a rel="bookmark" class="btn" title="'.get_the_title().'" href="'.get_permalink().'">'.__('View project', 'wpboots').'</a>
  			 </article>';
  			 
  			 
  	echo $elm;


?>
