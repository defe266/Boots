<?php

//----Dependencies----

//Config
include_once('functions/options.php');
include_once('functions/facebook.php');

//Basic libs
include_once('functions/bootstrap/bootstrap.php');

include_once('functions/metabox_gen/metabox_gen.php');
include_once('functions/fancybox/fancybox.php');
include_once('functions/stacktable/stacktable.php');
include_once('functions/elastislide/elastislide.php');
include_once('functions/functions_lib.php');
include_once('functions/ambrosite-post-link-plus/ambrosite-post-link-plus.php');
include_once('functions/google-code-prettify/google-code-prettify.php');
include_once('functions/youtubeParser/YoutubeParser.class.php');

include_once('functions/side_menu/side_menu.php');

include_once('functions/BootsAPI/BootsAPI.php');



//include_once('functions/bp/bp-functions.php' ); //compatibilidad con Buddypress
/* Only load code that needs BuddyPress to run once BP is loaded and initialized. */

function bp_compatibility_init() {
    include_once('functions/bp/bp-functions.php' );
}
add_action( 'bp_include', 'bp_compatibility_init' );



//Avanced libs
include_once('functions/shortcodes.php');
include_once('functions/metaboxes.php');
include_once('functions/slider_gen/slider_gen.php');

include_once('functions/cookieConsent/cookieConsent.php');


//Basic Setup
include_once('functions/setups/setup_theme.php');
include_once('functions/setups/setup_bootstrap.php');
include_once('functions/setups/setup_banners.php');
include_once('functions/setups/setup_portfolio.php');


///----Dependencies----


//Init

?>