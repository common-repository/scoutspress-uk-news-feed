<?php
/*
Plugin Name:       ScoutsPress UK News Feed
Description:       Plugin to display posts from the UK Scouts Website
Plugin URI:        https://scoutspress.com
Contributors:      scoutspress
Author:            Owen Lees
Author URI:        https://scoutspress.com/about-us
Donate link:       https://scoutspress.com/
Tags:              scouts, news feed
Version:           0.1.8
Requires at least: 4.5
Tested up to:      4.9
Text Domain:       sp-uknewsfeed
License:           GPL v2 or later
License URI:       https://www.gnu.org/licenses/gpl-2.0.txt

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version
2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
with this program. If not, visit: https://www.gnu.org/licenses/
*/

//exit if called directly
if ( ! defined( 'ABSPATH' )){
	//quit
	exit();
}

$url = plugin_dir_url(__FILE__);
define('SCOUT_PRESS_NEWSFEED_PLUGIN_URL',$url);

$baseDir = trailingslashit( dirname( __FILE__ ) );
define('SCOUT_PRESS_NEWSFEED_PLUGIN_DIR',$baseDir);

//check that ScoutsPress exists
add_action( 'admin_init', 'checkForScoutsPressNF' );

//hooks for activation and deactivation
if(class_exists("Scoutspress\\Scoutspress")) {
	register_activation_hook( __FILE__, 'sp_newsfeed_activation' );
	register_deactivation_hook( __FILE__, 'sp_newsfeed_deactivation' );
}

add_action( 'plugins_loaded', 'init_sp_newsfeed' ,20);

function init_sp_newsfeed(){

	if(class_exists("Scoutspress\\Scoutspress")) {

		require_once( SCOUT_PRESS_NEWSFEED_PLUGIN_DIR . 'scoutspress/loader.php' );

		$sp_uk_news = new spUkNewsFeed();
		$sp_uk_news->init();

		if (is_admin()){
			$sp = new spUkNewsFeedAdmin();
			$sp->initAdminMenu();
		}
	}
}

//create CPT as required on plugin deactivation
function sp_newsfeed_activation(){
	//nothing to init for this plugin
}

function sp_newsfeed_deactivation(){
	//nothing to deactivate for this plugin
}

function checkForScoutsPressNF(){

	if(!class_exists("Scoutspress\\Scoutspress")) {
		deactivate_plugins( plugin_basename( __FILE__ ) );
	}

}