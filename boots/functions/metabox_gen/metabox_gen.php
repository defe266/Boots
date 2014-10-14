<?php

class My_meta_box {
		
		protected $id;
		protected $title; 
		// $callback
		protected $page;
		protected $context;
		protected $priority;
		protected $fields;
		
		function __construct($id,$title,$page,$context,$priority,$fields)
		{ 
	      	 $this->id = $id;
	      	 $this->title = $title;
	      	 $this->page = $page;
	      	 $this->context = $context;
	      	 $this->priority = $priority;
	      	 $this->fields = $fields;
	      	 
	      	 
	      	 //add_action('add_meta_boxes', 'add_custom_meta_box');
	      	 add_action('add_meta_boxes', array($this, 'add_custom_meta_box'));
	      	 
	      	 
	      	add_action('admin_enqueue_scripts', array($this, 'metabox_gen_scripts'));
			
			// add some custom js to the head of the page
			add_action('admin_head',array($this, 'add_custom_scripts'));
			
			
			//!! comento porque quita todas las cajas de categorías... estudiar razones: http://wp.tutsplus.com/tutorials/reusable-custom-meta-boxes-part-2-advanced-fields/
			//add_action( 'admin_menu' , array($this, 'remove_taxonomy_boxes' ));
			
			add_action('save_post', array($this, 'save_custom_meta'));
	      	 
   		}
   		
   		
   		
   		function metabox_gen_scripts() 
   		{
			if(is_admin()) 
			{
	      	 	wp_enqueue_script('jquery');
	      	 	wp_enqueue_script('jquery-ui-core');//,'',array('jquery')
				wp_enqueue_script('jquery-ui-datepicker');
				wp_enqueue_script('jquery-ui-slider');
				wp_enqueue_script('jquery-ui-sortable');
				
				
				wp_enqueue_style( 'chosen', get_template_directory_uri().'/functions/metabox_gen/lib/chosen/chosen.min.css');
				wp_enqueue_script('chosen', get_template_directory_uri().'/functions/metabox_gen/lib/chosen/chosen.jquery.min.js', array('jquery') );
				
				
				wp_enqueue_script('custom-js', get_template_directory_uri().'/functions/metabox_gen/js/custom-js.js', array('chosen','jquery-ui-datepicker'));
				wp_enqueue_style('jquery-ui-custom', get_template_directory_uri().'/functions/metabox_gen/css/jquery-ui-custom.css');

				
				
			}
		}
		
		

   		
   		
   		// Add the Meta Box

	
   		
   		
   		
   		function add_custom_meta_box() {
		    add_meta_box(
				$this->id,
				$this->title,
				//'show_custom_meta_box', // $callback
				array( $this, 'show_custom_meta_box' ),
				$this->page,
				$this->context,
				$this->priority
				); 
		}
   		
   		
   		
		// enqueue scripts and styles, but only if is_admin
		
