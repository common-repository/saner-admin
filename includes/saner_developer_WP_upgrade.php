<?php class saner_developer_WP_upgrade
{
	function saner_developer_WP_upgrade()
	{
		$this__construct();
	}
	
	function __construct()
	{
		$options = get_option( 'saner_developer_settings' );
		if( isset( $options['remove_WP_upgrade'] ) )
		{
    	add_action( 'init', array( &$this, 'remove_reminder' ) );
		}
	}
	function remove_reminder()
	{
		if ( !current_user_can( 'add_users' ) ) {
			remove_action( 'init', 'wp_version_check' );
			add_filter( 'pre_option_update_core', array( &$this, 'pre_option' ) );
    	add_filter( 'pre_site_transient_update_core', array( &$this, 'pre_site' ) );
		}
	}
	function pre_option()
	{
		return null;
	}
	function pre_site()
	{
		return null;
	}
}