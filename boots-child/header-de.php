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
    <link rel="shortcut icon" href="<?php bloginfo( 'stylesheet_directory' );?>/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php bloginfo( 'stylesheet_directory' );?>/ico/favicon_57.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo( 'stylesheet_directory' );?>/ico/favicon_72.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php bloginfo( 'stylesheet_directory' );?>/ico/favicon_144.png">


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
		$default_img = get_bloginfo('stylesheet_directory').'/imagenes/imagen_por_defecto.png';
	 
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



<!-- ?¿ -->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/init.css" />

<!-- ?¿ -->
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />


<!--<script src="<?php echo get_template_directory_uri(); ?>/js/init.js" type="text/javascript"></script>-->



<!--<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/init.js" type="text/javascript"></script>-->

</head>

<body <?php body_class(); ?>>

<?php do_action( 'before' ); ?>


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
            
        </div>
    </div>
    <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right">
    	
    	<?php
			
				$args = array(
					'theme_location' => 'primary',
					'depth'		 => 3,
					'container'	 => false,
					'menu_id'    => 'nav-main-sm',
					'menu_class' => 'nav nav-cbp-spmenu',
					'walker'	 => new Bootstrap_Walker_Nav_Menu()
				);

				wp_nav_menu($args);
			
			?>
    	
    </div>
</div>

<!--###### EMD MENÚS LATERALES ######-->





<div id="page" class="hfeed cbp-spmenu-push">








	<header id="branding" class="navbar navbar-static-top cbp-spmenu-push" role="banner">	    <!--navbar-fixed-top-->
	
		<!--<div class="container">-->
		
            <a class="navbar-brand" href="<?php echo home_url( '/' ); ?>">
            	
            	
            	
            	<img class="hidden-xs img-responsive" src="<?php bloginfo( 'stylesheet_directory' ); ?>/img/logo.svg" onerror="this.onerror=null; this.src='img/logo.png'"  alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
            	
            	<img class="visible-xs img-responsive" src="<?php bloginfo( 'stylesheet_directory' ); ?>/img/logo-sm.svg" onerror="this.onerror=null; this.src='img/logo-sm.png'"  alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
            	
            	<!--<img src="img/logo.svg" onerror="this.onerror=null; this.src='img/logo.png'"  alt="logo">-->
            </a>
            
            
            <button type="button" class="navbar-toggle pull-right visible-md visible-sm visible-xs" id="cbp-spmenu-btn-right">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>


					    
		   
            
            
            <div class="pull-left">
                
                
                <?php
                
                	//wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) );

					$args = array(
						'theme_location' => 'primary',
						'depth'		 => 3,
						'container'	 => false,
						'menu_id'    => 'nav-main',
						'menu_class' => 'nav navbar-nav hidden-md hidden-sm hidden-xs',// nav-pills hidden-sm hidden-xs
						'walker'	 => new Bootstrap_Walker_Nav_Menu()
					);//<ul id="%1$s" class="%2$s">%3$s</ul>

					wp_nav_menu($args);
				
				?>							
				<!--<div class="clearfix"></div>-->
					
					
					<!--
                <ul id="nav-main" class="nav nav-pills hidden-sm hidden-xs" role="navigation">
                	<li><a href="#">Instalaciones</a></li>
                </ul>	
				-->


            </div><!--/.nav-collapse -->
            
            
            <div class="pull-right">
            
            	<?php
            	
            		if ( is_user_logged_in() ) :
	               		
               			$current_user = wp_get_current_user();
						//$user_id = $current_user->ID;
						//$categorias = get_terms('archivo_personal-type','orderby=id&hide_empty=1');
            	?>
            	
            		<ul class="nav navbar-right" id="nav-user"><!--nav-pills-->
						<li class="dropdown">
						
							<a data-toggle="dropdown" class="dropdown-toggle user-display" role="button" href="#">
								<div class="user-avatar-container">
									<?php echo get_avatar($current_user->ID); ?>
								</div>
							
								<span class="alias"><?php echo $current_user->user_login; ?> <b class="caret"></b></span>
							</a>

							<ul role="menu" class="dropdown-menu">
								<!--<li role="presentation" class="dropdown-header">User Options</li>-->
								<!--
								<li role="presentation"><a href="" role="menuitem" tabindex="-1"> <i class="icon icon-suitcase"></i>&nbsp;  Mis reservas</a></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href=""> <i class="icon icon-user"></i> &nbsp; Mis datos</a></li>
								-->
								<?php
								
				                	//wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) );
									//<ul id="%1$s" class="%2$s">%3$s</ul>
				
									wp_nav_menu(array(
										'theme_location' => 'user',
										'depth'		 => 2,
										'container'	 => false,
										'items_wrap' => '%3$s'
									));
								?>	

								<li role="presentation" class="divider"></li>
								
								<li role="presentation"><a tabindex="-1" role="menuitem" class="logout" href="<?php echo wp_logout_url( get_permalink() ); ?>"> <span class="icon icon-power-off"></span>  &nbsp; Salir</a></li>
							</ul>
						</li>
					</ul>

		        		
	        		
				<?php else : ?>
	
					<ul id="nav-login" class="nav nav-pills" role="navigation">
		       			<!-- Button to trigger modal -->
		           		
		           		<li>
							<a href="#login" data-toggle="modal">Entrar</a>
						</li>
						
						<li>
		           			<a href="#register" class="btn-blue" role="button" data-toggle="modal">Registro</a>
		           		</li>
					</ul>	
							
				<?php endif; ?>

            
	        	
			</div>
            
            
            
       <!-- </div>-->
        
        
        						
	
	</header><!-- #branding -->

	

	<div id="main">