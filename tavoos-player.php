<?php 
/*
Plugin Name: Tavoos Player
Plugin URI: https://tavoos.net/player
Version: 3.4
Description: با فعال سازی و تنظیم آدرس کد VAST  میتوانید از شبکه تبلیغاتی طاووس کسب درآمد کنید.
*/
if( ( !defined('ABSPATH') ) )
{
	die;
}


if( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) )
{
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

require_once dirname( __FILE__ ) . '/inc/Helper.php';

define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

define( 'PLUGIN_TEMPLATES_PATH', plugin_dir_path( __FILE__ ) . '/templates/' );

define( 'PLUGIN_URI', plugin_dir_url( __FILE__ ) );

define( 'PLUGIN_BASE_NAME', plugin_basename( __FILE__ ) );

register_activation_hook( __FILE__, function()
{
	Inc\Base\Activate::activate();
} );

register_deactivation_hook( __FILE__, function()
{
} );


if( class_exists( 'Inc\\Init' ) )
{
	add_action( 'init', function()
	{
		Inc\Init::register_services();
	} );
}
?>