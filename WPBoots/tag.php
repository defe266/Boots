<?php
/**
 * The template used to display Tag Archive pages
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
					<h1 class="page-title"><?php
                              printf( __( 'Tag Archives: %s', 'wpboots' ), '<span>' . single_tag_title( '', false ) . '</span>' );
                         ?></h1>

                         <?php
                              $tag_description = tag_description();
                              if ( ! empty( $tag_description ) )
                                   echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
                         ?>

				</header>

				<?php //toolbox_content_nav( 'nav-above' ); ?>

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