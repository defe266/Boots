
var BootsAPI = {};


jQuery(function ($){

	//BootsAPI.lib = {};
	
	//# info básica de wp
	BootsAPI.wp = BootsAPI_wp;
	
	//# librería de funciones
	BootsAPI.deparam = function (querystring) {
	  // remove any preceding url and split
	  querystring = querystring.substring(querystring.indexOf('?')+1).split('&');
	  var params = {}, pair, d = decodeURIComponent, i;
	  // march and parse
	  for (i = querystring.length; i > 0;) {
	    pair = querystring[--i].split('=');
	    params[d(pair[0])] = d(pair[1]);
	  }
	
	  return params;
	};//--  fn  deparam
	
	
	BootsAPI.showFormErrors = function(form,errors){
		
	    //reiniciamos todos los textos de error
	    form.find('.form-group').removeClass('has-error');
	    form.find('.control-label').text('');
	    
		//Muestro cada error
	    for (var i in errors){
	    
	    	//busco inputs
	        var elm = form.find('input[name="'+ i +'"]').closest('.form-group');//.parent();
			
			
			$(elm).addClass("has-error");
	        $(elm).find('.control-label').text( errors[i][0] );
	        
	        //busco textareas
	        var elm = form.find('textarea[name="'+ i +'"]').closest('.form-group');//.parent();
	
	        $(elm).addClass("has-error");
	        $(elm).find('.control-label').text( errors[i][0] );
	        
	        //busco selects
	        var elm = form.find('select[name="'+ i +'"]').closest('.form-group');//.parent();
	        
	        $(elm).addClass("has-error");
	        $(elm).find('.control-label').text( errors[i][0] );
	    }
	}
	
	
	BootsAPI.getFormParams = function(form){
	
		var formData = {};
	
		form.find("input, select, textarea").each(function () {
	        
	    	// solo introducimos automáticos aquellos que tengan atributo name
			if(typeof($(this).attr("name")) !== 'undefined'){
				
				
				//por defecto su valor es un val()
				var value = $(this).val();
				

	
				// si es un select multiple
				if( $(this).attr("multiple") == 'multiple'){
				
					var value = ($(this).val() != null) ? $(this).val() : [];
				}
				
				//si es un checkbox
				if( $(this).is(':checkbox') ){
				
					var value = ( $(this).prop('checked') ) ? "true" : "false";
				}
				
				
				//introducimos el valor en el objeto POST
				formData[$(this).attr("name")] = value;
				
	
			}
	    });
	    
	    return formData;
	}
	
	
	
});
