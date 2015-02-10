<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Toolbox
 * @since Toolbox 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	
	<?php
			
		if(get_post_meta($post->ID,'wpbootstrap_hide_title',true) != 'on')
		{
			?>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->
			<?php
		}
	
	?>
	
		
	

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'wpboots' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'wpboots' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
