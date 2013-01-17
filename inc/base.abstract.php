<?php
defined( 'ABSPATH' ) OR exit;


/**
 * @package    Current Admin Info
 * @subpackage Abstract/Base
 */
abstract class current_screen_data
{
	protected $data = array();

	public function __construct()
	{
		// Add a subarray for each sub class with the class name as key
		if ( ! array_key_exists( get_class( $this ), $this->data ) )
			$this->data[ get_class( $this ) ] = array();

		add_action( 'all', array( $this, 'collect' ) );

		add_filter( 'contextual_help', array( $this, 'show' ), 10, 3 );
	}

	public function show( $help, $screen_id, $screen )
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
			$screen->add_help_tab( array(
				 'id'      => "{$title}-screen-help"
				,'title'   => ucwords( str_replace( '_', ' ', $title ) )
				,'content' => $this->markup( $set )
			) );
		}

		return $help;
	}

	// Data Collector: Must get defined in child/extending class
	abstract protected function collect();

	protected function markup( $set )
	{
		sort( $set );
		return sprintf(
			 "<ul><li>%s</li></ul>"
			,implode( "</li><li>", $set )
		);
	}
}