<?php
/**
 * Copyright (c) 2017. ScoutsPress.com
 *
 */

class spUkNewsFeed extends \Scoutspress\Scoutspress {

	protected $pluginName = "sp_uknewsfeed";
	protected $pluginTitle = "UK Scouts News Feed";
	protected $pluginDescription = "Provides news items from the Scouts UK Website";
	protected $pluginPosts = 5;
	protected $pluginShowImages = "enable";

	protected $css_scripts = array(
		//add your css in here (name/location)
		array("path" => "public/css/sp_uknewsfeed.css", "location" => "local", "name" => "UK_NewsFeed_CSS")
	);
	protected $js_scripts = array(
		//add your scripts in here
		array("path" => "public/js/sp_uknewsfeed.js", "location" => "local", "name" => "UK_NewsFeed_JS")
	);

	protected $sp_plugin_url;

	public function __construct() {

		//do the path so that THIS plugin dir is used
		$this->sp_plugin_url = SCOUT_PRESS_NEWSFEED_PLUGIN_URL;

		parent:: __construct();

	}

	/**
	 * fire up the widgets and scripts etc
	 */
	public function init(){

		//now enqueue scripts etc
		add_action( 'wp_enqueue_scripts', array($this,'enqueue_plugin_scripts') );
		add_action( 'widgets_init', function(){ register_widget( 'spUkNewsFeedWidget' ); });
	}

	public function createWidget(){

		//get our settings options
		$opts = get_option($this->getPluginName()."_options");

		//test the settings
		$numPosts = (empty($opts['newsfeed_posts']))? $this->pluginPosts : $opts['newsfeed_posts'];
		$titleBar = (empty($opts['newsfeed_title']))? $this->getPluginTitle() : $opts['newsfeed_title'];
		$showImages = (empty($opts['newsfeed_images']))? $this->pluginShowImages : $opts['newsfeed_images'];

		//set the params for the widget here
		$url = "https://scoutspress.com/api/v1/feeds/ukscoutsnews/{$numPosts}";

		$response = json_decode(wp_remote_retrieve_body(wp_remote_get($url)));

		//make up the widget
		$wg = "<div class='sp_uknf_container'>";
		$wg .= "<div class='sp_uknf_header'>";

		$wg .= "<img class='sp_uknf_header_image' src='".plugins_url("/public/img/sp_FDL_th.png",dirname(__FILE__))."'/> {$titleBar} </div>";
		$wg .= "<div class='sp_uknf_body'>";


		//repeat the data in the card body
		if(!empty($response)) {
			foreach ( $response as $dd ) {
				$wg .= "<h5 class='sp_uknf_post_title'>{$dd->sf_title}</h5>";
				$wg .= "<p class='sp_uknf_text_small'>Published: {$dd->sf_date}</p>";
				$wg .= "<img class='sp_uknf_image' src='{$dd->sf_image}'/>";
				$wg .= "<p class='sp_uknf_text'>{$dd->sf_content}<a href='{$dd->sf_link}' target='_blank'>..read more</a> </p>";
			}
		}else{
			$wg .= "<p><strong>Sorry!</strong> It seems we are unable to establish connection with the News Feed.</p>";
		}

		//close the box
		$wg .= "</div></div>";


		return $wg;
	}
}