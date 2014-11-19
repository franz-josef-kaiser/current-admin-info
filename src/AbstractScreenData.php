<?php

namespace WCM\CurrentAdminInfo;

/**
 * @package    Current Admin Info
 * @subpackage Abstract/Base
 */
abstract class AbstractScreenData
{
	protected $data = array();

	public function setup()
	{
		// Add a sub-array for each sub class with the class name as key
		if ( ! array_key_exists( get_class( $this ), $this->data ) )
			$this->data[ get_class( $this ) ] = array();

		add_action( 'all', array( $this, 'collect' ) );

		add_filter( 'contextual_help', array( $this, 'show' ), 10, 3 );
	}

	/**
	 * @param string     $help
	 * @param string     $screen_id
	 * @param \WP_Screen $screen
	 * @return mixed
	 */
	public function show( $help, $screen_id, \WP_Screen $screen )
	{
		if (
			! method_exists( $screen, 'add_help_tab' )
			OR ! current_user_can( 'manage_options' )
			# Uncomment if you only want to use this plugin during debug
			# OR ! defined( 'WP_DEBUG' )
			# OR ! WP_DEBUG
		)
			return $help;

		foreach ( $this->data as $title => $set )
		{
			$title = explode( "\\", $title );
			$title = end( $title );
			$screen->add_help_tab( array(
				'id'      => "{$title}-screen-help",
				'title'   => "Info: {$title}",
				'content' => $this->markup( $set )
			) );
		}

		return $help;
	}

	/**
	 * Data Collector: Must get defined in child/extending class
	 * @return mixed
	 */
	abstract protected function collect();

	/**
	 * @param array $set
	 * @return string
	 */
	protected function markup( Array $set )
	{
		sort( $set );
		return sprintf(
			"<ul><li>%s</li></ul>",
			implode( "</li><li>", $set )
		);
	}
}