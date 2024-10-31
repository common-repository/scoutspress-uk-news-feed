<?php

class spUkNewsFeedWidget extends \WP_Widget {

	protected $scoutsPress;

	/**
	* Sets up the widgets name etc
	*/
	public function __construct() {

	$this->scoutsPress = new spUkNewsFeed();

	$widget_ops = array(
	'classname' => $this->scoutsPress->getPluginName(),
	'description' => $this->scoutsPress->getPluginDescription(),
	);
	parent::__construct( $this->scoutsPress->getPluginName(), $this->scoutsPress->getPluginTitle() , $widget_ops );
	}

	/**
	* Outputs the content of the widget
	*
	* @param array $args
	* @param array $instance
	*/
	public function widget( $args, $instance ) {

	// outputs the content of the widget
	echo $this->scoutsPress->createWidget();

	}

	/**
	* Outputs the options form on admin
	*
	* @param array $instance The widget options
	*/
	public function form( $instance ) {
	echo '<p class="no-options-widget">' . __('Options for this widget are set in the ScoutsPress control panel under UK News Feed.') . '</p>';
	}

}