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
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0,target-densitydpi=160dpi, user-scalable=no" name="viewport"><!--, maximum-scale=1.0,minimum-scale=1.0, user-scalable=no-->
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


<!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php bloginfo( 'stylesheet_directory' );?>/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php bloginfo( 'stylesheet_directory' );?>/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo( 'stylesheet_directory' );?>/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo( 'stylesheet_directory' );?>/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php bloginfo( 'stylesheet_directory' );?>/ico/apple-touch-icon-57-precomposed.png">


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


<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />


<script src="<?php echo get_template_directory_uri(); ?>/js/init.js" type="text/javascript"></script>

</head>

<body <?php body_class(); ?>>





<!--###### MENÚS LATERALES ######-->
<div class="">
    <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left">
        <div>

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
    <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right">
    	Hola derecho!
    </div>
</div>

<!--###### EMD MENÚS LATERALES ######-->





<div id="page" class="hfeed cbp-spmenu-push">






<?php do_action( 'before' ); ?>

	<header id="branding" class="navbarnavbar-static-top cbp-spmenu-push" role="banner">	    <!-- navbar-default  navbar-fixed-top-->
	
		<div class="container">
		
            <a class="navbar-brand hidden-sm hidden-xs" href="<?php echo home_url( '/' ); ?>">
            	<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>
            	<!--<img src="img/logo.svg" onerror="this.onerror=null; this.src='img/logo.png'"  alt="logo">-->
            </a>
            
            
            <button type="button" class="navbar-toggle pull-left visible-sm visible-xs" id="cbp-spmenu-btn-left">
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
						'menu_class' => 'nav navbar-nav hidden-sm hidden-xs',// nav-pills hidden-sm hidden-xs
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
            
            
            
        </div>
	
	</header><!-- #branding -->
	
	

	<div id="main">