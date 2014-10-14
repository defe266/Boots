<?php
/**
 * The Template for displaying all single posts.
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


<div id="main_cont" class="container bg1">
	<div class="row">
		<div id="primary" class="col-md-9">
			<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php toolbox_content_nav( 'nav-above' ); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php toolbox_content_nav( 'nav-below' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->
	
		<?php get_sidebar(); ?>
	</div>
</div><!-- .container (main) -->

<?php get_footer(); ?>