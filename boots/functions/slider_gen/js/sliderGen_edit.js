jQuery(function ($){

	
	var data = $('#slider_gallery').val();
	
	//# iniciamos media con los elementos guardados
	if(data != ''){
	
		var shortcode = new wp.shortcode({
	        tag:      'gallery',
	        attrs:    { ids: data },//'94,91,92' },
	        type:     'single'
	    });
	
		var attachments = wp.media.gallery.attachments( shortcode );
		    
	    var selection = new wp.media.model.Selection( attachments.models, {
	        props:    attachments.props.toJSON(),
	        multiple: true
	    });
	     
	    selection.gallery = attachments.gallery;
	 
	    selection.more().done( function() {
	        selection.props.set({ query: false });
	        selection.unmirror();
	        selection.props.unset('orderby');
	    });
	
	    
		//# creamos le objeto
		var mediaView = wp.media({
	
	        id:         'my-frame',          
	        frame:      'post',
	        state:      'gallery-edit',
	        title:      wp.media.view.l10n.editGalleryTitle,
	        library : { type : 'image'},
	        editing:    true,
	        multiple:   true,
	        selection: selection
	    });
    
    }else{
    
    	//# creamos le objeto
		var mediaView = wp.media({
	
	        id:         'my-frame',          
	        frame:      'post',
	        state:      'gallery-edit',
	        title:      wp.media.view.l10n.editGalleryTitle,
	        library : { type : 'image'},
	        editing:    true,
	        multiple:   true
	    });
    }



	//# abrimos la ventana
	$('#selectSliderGalleryBtn').on('click',function(){
		
		mediaView.open();
		
	});
	
	
	//# guardamos los datos
	mediaView.on('update', function(collection){
	
		collection = collection.toJSON();
		
		console.log('collection',collection);
		
		var ids = '';
		
		for(var i in collection){
		
			ids += collection[i].id
			
			if(i < collection.length - 1){
			
				ids += ',';
			}
		}
		
		$('#slider_gallery').val(ids);
	});


});