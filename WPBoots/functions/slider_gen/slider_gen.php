<?php

function slider_register(){
	
	$args_labels = array(
		  'name' => 'sliders',
		  'singular_name' => 'slider',
		  'add_new' => 'Añadir slider',
		  'add_new_item' => 'Añadir nueva slider',
		  'edit_item' => 'Editar slider',
		  'new_item' => 'Añadir slider',
		  'view_item' => 'Ver slider',
		  'search_items' => 'Buscar sliders',
		  'not_found' =>  'No se han encontrado sliders',
		  'not_found_in_trash' => 'No hay sliders en la papelera',
		  'parent_item_colon' => ''
		  );
		  $args = array(
		    'labels' => $args_labels,
		    'public' => true,
		    'publicly_queryable' => true,
		    'show_ui' => true,
		    'query_var' => true,
		    'rewrite' => true,
		    'capability_type' => 'post',
		    'hierarchical' => true,
		    'register_meta_box_cb' => 'slider_add_meta_box',
		    'menu_position' => 20, // 5 - below Posts, 10 - below Media, 20 - below Pages, 60 - below first separator, 100 - below second separator
		    'supports' => array('title','editor'),//thumbnail editor
		  'rewrite' => array(
		    'slug' => 'slider',
		    'with_front' => FALSE
		  )
		); 
		// Con los arrays creados, por fin llamamos a la función Register post Type:
		register_post_type('slider',$args);
	
}

//añado campos extras necesarios para las imágenes
add_filter( 'attachment_fields_to_edit', function ( $form_fields, $post ) {

	$form_fields['url-link'] = array(
		'label' => 'URL link',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'url-link', true )//,
		//'helps' => 'If provided, photo credit will be displayed',
	);
	
	return $form_fields;
	
}, 10, 2 );
 
add_filter( 'attachment_fields_to_save', function ( $post, $attachment ) {

	if( isset( $attachment['url-link'] ) )
		update_post_meta( $post['ID'], 'url-link', $attachment['url-link'] );
	
	return $post;
	
}, 10, 2 );


/*
function slider_archive_enqueue(){
		
	wp_enqueue_script("sliderGen", get_bloginfo( 'template_url' ).'/functions/slider_gen/js/sliderGen.js', array('jquery'));
	
	//paso info de wp a la app.js
	wp_localize_script(
		'sliderGen',
		'wp',
		array(
			'site_url' => site_url(),
			'home_url' => home_url(),
			'lang' => get_bloginfo("language")
		)
	);
}

*/


function slider_init_enqueue(){
		
	wp_enqueue_script("sliderInit", get_bloginfo( 'template_url' ).'/functions/slider_gen/js/init.js', array('jquery'));
}

//shortcode que introduce el slider
function short_slider($atts) 
{
	
	global $wpdb;
	
	//slider_archive_enqueue();

	extract( shortcode_atts( array(
      'slug' => '',
      'id' => '',
      'gallery' => '',
      'size' => 'full',
      'background' => 'false'
      ), $atts ) );

	
	slider_init_enqueue();


	//buscaoms la id por la slug	
	if($slug != '')
	{
		$pageid_name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$slug."'");
		$attachs = explode(',', get_post_meta($pageid_name, 'slider_gallery', true));	
	}
	
	if($id != '')
	{
	
		$pageid_name = $id;
		$attachs = explode(',', get_post_meta($pageid_name, 'slider_gallery', true));	
	}
	
	if($gallery != '')
	{

		$attachs = explode(',', $gallery);	
	}
	
	
	
	
	/*
		
		$attachs = explode(',',$galleryIDs);
	
	
	
	//mostramos las imágenes actuales con sus clicks		
					
	$i = 0;

	foreach ($attachs as $att_id){
		
	*/
	
	
		
	/*
	$attachs = get_posts(array(
						 'numberposts' => -1,
						 'post_type' => 'attachment',
						 'post_parent' => $pageid_name,
						 'post_mime_type' => 'image', // get attached images only
						 'order' => 'ASC',
						 'orderby' => 'menu_order',
						 'output' => ARRAY_A
						));
	*/
	
	
	
	
	$output = '<div class="carousel slide" id="myCarousel-'.$pageid_name.'">
					<div class="carousel-inner">';
					
	$i = 0;
	

	foreach ($attachs as $att_ID)
	{
	
		$att = get_post($att_ID);
		
		if($i == 0)
		{
			$active = "active";
		}
		else
		{
			$active = "";
		}
	
		$img = wp_get_attachment_image_src($att_ID, $size);//$large_thumbnail_size) //medium large

		
		$url = get_post_meta($att_ID, 'url-link', true);
		$title = $att->post_excerpt;//post_title;
		$content = $att->post_content;
		
		
		//if($title == '*') $title = '';
		
		
		//si no hay contenido ni titulo no colocamos el caption
		$caption = '';
		
		if(($content != '') || ($title != ''))
		{
			$caption ='<div class="carousel-caption">
			              <h4>'.$title.'</h4>
			              <p>'.$content.'</p>
			            </div>';
		}
		
		//napa
		//$caption = '';
		
		
		if($atts["background"] == "true"){
		
			$imgItem = '<div class="item-img" style="background: url(\''.$img[0].'\') no-repeat center center transparent; background-size: cover; width:100%; min-height:400px;"></div>';
			
		}else{
			
			$imgItem = '<img alt="" src="'.$img[0].'">';
		}
		
		
		
		
		if($url == ''){
		
			$output .=	'<div class="item '.$active.'">
				            '.$imgItem.'
				            '.$caption.'
				          </div>';
		}else{
			//onclick="WPBannerizeJavascript.incrementClickCount(3)"
			//onclick="sliderGen.incrementClickCount('.$att_ID.')
						$output .=	'<div class="item '.$active.'">
				            <a target="_blank" " href="'.$url.'">'.$imgItem.' 
				            '.$caption.'</a>
				          </div>';
		}
		
		
		$i++;
	}
	
	
	//si solo hay una imagen no colocamos los botones
	$controles = '';
	
	if($i > 1)
	{
		$controles = '<a class="left carousel-control" href="#myCarousel-'.$pageid_name.'" role="button" data-slide="prev">
					    <span class="glyphicon glyphicon-chevron-left"></span>
					  </a>
					  <a class="right carousel-control" href="#myCarousel-'.$pageid_name.'" role="button" data-slide="next">
					    <span class="glyphicon glyphicon-chevron-right"></span>
					  </a>';
	}
	
	


	$output .= '</div>
		  '.$controles.'
		</div>';

	
	
	
	return $output;
}





