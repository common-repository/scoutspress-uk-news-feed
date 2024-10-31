<?php
/**
 * Copyright (c) 2017. ScoutsPress.com
 *
 */

class spUkNewsFeedAdmin extends \Scoutspress\Admin\Scoutspress_Admin {

	protected $pluginName = "sp_uknewsfeed";
	protected $pluginTitle = "UK News Feed";
	protected $sectionSettings = array(
		'section_params' => array(
            "title" => "News Feed Parameters",
			"subtitle" => "These settings will alter how the News Feed gets its data",
			"custom" => false
        ),
        'section_display' => array(
	        "title" => "Customize News Feed Display",
	        "subtitle" => "These settings will alter the look and feel of the News Feed display",
	        "custom" => false
        )
    );
	protected $pluginDefaultOptions = array(
			'newsfeed_posts'     => 5,
			'newsfeed_images'   => 'enable',
			'newsfeed_title'   => 'UK Scouts News'
    );

	protected $plugin_tabs = false;
	protected $sp_plugin_url;
	protected $sp_plugin_dir;

	public function __construct()
	{
		//add_shortcode('Dribbble', array($this, 'shortcode'));

		//do the path so that THIS plugin dir is used
		$this->sp_plugin_url = SCOUT_PRESS_NEWSFEED_PLUGIN_URL;
		$this->sp_plugin_dir = SCOUT_PRESS_NEWSFEED_PLUGIN_DIR;

		parent:: __construct();


	}

	/**
	 * Register the plugin specific settings fields
	 * This function is in the plugin as its specific
	 * to the plugin
	 */
	public function register_settings_fields(){

		add_settings_field(
			'newsfeed_posts',
			'Posts to Display',
			array($this,'callback_field_text'),
			'section_params',
			'section_params',
			[ 'id' => 'newsfeed_posts', 'label' => 'Number of News Feed posts to display' ]
		);

		add_settings_field(
			'newsfeed_title',
			'News Feed Title',
			array($this,'callback_field_text'),
			'section_display',
			'section_display',
			[ 'id' => 'newsfeed_title', 'label' => 'The Title of the News Feed Panel' ]
		);

		add_settings_field(
			'newsfeed_images',
			'Images',
			array($this,'callback_field_radio'),
			'section_display',
			'section_display',
			[ 'id' => 'newsfeed_images', 'label' => 'Display images in the News Feed' ]
		);

	}

	/**
	 * Validates the input from the admin forms
     * This function is in the plugin as its specific
     * to the plugin
     *
	 * @param $input
	 *
	 * @return mixed
	 */
	public function validate_admin_options($input){

		// start title
		if ( isset( $input['newsfeed_title'] ) ) {

			$input['newsfeed_title'] = sanitize_text_field( $input['newsfeed_title'] );

		}
		//end title

		// start number posts
		if ( isset( $input['newsfeed_posts'] ) ) {

			$input['newsfeed_posts'] = absint(sanitize_text_field( $input['newsfeed_posts'] ));
			if($input['newsfeed_posts'] == 0){
				$input['newsfeed_posts'] = 5;
            }

		}
		//end number posts

		// start images
		$radio_options = array(

			'enable'  => 'Enable',
			'disable' => 'Disable'

		);

		if ( ! isset( $input['newsfeed_images'] ) ) {

			$input['newsfeed_images'] = null;

		}
		if ( ! array_key_exists( $input['newsfeed_images'], $radio_options ) ) {

			$input['newsfeed_images'] = null;

		}
		//end images

		return $input;

	}


}