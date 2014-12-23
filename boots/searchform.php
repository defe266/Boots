<?php
/**
 * The template for displaying search forms
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<!--
		<div class="input-append">
          <input type="text" class="field span2" size="16" name="s" id="s"/>
          <button id="searchsubmit" name="submit" class="submit btn" type="submit"><?php _e( 'Search', 'wpboots' ); ?></button>
        </div>
        -->
        
        
        <div class="input-group">
          <input type="text" class="form-control field" size="16" name="s" id="s"/>
          <span class="input-group-btn">
            <button id="searchsubmit" name="submit" class="submit btn btn-default" type="submit"><?php _e( 'Search', 'wpboots' ); ?></button>
          </span>
        </div>
        
	</form>
