<?php
/**
 * Template Name: Full-width, no sidebar
 * Description: A full-width template with no sidebar
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

				<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->
	</div>
</div><!-- .container (main) -->

<?php get_footer(); ?>