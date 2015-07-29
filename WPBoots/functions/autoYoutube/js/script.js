jQuery(function($){
	
		$('.YVideo').click(function (e) {
		
			var self = this;
  
	  		e.preventDefault();
	  		
	  		var wh = $(window).height();
	      
	  		var videoSRC = $(this).attr("data-YVideo");
	  		var videoSRCauto = videoSRC + "?autoplay=1&rel=0&showinfo=0";
	  		var theModal = $('<div id="video-holder" class="hidden"><div class=""><a class="closeButton"><i class="fa fa-times-circle-o"></i></a><iframe width="100%" height="'+wh+'" src="'+videoSRCauto+'" frameborder="0" allowfullscreen></iframe></div></div>');
	  		
	  		$(this).after(theModal);
	  		
	  		theModal.css('position','relative');
	  		//theModal.height(wh);
	  		
	  		
	  		var closeButton = theModal.find(".closeButton");
	  		
	  		closeButton.css('font-size','50px');
	  		closeButton.css('position','absolute');
	  		closeButton.css('right','20px');
	  		closeButton.css('top','20px');
	  		closeButton.css('color','#fff');
	  		closeButton.css('text-shadow','2px 2px 2px #000');

	  		
	  		
	  		closeButton.click(function(){
		  		
		  		$(self).slideDown(200);
		  		
		  		
		  		theModal.slideUp(200,function(){
			  		
			  		theModal.remove();
		  		});
	  		});
	  		
	  		
	  		theModal.removeClass('hidden').hide().slideDown(200,function(){
		          
	          $("html, body").animate({
		          scrollTop: theModal.offset().top
	          });
	          
			});
	  		
	  		$(this).slideUp(200);
	  		
	  		//theModal.find('iframe').attr('src', videoSRCauto);
	  		
	  		
	  		
	      /*
	          var theModal = $("#video-holder"),
	              videoSRC = $(this).attr("data-YVideo"),
	              videoSRCauto = videoSRC + "?autoplay=1";
	          

	          $('#wideblock-video').slideUp(200);//hide(); 
	          $('#video-holder').removeClass('hidden').hide().slideDown(200,function(){
		          
		          $("html, body").animate({
			          scrollTop:$('#video-holder').offset().top
		          });
		          
	          });
	          
	          theModal.find('iframe').attr('src', videoSRCauto);
	          
	          */
	          //$(window).scrollTop($('#video-holder').offset().top);
	   });
		
	});