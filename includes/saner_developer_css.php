<?php class saner_developer_css
{
	function saner_developer_css()
	{
		$this__construct();
	}
	
	function __construct()
	{
		global $wp_version;
		$this->options = get_option( 'saner_developer_settings' );
		if( $this->options )
		{
			add_action( 'admin_head', array( &$this, 'sd_admin_bar_css' ) );
			add_action( 'wp_head', array( &$this, 'sd_admin_bar_css' ) );
			add_action( 'admin_head', array( &$this, 'sd_css' ) );
		}
		
	}
	function sd_admin_bar_css()
	{
		/* first up we have the admin bar */
		/* admin text color */
		echo '<style type="text/css">
					#wpadminbar * {					
						color: '.$this->options['dash_header_site_color'].';
					}';
		/* admin text hover color */
		echo '#wpadminbar .ab-top-menu > li:hover > .ab-item, #wpadminbar .ab-top-menu > li.hover > .ab-item, #wpadminbar .ab-top-menu > li > .ab-item:focus, #wpadminbar.nojq .quicklinks .ab-top-menu > li > .ab-item:focus,#wpadminbar.nojs .ab-top-menu > li.menupop:hover > .ab-item, #wpadminbar .ab-top-menu > li.menupop.hover > .ab-item, #wpadminbar .menupop.hover .ab-label, #wpadminbar ul.ab-top-menu > li > .ab-item:hover > span.ab-label {
						color: '.$this->options['dash_header_site_hover_color'].';
		}';
		/* if we have 2 colors then we create a gradient */			
		if( $this->options['dash_header_bg_col2'] != '' )
		{
			echo '#wpadminbar {
							background-color: '.$this->options['dash_header_bg_col1'].'; /* Fallback */
							background-image: -ms-linear-gradient(bottom, '.$this->options['dash_header_bg_col2'].', '.$this->options['dash_header_bg_col1'].' 50%); /* IE10 */
							background-image: -moz-linear-gradient(bottom, '.$this->options['dash_header_bg_col2'].', '.$this->options['dash_header_bg_col1'].' 50%); /* Firefox */
							background-image: -o-linear-gradient(bottom, '.$this->options['dash_header_bg_col2'].', '.$this->options['dash_header_bg_col1'].' 50%); /* Opera */
							background-image: -webkit-gradient(linear, left bottom, left top, from('.$this->options['dash_header_bg_col2'].'), to('.$this->options['dash_header_bg_col1'].')); /* old Webkit */
							background-image: -webkit-linear-gradient(bottom, '.$this->options['dash_header_bg_col2'].', '.$this->options['dash_header_bg_col1'].' 50%); /* new Webkit */
							background-image: linear-gradient(bottom, '.$this->options['dash_header_bg_col2'].', '.$this->options['dash_header_bg_col1'].' 50%); /* proposed W3C Markup */
						}
						#wpadminbar .quicklinks .ab-top-secondary > li > a, #wpadminbar .quicklinks .ab-top-secondary > li > .ab-empty-item {
							background-color: '.$this->options['dash_header_bg_col1'].'; /* Fallback */
							background-image: -ms-linear-gradient(bottom, '.$this->options['dash_header_bg_col2'].', '.$this->options['dash_header_bg_col1'].' 50%); /* IE10 */
							background-image: -moz-linear-gradient(bottom, '.$this->options['dash_header_bg_col2'].', '.$this->options['dash_header_bg_col1'].' 50%); /* Firefox */
							background-image: -o-linear-gradient(bottom, '.$this->options['dash_header_bg_col2'].', '.$this->options['dash_header_bg_col1'].' 50%); /* Opera */
							background-image: -webkit-gradient(linear, left bottom, left top, from('.$this->options['dash_header_bg_col2'].'), to('.$this->options['dash_header_bg_col1'].')); /* old Webkit */
							background-image: -webkit-linear-gradient(bottom, '.$this->options['dash_header_bg_col2'].', '.$this->options['dash_header_bg_col1'].' 50%); /* new Webkit */
							background-image: linear-gradient(bottom, '.$this->options['dash_header_bg_col2'].', '.$this->options['dash_header_bg_col1'].' 50%); /* proposed W3C Markup */
						}';
		}
		/* if we don't have a second color for the gradient make it a solid color */
		elseif( $this->options['dash_header_bg_col2'] == '' )
		{
			echo '#wpadminbar {
							background-color: '.$this->options['dash_header_bg_col1'].';
							background-image: none;
						}
						#wpadminbar .quicklinks .ab-top-secondary > li > a, #wpadminbar .quicklinks .ab-top-secondary > li > .ab-empty-item {
							background: '.$this->options['dash_header_bg_col1'].';
						}
						';
		}
		/* all sub menu background color */
			echo '#wpadminbar.nojs .ab-top-menu > li.menupop:hover > .ab-item, #wpadminbar .ab-top-menu > li.menupop.hover > .ab-item, #wpadminbar .menupop .ab-sub-wrapper, #wpadminbar .shortlink-input, #adminmenu .wp-submenu .wp-submenu-wrap a {
							background: '.$this->options['sub_menu_bg_color'].';
							text-shadow: none;
						}';
		/* all sub menu text */
			echo '#adminmenu .wp-submenu a:link, #adminmenu .wp-submenu a:visited, #wpadminbar .ab-submenu .ab-item, #wpadminbar .quicklinks .menupop ul li a, #wpadminbar .quicklinks .menupop ul li a strong, #wpadminbar .quicklinks .menupop.hover ul li a, #wpadminbar #wp-admin-bar-user-info .display-name {
							color: '.$this->options['sub_menu_title_color'].';
							
						}';
		/* all sub menu hover */
			echo '#adminmenu .wp-submenu a:hover, #wpadminbar .quicklinks .menupop ul li a:hover {
							color: '.$this->options['sub_menu_title_hover_color'].'!important;
							background: '.$this->options['sub_menu_title_hover_bg_color'].'!important;
						}
						#wpadminbar #wp-admin-bar-user-info a.ab-item {
							background: none!important;
						}';

		echo '</script>';
	}
}
?>