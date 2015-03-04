jQuery(function($){
	
	
	function getUrl(item){

	  if( item.find('.item-img').size() > 0 ){
	    
	    return item.find('.item-img').css('background-image').replace(/^url\(['"]?/,'').replace(/['"]?\)$/,'');
	    
	  }else{
	      return item.find('img').attr('src');
	  }
	}
	
	function preload(urls) {
	
		var images = new Array()
		
		for (i = 0; i < urls.length; i++) { //preload.arguments
		
		  images[i] = new Image()
		  images[i].src = urls[i]
		}
	}
	
	function preloadNext(item){
	
		
		var prev = item.prev();
		var next = item.next();
		
		
		var urls = [];
	  
		if(prev.size() > 0){
		
			//urls.push(prev.find('.item-img').css('background-image').replace(/^url\(['"]?/,'').replace(/['"]?\)$/,''));
			
			urls.push( getUrl(prev) );
		}else{
			//urls.push(item.parent().find(".item").last().find('.item-img').css('background-image').replace(/^url\(['"]?/,'').replace(/['"]?\)$/,''));
			urls.push( item.parent().find(".item").last() );
		}
		
		if(next.size() > 0){
		
			urls.push( getUrl(next) );
			//urls.push(next.find('.item-img').css('background-image').replace(/^url\(['"]?/,'').replace(/['"]?\)$/,''));
		}else{
			//urls.push(item.parent().find(".item").first().find('.item-img').css('background-image').replace(/^url\(['"]?/,'').replace(/['"]?\)$/,''));
			
			//urls.push( item.parent().find(".item").first() );
		}
		
		
		//preload(urls);	
	}
	
	
	//precargo la imagen del siguiente y el anterior
	$('.carousel.slide').each(function(){
		
		$(this).on('slide.bs.carousel', function (e) {

			preloadNext( $(e.relatedTarget) );
			
		});
		
		preloadNext( $(this).find('.item').eq(0) );
		
	});
	
});