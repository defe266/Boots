<?php get_header(); ?>

<?php //echo do_shortcode('[slider slug="home-2"][/slider]'); ?>


<div id="main_cont" class="onepage"> <!--container-->
	<div class="row">
		<div id="primary" class="col-md-12">
			<div id="content" role="main">
			
				
			<?php

					
				//create custom query for retrieve pages
				//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				query_posts( array( 'post_type' => 'page',
				
									'meta_query' => array(
										array(
											'key' => 'onepage_activate',
											'value' => 'on',
											'compare' => '=='
										)
									),
				
									'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC') );
			?>
			

			<?php if ( have_posts() ) : ?>
				
				<?php //toolbox_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						//get_template_part( 'content', get_post_format() );
						//get_template_part( 'content', 'single' );
						get_template_part( 'onepageContent', get_post_meta($post->ID,'onepage_type',true) );

						
						//onpage-page.php
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
						<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'wpboots' ); ?></p>
						<?php //get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->
	


	</div><!-- .row (main) -->
</div><!-- .container (main) -->
	
<?php get_footer(); ?>