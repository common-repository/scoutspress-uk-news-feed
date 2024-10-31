<?php
/**
 * Copyright (c) 2017. ScoutsPress.com
 *
 */

/**
 * Loads the class attempting to be instantiated elsewhere in the
 * plugin. Very simple approach as auto load was horrendous!
 *
 * @package Scoutspress
 */


$home_path = trailingslashit( dirname( __FILE__ ) ) ;

$files_to_load = array(
	"class-sp-uk-newsfeed.php",
	"class-sp-uk-newsfeed-widget.php",
	"class-sp-uk-newsfeed-admin.php",
	"utility/class-sp-newsfeed-templatepartloader.php"
);

foreach ($files_to_load as $f){

		require_once $home_path . $f;


}