//ajax request para contar clicks
//var WPBannerizeJavascript={version:"1.0",incrementClickCount:function(a){jQuery.post(wpBannerizeJavascriptLocalization.ajaxURL,{action:'wpBannerizeClickCounter',id:a})}};


var sliderGen = {

	incrementClickCount:function(id){
	
		jQuery.post( wp.site_url+"/wp-admin/admin-ajax.php", {
			action:'slider_ClickCounter',
			id:id
		});
	}
};