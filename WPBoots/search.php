<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */

get_header(); ?>

<div id="main_cont" class="container">
	<div class="row">
		<div id="primary" class="span9">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'wpboots' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>

				<?php toolbox_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php //get_template_part( 'content', 'search' ); ?>
					
					<?php get_template_part( 'content', 'post-excerpt' ); ?>
					

				<?php endwhile; ?>

				<?php toolbox_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'wpboots' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'wpboots' ); ?></p>
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