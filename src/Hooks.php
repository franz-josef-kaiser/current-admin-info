<?php

namespace WCM\CurrentAdminInfo;

/**
 * @package    Current Admin Info
 * @subpackage Contextual Hooks
 */
class Hooks extends AbstractScreenData
{
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
}