jQuery(function($) {


	//$.removeCookie('cookieConsent');
	//$.removeCookie('cookieConsent', { path: '/' });


	//!!provisional para pruebas
	//if( window.location.href == "http://avantihotelboutique.com/atico/test"){//!!provisional para pruebas
	
	
		//si no tiene la cookie
		if( $.cookie('cookieConsent') != 'true' ){
			
			//introducimos banner
			$('body').append(wp_cookieConsent.bannerContent)
			
			//esperamos confirmación
			$('#cookieConsentButton').bind('click', function(){
				
				//si acepta, seteo la cookie
				$.cookie('cookieConsent', 'true', { expires: 3650, path: '/' });//expira en 10 años
				
				$('#cookieConsent-container').slideUp(400, function(){
					
					this.remove();
				});
				
			});
		}
		
	//}//!!provisional para pruebas
	

	
	
	
	
	
	
	
	

});