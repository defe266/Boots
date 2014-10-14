<?php
/**
 * @package WPboots
 */
?>


<div class="single-project">
	<div class="row">
		
		<div class="">
			<?php get_template_part( 'content', 'page' ); ?>
			
			<?php

				$gallery = explode(',', get_post_meta($post->ID,'wpb_portfolio_gallery',true));


				foreach( $gallery as $img ){ ?>

					<?php echo wp_get_attachment_image( $img, 'full', false, array('class' => 'img-responsive') ); ?>

			<?php } ?>
			
			
		</div>
	</div>
</div>
