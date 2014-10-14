<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta content="width=device-width, target-densitydpi=160dpi, initial-scale=1.0" name="viewport"><!--, maximum-scale=1.0,minimum-scale=1.0, user-scalable=no-->
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'wpboots' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


<!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php bloginfo( 'stylesheet_directory' );?>/ico/favicon.png?v=3">
    <!--<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php bloginfo( 'stylesheet_directory' );?>/ico/favicon_57.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo( 'stylesheet_directory' );?>/ico/favicon_72.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php bloginfo( 'stylesheet_directory' );?>/ico/favicon_144.png">-->
    
    <link rel="apple-touch-icon-precomposed" href="<?php bloginfo( 'stylesheet_directory' );?>/ico/favicon_152.png?v=3">


<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->


<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
<script>window.jQuery || document.write("<script src='<?php echo get_template_directory_uri(); ?>/js/jquery-1.8.0.min.js'>\x3C/script>")</script>-->





<!-- share FB Fix -->
<?php
	$thumb = get_post_meta($post->ID,'_thumbnail_id',false);
?>

<?php if($thumb) : ?>

		<?php
		$thumb = wp_get_attachment_image_src($thumb[0], false);
		$thumb = $thumb[0];
		$default_img = get_bloginfo('stylesheet_directory').'/img/logo.png';
	 
		?>
	 
	<?php if(is_single() || is_page()) { ?>
		<meta property="og:type" content="article" />
		<meta property="og:title" content="<?php single_post_title(''); ?>" />
		<meta property="og:description" content="<?php 
		while(have_posts()):the_post();
		$out_excerpt = str_replace(array("\r\n", "\r", "\n"), "", get_the_excerpt());
		echo apply_filters('the_excerpt_rss', $out_excerpt);
		endwhile; 	?>" />
		<meta property="og:url" content="<?php the_permalink(); ?>"/>
		<meta property="og:image" content="<?php if ( $thumb[0] == null ) { echo $default_img; } else { echo $thumb; } ?>" />
	<?php  } else { ?>
		<meta property="og:type" content="article" />
	   <meta property="og:title" content="<?php bloginfo('name'); ?>" />
		<meta property="og:url" content="<?php bloginfo('url'); ?>"/>
		<meta property="og:description" content="<?php bloginfo('description'); ?>" />
	    <meta property="og:image" content="<?php  if ( $thumb[0] == null ) { echo $default_img; } else { echo $thumb; } ?>" />
	<?php  }  ?>
	
<?php endif; ?>
<!--END share FB Fix -->




<?php wp_head(); ?>

<!--<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">-->


<!--<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>/icomoon" />-->


<!--<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>/css/font-awesome.min.css">-->


<!-- ?¿ -->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/init.css" />


<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">


<!-- ?¿ -->
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />


<!--<script src="<?php echo get_template_directory_uri(); ?>/js/init.js" type="text/javascript"></script>-->

<!--
<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/lib/masonry.pkgd.min.js" type="text/javascript"></script>


<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/init.js" type="text/javascript"></script> -->

</head>

<body <?php body_class(); ?>>



<!--[if lt IE 9]>    
    <div id="chromeframe" style="position:fixed;top:0;width:100%;z-index:9999">
        <div class="alert alert-warning alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
		  Está usando un navegador <strong>desactualizado</strong>. Por favor, <a target="_blank" href="http://browsehappy.com/?locale=es_ES">Actualize su navegador</a> para mejorar la experiencia.
		</div>
	</div>
<![endif]-->





<!--###### MENÚS LATERALES ######-->
<div class="">
    <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left">
        <div>
        
        	<?php
		
				$args = array(
					'theme_location' => 'left',
					'depth'		 => 3,
					'container'	 => false,
					//'menu_id'    => 'nav-main-left',
					'menu_class' => 'nav nav-cbp-spmenu',
					'walker'	 => new Bootstrap_Walker_Nav_Menu()
				);

				wp_nav_menu($args);
			
			?>
			
			<?php

				$args = array(
					'theme_location' => 'right',
					'depth'		 => 3,
					'container'	 => false,
					//'menu_id'    => 'nav-main-right',
					'menu_class' => 'nav nav-cbp-spmenu',
					'walker'	 => new Bootstrap_Walker_Nav_Menu()
				);

				wp_nav_menu($args);
			
			?>
            
        </div>
    </div>
    <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right">
    	
 
    	
    </div>
</div>

<!--###### EMD MENÚS LATERALES ######-->





<!-- ### modals ### -->

