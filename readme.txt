=== WCM Current Admin Info ===
Contributors: F J Kaiser, stephenharris
Tags: debug, globals, hooks, admin, current screen, contextual help, development, debug
Tested up to: 3.5
Stable tag: 1.1
Requires at least: 3.5
License: MIT
License URI: http://www.tldrlegal.com/license/mit-license

Developer info about the current admin screen, its globals and contextual hooks at your finger tips.

== Description ==

WCM Current Admin Info displays info about globals, contextual hooks and the current admin screen in new tabs in the »Contextual Help«-panel in the upper right corner of an admin screen.

= What is WCM? =

WeCodeMore (WCM) is your label for high quality WordPress code from renowned authors.

If you want to get updates, just follow us on…

 * <a href="https://plus.google.com/b/109907580576615571040/109907580576615571040/posts">our page on Google+</a>
 * <a href="https://github.com/wecodemore">our GitHub repository</a>

Based on an idea by Stephen Harris / @stephenharris

= Currently available info tabs =

* Contextual hooks - all hooks that have »context«, the `$hook_suffix` in their name.
* Set Globals: Arrays/Objects are hidden and shown on click (js).
* Current screen info: Everything that the `$current_screen` object contains and isn't private.

== Frequently Asked Questions ==

= How do I extend the plugin? =

Write a normal plugin (or mu-plugin) with a plugin header and a class.
Then write a simple class that extends the `current_screen_data` class and it hook into `plugins_loaded`.
Your class needs only two methods:

* a static `init()` method
* and a method that that is named `collect()` and does exactly that to your data for the output
* you can optionally add a third method named `markup()` if you don't want a list. It has one argument that is your collected data.

Here's an example:

	<?php
	/** Plugin Name: (WCM) CAI Extension */
	defined( 'ABSPATH' ) OR exit;

	add_action( 'plugins_loaded', array( 'wcm_cai_extension', 'init' ), 20 );
	final class wcm_cai_extension extends current_screen_data
	{
		private static $instance;

		public static function init()
		{
			null === self :: $instance AND self :: $instance = new self;
			return self :: $instance;
		}

		// This method collects data
		public function collect()
		{
			if ( ! defined( 'WP_ADMIN' ) )
				return;

			// Your logic goes here
		}
		// This method is optional and formats your output
		protected function markup( $set )
		{
			sort( $set );

			// Custom formatting goes here
		}
	}


If you now activate your plugin, you'll find a new help tab that is named `Wcm Cai Extension` (the class name is taken to form the contextual help tab title).

= Can I use the plugin on a live site on a server? =

Well, you can do a lot, but this is not recommended. The plugin hooks into the `gettext`, which is responsible for translating each and every string. This means that it will slow down your admin user interface pretty much. This plugin was written for local software development and we highly recommend that you run it only locally.

= Can I get the same information for public screens (Themes)? =

WCM CAI is not capable of doing this. It was written to hook into the contextual help tabs, which are not present in a Theme.

== Installation ==

Extract the zip file and just drop the contents in the `~/wp-content/plugins/` directory of your WordPress installation and then activate the Plugin from Plugins page.

== Screenshots ==

1. The contextual hooks tab.
2. The available and set globals tab. Closed Arrays/Objects
3. The available and set globals tab. Showing an open Array/Object
4. The current screen tab.

== Changelog ==

= 1.1 =

* Performance Improvement: Avoid loading on the front end

= 1.0 =

* Initial Release version