<?php
! defined( 'ABSPATH' ) AND exit;



if ( ! class_exists( 'current_admin_screen' ) )
{
	add_action( 'plugins_loaded', array( 'current_admin_screen', 'init' ), 20 );

/**
 * @package    Current Admin Info
 * @subpackage Contextual Hooks
 */
final class current_admin_screen extends current_screen_data
{
	private static $instance;

	public static function init()
	{
		null === self :: $instance AND self :: $instance = new self;
		return self :: $instance;
	}

	public function collect()
	{
		remove_filter( current_filter(), __FUNCTION__ );
		add_action( 'contextual_help', array( $this, 'screen' ), 0, 3 );
	}

	public function screen( $contextual_help, $screen_id, $screen )
	{
		foreach ( get_current_screen() as $key => $data )
		{
			empty( $data ) AND $data = '<em>not set</em>';
			$this->data[ get_class() ][] = sprintf(
				'<strong>%s</strong>: %s'
				,$key
				,$data
			);
		}
	}
} // END Class current_admin_screen

} // endif;