// Metabox para motrar clicks contados y todo lo demás

function slider_add_meta_box($post) {
	
		wp_enqueue_script("sliderGen_edit", get_bloginfo( 'template_url' ).'/functions/slider_gen/js/sliderGen_edit.js', array('jquery'));

	    add_meta_box(
			"slider-panel",
			"Slider panel",
			"slider_show_meta_box",
			"slider",
			"normal",
			"high"
		);
}

/*
function slider_save_meta_box($post_id){

}*/


function slider_show_meta_box($post) {

	wp_nonce_field( 'slider_metaboxes', 'slider_metaboxes_nonce' );


	$galleryIDs = get_post_meta($post->ID, 'slider_gallery', true);

	// Use nonce for verification
	//echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
	
	
	//ajustes previos
	?>
	
	<style>
		#postdivrich{
			display: none !important;
		}
		
		.sliderSummary-thumb{
			display: inline-block;
			position: relative;
		}
		
		.sliderSummary-thumb img{
			display: block;
		}
		
		.sliderSummary-thumb .clicks{
			position: absolute;
			right: 0;
			bottom: 0;
			background: rgba(0,0,0,0.5);
			color: #fff;
			padding: 10px;
			font-size: 16px;
		}
		
	</style>
	
	
	
	<!--mostramos botón de subir imágenes y ocultamos contenedores que nos sobren-->
	
	<br>
	
	
	<input type="hidden" name="slider_gallery" id="slider_gallery" value="<?php echo $galleryIDs; ?>">
	
	<!--<a class="thickbox button" href="<?php echo site_url(); ?>/wp-admin/media-upload.php?post_id=<?php echo $post->ID; ?>&type=image&TB_iframe=1">Upload/order images</a>-->
	
	
	<a id="selectSliderGalleryBtn" class="button" href="#">Upload/order images</a>
	

	<br>
	<br>
	<br>
	
	<?php
	
	
	//var_dump();
	/*
	$attachs = explode(',',$galleryIDs);
	
	
	
	//mostramos las imágenes actuales con sus clicks		
					
	$i = 0;

	foreach ($attachs as $att_id){
	
		$img = wp_get_attachment_image_src($att_id, "thumbnail");//$large_thumbnail_size) //medium large
		
		$title = get_the_title($att_id);
		$content = get_the_content($att_id);
		$clicks = get_post_meta($att_id, 'slider_clicks', true);
		$clicks = ( $clicks != '' ) ? $clicks : 0;
		
		if($title == '*') $title = '';
		
		?>
			<div class="sliderSummary-thumb">
				<img alt="thumb" src="<?php echo $img[0] ?>">
				
				<div class="clicks">
					<?php echo $clicks; ?> clicks
				</div>
			</div>
			
		<?php

	}*/
}


add_action('save_post', function ($post_id, $post){

	 if(isset($_POST['slider_metaboxes_nonce'])){
	 
        //$fields = $this->fields;
        //var_dump($_POST);
        //var_dump($_POST['custom_meta_box_nonce']);
        //var_dump(wp_verify_nonce($_POST['slider_meta_box_nonce'], "tour_metaboxes"));
         // verify nonce
         if (wp_verify_nonce($_POST['slider_metaboxes_nonce'], "slider_metaboxes")){ //!!seguro que lleva el ! ????
             
             //guardamos la info
             update_post_meta( $post_id, "slider_gallery", $_POST['slider_gallery']);
         }
	}
      

	//update_post_meta( $post_id, $field['id'], $goal_image_file['url'] );

}, 1, 2);



//AJAX
function slider_ajaxControl(){

	function slider_ClickCounter() {
	
		$clicks = get_post_meta($_POST["id"], 'slider_clicks', true);
		$clicks = ( $clicks != '' ) ? $clicks : 0;
	
		update_post_meta( $_POST["id"], 'slider_clicks', $clicks + 1 );
		
		//envío la respuesta
		header('Content-type: application/json; charset=utf-8');
		echo "ok";
		
		
	    die();
	}

	add_action( 'wp_ajax_slider_ClickCounter', 'slider_ClickCounter' );
	add_action('wp_ajax_nopriv_slider_ClickCounter', 'slider_ClickCounter');

}




//####### INIT ####### 

slider_register();
slider_ajaxControl();
//add_action( 'add_meta_boxes', 'slider_add_meta_box' );
//add_action( 'save_post', 'slider_save_meta_box' );
add_shortcode( 'slider', 'short_slider' );


?>