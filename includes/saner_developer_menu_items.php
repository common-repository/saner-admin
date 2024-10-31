<?php class saner_developer_menu_items
{
	function saner_developer_menu_items()
	{
		$this__construct();
	}
	
	function __construct()
	{
		$this->options = $options = get_option( 'saner_developer_settings' );
		if ( isset( $options['remove_menu'] ) ) 
		{
			add_action('admin_menu', array( &$this, 'remove_menus' ) );
		}
		if ( isset( $options['remove_menu']['dash'] ) )
		{
			add_filter( 'login_redirect', array( &$this, 'redirect_to_profile' ) );
		}
	}
	function remove_menus()
	{
		global $menu;
		$options = $this->options;
		if( !current_user_can( 'add_users' ) )
		{
			if( $options['remove_menu']['dash'] )
			{
				$menu_item[] = __('Dashboard');
			}
			if( $options['remove_menu']['posts'] )
			{
				$menu_item[] = __('Posts');
			}
			if( $options['remove_menu']['media'] )
			{
				$menu_item[] = __('Media');
			}
			if( $options['remove_menu']['links'] )
			{
				$menu_item[] = __('Links');
			}
			if( $options['remove_menu']['pages'] )
			{
				$menu_item[] = __('Pages');
			}
			if( $options['remove_menu']['tools'] )
			{
				$menu_item[] = __('Tools');
			}
			if( $options['remove_menu']['comments'] )
			{
				$menu_item[] = __('Comments');
			}
			if( $options['remove_menu']['settings'] )
			{
				$menu_item[] = __('Settings');
			}
			end ($menu);
			
			while (prev($menu)){
					$value = explode(' ',$menu[key($menu)][0]);
					if(in_array($value[0] != NULL?$value[0]:"" , $menu_item)){unset($menu[key($menu)]);}
			}	
		}
	}
	function redirect_to_profile( $redirect_to, $url_redirect_to = '', $user = null )
	{
		$url = get_bloginfo( 'url' ).'/wp-admin/profile.php';
		return $url;
	}
}