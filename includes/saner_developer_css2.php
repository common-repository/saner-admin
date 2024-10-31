<?php class saner_developer_css2
{
	function saner_developer_css2()
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
			/* add_action( 'admin_head', array( &$this, 'sd_css' ) );*/
		}
		
	}
	function sd_admin_bar_css()
	{
		echo '<style type="text/css">';
		echo '#wpadminbar * {
					color: '.$this->options['dash_header_site_color'].';
				}';
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
		elseif( $this->options['dash_header_bg_col2'] == '' )
		{
		echo '#wpadminbar {				
					background-color: '.$this->options['dash_header_bg_col1'].'; /* Fallback */
					background-image: none;
					}
					#wpadminbar .quicklinks .ab-top-secondary > li > a, #wpadminbar .quicklinks .ab-top-secondary > li > .ab-empty-item {
					background-color: '.$this->options['dash_header_bg_col1'].'; /* Fallback */
					background-image: none;
					}';
		}
		echo '#wpadminbar .menupop .ab-sub-wrapper, #wpadminbar .shortlink-input {
					background: '.$this->options['sub_menu_bg_color'].';
				}
				
				#wpadminbar .ab-top-menu > li:hover > .ab-item,
				#wpadminbar .ab-top-menu > li.hover > .ab-item,
				#wpadminbar .ab-top-menu > li > .ab-item:focus,
				#wpadminbar.nojq .quicklinks .ab-top-menu > li > .ab-item:focus {
					color: '.$this->options['dash_header_site_hover_color'].';
					background-color: '.$this->options['sub_menu_bg_color'].'!important; /* Fallback */
				}
				
				#wpadminbar.nojs .ab-top-menu > li.menupop:hover > .ab-item,
				#wpadminbar .ab-top-menu > li.menupop.hover > .ab-item {
					background: '.$this->options['sub_menu_bg_color'].';
					color: '.$this->options['dash_header_site_hover_color'].';
				}
				
				#wpadminbar .hover .ab-label,
				#wpadminbar.nojq .ab-item:focus .ab-label {
					color: '.$this->options['dash_header_site_hover_color'].';
				}
				
				#wpadminbar .menupop.hover .ab-label {
					color: '.$this->options['dash_header_site_hover_color'].';
					text-shadow: none;
				}
				
				#wpadminbar .menupop li:hover,
				#wpadminbar .menupop li.hover,
				#wpadminbar .quicklinks .menupop .ab-item:focus,
				#wpadminbar .quicklinks .ab-top-menu .menupop .ab-item:focus {
					background-color: '.$this->options['sub_menu_title_hover_bg_color'].';
				}
				
				#wpadminbar .ab-submenu .ab-item {
					color: '.$this->options['dash_header_site_color'].';
					text-shadow: none;
				}
				
				#wpadminbar .quicklinks .menupop ul li a,
				#wpadminbar .quicklinks .menupop ul li a strong,
				#wpadminbar .quicklinks .menupop.hover ul li a,
				#wpadminbar.nojs .quicklinks .menupop:hover ul li a {
					color: '.$this->options['sub_menu_title_color'].';
				}
				
				#wpadminbar .quicklinks .menupop ul.ab-sub-secondary {
					display: block;
					position: relative;
					right: auto;
					margin: 0;
				
					background: '.$this->options['sub_menu_bg_color'].';
				
					-moz-box-shadow: none;
					-webkit-box-shadow: none;
					box-shadow: none;
				}
				
				#wpadminbar .quicklinks .menupop .ab-sub-secondary > li:hover,
				#wpadminbar .quicklinks .menupop .ab-sub-secondary > li.hover,
				#wpadminbar .quicklinks .menupop .ab-sub-secondary > li .ab-item:focus {
					background-color: '.$this->options['sub_menu_title_hover_bg_color'].';
				}
				
				#wpadminbar .quicklinks a span#ab-updates {
					background: '.$this->options['sub_menu_bg_color'].';
					color: '.$this->options['sub_menu_title_color'].';
					text-shadow: none;
					display: inline;
					padding: 2px 5px;
					font-size: 10px;
					font-weight: bold;
					-webkit-border-radius: 10px;
					border-radius: 10px;
				}
				
				#wpadminbar .quicklinks a:hover span#ab-updates  {
					background: '.$this->options['sub_menu_title_hover_bg_color'].';
					color: '.$this->options['sub_menu_title_hover_color'].';
				}
				
				#wpadminbar .ab-top-secondary {
					float: right;
					background-color: '.$this->options['dash_header_bg_col1'].'; /* Fallback */
					background-image: -ms-linear-gradient(bottom, '.$this->options['dash_header_bg_col2'].', '.$this->options['dash_header_bg_col1'].' 50%); /* IE10 */
					background-image: -moz-linear-gradient(bottom, '.$this->options['dash_header_bg_col2'].', '.$this->options['dash_header_bg_col1'].' 50%); /* Firefox */
					background-image: -o-linear-gradient(bottom, '.$this->options['dash_header_bg_col2'].', '.$this->options['dash_header_bg_col1'].' 50%); /* Opera */
					background-image: -webkit-gradient(linear, left bottom, left top, from('.$this->options['dash_header_bg_col2'].'), to('.$this->options['dash_header_bg_col1'].')); /* old Webkit */
					background-image: -webkit-linear-gradient(bottom, '.$this->options['dash_header_bg_col2'].', '.$this->options['dash_header_bg_col1'].' 50%); /* new Webkit */
					background-image: linear-gradient(bottom, '.$this->options['dash_header_bg_col2'].', '.$this->options['dash_header_bg_col1'].' 50%); /* proposed W3C Markup */
				}
				
				#wpadminbar .quicklinks li#wp-admin-bar-updates:hover span.ab-label {
					color: '.$this->options['dash_header_site_hover_color'].';
				}
				
				/**
				 * My Account
				 */
				#wpadminbar #wp-includes-bar-user-info .display-name {
					color: '.$this->options['sub_menu_title_color'].';
				}
				
				#wpadminbar #wp-includes-bar-user-info .username {
					color: '.$this->options['sub_menu_title_color'].';
					font-size: 11px;
				}
				
				/**
				 * Main Menu Bar
				 */
				#adminmenu a:hover, #adminmenu li.menu-top > a:focus, #adminmenu ul.wp-submenu a:hover, #the-comment-list .comment a:hover, #rightnow a:hover, #media-upload a.del-link:hover, 			div.dashboard-widget-submit input:hover, .subsubsub a:hover, .subsubsub a.current:hover, .ui-tabs-nav a:hover, .plugins .inactive a:hover, #all-plugins-table .plugins .inactive a:hover, #search-plugins-table .plugins .inactive a:hover {
					color: '.$this->options['menu_title_color_hover'].';
				}
				a, #adminmenu a, #the-comment-list p.comment-author strong a, #media-upload a.del-link, #media-items a.delete, .plugins a.delete, .ui-tabs-nav a {
					color: '.$this->options['menu_title_color'].';
				}
				#adminmenuback {
					background-color: '.$this->options['sidebar_color'].';
				}
				#adminmenuwrap {
    			background-color: '.$this->options['menu_title_bg_color'].';
					border-color: '.$this->options['menu_title_bg_color'].';
				}
				#adminmenu li.wp-menu-separator {
					background: '.$this->options['sidebar_color'].';
					border-color: '.$this->options['sidebar_color'].';
				}
				#adminmenu div.separator {
					border-color: '.$this->options['sidebar_color'].';
				}
				#adminmenu a.menu-top, .folded #adminmenu li.menu-top, #adminmenu .wp-submenu .wp-submenu-head {
					border-top-color: '.$this->options['menu_topborder_color'].';
					border-bottom-color: '.$this->options['menu_bottomborder_color'].';
				}
				#adminmenu li.menu-top:hover > a, #adminmenu li.menu-top.focused > a, #adminmenu li.menu-top > a:focus {
					background-color: '.$this->options['menu_title_bg_color_hover'].';
					border-top-color: '.$this->options['menu_topborder_color_hover'].';
					border-bottom-color: '.$this->options['menu_bottomborder_color_hover'].';
				}
				';
				if( $this->options['menu_title_selected_color_2'] != '' )
				{
				echo '#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, #adminmenu li.current a.menu-top, .folded #adminmenu li.wp-has-current-submenu, .folded #adminmenu li.current.menu-top, #adminmenu .wp-menu-arrow, #adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head {
					background-color: '.$this->options['menu_title_selected_color_1'].'; /* Fallback */
					background-image: -ms-linear-gradient(bottom, '.$this->options['menu_title_selected_color_2'].', '.$this->options['menu_title_selected_color_1'].'); /* IE10 */
					background-image: -moz-linear-gradient(bottom, '.$this->options['menu_title_selected_color_2'].', '.$this->options['menu_title_selected_color_1'].'); /* Firefox */
					background-image: -o-linear-gradient(bottom, '.$this->options['menu_title_selected_color_2'].', '.$this->options['menu_title_selected_color_1'].'); /* Opera */
					background-image: -webkit-gradient(linear, left bottom, left top, from('.$this->options['menu_title_selected_color_2'].'), to('.$this->options['menu_title_selected_color_1'].')); /* old Webkit */
					background-image: -webkit-linear-gradient(bottom, '.$this->options['menu_title_selected_color_2'].', '.$this->options['menu_title_selected_color_1'].'); /* new Webkit */
					background-image: linear-gradient(bottom, '.$this->options['menu_title_selected_color_2'].', '.$this->options['menu_title_selected_color_1'].'); /* proposed W3C Markup */
					border-top-color: '.$this->options['menu_title_selected_color_1'].';
					border-bottom-color: '.$this->options['menu_title_selected_color_2'].';
				}
				#adminmenu .wp-menu-arrow div {
					background-color: '.$this->options['menu_title_selected_color_1'].'; /* Fallback */
					background-image: -ms-linear-gradient(right bottom, '.$this->options['menu_title_selected_color_2'].', '.$this->options['menu_title_selected_color_1'].'); /* IE10 */
					background-image: -moz-linear-gradient(right bottom, '.$this->options['menu_title_selected_color_2'].', '.$this->options['menu_title_selected_color_1'].'); /* Firefox */
					background-image: -o-linear-gradient(right bottom, '.$this->options['menu_title_selected_color_2'].', '.$this->options['menu_title_selected_color_1'].'); /* Opera */
					background-image: -webkit-gradient(linear, right bottom, left top, from('.$this->options['menu_title_selected_color_2'].'), to('.$this->options['menu_title_selected_color_1'].')); /* old Webkit */
					background-image: -webkit-linear-gradient(right bottom, '.$this->options['menu_title_selected_color_2'].', '.$this->options['menu_title_selected_color_1'].'); /* new Webkit */
					background-image: linear-gradient(right bottom, '.$this->options['menu_title_selected_color_2'].', '.$this->options['menu_title_selected_color_1'].'); /* proposed W3C Markup */
				}
				';
				}
				elseif( $this->options['menu_title_selected_color_2'] == '' )
				{
					echo '#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, #adminmenu li.current a.menu-top, .folded #adminmenu li.wp-has-current-submenu, .folded #adminmenu li.current.menu-top, #adminmenu .wp-menu-arrow, #adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head {
					background-color: '.$this->options['menu_title_selected_color_1'].';
					background-image: none;
					border-top-color: '.$this->options['menu_title_selected_color_1'].';
					border-bottom-color: '.$this->options['menu_title_selected_color_1'].';
					}
					#adminmenu .wp-menu-arrow div {
						background-color: '.$this->options['menu_title_selected_color_1'].';
						background-image: none;
					}';
				}
		echo '#adminmenu li.wp-not-current-submenu .wp-menu-arrow {
						border-top-color: '.$this->options['menu_topborder_color_hover'].';
						border-bottom-color: '.$this->options['menu_bottomborder_color_hover'].';
						background: '.$this->options['menu_title_bg_color_hover'].';
					}
					#adminmenu li.wp-not-current-submenu .wp-menu-arrow div {
						background: '.$this->options['menu_title_bg_color_hover'].';
					}
					#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, #adminmenu li.current a.menu-top, #adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head {
						text-shadow: 0 -1px 0 #333;
						color: '.$this->options['menu_title_selected_color'].';
					}
					.folded #adminmenu li.wp-has-current-submenu, .folded #adminmenu li.current.menu-top {
						border-top-color: '.$this->options['menu_topborder_color'].';
						border-bottom-color: '.$this->options['menu_bottomborder_color'].';
					}
					#adminmenu .wp-submenu a:hover, #adminmenu .wp-submenu a:focus {
						background-color: '.$this->options['sub_menu_title_hover_bg_color'].';
						color: '.$this->options['sub_menu_title_hover_color'].';
					}
					#adminmenu .wp-submenu li.current, #adminmenu .wp-submenu li.current a, #adminmenu .wp-submenu li.current a:hover {
						color: '.$this->options['sub_menu_selected_color'].';
					}
					#adminmenu .wp-submenu ul {
						background-color: '.$this->options['sub_menu_bg_color'].';
					}
					#collapse-menu {
						color: '.$this->options['menu_title_color'].';
					}
					#collapse-menu:hover {
						color: '.$this->options['menu_title_color_hover'].';
					}
					
';
		echo '</style>';
	}
}
?>