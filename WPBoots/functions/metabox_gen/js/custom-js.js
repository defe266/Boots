//jQuery(function(jQuery) {
jQuery(function($) {
	
	jQuery(function ($)
	{
	
		   /* Inicialización en español para la extensión 'UI date picker' para jQuery. */
				   /* Traducido por Vester (xvester [en] gmail [punto] com). */
				   jQuery(function($){
					  $.datepicker.regional['es'] = {
							 closeText: 'Cerrar',
							 prevText: '<Ant',
							 nextText: 'Sig>',
							 currentText: 'Hoy',
							 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
							 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
							 dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi\u00e9rcoles', 'Jueves', 'Viernes', 'S\u00e1bado'],
							 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','S\u00e1b'],
							 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S\u00e1'],
							 weekHeader: 'Sm',
							 dateFormat: 'yy-mm-dd',
							 firstDay: 1,
							 isRTL: false,
							 showMonthAfterYear: false,
							 yearSuffix: ''};
					  $.datepicker.setDefaults($.datepicker.regional['es']);
				   });
	})
	
	
	
	jQuery('#media-items').bind('DOMNodeInserted',function(){
		jQuery('input[value="Insert into Post"]').each(function(){
				jQuery(this).attr('value','Use This Image');
		});
	});
	
	jQuery('.custom_upload_image_button').click(function() {
		formfield = jQuery(this).siblings('.custom_upload_image');
		preview = jQuery(this).siblings('.custom_preview_image');
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			classes = jQuery('img', html).attr('class');
			id = classes.replace(/(.*?)wp-image-/, '');
			formfield.val(id);
			preview.attr('src', imgurl);
			tb_remove();
		}
		return false;
	});
	
	jQuery('.custom_clear_image_button').click(function() {
		var defaultImage = jQuery(this).parent().siblings('.custom_default_image').text();
		jQuery(this).parent().siblings('.custom_upload_image').val('');
		jQuery(this).parent().siblings('.custom_preview_image').attr('src', defaultImage);
		return false;
	});
	
	jQuery('.repeatable-add').click(function() {
		field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true);
		fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
		jQuery('input', field).val('').attr('name', function(index, name) {
			return name.replace(/(\d+)/, function(fullMatch, n) {
				return Number(n) + 1;
			});
		})
		field.insertAfter(fieldLocation, jQuery(this).closest('td'))
		return false;
	});
	
	jQuery('.repeatable-remove').click(function(){
		jQuery(this).parent().remove();
		return false;
	});
		
	jQuery('.custom_repeatable').sortable({
		opacity: 0.6,
		revert: true,
		cursor: 'move',
		handle: '.sort'
	});
	
	
	
	
	$(document).ready(function(){
	
		$('.custom_meta_box select.chosen').chosen();
		
	});
	
	
	
	
	
	//## gallery
	
	
	
	$('.metabox_gallery').each(function(){
	
		var gal = $(this);
	
		var data = gal.find('.data').val();
		
		
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
		gal.find('.button').on('click',function(){
			
			mediaView.open();
			
		});
		
		
		//# guardamos los datos
		mediaView.on('update', function(collection){
		
			collection = collection.toJSON();
			
			//console.log('collection',collection);
			
			var ids = '';
			
			for(var i in collection){
			
				ids += collection[i].id
				
				if(i < collection.length - 1){
				
					ids += ',';
				}
			}
			
			gal.find('.data').val(ids);
		});
	
	});
	
	
	
	
	
	

});