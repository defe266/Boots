<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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

					<?php get_template_part( 'content', 'page' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->
	

		<?php get_sidebar(); ?>
	</div>
</div><!-- .container (main) -->
	
<?php get_footer(); ?>