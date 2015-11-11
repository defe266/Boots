jQuery(function($){


		var header = $('#branding');
		
	
		$('.YVideo').each(function (e) {
		
			
			
			var container = $(this);
			var trigger = ($(this).hasClass('YVideo-play')) ? $(this) : $(this).find('.YVideo-play');
			
			
			
			

			
			trigger.click(function (e) {
			
				e.preventDefault();
			
				var wh = $(window).height();
				var h_offset = (header.size() == 1 && header.css('position') == 'fixed') ? header.outerHeight() : 0;
				
				var videoSRC = container.attr("data-YVideo");
		  		var videoSRCauto = videoSRC + "?autoplay=1&rel=0&showinfo=0";
				var theModal = $('<div id="video-holder" class="hidden"><div class=""><a class="closeButton"><i class="fa fa-times-circle-o"></i></a><iframe width="100%" height="'+(wh - h_offset)+'" src="'+videoSRCauto+'" frameborder="0" allowfullscreen></iframe></div></div>');
				
				container.after(theModal);
				
				var closeButton = theModal.find(".closeButton");
	  		
		  		closeButton.css('font-size','50px');
		  		closeButton.css('position','absolute');
		  		closeButton.css('right','20px');
		  		closeButton.css('top','20px');
		  		closeButton.css('color','#fff');
		  		closeButton.css('text-shadow','2px 2px 2px #000');
		  		
		  		
		  		
		  		
		  		
		  		closeButton.click(function(){
			  		
			  		container.slideDown(200);
			  		
			  		
			  		theModal.slideUp(200,function(){
				  		
				  		theModal.remove();
			  		});
		  		});
				

				
				theModal.css('position','relative');
				
				theModal.removeClass('hidden');
				
				window.aux = {
					theModal:theModal,
					container: container
				}
				
				
				
				
				var Deff_open = jQuery.Deferred();
				var Deff_close = jQuery.Deferred();
				
				theModal.removeClass('hidden').hide().slideDown(200,function(){
						
					Deff_open.resolve();
				});
				
				
				container.slideUp(200, function(){
					Deff_close.resolve();
				});
				
				
				$.when(Deff_open,Deff_close).done(function(){
					
					
					$("html, body").animate({
				          scrollTop: theModal.offset().top - h_offset
			         }, 200, 'swing', function(){
				         
				         //# reajustamos después del scroll por si es una cabecera affix (con retardo extra para que affix se ejecute)
				         
				         setTimeout(function(){
					         console.log(h_offset);
					         
					         //# solo reajustamos si teniamos una cabecera normal para ver si cambió.
					         if(h_offset == 0){
					         
						         h_offset = (header.size() == 1 && header.css('position') == 'fixed') ? header.outerHeight() : 0;
						         console.log(h_offset);
						         
						         //theModal.find('iframe').attr('height', wh - h_offset);
						         $("html, body").scrollTop(theModal.offset().top - h_offset);
						         theModal.find('iframe').attr('height', wh - h_offset);
					         }
					         
					         
				         }, 1000);
				         
				         
				         
				         
/*
						 header.on('affixed.bs.affix', function (e) {
							 console.log("affixed");
							 h_offset = header.outerHeight();
						  	$("html, body").scrollTop(theModal.offset().top - h_offset);
						  	
						  	header.off('affixed.bs.affix');
						 });*/
				         
			         });
				});

			});
			
			
			
		});
		
	});