<div class="modal fade" id="contact-modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">CONTACTO</h4>
        </div>
        <div class="modal-body">

          <form id="form-login" class="" action="" method="post">

              	<!--
            
                
                <div class="form-group">
	                <label for="description" class="control-label">Email</label>
                  	<label class="control-label"></label>
			       	<input type="text" name="user_password" class="form-control form-field password" placeholder="Contraseña">
                </div>
                
                <div class="form-group">
	                <label for="description" class="control-label">Nombre</label>
                  	<label class="control-label"></label>
			        <input type="text" name="user_password" class="form-control form-field password" placeholder="Contraseña">
                </div>
                          	
                <div class="form-group">
	                <label for="description" class="control-label">Mensaje</label>
                  	<label class="control-label"></label>
			        <div class="controls">
			            <textarea id="cancel-causa" cols="50" rows="8" class="form-control"></textarea>
			        </div>
                </div>


				
                <br><br>
                
                
                <button type="submit" class="btn btn-block btn-danger btn-lg">
                	ENVIAR
                	<span class="loader">
						&nbsp;&nbsp;<i class="icon icon-refresh animate-spin"></i>
					</span>
                </button>
                
                -->
                
                
                <?php echo do_shortcode('[contact-form-7 id="156" title="Formulario de contacto 1"]'); ?>
                
            </form>


        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  
  

<!--### END modals ###-->








<div id="timeline-wrap-back"></div>
<div id="timeline-wrap"></div>



<div id="page" class="hfeed cbp-spmenu-push">


	<?php do_action( 'before' ); ?>




	<div id="cover">

		<img id="cover-img" src="<?php bloginfo('stylesheet_directory'); ?>/img/keystar.jpg" />
		
		<img class="logo" src="<?php bloginfo('stylesheet_directory'); ?>/img/logo.png" />
		
		<div id="cover-overlay"></div>
		
		
		
		
		<div class="cover-title-container">
			<div class="container">
				<h1><span class="text-danger">GABRIEL</span> GÓMEZ PÉREZ</h1>
				<hr>
				<!--<h2>Desarrollador web</h2>-->
				<h2>Construyendo la web desde 1816</h2>
			</div>
		</div>
		
	</div>
	
	
	<div id="menu-mobile" class="visible-xs cbp-spmenu-push" data-spy="affix" data-offset-top="1">
	
		<button id="cbp-spmenu-btn-left" class="navbar-toggle" type="button">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		
		<img class="logo" width="55" height="55" src="<?php bloginfo('stylesheet_directory'); ?>/img/logo.png" />
		
	</div>



	<div id="profile-block-container">

		
		<!-- sustituto de la cabezera flotante -->
		<div class="container hidden-xs">
			<div id="profile-block-holder" class="row">  <!--simetric-row-->
				<div class="col-sm-5 col-md-5 simetric-l bg1">
		
				</div>
				<div class="col-sm-2 col-md-2 simetric-c">
				</div>
				<div class="col-sm-5  col-md-5 simetric-r bg1">
		
				</div>
			</div>
		</div>
		<!-- END sustituto de la cabezera flotante -->
		
		

				
					
			<div id="nav-main-container" class="nav-main container">
				
				
					
				<div class="row">
				
					<div class="col-sm-5 col-md-5 bg1">
						
						<?php
		
							$args = array(
								'theme_location' => 'left',
								'depth'		 => 3,
								'container'	 => false,
								'menu_id'    => 'nav-main-left',
								'menu_class' => 'nav navbar-nav hidden-xs',
								'walker'	 => new Bootstrap_Walker_Nav_Menu()
							);
			
							wp_nav_menu($args);
						
						?>
					
					</div>
	
					<div class="col-sm-2 col-md-2">
					
					
						<img id="profile-frame" src="<?php bloginfo('stylesheet_directory'); ?>/img/TL/TL-frame-half.png" />
					
			        	<div id="profile-container">
			        		<div id="profile-inner">
			        		
			        			<img class="logo" src="<?php bloginfo('stylesheet_directory'); ?>/img/logo.png" />
			        			
								<img class="me" src="<?php bloginfo('stylesheet_directory'); ?>/img/yo_grey.jpg" />
								
								
								
							</div>
						</div>
						
					</div>
					
					<div class="col-sm-5 col-md-5 bg1">
	
						<?php
	
							$args = array(
								'theme_location' => 'right',
								'depth'		 => 3,
								'container'	 => false,
								'menu_id'    => 'nav-main-right',
								'menu_class' => 'nav navbar-nav hidden-xs',
								'walker'	 => new Bootstrap_Walker_Nav_Menu()
							);
			
							wp_nav_menu($args);
						
						?>
						
					</div>
				
				<!--<div class="clearfix"></div>-->
				
				</div>
				
			</div>
						
					

		
	</div>
	

	<div id="main">