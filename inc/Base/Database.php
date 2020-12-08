<?php 
namespace Inc\Base;

/**
 * 
 */
class Database
{
	public function createTable()
	{
		
	}

	public function insertRequired( $sql )
	{
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		dbDelta( $sql );

		update_option('tables_created', true);

		add_option('packages_database_version','1.0');
	}	
}