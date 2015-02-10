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

?>