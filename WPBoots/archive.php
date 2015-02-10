<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */

get_header(); ?>

<div id="main_cont" class="container">
	<div class="row">
		<div id="primary" class="col-md-9">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php
							if ( is_day() ) :
								printf( __( 'Daily Archives: %s', 'wpboots' ), '<span>' . get_the_date() . '</span>' );
							elseif ( is_month() ) :
								printf( __( 'Monthly Archives: %s', 'wpboots' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
							elseif ( is_year() ) :
								printf( __( 'Yearly Archives: %s', 'wpboots' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
							else :
								_e( 'Archives', 'wpboots' );
							endif;
						?>
					</h1>
				</header>

				<?php //toolbox_content_nav( 'nav-above' ); ?>
				
				<div class="row">
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
	
						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to overload this in a child theme then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
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