		function add_custom_scripts() {
			global $post;
			
			$custom_meta_fields = $this->fields;
			
			$output = '<script type="text/javascript">
						jQuery(function() {';
			
			foreach ($custom_meta_fields as $field) { // loop through the fields looking for certain types
				// date
				if($field['type'] == 'date')
					$output .= 'jQuery(".datepicker").datepicker();';
				// slider
				if ($field['type'] == 'slider') {
					$value = get_post_meta($post->ID, $field['id'], true);
					if ($value == '') $value = $field['min'];
					$output .= '
							jQuery( "#'.$field['id'].'-slider" ).slider({
								value: '.$value.',
								min: '.$field['min'].',
								max: '.$field['max'].',
								step: '.$field['step'].',
								slide: function( event, ui ) {
									jQuery( "#'.$field['id'].'" ).val( ui.value );
								}
							});';
				}
			}
			
			$output .= '});
				</script>';
				
			echo $output;
			
			
			
			
			
		}
		
   		
   		
   		
   		// The Callback
		function show_custom_meta_box($post) {
				$custom_meta_fields = $this->fields;
				
				// Use nonce for verification
				echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
				
				// Begin the field table and loop
				echo '<table class="form-table custom_meta_box">';
				//var_dump($metabox);
				//var_dump($custom_meta_fields);
				foreach ($custom_meta_fields as $field) {
				
					// get value of this field if it exists for this post
					$meta = get_post_meta($post->ID, $field['id'], true);
					// begin a table row with
					echo '<tr>
							<th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
							<td>';
							switch($field['type']) {
								// text
								case 'text':
									echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
											<br /><span class="description">'.$field['desc'].'</span>';
								break;
								// textarea
								case 'textarea':
									echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
											<br /><span class="description">'.$field['desc'].'</span>';
								break;
								// checkbox
								case 'checkbox':
									echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
											<label for="'.$field['id'].'">'.$field['desc'].'</label>';
								break;
								// select
								case 'select':
									echo '<select name="'.$field['id'].'" id="'.$field['id'].'"  ' , $field['chosen'] ? 'class="chosen"' : '' , '>';
									foreach ($field['options'] as $option) {
										echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
									}
									echo '</select><br /><span class="description">'.$field['desc'].'</span>';
								break;
								// radio
								case 'radio':
									foreach ( $field['options'] as $option ) {
										echo '<input type="radio" name="'.$field['id'].'" id="'.$option['value'].'" value="'.$option['value'].'" ',$meta == $option['value'] ? ' checked="checked"' : '',' />
												<label for="'.$option['value'].'">'.$option['label'].'</label><br />';
									}
									echo '<span class="description">'.$field['desc'].'</span>';
								break;
								// checkbox_group
								case 'checkbox_group':
									foreach ($field['options'] as $option) {
										echo '<input type="checkbox" value="'.$option['value'].'" name="'.$field['id'].'[]" id="'.$option['value'].'"',$meta && in_array($option['value'], $meta) ? ' checked="checked"' : '',' /> 
												<label for="'.$option['value'].'">'.$option['label'].'</label><br />';
									}
									echo '<span class="description">'.$field['desc'].'</span>';
								break;
								// tax_select
								case 'tax_select':
									echo '<select name="'.$field['id'].'" id="'.$field['id'].'"  ' , $field['chosen'] ? 'class="chosen"' : '' , '>
											<option value="">Select One</option>'; // Select One
									$terms = get_terms($field['id'], 'get=all');
									$selected = wp_get_object_terms($post->ID, $field['id']);
									foreach ($terms as $term) {
										if (!empty($selected) && !strcmp($term->slug, $selected[0]->slug)) 
											echo '<option value="'.$term->slug.'" selected="selected">'.$term->name.'</option>'; 
										else
											echo '<option value="'.$term->slug.'">'.$term->name.'</option>'; 
									}
									$taxonomy = get_taxonomy($field['id']);
									echo '</select><br /><span class="description"><a href="'.get_bloginfo('home').'/wp-admin/edit-tags.php?taxonomy='.$field['id'].'">Manage '.$taxonomy->label.'</a></span>';
								break;
								// post_list
								case 'post_list':
								$items = get_posts( array (
									'post_type'	=> $field['post_type'],
									'posts_per_page' => -1
								));
									echo '<select name="'.$field['id'].'" id="'.$field['id'].'"  ' , $field['chosen'] ? 'class="chosen"' : '' , '>
											<option value="">Select One</option>'; // Select One
										foreach($items as $item) {
											echo '<option value="'.$item->ID.'"',$meta == $item->ID ? ' selected="selected"' : '','>'.$item->post_type.': '.$item->post_title.'</option>';
										} // end foreach
									echo '</select><br /><span class="description">'.$field['desc'].'</span>';
								break;
								// date
								case 'date':
									echo '<input type="text" class="datepicker" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
											<br /><span class="description">'.$field['desc'].'</span>';
								break;
								// slider
								case 'slider':
								$value = $meta != '' ? $meta : '0';
									echo '<div id="'.$field['id'].'-slider"></div>
											<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$value.'" size="5" />
											<br /><span class="description">'.$field['desc'].'</span>';
								break;
								// image
								case 'image':
									$image = get_template_directory_uri().'/images/image.png';	
									echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';
									if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium');	$image = $image[0]; }				
									echo	'<input name="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$meta.'" />
												<img src="'.$image.'" class="custom_preview_image" alt="" /><br />
													<input class="custom_upload_image_button button" type="button" value="Choose Image" />
													<small>&nbsp;<a href="#" class="custom_clear_image_button">Remove Image</a></small>
													<br clear="all" /><span class="description">'.$field['desc'].'</span>';
								break;
								// repeatable
								case 'repeatable':
									echo '<a class="repeatable-add button" href="#">+</a>
											<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
									$i = 0;
									if ($meta) {
										foreach($meta as $row) {
											echo '<li><span class="sort hndle">|||</span>
														<input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="'.$row.'" size="30" />
														<a class="repeatable-remove button" href="#">-</a></li>';
											$i++;
										}
									} else {
										echo '<li><span class="sort hndle">|||</span>
													<input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="" size="30" />
													<a class="repeatable-remove button" href="#">-</a></li>';
									}
									echo '</ul>
										<span class="description">'.$field['desc'].'</span>';
								break;
								//----------------------BEGIN ADD------
								// checkbox_group
								case 'checkbox_group_posts':
									//echo 'bingo';
								
									$items = get_posts( array (
										'post_type'	=> $field['post_type'],
										'posts_per_page' => -1
									));
									
									//var_dump($items);
									
									foreach ($items as $option) {

										echo '<input type="checkbox" value="'.$option->ID.'" name="'.$field['id'].'[]" id="'.$option->ID.'"',$meta && in_array($option->ID, $meta) ? ' checked="checked"' : '',' /> 
												<label for="'.$option->ID.'">'.$option->post_title.'</label><br />';
									}
									echo '<span class="description">'.$field['desc'].'</span>';
									
									/*
									foreach ($field['options'] as $option) {
										echo '<input type="checkbox" value="'.$option['value'].'" name="'.$field['id'].'[]" id="'.$option['value'].'"',$meta && in_array($option['value'], $meta) ? ' checked="checked"' : '',' /> 
												<label for="'.$option['value'].'">'.$option['label'].'</label><br />';
									}
									echo '<span class="description">'.$field['desc'].'</span>';*/
								break;
								
								// editor de texto avanzado
								case 'editor':
									wp_editor( $meta, $field['id'], array( 'textarea_name' => $field['id']/*, 'media_buttons' => false*/ ) );
									echo '<br /><span class="description">'.$field['desc'].'</span>';
								break;
								
								//list of users
								case 'users':
									$items = get_users();
									echo '<select name="'.$field['id'].'" id="'.$field['id'].'"  ' , $field['chosen'] ? 'class="chosen"' : '' , '>
											<option value="">Select One</option>'; // Select One
										foreach($items as $item) {
											echo '<option value="'.$item->ID.'"',$meta == $item->ID ? ' selected="selected"' : '','>'.$item->user_login.'</option>';
										} // end foreach
									echo '</select><br /><span class="description">'.$field['desc'].'</span>';
								break;
								
								//file upload
								case 'file':
	
									?>
										<script>
											(function($) {
											
												$(function() {
																				
													//if( 0 < $('#post_media').length ) {
													  $('form').attr('enctype', 'multipart/form-data');
													//} // end if
											
												});
											}(jQuery));
										</script>
									<?php
									
									//if(){
									//}else{
									
										//echo '<input id="'.$field['id'].'" type="file" name="post_media" value="" size="25" />';
										//var_dump($meta);
									//}
									
									
									$html = '<input id="'.$field['id'].'" name="'.$field['id'].'" type="file" value="" size="25" />';

									$html .= '<p class="description">';
									
									if( '' == $meta ) {
										$html .= __( 'You have no file attached to this post.', 'metabox_gen' );
									} else {
										$html .= $meta;
									} // end if
									
									$html .= '</p><!-- /.description -->';
							
									echo $html;



								break;
								
								//relaciones con posts, multiples
								case 'post_list_multiple':
								
									$items = get_posts( array (
										'post_type'	=> $field['post_type'],
										'posts_per_page' => -1
									));
									
									
									
									//$meta && in_array($option->ID, $meta) ? ' checked="checked"' : ''
									
										echo '<select name="'.$field['id'].'[]" id="'.$field['id'].'" multiple="multiple" ' , $field['chosen'] ? 'class="chosen"' : '' , '>';
											
											foreach($items as $item) {
											
												echo '<option value="'.$item->ID.'"', $meta && in_array($item->ID, $meta) ? ' selected="selected"' : '','>'.$item->post_type.': '.$item->post_title.'</option>';
											} // end foreach
										echo '</select><br /><span class="description">'.$field['desc'].'</span>';
								break;
								
								
								case 'gallery':
									
									//$meta && in_array($option->ID, $meta) ? ' checked="checked"' : ''
									
										echo '<div class="metabox_gallery">';
									
											echo '<input type="hidden" name="'.$field['id'].'" id="'.$field['id'].'" class="data" value="' . $meta . '">';
											
											echo '<a class="button" href="#">Upload/order images</a>
													<br /><span class="description">'.$field['desc'].'</span>';
												
										echo '</div>';

								break;
								
								
								//---------------------END ADD----
							} //end switch
					echo '</td></tr>';
				} // end foreach
				echo '</table>'; // end table
			}
			
			
			

			function remove_taxonomy_boxes() {
				remove_meta_box('categorydiv', 'post', 'side');
			}
			
			
			
			// Save the Data
			function save_custom_meta($post_id) {
			
				if(isset($_POST['custom_meta_box_nonce']))
				{
				    $custom_meta_fields = $this->fields;
					
					// verify nonce
					if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) 
						return $post_id;
					// check autosave
					if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
						return $post_id;
					// check permissions
					if ('page' == $_POST['post_type']) {
						if (!current_user_can('edit_page', $post_id))
							return $post_id;
						} elseif (!current_user_can('edit_post', $post_id)) {
							return $post_id;
					}
					
					// loop through fields and save the data
					foreach ($custom_meta_fields as $field) 
					{
						
							if($field['type'] == 'tax_select') continue;
							
							//si es de tipo file
							if($field['type'] == 'file'){
							
								// If the user uploaded an image, let's upload it to the server
								if( ! empty( $_FILES ) && isset( $_FILES[$field['id']] ) ) {
								
									//elimino la anterior si existe
									$upload_dir = wp_upload_dir();
									$old = get_post_meta($post_id, $field['id'], true);

									if($old != '') unlink( $upload_dir["basedir"] . substr($old, strrpos( $old, "uploads/") + 7) );
									
									
									// Upload the goal image to the uploads directory, resize the image, then upload the resized version
									$goal_image_file = wp_upload_bits( $_FILES[$field['id']]['name'], null, file_get_contents( $_FILES[$field['id']]['tmp_name'] ) );//wp_remote_get

									// Set post meta about this image. Need the comment ID and need the path.
									if( !$goal_image_file['error'] ) {
										
										// Since we've already added the key for this, we'll just update it with the file.
										update_post_meta( $post_id, $field['id'], $goal_image_file['url'] );
					
									} // end if/else
					
								} // end if
								
								continue;
							}

							
							
							
							$old = get_post_meta($post_id, $field['id'], true);
							
							if(isset($_POST[$field['id']]))
							{
								$new = $_POST[$field['id']];
							}
							else
							{
								$new = '';
							}
							
							
							if ($new && $new != $old) {
								update_post_meta($post_id, $field['id'], $new);
							} elseif ('' == $new && $old) {
								delete_post_meta($post_id, $field['id'], $old);
							}
						
					} // enf foreach
					
					// save taxonomies
					if(isset($_POST['category']))
					{
						$post = get_post($post_id);
						$category = $_POST['category'];
						wp_set_object_terms( $post_id, $category, 'category' );
					}
				
				}
			}

}
?>