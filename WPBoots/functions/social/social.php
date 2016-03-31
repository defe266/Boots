<?php
	
	
	
	//##### share buttons #####
	
	
	
	/** Get tweet count from Twitter API (v1.1) */

	function ds_post_tweet_count( $post_id ) {
	 
	  // Check for transient
	  if ( ! ( $count = get_transient( 'ds_post_tweet_count' . $post_id ) ) ) {
	 
	    // Do API call
	    $response = wp_remote_retrieve_body( wp_remote_get( 'https://cdn.api.twitter.com/1/urls/count.json?url=' . urlencode( get_permalink( $post_id ) ) ) );
	 
	    // If error in API call, stop and don't store transient
	    if ( is_wp_error( $response ) )
	      return 'error';
	 
	    // Decode JSON
	    $json = json_decode( $response );
	 
	    // Set total count
	    $count = absint( $json->count );
	 
	    // Set transient to expire every 30 minutes
	    set_transient( 'ds_post_tweet_count' . $post_id, absint( $count ), 30 * MINUTE_IN_SECONDS );
	 
	  }
	 
	 return absint( $count );
	 
	}  /** Twitter End */
	 
	 
	/** Get like count from Facebook FQL  */
	
	function ds_post_like_count( $post_id ) {
	 
	  // Check for transient
	  if ( ! ( $count = get_transient( 'ds_post_like_count' . $post_id ) ) ) {
	 
	    // Setup query arguments based on post permalink
	    $fql  = "SELECT url, ";
	    //$fql .= "share_count, "; // total shares
	    //$fql .= "like_count, "; // total likes
	    //$fql .= "comment_count, "; // total comments
	    $fql .= "total_count "; // summed total of shares, likes, and comments (fastest query)
	    $fql .= "FROM link_stat WHERE url = '" . get_permalink( $post_id ) . "'";
	 
	    // Do API call
	    $response = wp_remote_retrieve_body( wp_remote_get( 'https://api.facebook.com/method/fql.query?format=json&query=' . urlencode( $fql ) ) );
	 
	    // If error in API call, stop and don't store transient
	    if ( is_wp_error( $response ) )
	      return 'error';
	 
	    // Decode JSON
	    $json = json_decode( $response );
	 
	    // Set total count
	    $count = absint( $json[0]->total_count );
	 
	    // Set transient to expire every 30 minutes
	    set_transient( 'ds_post_like_count' . $post_id, absint( $count ), 30 * MINUTE_IN_SECONDS );
	 
	  }
	 
	 return absint( $count );
	 
	} /** Facebook End  */
	
	
	/** Get share count from Google Plus */
	
	function ds_post_plusone_count($post_id) {
	
		// Check for transient
		if ( ! ( $count = get_transient( 'ds_post_plus_count' . $post_id ) ) ) {
	     
		    $args = array(
		            'method' => 'POST',
		            'headers' => array(
		                // setup content type to JSON 
		                'Content-Type' => 'application/json'
		            ),
		            // setup POST options to Google API
		            'body' => json_encode(array(
		                'method' => 'pos.plusones.get',
		                'id' => 'p',
		                'method' => 'pos.plusones.get',
		                'jsonrpc' => '2.0',
		                'key' => 'p',
		                'apiVersion' => 'v1',
		                'params' => array(
		                    'nolog'=>true,
		                    'id'=> get_permalink( $post_id ),
		                    'source'=>'widget',
		                    'userId'=>'@viewer',
		                    'groupId'=>'@self'
		                ) 
		             )),
		             // disable checking SSL sertificates               
		            'sslverify'=>false
		        );
		     
		    // retrieves JSON with HTTP POST method for current URL  
		    $json_string = wp_remote_post("https://clients6.google.com/rpc", $args);
		     
		    if (is_wp_error($json_string)){
		        // return zero if response is error                             
		        return "0";             
		    } else {        
		        $json = json_decode($json_string['body'], true);                    
		        // return count of Google +1 for requsted URL
		        $count = intval( $json['result']['metadata']['globalCounts']['count'] ); 
		    }
		    
		    // Set transient to expire every 30 minutes
			set_transient( 'ds_post_plus_count' . $post_id, absint( $count ), 30 * MINUTE_IN_SECONDS );
		    
		}
	 
		return absint( $count );    
	} /** Google Plus End */
	
	
	/** Get Flattr count */
	
	function ds_post_flattr_count( $post_id ) {
	 
	  // Check for transient
	  if ( ! ( $count = get_transient( 'ds_post_flattr_count' . $post_id ) ) ) {
	 
	    // Check if URL exists
	    $response = wp_remote_retrieve_body( wp_remote_get( 'https://api.flattr.com/rest/v2/things/lookup/?url=' . urlencode( get_permalink( $post_id ) ) ) );
	 
	    // Decode JSON
	    $json = json_decode( $response );
	 
		// Get URL ID
		$message = $json->message;
		
		if ($message == "not_found") {
	      return 0;
		}
		
		else {
			$location = $json->location;
			$flattrs = $json->flattrs;
			$count = $flattrs;
		}
		
		// Set transient to expire every 30 minutes
		set_transient( 'ds_post_flattr_count' . $post_id, absint( $count ), 30 * MINUTE_IN_SECONDS );
	 
	  }
	 
	 return absint( $count );
	 
	} /** Flattr End */
	
	
	/** Get Count from LinkedIn */
	
	function ds_post_linkedin_count( $post_id ) {
	 
	  // Check for transient
	  if ( ! ( $count = get_transient( 'ds_post_linkedin_count' . $post_id ) ) ) {
	 
	    // Do API call
	    $response = wp_remote_retrieve_body( wp_remote_get( 'https://www.linkedin.com/countserv/count/share?url=' . urlencode( get_permalink( $post_id ) ) . '&format=json' ) );
	 
	    // If error in API call, stop and don't store transient
	    if ( is_wp_error( $response ) )
	      return 'error';
	 
	    // Decode JSON
	    $json = json_decode( $response );
	 
	    // Set total count
	    $count = absint( $json->count );
	 
	    // Set transient to expire every 30 minutes
	    set_transient( 'ds_post_linkedin_count' . $post_id, absint( $count ), 30 * MINUTE_IN_SECONDS );
	 
	  }
	 
	 return absint( $count );
	
	}  /** LinkedIn End */
	
	
	
	 
	/** Expose function */
	
	function WPB_social_shareButtons() {
		
	  	// Get the post ID
	 	$post_id = get_the_ID(); ?>
	 
		<ul class="block-social  bordered"><!--colored-->
			<!-- Facebook Button-->
			<li class="social-facebook">
				<a onclick="javascript:popupCenter('https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>&amp;appId=<?php echo get_option("wpboots_facebookID"); ?>','Facebook Share', '540', '400');return false;" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>&amp;appId=<?php echo get_option("wpboots_facebookID"); ?>" target="blank"> <i class="icon icon-facebook fa fa-facebook" title="Share"></i> </a><span class="share-count"><?php //echo ds_post_like_count( $post_id ); ?></span>
			</li>
			<!-- Twitter Button -->
			<li class="social-twitter">
				<a onclick="javascript:popupCenter('https://twitter.com/share?&amp;url=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;','Tweet', '540', '400');return false;" href="https://twitter.com/share?&amp;url=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;via=XXX_YOUR_TWITTER_HANDLE" target="blank"> <i class="icon icon-twitter fa fa-twitter" title="Tweet"></i> </a><!--via=XXX_YOUR_TWITTER_HANDLE-->
			</li>
			<!-- Google + Button-->
			<li class="social-google">
				<a onclick="javascript:popupCenter('https://plus.google.com/share?url=<?php the_permalink(); ?>','Share on Google+', '600', '600');return false;" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="blank"> <i class="icon icon-google-plus fa fa-google-plus" title="Share"></i> </a><span class="share-count"><?php //echo ds_post_plusone_count( $post_id ); ?></span>
			</li>

			<!-- LinkedIn Button -->
			<li class="social-linkedin">
				<a onclick="javascript:popupCenter('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>&amp;source=<?php site_url(); ?>','Share on LinkedIn', '520', '570');return false;" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>&amp;source=<?php site_url(); ?>" target="blank"> <i class="icon icon-linkedin fa fa-linkedin" title="Share"></i>  </a><span class="share-count"><?php //echo ds_post_linkedin_count( $post_id ); ?></span>
			</li>
		</ul>
	  
	  <script>
		  	var popupCenter = function(url, title, w, h) {
		        // Fixes dual-screen position                         Most browsers      Firefox
		        var dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : screen.left;
		        var dualScreenTop = window.screenTop !== undefined ? window.screenTop : screen.top;
		
		        var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
		        var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;
		
		        var left = ((width / 2) - (w / 2)) + dualScreenLeft;
		        var top = ((height / 3) - (h / 3)) + dualScreenTop;
		
		        var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
		
		        // Puts focus on the newWindow
		        if (window.focus) {
		            newWindow.focus();
		        }
		    };
	  </script>
	  
	  
	  <style>
		  

			.block-social{
					
				padding: 0;
				margin: 0;
				list-style: none;
			}
			
			.block-social li{
				display: inline-block;
			    margin: 5px;
			}

			
			.block-social i{
				margin: 0 8px;
				font-size: 18px;
			}
			
			.block-social a{
				color: #A6A6A6;
			}
			
			
			.block-social.colored .social-facebook a{
				color: #4463A2;
			}
			
			.block-social.colored .social-twitter a{
				color: #69B2E1;
			}
			
			.block-social.colored .social-google a{
				color: #CB3E2B;
			}
			
			.block-social.colored .social-linkedin a{
				color: #0075B6;
			}
			
			
			.block-social.bordered li{
				
			    border-radius: 50%;
			    color: #fff;
			    height: 32px;
			    width: 32px;
			    line-height: 36px;
			    position: relative;
			}
			
			.block-social.bordered li a{
				color: #fff;
			    display: block;
			    text-align: center;
			}
			
			.block-social.bordered .share-count{
				display: none;
				/*
				background: none repeat scroll 0 0 #444;
			    bottom: 0;
			    font-size: 9px;
			    line-height: 9px;
			    padding: 2px 3px;
			    position: absolute;
			    right: 0;*/
			}
			
			.block-social.bordered .social-facebook{
				background: #4463a2;
			}
			
			.block-social.bordered .social-twitter{
				background: #69B2E1;
			}
			
			.block-social.bordered .social-google{
				background: #CB3E2B;
			}
			
			.block-social.bordered .social-linkedin{
				background: #0075B6;
			}


			

	  </style>
	  
	 
	<?php }




?>