<?php

//Bootstrap suport

//enqueue scritps and styles in all pages
add_action( 'wp_enqueue_scripts', 'bootstrap_enqueue' );

add_action( 'admin_enqueue_scripts', 'bootstrap_backend_enqueue' );


//Setup
add_action( 'after_setup_theme', 'bootstrap_setup' );

if ( ! function_exists( 'bootstrap_setup' ) ):

	function bootstrap_setup(){
/*
		add_action( 'init', 'register_menu' );

		function register_menu(){
			register_nav_menu( 'top-bar', 'Bootstrap Top Menu' ); 
		}
*/

		//categories list walker
		class Bootstrap_Walker_Category extends Walker_Category {
		 function start_el(&$output, $category, $depth, $args) {
				extract($args);
		 
				$cat_name = esc_attr( $category->name );
				$cat_name = apply_filters( 'list_cats', $cat_name, $category );
								
				if ( 'list' == $args['style'] ) {
					//$output .= $category->term_id;
					if ( !empty($current_category) ) 
					{
						$_current_category = get_term( $current_category, $category->taxonomy );
						
						if ( $category->term_id == $current_category )
							$class .=  ' current-cat active';
						elseif ( $category->term_id == $_current_category->parent )
							$class .=  ' current-cat-parent active';
					}
				}
				
				
				$link = '<li class="'.$class.'"><a href="' . esc_attr( get_term_link($category) ) .'"';
				//$link .= 'rel="'.$category->slug.'" ';
				$link .= '>'; 
				$link .= $cat_name . '</a></li>';
				
				$output .= $link;
			}
		}


		//menu walker
		class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {


			function start_lvl( &$output, $depth ) {

				$indent = str_repeat( "\t", $depth );

				$output	   .= "\n$indent<ul class=\"dropdown-menu\">\n";


			}

			function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

				$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

				$li_attributes = '';
				$class_names = $value = '';

				$classes = empty( $item->classes ) ? array() : (array) $item->classes;
				
				if($depth < 1)
				{
					$classes[] = ($args->has_children) ? 'dropdown' : '';
				}
				else
				{
					$classes[] = ($args->has_children) ? 'dropdown-submenu' : '';
				}
				
				//$classes[] = ($args->has_children) ? 'dropdown' : '';
				$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
				$classes[] = 'menu-item-' . $item->ID;


				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
				$class_names = ' class="' . esc_attr( $class_names ) . '"';

				$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
				$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

				$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
				$attributes .= ($args->has_children) 	    ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

				$item_output = $args->before;
				
				if($depth < 1)
				{
					$item_output .= '<a'. $attributes .'>';
					$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
					$item_output .= ($args->has_children) ? ' <b class="caret"></b></a>' : '</a>';
					$item_output .= $args->after;
				}
				else
				{
					$item_output .= '<a tabindex="-1" '. $attributes .'>';
					$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
					$item_output .= ($args->has_children) ? ' </a>' : '</a>';
					$item_output .= $args->after;
				}

				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}

			function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

				if ( !$element )
					return;

				$id_field = $this->db_fields['id'];

				//display this element
				if ( is_array( $args[0] ) ) 
					$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
				else if ( is_object( $args[0] ) ) 
					$args[0]->has_children = ! empty( $children_elements[$element->$id_field] ); 
				$cb_args = array_merge( array(&$output, $element, $depth), $args);
				call_user_func_array(array(&$this, 'start_el'), $cb_args);

				$id = $element->$id_field;

				// descend only when the depth is right and there are childrens for this element
				if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

					foreach( $children_elements[ $id ] as $child ){

						if ( !isset($newlevel) ) {
							$newlevel = true;
							//start the child delimiter
							$cb_args = array_merge( array(&$output, $depth), $args);
							call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
						}
						$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
					}
						unset( $children_elements[ $id ] );
				}

				if ( isset($newlevel) && $newlevel ){
					//end the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
				}

				//end this element
				$cb_args = array_merge( array(&$output, $element, $depth), $args);
				call_user_func_array(array(&$this, 'end_el'), $cb_args);

			}

		}


		//pagination
		//function bootstrap_pagination($pages = '', $range = 2)
		
		function bootstrap_pagination($custom_query = false)
		{	
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
						'prev_text'    => __('«'),
						'next_text'    => __('»'),
				    ) );
				
				
				if( is_array( $pages ) ) {
				    $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
				    echo '<ul class="pagination">';
				    foreach ( $pages as $page ) {
				    
				    	$extraClass = strrpos($page, "current")  ? "current active" : "";
				    	
				        echo '<li class="'.$extraClass.'">'.$page.'</li>';
				    }
				   echo '</ul>';
				}
		}

	}

endif;

?>