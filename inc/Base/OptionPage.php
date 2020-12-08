<?php 
namespace Inc\Base;

/**
 * 
 */
class OptionPage
{
	public function register()
	{
   		add_action( 'admin_init', array( $this, 'option' ) );
	}

	public function option()
	{
		register_setting( 'tavoos-player-settings-group', 'tavoos_player_vast' );
	}
}