<?php 
namespace Inc\Base;

use Inc\Controllers\Option\Index as Dashboard;
/**
 * 
 */
class Menu
{
	public function __construct()
	{
		$this->dashboard_controller = new Dashboard();
	}

	public function register()
	{
		add_action( 'admin_menu', array( $this , 'menu' ) );
	}

	public function menu()
	{
		add_menu_page(
            'پلیر طاووس',
			'پلیر طاووس',
			'manage_options',
			'tavoos_player',
			array( $this->dashboard_controller, 'index' ),
			PLUGIN_URI . 'assets/admin/images/logo.png',
			110
		);
	}
}