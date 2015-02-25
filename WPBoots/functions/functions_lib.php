<?php

function get_the_excerpt_max_charlength($excerpt,$charlength) {
	$output='';
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			$output .= mb_substr( $subex, 0, $excut );
		} else {
			$output .= $subex;
		}
		$output .= '[...]';
		
		return $output;
	} else {
		return $excerpt;
	}
}	

function the_excerpt_max_charlength($excerpt,$charlength) {
	echo get_the_excerpt_max_charlength($excerpt,$charlength);
}



//# funciones auxiliares para tratar con columasn de bootstrap

function wpboots_printCol($xs,$sm,$md,$lg,$content,$pos){
										
	?>
	
	<div class="col-xs-<?php echo $xs ?> col-sm-<?php echo $sm ?> col-md-<?php echo $md ?> col-lg-<?php echo $lg ?>">
	
		<?php echo $content; ?>
		
	</div>
	
	<?php
	
	
	if( $pos % (12/$lg) == 0 ){
				
		echo '<div class="clearfix visible-lg-block"></div>';
	}
	
	if( $pos % (12/$md) == 0 ){
		
		echo '<div class="clearfix visible-md-block"></div>';
	}
	
	if( $pos % (12/$sm) == 0 ){
		
		echo '<div class="clearfix visible-sm-block"></div>';
	}
	
	if( $pos % (12/$xs) == 0 ){
		
		echo '<div class="clearfix visible-xs-block"></div>';
	}
}

function wpboots_printColClearfix($xs,$sm,$md,$lg,$pos){

	
	if( $pos % (12/$lg) == 0 ){
				
		echo '<div class="clearfix visible-lg-block"></div>';
	}
	
	if( $pos % (12/$md) == 0 ){
		
		echo '<div class="clearfix visible-md-block"></div>';
	}
	
	if( $pos % (12/$sm) == 0 ){
		
		echo '<div class="clearfix visible-sm-block"></div>';
	}
	
	if( $pos % (12/$xs) == 0 ){
		
		echo '<div class="clearfix visible-xs-block"></div>';
	}
}

?>