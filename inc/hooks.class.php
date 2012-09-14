<?php
! defined( 'ABSPATH' ) AND exit;



if ( ! class_exists( 'current_admin_hooks' ) )
{
	add_action( 'plugins_loaded', array( 'current_admin_hooks', 'init' ), 20 );

/**
 * @package    Current Admin Info
 * @subpackage Contextual Hooks
 */
final class current_admin_hooks extends current_screen_data
{
	private static $instance;

	public static function init()
	{
		null === self :: $instance AND self :: $instance = new self;
		return self :: $instance;
	}

	public function collect()
	{
		global $hook_suffix;
		// We're done: Remove callback
		if ( 'contextual_help' === current_filter() )
			remove_filter( current_filter(), __FUNCTION__ );

		// Only add when we got context and the current filter has context
		if (
			! empty( $hook_suffix )
			AND strstr( current_filter(), $hook_suffix )
		)
			$this->data[ get_class() ][] = current_filter();
	}
} // END Class current_admin_hooks

} // endif;