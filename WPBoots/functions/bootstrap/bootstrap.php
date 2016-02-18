<?php

	
	//## define enqueues
	function bootstrap_enqueue(){
	
		wp_enqueue_style("bootstrap", get_template_directory_uri().'/functions/bootstrap/css/bootstrap.min.css');
		
		wp_enqueue_script("bootstrap", get_template_directory_uri().'/functions/bootstrap/js/bootstrap.min.js', array("jquery"));
		wp_enqueue_script("bootstrap-touch-carousel", get_template_directory_uri().'/functions/bootstrap/lib/bootstrap-touch-carousel.js', array("bootstrap"));
	}


	function bootstrap_backend_enqueue(){
		wp_enqueue_style("bootstrap_backend", get_template_directory_uri().'/functions/bootstrap/backend/css/bootstrap_wrap.css');
		wp_enqueue_script("bootstrap_backend", get_template_directory_uri().'/functions/bootstrap/backend/js/bootstrap.js', array("jquery"));
	}
	
	
	//## define walker for menu
	require_once('wp_bootstrap_navwalker.php');
	

	
	//## enqueue scritps and styles in all pages
	add_action( 'wp_enqueue_scripts', 'bootstrap_enqueue' );
	
	add_action( 'admin_enqueue_scripts', 'bootstrap_backend_enqueue' );
	
	
	
	
	//## Pagination
	
	function bootstrap_pagination($custom_query = false){	
		/*  
	     $showitems = ($range * 2)+1;  
	
	     global $paged;
	     if(empty($paged)) $paged = 1;
	
	     if($pages == '')
	     {
	         global $wp_query;
	         $pages = $wp_query->max_num_pages;
	         if(!$pages)
	         {
	             $pages = 1;
	         }
	     }   
	
	     if(1 != $pages)
	     {
	         echo "<div class='pagination-container'><ul class='pagination'>";
	         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
	         if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";
	
	         for ($i=1; $i <= $pages; $i++)
	         {
	             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
	             {
	                 echo ($paged == $i)? "<li class='current active'><a href='#'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
	             }
	         }
	
	         if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";  
	         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
	         echo "</ul></div>\n";
	     }
	     */
	     
	     	if( $custom_query ){
	     	
	     	
		    	$wp_query = $custom_query;
		    	
	     	}else{
	     	
	     		global $wp_query;
		     	
	     	}
		 	
											
			$big = 999999999; // need an unlikely integer
			$pages = paginate_links( array(
			        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			        'format' => '?paged=%#%',
			        'current' => max( 1, get_query_var('paged') ),
			        'total' => $wp_query->max_num_pages,
			        'prev_next' => false,
			        'type'  => 'array',
			        'prev_next'   => TRUE,
					'prev_text'    => '«',//__('«','wpboots'),
					'next_text'    => '»'//__('»','wpboots'),
			    ) );
			
			
			if( is_array( $pages ) ) {
			    $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
			    echo '<ul class="pagination">';
			    foreach ( $pages as $page ) {
			    
			    	//if(strpos($page, 'prev') !== false) $page = substr_replace($page,' rel="prev" ',2,1);
				    //if(strpos($page, 'next') !== false) $page = substr_replace($page,' rel="next" ',2,1);
			    
			    	$extraClass = strrpos($page, "current")  ? "current active" : "";
			    	
			        echo '<li class="'.$extraClass.'">'.$page.'</li>';
			    }
			   echo '</ul>';
			}
	}
	
	
	
	//# add responsive filter to embed videos
	function bootstrap_wrap_oembed( $html ){
	
	  $html = preg_replace( '/(width|height)="\d*"\s/', "", $html ); // Strip width and height #1
	  return'<div class="embed-responsive embed-responsive-16by9">'.$html.'</div>'; // Wrap in div element and return #3 and #4
	  
	}
	
	add_filter( 'embed_oembed_html','bootstrap_wrap_oembed',10,1);

?>