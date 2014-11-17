<?php

	function facebook_sdk(){
		/*
		?>
		
			<script>
			  window.fbAsyncInit = function() {
			    FB.init({
			      appId      : <?php echo get_option("wpboots_facebookID"); ?>,
			      xfbml      : true,
			      version    : 'v2.2'
			    });
			  };
			
			  (function(d, s, id){
			     var js, fjs = d.getElementsByTagName(s)[0];
			     if (d.getElementById(id)) {return;}
			     js = d.createElement(s); js.id = id;
			     js.src = "//connect.facebook.net/en_US/sdk.js";
			     fjs.parentNode.insertBefore(js, fjs);
			   }(document, 'script', 'facebook-jssdk'));
			</script>
		
		<?php
		*/
		
		?>
		
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&appId=<?php echo get_option("wpboots_facebookID"); ?>&version=v2.0";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
		
		<?php
	}



	add_action('before', 'facebook_sdk');
?>