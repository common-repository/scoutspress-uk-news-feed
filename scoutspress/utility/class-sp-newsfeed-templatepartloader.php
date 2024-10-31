<?php
/**
 * Copyright (c) 2017. ScoutsPress.com
 *
 */

class ScoutsPress_NF_Template_Loader extends Gamajo_Template_Loader {

	protected $filter_prefix = 'scoutspress';

	protected $theme_template_directory = 'scoutspress';

	protected $plugin_directory = SCOUT_PRESS_ONLINEPAYMENTS_PLUGIN_DIR ;

	protected $plugin_template_directory = 'scoutspress/templates';
}
