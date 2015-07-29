jQuery(function($){

//# Mosaico
   
   $(window).on('load',function(){
	
		
		$('.masonry-row').masonry({

			columnWidth: ".masonry-sizer",
				//columnWidth: document.querySelector('.js-masonry').querySelector('.mosaic-grid-sizer'),
			//columnWidth: 230,//".mosaic-grid-sizer",//230,
			//isFitWidth: true,
			itemSelector: ".masonry-col"/*,
			
			columnWidth: function( containerWidth ) {
			    return containerWidth / 4;
			}*/
			
			//gutter: ".mosaic-gutter-sizer",
			//isResizable: false,
			//isAnimated: true//4
		  
		});
		
		//$('.js-masonry').masonry('bindResize');
		
	});
})