<?php
/**
 * Template Name: Blog
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
		<div id="primary" class="col-md-9">
			<div id="content" role="main">

			<?php 
			
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				query_posts( array( 'post_type' => 'post', 'paged' => $paged, 'posts_per_page' => 10, 'orderby' => 'date', 'order' => 'DESC') );
				
				if ( have_posts() ) : 
						
					  
			?>

				<div class="row">
									
					<?php //toolbox_content_nav( 'nav-above' ); ?>
	
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
	
						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to overload this in a child theme then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							//get_template_part( 'content', get_post_format() );
							get_template_part( 'content', 'post-excerpt' );
						?>
	
					<?php endwhile; ?>
				</div>
				
				<?php //toolbox_content_nav( 'nav-below' ); ?>
				<?php bootstrap_pagination(); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'wpboots' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'wpboots' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->
	

		<?php get_sidebar(); ?>

	</div><!-- .row (main) -->
</div><!-- .container (main) -->
	
<?php get_footer(); ?>