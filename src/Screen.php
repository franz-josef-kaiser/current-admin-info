<?php

namespace WCM\CurrentAdminInfo;

/**
 * @package    Current Admin Info
 * @subpackage Contextual Hooks
 */
class Screen extends AbstractScreenData
{
	public function collect()
	{
		remove_filter( current_filter(), __FUNCTION__ );
		add_action( 'contextual_help', array( $this, 'screen' ), 0, 3 );
	}

	/**
	 * @param string     $contextual_help
	 * @param string     $screen_id
	 * @param \WP_Screen $screen
	 */
	public function screen( $contextual_help, $screen_id, \WP_Screen $screen )
	{
		foreach ( get_current_screen() as $key => $data )
		{
			empty( $data ) AND $data = '<em>not set</em>';
			$this->data[ get_class() ][] = sprintf(
				'<strong>%s</strong>: %s',
				$key,
				$data
			);
		}
	}
}