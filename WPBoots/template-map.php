<?php
/**
 * Template Name: Map
 * Description: A full-width template with no sidebar and map
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */

get_header(); ?>


<div id="map_canvas" style="height:450px;"></div>

<script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>



<div id="main_cont" class="container">
	<div class="row">
		<div id="primary" class="col-md-12">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->
	</div>
</div><!-- .container (main) -->



<script>
	//Center of the map
	 var latlngMap = new google.maps.LatLng(45.441465,12.315648);


	
    var map = new google.maps.Map(document.getElementById("map_canvas"), {
		  scrollwheel: false,
	      zoom: 14,
	      center: latlngMap,
	      mapTypeId: google.maps.MapTypeId.ROADMAP, 
	      disableDefaultUI: false,
	      zoomControl: true,
	      zoomControlOptions: {
	 	   style: google.maps.ZoomControlStyle.SMALL,
	 	   position: google.maps.ControlPosition.RIGHT_TOP
	 	 },
	 	 streetViewControl: true,
	    streetViewControlOptions: {
	        position: google.maps.ControlPosition.RIGHT_TOP
	    },
	 	 mapTypeControl: true,
	    mapTypeControlOptions: {
	      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
	    },
	    panControl: false
	
    });
    
    //marker position
    var position = new google.maps.LatLng(45.441465,12.315648);

 	var marker = new google.maps.Marker({
		  position: position, 
		  map: map, 
		  title: ""/*,
		  icon: "<?php bloginfo('template_url'); ?>/images/pin.png"*/
 	 });
 	 
 	 
 	 //adjust button
/*
	var elemento = document.getElementsByClassName("wpcf7-submit");
	
	elemento[0].className += " btn";
	elemento[0].className += " btn-primary";
	elemento[0].className += " btn-large";
	*/



</script>

<?php get_footer(); ?>