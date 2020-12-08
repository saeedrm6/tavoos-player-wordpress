<?php 
namespace Inc\Controllers\Option;

use Inc\Controllers\Controller;
/**
 * 
 */
class Index extends Controller
{
	public function index()
	{
		require_once  PLUGIN_TEMPLATES_PATH . 'option.php';
	}
}
