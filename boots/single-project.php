<?php
/**
 *  The Template for displaying all single projects.
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */

get_header(); ?>

<?php
	$slider_id = get_post_meta(get_the_ID(), 'wpbootstrap_slider', true);

	if ($slider_id != '')
	{
		echo do_shortcode('[slider id="'.$slider_id.'"]');
	}
?>

<div id="main_cont" class="container">
	<div class="row">
		<div id="primary" class="col-md-12">
			<div id="content" role="main">
			
				<!--################## Project categories ################-->
								
							
				<ul id="project-types" class="nav nav-pills">
				
					<?php
					
						wp_list_categories( array(
												'taxonomy' => 'project-type',
												/*'show_count' => 1,*/
												'title_li' => '',
												'show_option_none'   => '',
												'walker'	 => new Bootstrap_Walker_Category()
											));	
					?>
					
				</ul>


				<!--################## Project single ################-->
				

				<?php while ( have_posts() ) : the_post(); ?>

					<?php toolbox_content_nav( 'nav-above' ); ?>
					
					<?php get_template_part( 'content', 'project-single' ); ?>
					
					<?php toolbox_content_nav( 'nav-below' ); ?>
					
					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->
	</div>
</div><!-- .container (main) -->

<?php get_footer(); ?>