<?php



	//settings page
	

	add_action( 'admin_menu', function () {
	
		//add_options_page( 'My Plugin Options', 'My Plugin', 'manage_options', 'my-unique-identifier', 'my_plugin_options' );
		
		//add_menu_page( 'Tours', 'Opciones', 'manage_options', 'tours-handle', 'tour_options_HTML', 'dashicons-admin-site' );
		//add_submenu_page( 'tours-handle', 'Page title', 'Sub-menu title', 'manage_options', 'tours-options-handle', "tour_options_HTML" );
		
		
		//paneles
		/*
		add_menu_page( 'Tours', 'Tours', 'edit_others_pages', 'toursPage-handle', 'tour_options_HTML', 'dashicons-admin-site',5 );
		add_submenu_page( 'toursPage-handle', 'Opciones', 'Opciones', 'edit_others_pages', 'toursPage-handle'); //alias para la primera página en sí
		*/
		
	    //add_submenu_page('tours-handle', 'Submenu Page Title2', 'Whatever You Want2', 'manage_options', 'my-menu2' );
	    //add_submenu_page('toursPage-handle', 'Tours', 'Tours', 'manage_options', 'edit.php?post_type=tour' );
	    
	    
	    //add_menu_page( 'options-general.php', 'Tours', 'edit_others_pages', 'toursPage-handle', 'wpboots_options_HTML', 'dashicons-admin-site',5 );
	    add_submenu_page( 'options-general.php', 'WPBoots Opciones', 'WPBoots Opciones', 'edit_others_pages', 'wpboots_options-handle', 'wpboots_options_HTML');
	    
	    
		
	});
	
	//settings registers
	add_action( 'admin_init', 'wpboots_registerSettings' );
	
	function wpboots_registerSettings() {
	
		register_setting( 'wpboots', 'wpboots_pageCookies' );
		register_setting( 'wpboots', 'wpboots_facebookID' );
		/*
		register_setting( 'wpboots', 'wpboots_prepaid' );
		register_setting( 'wpboots', 'wpboots_managerEmail' );
		register_setting( 'wpboots', 'wpboots_cancelText' );
		register_setting( 'wpboots', 'wpboots_partidaText' );
		
		
		register_setting( 'wpboots', 'wpboots_paypalMail' );
		register_setting( 'wpboots', 'wpboots_paypalError' );
		register_setting( 'wpboots', 'wpboots_paypalSuccess' );
		register_setting( 'wpboots', 'wpboots_paypalSandbox' );
		register_setting( 'wpboots', 'wpboots_myBooking' );
		
		register_setting( 'wpboots', 'wpboots_checkoutTour' );
		register_setting( 'wpboots', 'wpboots_checkoutExcursion' );*/
		
		//register_setting( 'tour_options-group', 'some_other_option' );
		//register_setting( 'tour_options-group', 'option_etc' );
	}
	

	
	
	function wpboots_options_HTML() {
	
		if ( !current_user_can( 'edit_others_pages' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.', 'wpboots' ) );
		}
		/*
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		echo '<div class="wrap">';
		echo '<p>Here is where the form would go if I actually had options.</p>';
		echo '</div>';
		*/
		
		
		?>
			<div class="wrap">

				<style>
					h2:before {
					    content: "\f108";
					    display: inline-block;
					    -webkit-font-smoothing: antialiased;
					    font: normal 29px/1 'dashicons';
					    vertical-align: middle;
					    margin-right: 0.3em;
					}
				</style>
				
				
				
				<form method="post" action="options.php">
				    <?php settings_fields( 'wpboots' ); ?>
				    <?php do_settings_sections( 'wpboots' ); ?>
				    
				    <h2>Opciones</h2>
				    
				    <table class="form-table">
				    
				    	<tr valign="top">
				        	<th scope="row">Ruta "política de cookies"</th>
				       		<td>
				        
					        	<?php 
					        	
					        			$option = 'wpboots_pageCookies';
					        			
					        			$meta = esc_attr( get_option($option) );
					        			
					        			$items = get_posts( array (
											'post_type'	=> 'page',
											'posts_per_page' => -1
										));
										
										
										
										//$meta && in_array($option->ID, $meta) ? ' checked="checked"' : ''
										
											echo '<select name="'.$option.'" id="'.$option.'" >';
											
												echo '<option value="-1">*Ninguna</option>';
												
												foreach($items as $item) {
												
													echo '<option value="'.$item->ID.'"', $meta == $item->ID ? ' selected="selected"' : '','>'.$item->post_title.'</option>';
												} // end foreach
											echo '</select>';
					        	
					        	?>

				        	
				        	</td>
				        </tr>
				        
				        <tr valign="top">
				        <th scope="row">Facebook app ID</th>
				        <td><input type="text" name="wpboots_facebookID" value="<?php echo esc_attr( get_option('wpboots_facebookID') ); ?>" /></td>
				        </tr>
				        
				        <!--
				        <tr valign="top">
				        <th scope="row">Email del Gestor de la tienda </th>
				        <td><input type="text" name="wpboots_managerEmail" value="<?php echo esc_attr( get_option('wpboots_managerEmail') ); ?>" /></td>
				        </tr>
				        
				        <tr valign="top">
				        <th scope="row">Email de Paypal</th>
				        <td><input type="text" name="wpboots_paypalMail" value="<?php echo esc_attr( get_option('wpboots_paypalMail') ); ?>" /></td>
				        </tr>
				        
				        <tr valign="top">
				        <th scope="row">Porcentaje de prepago</th>
				        <td><input type="text" name="wpboots_prepaid" value="<?php echo esc_attr( get_option('wpboots_prepaid') ); ?>" /></td>
				        </tr>
				        
				        
				        <tr valign="top">
				        <th scope="row">Texto de cancelación</th>
				        <td>
				        	
				        	<?php wp_editor( get_option('wpboots_cancelText'), "wpboots_cancelText", array( 'textarea_name' => "wpboots_cancelText", 'media_buttons' => false, 'textarea_rows' => 10  ) ); ?>
				        </td>
				        </tr>
				        
				        
				        <tr valign="top">
				        <th scope="row">Punto de partida por defecto para las excursiones</th>
				        <td>
				        	
				        	<?php wp_editor( get_option('wpboots_partidaText'), "wpboots_partidaText", array( 'textarea_name' => "wpboots_partidaText", 'media_buttons' => false, 'textarea_rows' => 10  ) ); ?>
				        </td>
				        </tr>
				        
				        -->
				        
				    </table>
				    <!--

				    <br><br><br>
				    
				    <h2>Opciones Avanzadas</h2>
				    
				    
				    <table class="form-table">
				    
				    	<tr valign="top">
				        <th scope="row">Paypal Sandbox</th>
				        <td>
				        	
				        	<div class="radio">
							    <label>
							      <input type="radio" name="wpboots_paypalSandbox" value="on" <?php echo (esc_attr( get_option('wpboots_paypalSandbox') ) == 'on') ? 'checked' : ''   ?>>
							      Activado
							    </label>
							  </div>
							  <div class="radio">
							    <label>
							      <input type="radio" name="wpboots_paypalSandbox" value="off" <?php echo (esc_attr( get_option('wpboots_paypalSandbox') ) != 'on') ? 'checked' : ''   ?>>
							      Desactivado
							    </label>
							  </div>
							  
				        </td>
				        </tr>
				    
				        <tr valign="top">
				        <th scope="row">Ruta Paypal error</th>
				        	<td>
					        	<?php 
					        	
					        			$option = 'wpboots_paypalError';
					        			
					        			$meta = esc_attr( get_option($option) );
					        			
					        			$items = get_posts( array (
											'post_type'	=> 'page',
											'posts_per_page' => -1
										));
										
										
										
										//$meta && in_array($option->ID, $meta) ? ' checked="checked"' : ''
										
											echo '<select name="'.$option.'" id="'.$option.'" >';
											
												echo '<option value="-1">*Ninguna</option>';
												
												foreach($items as $item) {
												
													echo '<option value="'.$item->ID.'"', $meta == $item->ID ? ' selected="selected"' : '','>'.$item->post_title.'</option>';
												} // end foreach
											echo '</select>';
					        	
					        	?>
				        	</td>
				        </tr>
				        
				        <tr valign="top">
				        <th scope="row">Ruta Paypal éxito</th>
					        <td>
					        	<?php 
					        	
					        			$option = 'wpboots_paypalSuccess';
					        			
					        			$meta = esc_attr( get_option($option) );
					        			
					        			$items = get_posts( array (
											'post_type'	=> 'page',
											'posts_per_page' => -1
										));
										
										
										
										//$meta && in_array($option->ID, $meta) ? ' checked="checked"' : ''
										
											echo '<select name="'.$option.'" id="'.$option.'" >';
												
												echo '<option value="-1">*Ninguna</option>';
												
												foreach($items as $item) {
												
													echo '<option value="'.$item->ID.'"', $meta == $item->ID ? ' selected="selected"' : '','>'.$item->post_title.'</option>';
												} // end foreach
											echo '</select>';
					        	
					        	?>
				        	</td>
				        </tr>
				        
				        
				        <tr valign="top">
				        <th scope="row">Ruta "Mis reservas"</th>
				        <td>
				        
				        	
				        
				        	<?php 
				        	
				        			$option = 'wpboots_myBooking';
				        			
				        			$meta = esc_attr( get_option($option) );
				        			
				        			$items = get_posts( array (
										'post_type'	=> 'page',
										'posts_per_page' => -1
									));
									
									
									
									//$meta && in_array($option->ID, $meta) ? ' checked="checked"' : ''
									
										echo '<select name="'.$option.'" id="'.$option.'" >';
											
											echo '<option value="-1">*Ninguna</option>';
											
											foreach($items as $item) {
											
												echo '<option value="'.$item->ID.'"', $meta == $item->ID ? ' selected="selected"' : '','>'.$item->post_title.'</option>';
											} // end foreach
										echo '</select>';
				        	
				        	?>
				        
				        	
				        	
				        	
				        	</td>
				        </tr>
				        
				        <tr valign="top">
				        	<th scope="row">Ruta "checkout tours"</th>
				       		<td>
				        
					        	<?php 
					        	
					        			$option = 'wpboots_checkoutTour';
					        			
					        			$meta = esc_attr( get_option($option) );
					        			
					        			$items = get_posts( array (
											'post_type'	=> 'page',
											'posts_per_page' => -1
										));
										
										
										
										//$meta && in_array($option->ID, $meta) ? ' checked="checked"' : ''
										
											echo '<select name="'.$option.'" id="'.$option.'" >';
												
												echo '<option value="-1">*Ninguna</option>';
												
												foreach($items as $item) {
												
													echo '<option value="'.$item->ID.'"', $meta == $item->ID ? ' selected="selected"' : '','>'.$item->post_title.'</option>';
												} // end foreach
											echo '</select>';
					        	
					        	?>

				        	
				        	</td>
				        </tr>



						<tr valign="top">
				        	<th scope="row">Ruta "checkout excursiones"</th>
				       		<td>
				        
					        	<?php 
					        	
					        			$option = 'wpboots_checkoutExcursion';
					        			
					        			$meta = esc_attr( get_option($option) );
					        			
					        			$items = get_posts( array (
											'post_type'	=> 'page',
											'posts_per_page' => -1
										));
										
										
										
										//$meta && in_array($option->ID, $meta) ? ' checked="checked"' : ''
										
											echo '<select name="'.$option.'" id="'.$option.'" >';
											
												echo '<option value="-1">*Ninguna</option>';
												
												foreach($items as $item) {
												
													echo '<option value="'.$item->ID.'"', $meta == $item->ID ? ' selected="selected"' : '','>'.$item->post_title.'</option>';
												} // end foreach
											echo '</select>';
					        	
					        	?>

				        	
				        	</td>
				        </tr>
				         

				    </table>-->
				    
				    
				    <?php submit_button(); ?>
				
				</form>
			</div>
		<?php
	}



	
	
?>