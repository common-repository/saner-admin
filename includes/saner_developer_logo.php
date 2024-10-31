<?php class saner_developer_logo
{
	function saner_developer_logo()
	{
		$this__construct();
	}
	
	function __construct()
	{
		$options = get_option( 'saner_developer_settings' );
		if( isset( $options['admin_logo'] ) )
		{
			add_action( 'admin_head', array( &$this, 'admin_logo_css' ) );
			add_action( 'wp_head', array( &$this, 'admin_logo_css' ) );
		}
		if ( isset( $options['login_logo'] ) )
		{
			add_action( 'login_head', array( &$this, 'login_logo_css' ) );
		}
	}
	function admin_logo_css()
	{
		global $wp_version;
		$options = get_option( 'saner_developer_settings' );
		/* check for wp version as header layout and display changed in version 3.3 */
		if ( version_compare($wp_version, '3.3', '<' ))
		{
			if ( $options['admin_logo_new'] !== '' )
			{
				echo '<style type="text/css">
						 #header-logo { background: url('.$options['admin_logo_new'].') no-repeat scroll center center transparent !important; }</style>';
			}
			else {
				echo '<style type="text/css">
						 #header-logo { display: none !important; }</style>';
			}
		}
		else {
			if ( $options['admin_logo_new'] !== '' )
			{
				echo '<style type="text/css">
						 #wp-admin-bar-wp-logo a.ab-item span.ab-icon { background: url('.$options['admin_logo_new'].') no-repeat scroll center center transparent !important; }</style>';
			}
			else {
				echo '<style type="text/css">
							#wp-admin-bar-wp-logo a.ab-item span.ab-icon { background-image: none !important; }</style>';
			}
		}
	}
	function login_logo_css()
	{
		$options = get_option( 'saner_developer_settings' );
		
		if ( $options['login_logo_new'] !== '' )
		{
			echo '<style type="text/css">
					h1 a { background-image:url('.$options['login_logo_new'].') !important; }
			</style>';
		}
		else {
			echo '<style type="text/css">
					h1 a { display: none !important; }
			</style>';
		}
	}
}
?>