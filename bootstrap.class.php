<?php
! defined( 'ABSPATH' ) AND exit;
/**
 * Plugin Name: Current admin screen info
 * Description: Show information about contextual hooks and availability of globals in the admin UI.
 * Version:     2012-09-14.1801
 * Author:      Franz Josef Kaiser <wecodemore@gmail.com>
 * Author URI:  http://unserkaiser.com
 * License:     The MIT License (MIT)
 * 
 * Copyright:   © Franz Josef Kaiser 2011-2012
 */


if ( ! class_exists( 'current_screen_data_bootstrap' ) )
{
	add_action( 'plugins_loaded', array( 'current_screen_data_bootstrap', 'init' ), 5 );

final class current_screen_data_bootstrap
{
	private static $instance;

	private $includes = array(
		 'base.abstract'
		,'hooks.class'
		,'globals.class'
	);

	public static function init()
	{
		null === self :: $instance AND self :: $instance = new self;
		return self :: $instance;
	}

	public function __construct()
	{
		foreach ( $this->includes as $file )
			require_once plugin_dir_path( __FILE__ )."inc/{$file}.php";
	}
} // END Class current_screen_data_bootstrap
	
} // endif;