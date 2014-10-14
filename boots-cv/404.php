<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */

get_header(); ?>

<div id="main_cont" class="container bg1 text-center">
	<div class="row">
		<div id="primary" class="col-md-12">
			<div id="content" role="main">
	
				<article id="post-0" class="post error404 not-found">
					<header class="entry-header">
						

						<br>
						<h1 class="entry-title">
							404
							<br><br>
							<?php _e( 'Well this is somewhat embarrassing, isn&rsquo;t it?', 'wpboots' ); ?>
						</h1>
					</header>
	
					<div class="entry-content">
						<p><!--<?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'wpboots' ); ?>-->
						
							Parece que no encontramos lo que estás buscando.
						</p>
	
						<?php //get_search_form(); ?>
	
						
	
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->
	
			</div><!-- #content -->
		</div><!-- #primary -->
	</div>
</div> <!-- .container (main) -->
<?php get_footer(); ?>