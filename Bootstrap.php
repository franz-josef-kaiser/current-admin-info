<?php
/**
 * Plugin Name:  Current admin screen info
 * Description:  Show information about contextual hooks and availability of globals in the admin UI.
 * Version:      2.0
 * Author:       Franz Josef Kaiser <wecodemore@gmail.com>
 * Author URI:   http://unserkaiser.com
 * Contributers: Stephen Harris
 * License:      The MIT License (MIT)
 * License URI:  http://www.tldrlegal.com/license/mit-license
 *
 * Copyright:    © Franz Josef Kaiser 2011-2015
 */

if ( file_exists( __DIR__.'/vendor/autoload.php' ) )
	require __DIR__.'/vendor/autoload.php';

use WCM\CurrentAdminInfo\Hooks;
use WCM\CurrentAdminInfo\Screen;
use WCM\CurrentAdminInfo\Globals;

add_action( 'plugins_loaded', function()
{
	if ( ! is_admin() )
		return;

	$hooks = new Hooks;
	$hooks->setup();

	$screen = new Screen;
	$screen->setup();

	$globals = new Globals;
	$globals->setup();
}, 5 );