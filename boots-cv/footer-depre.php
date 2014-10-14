<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */
?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">
		<div id="footer_content">
			<div class="container">
				<div class="row">
					<div class="span4">

						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-1') ) : ?>
			            <?php endif; ?>

					</div>
					<div class="span4">

						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-2') ) : ?>
			            <?php endif; ?>

					</div>
					<div class="span4">

						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-3') ) : ?>
			            <?php endif; ?>

					</div>
				</div>
			</div>
		</div>
		
		<div id="subfooter_content">
			<div class="container">
			
			</div>
		</div>
		
		<div id="creditos">
			<div class="container">
				
			</div>
		</div>
	
	</footer><!-- #colophon -->
	
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>