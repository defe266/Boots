<?php
/**
 * Template Name: Portfolio
 * Description: A portfolio template with no sidebar
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
				
				
					
					<?php
					
						$title = get_the_title();

						//change post per page on the default query
						$custom_query = wp_parse_args($query_string);
						$custom_query['post_type'] = get_post_type( get_the_ID() );
						$custom_query['posts_per_page'] = 12;
						query_posts($custom_query);
						
						if ( have_posts() ) :
	
					?>
						<section id="gallery-1">
						
							<header class="entry-header">
								<h1 class="entry-title">
									<?php printf( __( 'Category Archives: %s', 'wpboots' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
								</h1>
							</header><!-- .entry-header -->
					
					
					
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

					
					
							<!--################## List of projects ################ -->


							<?php
							
								
							
								$columns = 4;
							
								//divisible
								if(($columns < 5))
								{
									$span_cols = 12/$columns;
								}
								else
								{
									$span_cols = 2;
									$columns = 6;
								}
								
								
								$size = 'thumb-standar';	
								$max_col = $columns;
								$col = -1;
								$mes_en_curso = 0;
								
								while ( have_posts() ) : the_post();  	
									  	
									  	//##### Generate columns and insert element #####

										//If its the first
										if($col == -1)
										{
											$col = 1;
											
											echo '<div class="row-fluid">';
												echo '<div class="span'.$span_cols.'">';
														get_template_part( 'content', 'project' );
												echo '</div>';
										}
										else
										{
											//if columns exceeded
											if($col == $max_col)
											{
												$col=1;
												
												echo '</div>';
												echo '<div class="row-fluid">';
													echo '<div class="span'.$span_cols.'">';
														get_template_part( 'content', 'project' );
													echo '</div>';
											}
											else
											{
												$col++;
												
												echo '<div class="span'.$span_cols.'">';
													get_template_part( 'content', 'project' );
												echo '</div>';
											}
										}
										
										
								endwhile; // end of the loop.
										
									
								//if the last isn't closed
								echo '</div>';
							
							
							?>
	
						</section><!-- gallery-1 -->	
						
						
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
	</div>
</div><!-- .container (main) -->

<?php get_footer(); ?>