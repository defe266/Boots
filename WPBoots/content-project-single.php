<?php
/**
 * @package WPboots
 */
?>
<?php
					
	$video = get_post_meta($post->ID, 'wpb_portfolio_youtube',true);

		  	
  	//if its a video
  	if($video != '')
  	{
  	
  		$youtube = new YoutubeParser;
		$youtube->set('source', $video);
		
		$youtube_data = $youtube->getall();
		$front = $youtube_data[0]["embed"];
  	
  		//$front = '<iframe scrolling="auto" frameborder="0" class="img-polaroid" hspace="0" vspace="0" src="'.$video.'"></iframe>';
  		$left_cols = 6;					  		
  	}
  	else
  	{
  		$imgID = get_post_thumbnail_id();
		$img = wp_get_attachment_image_src($imgID, "full");
		
		$url = $img[0];
		$width = $img[1];
		
		$front = get_the_post_thumbnail($post->ID, 'full');
		
		
		if($width >= 670)
		{
			$left_cols = 7;
		}
		else
		{
			if($width >= 570)
			{
				$left_cols = 6;
			}
			else
			{
				if($width >= 370)
				{
					$left_cols = 4;
				}
				else
				{
					if($width >= 270)
					{
						$left_cols = 3;
					}
					else
					{
						if($width >= 150)
						{
							$left_cols = 2;
						}
						else
						{
							$left_cols = 1;
						}
					}
				}
			}
		}

  	}

							
	
	$right_cols = 12 - $left_cols;
?>

<div class="single-project">
	<div class="row">
		<div class="span<?php echo $left_cols; ?>">
			<div id="project_front">
				<div class="img-borders-container">
				  	<div class="img-borders img-polaroid">
						<?php echo $front; ?>
					</div>
				</div>
			</div>
			
			<!--<img src="<?php echo $url ?>" alt="<?php echo get_post_meta($imgID, '_wp_attachment_image_alt', true); ?>" class="attachment-post-thumbnail wp-post-image img-polaroid"/>-->
			
		</div>
		<div class="span<?php echo $right_cols; ?>">
			<?php get_template_part( 'content', 'page' ); ?>
		</div>
	</div>
</div>
