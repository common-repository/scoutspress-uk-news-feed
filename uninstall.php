<?php


// exit if uninstall constant is not defined
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// delete the plugin options
delete_option( 'sp_uknewsfeed_options' );


