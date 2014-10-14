<?php
/**
 * The template for displaying search forms
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">

		<div class="input-append">
          <input type="text" class="field span2" size="16" name="s" id="s"/>
          <button id="searchsubmit" name="submit" class="submit btn" type="submit"><?php _e( 'Search', 'wpboots' ); ?></button>
        </div>
        
	</form>
