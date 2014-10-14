jQuery(function($){


	//# ocultamos el timeline hasta cargar las imagenes
	//$('#timeline-wrap-back, #timeline-wrap').hide();
	
	

	$(document).ready(function(){
	
		//# initial windows & offset parameters
		var wh = $(window).height();
		var ph = $('#profile-block-container').height(); //#profile-block
		var coverOffset = wh-ph;
		var headerOffset = 100;//$('#nav-main-left').height();

		

		//# Set cover height		
		$('#cover').height(coverOffset);
		
		
		//# ANFIX header control
		
		var header = $('#profile-block-container');
		
		header.affix({
		    offset: {
		      top: coverOffset/*
		    , bottom: function () {
		        return (this.bottom = $('.footer').outerHeight(true))
		      }*/
		    }
		});
		/*
		header.on('affix.bs.affix', function (e) {
			
			//var hh = header.height();
			
			
		});*/
		
		//affix.bs.affix
		
		
		//# control de scroll hasta el elemento #
		$('a[href*=#]:not([href=#])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		  var target = $(this.hash);
		  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		  if (target.length) {
		    $('html,body').animate({
		      scrollTop: target.offset().top - headerOffset
		    }, 400, 'swing');
		    return false;
		  }
		}
		});
		
		
		
		
		//# Ajuste alturas de timelines 
		$(window).on('resize', function(){

			wh = $(window).height();
			ph = $('#profile-block').height();
			
		
			
			$('.simetric-row').each(function(){
			
			
				var sl = $(this).find('.simetric-l');
				var sc = $(this).find('.simetric-c');
				var sr = $(this).find('.simetric-r');
				
				sl.height("auto");
				sc.height("auto");
				sr.height("auto");
				sc.css("line-height",16+'px');
				
				var maxheight = Math.max(sl.height(), sc.height(), sr.height());
				
				sl.height(maxheight);
				sc.height(maxheight);
				sr.height(maxheight);
				
				sc.css("line-height",(maxheight+16)+'px');
				
			});
			
			
			projectOverlay.refreshBound();
			
		});
		
		$(window).trigger("resize");
		
		
		//# sincronización barras
		$(window).on('scroll', function(){
			
			
			
			$('.progress-bar').each(function(){
			
				var bar = $(this);
			
				if( $(document).scrollTop() + wh*0.6  >  bar.offset().top ){
				
					var porcent = bar.attr("aria-valuenow");
					
					bar.css('width', porcent+'%');
				}
			
			});
			
			
			
		});
		
		$(window).trigger("scroll");
		
	
	});
	
	
	
	
	$(window).on('load',function(){
	
		//# mostramos el timeline al cargar las imagenes
		$('#timeline-wrap-back, #timeline-wrap').fadeIn();
		
		//# masonry
		$('.js-masonry').masonry({

			//columnWidth: ".mosaic-grid-sizer",
			//columnWidth: 230,//".mosaic-grid-sizer",//230,
			//isFitWidth: true,
			itemSelector: ".mosaic-item",
			
			//gutter: ".mosaic-gutter-sizer",
			//isResizable: true,
			//isAnimated: true//4
		  
		});
		
		$('.js-masonry').masonry('bindResize');
		
	});
	
	
	
	
	
	
	
	
	 var projectOverlay = slideshow3d("#projectOverlay-container");
	 
	 
	 projectOverlay.calculateBounds();
	 
	 
	 $('.portfolio-mosaic-container .mosaic-item').on('click', function(){
	 
	 	projectOverlay.gotoPosAndShow( $(this).index() );

	 });
	 
	 /*
	 $('.projectOverlay-item-container').on('click', function(){
	 	
	 	projectOverlay.moveRight();
	 	
	 });*/
	 
	 
	 
	 
	
	
	
	/*
	// pruebas
	$('.projectOverlay-item-container').on('click', function(){
		
		
		$('.projectOverlay-item-container').eq(0).removeClass('show prev next open');
		$('.projectOverlay-item-container').eq(1).removeClass('show prev next open');
		$('.projectOverlay-item-container').eq(2).removeClass('show prev next open');
		
		
		$('.projectOverlay-item-container').eq(0).addClass('prevOut');

		
		
		$('.projectOverlay-item-container').eq(1).addClass('show prev');
		$('.projectOverlay-item-container').eq(2).addClass('show open');
		$('.projectOverlay-item-container').eq(3).addClass('show next');
		
	});
	
	*/
	
	
	
	
	//# ----- fixes ---- #
/*	
	$('#form-login').on('click', function(e){
		
		e.preventDefault();
	});
*/

	
	
});




