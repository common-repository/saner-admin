<?php class saner_developer_dashboard_header
{
	function saner_developer_dashboard_header()
	{
		$this__construct();
	}
	
	function __construct()
	{
		global $wp_version;
		$this->options = get_option( 'saner_developer_settings' );
		if( $this->options['dash_header_site_color'] !== '' )
		{
			add_action( 'admin_head', array( &$this, 'site_title_color' ) );
			add_action( 'wp_head', array( &$this, 'site_title_color' ) );
		}
		if( $this->options['dash_header_site_hover_color'] !== '' )
		{
			add_action( 'admin_head', array( &$this, 'site_title_hover_color' ) );
			add_action( 'wp_head', array( &$this, 'site_title_hover_color' ) );
		}
		if( $this->options['sidebar_color'] !== '' )
		{
			add_action( 'admin_head', array( &$this, 'sidebar_color' ) );
		}
		if( $this->options['menu_title_color'] !== '' )
		{
			add_action( 'admin_head', array( &$this, 'menu_title_color' ) );
		}
		if( $this->options['menu_title_color_hover'] !== '' )
		{
			add_action( 'admin_head', array( &$this, 'menu_title_color_hover' ) );
		}
		if( $this->options['menu_title_bg_color'] !== '' )
		{
			add_action( 'admin_head', array( &$this, 'menu_title_bg_color' ) );
		}
		if( $this->options['menu_topborder_color'] !== '' )
		{
			add_action( 'admin_head', array( &$this, 'menu_topborder_color' ) );
		}
		if( $this->options['menu_bottomborder_color'] !== '' )
		{
			add_action( 'admin_head', array( &$this, 'menu_bottomborder_color' ) );
		}
		if( $this->options['menu_title_bg_color_hover'] !== '' )
		{
			add_action( 'admin_head', array( &$this, 'menu_title_bg_color_hover' ) );
		}
		if( $this->options['menu_topborder_color_hover'] !== '' )
		{
			add_action( 'admin_head', array( &$this, 'menu_topborder_color_hover' ) );
		}
		if( $this->options['menu_bottomborder_color_hover'] !== '' )
		{
			add_action( 'admin_head', array( &$this, 'menu_bottomborder_color_hover' ) );
		}
		if( $this->options['sub_menu_title_color'] !== '' )
		{
			add_action( 'admin_head', array( &$this, 'sub_menu_title_color' ) );
		}
		if( $this->options['sub_menu_bg_color'] !== '' )
		{
			add_action( 'admin_head', array( &$this, 'sub_menu_bg_color' ) );
		}
		if( $this->options['sub_menu_title_hover_color'] !== '' )
		{
			add_action( 'admin_head', array( &$this, 'sub_menu_title_hover_color' ) );
		}
		if( $this->options['sub_menu_title_hover_bg_color'] !== '' )
		{
			add_action( 'admin_head', array( &$this, 'sub_menu_title_hover_bg_color' ) );
		}
		if( $this->options['menu_title_selected_color'] !== '' )
		{
			add_action( 'admin_head', array( &$this, 'menu_title_selected_color' ) );
		}
		if( $this->options['sub_menu_selected_color'] !== '' )
		{
			add_action( 'admin_head', array( &$this, 'sub_menu_selected_color' ) );
		}
		if( $this->options['menu_title_selected_color_1'] !== '' )
		{
			if( $this->options['menu_title_selected_color_2'] !== '' )
			{
				add_action( 'admin_head', array( &$this, 'menu_title_selected_color_2' ) );
			}
			else {
				add_action( 'admin_head', array( &$this, 'menu_title_selected_color_1' ) );
			}
		}
		if( $this->options['dash_header_bg_col1'] !== '' )
		{
			if( $this->options['dash_header_bg_col2'] !== '' )
			{
				add_action( 'admin_head', array( &$this, 'dashboard_gradient_background' ) );
				add_action( 'wp_head', array( &$this, 'dashboard_gradient_background' ) );
			}
			else
			{
				add_action( 'admin_head', array( &$this, 'dashboard_solid_background' ) );
				add_action( 'wp_head', array( &$this, 'dashboard_solid_background' ) );
			}
		}
	}
	function dashboard_gradient_background()
	{
		global $wp_version;
		if ( version_compare($wp_version, '3.3', '<' ))
		{
			echo '<style type="text/css">
			#wphead{
						background: '.$this->options['dash_header_bg_col1'].';
						background: -moz-linear-gradient(top, '.$this->options['dash_header_bg_col1'].' 0%, '.$this->options['dash_header_bg_col2'].' 100%);
						background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.$this->options['dash_header_bg_col1'].'), color-stop(100%,'.$this->options['dash_header_bg_col2'].'));
						background: -webkit-linear-gradient(top, '.$this->options['dash_header_bg_col1'].' 0%,'.$this->options['dash_header_bg_col2'].' 100%);
						background: -o-linear-gradient(top, '.$this->options['dash_header_bg_col1'].' 0%,'.$this->options['dash_header_bg_col2'].' 100%);
						background: -ms-linear-gradient(top, '.$this->options['dash_header_bg_col1'].' 0%,'.$this->options['dash_header_bg_col2'].' 100%);
						filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$this->options['dash_header_bg_col1'].'", endColorstr="'.$this->options['dash_header_bg_col2'].'",GradientType=0 );
						background: linear-gradient(top, '.$this->options['dash_header_bg_col1'].' 0%,'.$this->options['dash_header_bg_col2'].' 100%);
			}</style>';
		}
		else {
			echo '<style type="text/css">
			#wpadminbar{
						background-image: none;
						background: '.$this->options['dash_header_bg_col1'].';
						background: -moz-linear-gradient(top, '.$this->options['dash_header_bg_col1'].' 0%, '.$this->options['dash_header_bg_col2'].' 100%);
						background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.$this->options['dash_header_bg_col1'].'), color-stop(100%,'.$this->options['dash_header_bg_col2'].'));
						background: -webkit-linear-gradient(top, '.$this->options['dash_header_bg_col1'].' 0%,'.$this->options['dash_header_bg_col2'].' 100%);
						background: -o-linear-gradient(top, '.$this->options['dash_header_bg_col1'].' 0%,'.$this->options['dash_header_bg_col2'].' 100%);
						background: -ms-linear-gradient(top, '.$this->options['dash_header_bg_col1'].' 0%,'.$this->options['dash_header_bg_col2'].' 100%);
						filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$this->options['dash_header_bg_col1'].'", endColorstr="'.$this->options['dash_header_bg_col2'].'",GradientType=0 );
						background: linear-gradient(top, '.$this->options['dash_header_bg_col1'].' 0%,'.$this->options['dash_header_bg_col2'].' 100%);
			}
			#wpadminbar .quicklinks .ab-top-secondary > li{
						border: none;
			}</style>';
		}
		
	}
	function dashboard_solid_background()
	{
		global $wp_version;
		if ( version_compare($wp_version, '3.3', '<' ))
		{
			echo '<style type="text/css">
						#wphead{background:'.$this->options['dash_header_bg_col1'].';}
						</style>';
		}
		else {
			echo '<style type="text/css">
						#wpadminbar{background:'.$this->options['dash_header_bg_col1'].';
												background-image: none; }
						#wpadminbar .ab-top-menu > li.menupop > .ab-item {
  											background-color:'.$this->options['dash_header_bg_col1'].';
						}</style>';
		}
	}
	function site_title_color()
	{
		global $wp_version;
		if ( version_compare($wp_version, '3.3', '<' ))
		{
			echo '<style type="text/css">
					 #wphead h1#site-heading a{color: '.$this->options['dash_header_site_color'].';}
					 </style>';
		}
		else {
			echo '<style type="text/css">
					 #wpadminbar *{color: '.$this->options['dash_header_site_color'].'!important;
					 								text-shadow: none;}
					 </style>';
		}
	}
	function site_title_hover_color()
	{
		global $wp_version;
		if ( version_compare($wp_version, '3.3', '<' ))
		{
			echo '<style type="text/css">
					 #wphead h1#site-heading a:hover{color: '.$this->options['dash_header_site_hover_color'].';}
					 </style>';
		}
		else {
			echo '<style type="text/css">
					 #wpadminbar a:hover, #wpadminbar a:hover .ab-label{color: '.$this->options['dash_header_site_hover_color'].'!important;}
					 </style>';
		}
	}
	function sidebar_color()
	{
		global $wp_version;
		if ( version_compare($wp_version, '3.3', '<' ))
		{
			echo '<style type="text/css">
				 #adminmenuback, #adminmenuwrap, #adminmenu li.wp-menu-separator {background-color: '.$this->options['sidebar_color'].';}
				 #adminmenu li.wp-menu-separator {border-color: '.$this->options['sidebar_color'].';}
				 </style>';
		}
		else {
			echo '<style type="text/css">
				 #adminmenuback, #adminmenuwrap, #adminmenu li.wp-menu-separator {background-color: '.$this->options['sidebar_color'].';}
				 #adminmenu li.wp-menu-separator {border-color: '.$this->options['sidebar_color'].';}
				 #adminmenu .wp-submenu ul {background-color:  '.$this->options['sidebar_color'].';}
				 </style>';
		}
	}
	function menu_title_color()
	{
		echo '<style type="text/css">
				 #adminmenu a.menu-top{color: '.$this->options['menu_title_color'].';}
				 </style>';
	}
	function menu_title_color_hover()
	{
		echo '<style type="text/css">
				 #adminmenu a.menu-top:hover{color: '.$this->options['menu_title_color_hover'].';}
				 </style>';
	}
	function menu_title_bg_color()
	{
		echo '<style type="text/css">
				 #adminmenu a.menu-top {
					 background:'.$this->options['menu_title_bg_color'].';}
				 </style>';
	}
	function menu_topborder_color()
	{
		echo '<style type="text/css">
				 #adminmenu a.menu-top, .folded #adminmenu li.menu-top, #adminmenu .wp-submenu .wp-submenu-head {
					 border-top-color:'.$this->options['menu_topborder_color'].';}
				 </style>';
	}
	function menu_bottomborder_color()
	{
		echo '<style type="text/css">
				 #adminmenu a.menu-top, .folded #adminmenu li.menu-top, #adminmenu .wp-submenu .wp-submenu-head {
					 border-bottom-color:'.$this->options['menu_bottomborder_color'].';}
				 </style>';
	}
	
	function menu_title_bg_color_hover()
	{
		global $wp_version;
		if ( version_compare($wp_version, '3.3', '<' ))
		{
			echo '<style type="text/css">
					 #adminmenu a.menu-top:hover {
						 background:'.$this->options['menu_title_bg_color_hover'].';}
		</style>';
		}
		else {
			echo '<style type="text/css">
					 #adminmenu li.wp-not-current-submenu a.menu-top:hover {
						 background:'.$this->options['menu_title_bg_color_hover'].';}
					 #adminmenu li.wp-not-current-submenu .wp-menu-arrow {
							background-color:'.$this->options['menu_title_bg_color_hover'].';
					 }
					 #adminmenu li.wp-not-current-submenu .wp-menu-arrow div {
							background-color:'.$this->options['menu_title_bg_color_hover'].';
					 }</style>';
		}
	}
	function menu_topborder_color_hover()
	{
		echo '<style type="text/css">
				 #adminmenu a.menu-top, .folded #adminmenu li.menu-top, #adminmenu .wp-submenu .wp-submenu-head {
					 border-top-color:'.$this->options['menu_topborder_color_hover'].';}
				 #adminmenu li.wp-not-current-submenu .wp-menu-arrow {
						border-top-color:'.$this->options['menu_topborder_color_hover'].';
					}</style>';
	}
	function menu_bottomborder_color_hover()
	{
		echo '<style type="text/css">
				 #adminmenu a.menu-top, .folded #adminmenu li.menu-top, #adminmenu .wp-submenu .wp-submenu-head {
					 border-bottom-color:'.$this->options['menu_bottomborder_color_hover'].';}
				 #adminmenu li.wp-not-current-submenu .wp-menu-arrow {
						border-bottom-color:'.$this->options['menu_bottomborder_color_hover'].';
					}</style>';
	}
	
	function sub_menu_title_color()
	{
		global $wp_version;
		if ( version_compare($wp_version, '3.3', '<' ))
		{
			echo '<style type="text/css">
					 #adminmenu .wp-submenu a:link{color: '.$this->options['sub_menu_title_color'].';}
					 #adminmenu .wp-submenu a:visited{color: '.$this->options['sub_menu_title_color'].';}
					 </style>';
		}
		else {
			echo '<style type="text/css">
					 #adminmenu .wp-submenu a:link{color: '.$this->options['sub_menu_title_color'].';}
					 #adminmenu .wp-submenu a:visited{color: '.$this->options['sub_menu_title_color'].';}
					 #wpadminbar .ab-submenu .ab-item {color: '.$this->options['sub_menu_title_color'].'!important;}
					 </style>';
		}
	}
	function sub_menu_bg_color()
	{
		global $wp_version;
		if ( version_compare($wp_version, '3.3', '<' ))
		{
			echo '<style type="text/css">
					 #adminmenu .wp-submenu .wp-submenu-wrap a {background-color: '.$this->options['sub_menu_bg_color'].';}
					 </style>';
		}
		else {
			echo '<style type="text/css">
					 #adminmenu .wp-submenu .wp-submenu-wrap a {background-color: '.$this->options['sub_menu_bg_color'].';}
					 #wpadminbar .menupop .ab-sub-wrapper, #wpadminbar .shortlink-input {background-color: '.$this->options['sub_menu_bg_color'].';}
					 #wpadminbar.nojs .ab-top-menu > li.menupop:hover > .ab-item, #wpadminbar .ab-top-menu > li.menupop.hover > .ab-item {background-color: '.$this->options['sub_menu_bg_color'].';}
					 </style>';
		}
	}
	function sub_menu_title_hover_color()
	{
		global $wp_version;
		if ( version_compare($wp_version, '3.3', '<' ))
		{
			echo '<style type="text/css">
					 #adminmenu .wp-submenu a:hover{color: '.$this->options['sub_menu_title_hover_color'].'!important;}
					 </style>';
		}
		else {
			echo '<style type="text/css">
					 #adminmenu .wp-submenu a:hover{color: '.$this->options['sub_menu_title_hover_color'].'!important;}
					 #wpadminbar .ab-submenu a.ab-item:hover {color: '.$this->options['sub_menu_title_hover_color'].'!important;}
					 </style>';
		}
	}
	function sub_menu_title_hover_bg_color()
	{
		global $wp_version;
		if ( version_compare($wp_version, '3.3', '<' ))
		{
			echo '<style type="text/css">
					 #adminmenu .wp-submenu a:hover{background: '.$this->options['sub_menu_title_hover_bg_color'].'!important;}
					 </style>';
		}
		else {
			echo '<style type="text/css">
					 #adminmenu .wp-submenu a:hover{background: '.$this->options['sub_menu_title_hover_bg_color'].'!important;}
					 #wpadminbar .ab-submenu a.ab-item:hover{background: '.$this->options['sub_menu_title_hover_bg_color'].'!important;}
					 </style>';
		}
	}
	function menu_title_selected_color()
	{
		echo '<style type="text/css">
				 #adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, #adminmenu li.current a.menu-top, #adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head {
  color:'.$this->options['menu_title_selected_color'].';
}
				 </style>';
	}
	function menu_title_selected_color_1()
	{
		global $wp_version;
		if ( version_compare($wp_version, '3.3', '<' ))
		{
			echo '<style type="text/css">
					 	#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, #adminmenu li.current a.menu-top, .folded #adminmenu li.wp-has-current-submenu, .folded #adminmenu li.current.menu-top, #adminmenu .wp-menu-arrow, #adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head {
						background-image: none;
						background-color:'.$this->options['menu_title_selected_color_1'].';
						}
						#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, #adminmenu li.current a.menu-top, #adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head {
						border-top-color: '.$this->options['menu_title_selected_color_1'].';
						border-bottom-color: '.$this->options['menu_title_selected_color_1'].';
						}
										 </style>';
		}
		else {
			echo '<style type="text/css">
					 	#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, #adminmenu li.current a.menu-top, .folded #adminmenu li.wp-has-current-submenu, .folded #adminmenu li.current.menu-top, #adminmenu .wp-menu-arrow, #adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head {
						background-image: none;
						background-color:'.$this->options['menu_title_selected_color_1'].';
						}
						#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, #adminmenu li.current a.menu-top, #adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head {
						border-top-color: '.$this->options['menu_title_selected_color_1'].';
						border-bottom-color: '.$this->options['menu_title_selected_color_1'].';
						}
						#adminmenu .wp-has-current-submenu  .wp-menu-arrow div, #adminmenu .wp-menu-arrow div {
						background-color:'.$this->options['menu_title_selected_color_1'].';
						background-image: none;
						}
										 </style>';
		}
		}
	function menu_title_selected_color_2()
	{
		global $wp_version;
		if ( version_compare($wp_version, '3.3', '<' ))
		{
			echo '<style type="text/css">
				#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, #adminmenu li.current a.menu-top, .folded #adminmenu li.wp-has-current-submenu, .folded #adminmenu li.current.menu-top, #adminmenu .wp-menu-arrow, #adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head {
				background-color: '.$this->options['menu_title_selected_color_1'].';
				background-image: -ms-linear-gradient(bottom,'.$this->options['menu_title_selected_color_2'].','.$this->options['menu_title_selected_color_1'].');
				background-image: -moz-linear-gradient(bottom,'.$this->options['menu_title_selected_color_2'].','.$this->options['menu_title_selected_color_1'].');
				background-image: -o-linear-gradient(bottom,'.$this->options['menu_title_selected_color_2'].','.$this->options['menu_title_selected_color_1'].');
				background-image: -webkit-gradient(linear,left bottom,left top,from('.$this->options['menu_title_selected_color_2'].'),to('.$this->options['menu_title_selected_color_1'].'));
				background-image: -webkit-linear-gradient(bottom,'.$this->options['menu_title_selected_color_2'].','.$this->options['menu_title_selected_color_1'].');
				background-image: linear-gradient(bottom,#'.$this->options['menu_title_selected_color_2'].','.$this->options['menu_title_selected_color_1'].');
				}
				
				#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, #adminmenu li.current a.menu-top, #adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head {
				border-top-color: '.$this->options['menu_title_selected_color_1'].';
				border-bottom-color: '.$this->options['menu_title_selected_color_2'].';
				}
								 </style>';
		}
		else {
			echo '<style type="text/css">
					#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, #adminmenu li.current a.menu-top, .folded #adminmenu li.wp-has-current-submenu, .folded #adminmenu li.current.menu-top, #adminmenu .wp-menu-arrow, #adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head {
					background-color:'.$this->options['menu_title_selected_color_1'].';
					background-image: -ms-linear-gradient(bottom,'.$this->options['menu_title_selected_color_2'].','.$this->options['menu_title_selected_color_1'].');
					background-image: -moz-linear-gradient(bottom,'.$this->options['menu_title_selected_color_2'].','.$this->options['menu_title_selected_color_1'].');
					background-image: -o-linear-gradient(bottom,'.$this->options['menu_title_selected_color_2'].','.$this->options['menu_title_selected_color_1'].');
					background-image: -webkit-gradient(linear,left bottom,left top,from('.$this->options['menu_title_selected_color_2'].'),to('.$this->options['menu_title_selected_color_1'].'));
					background-image: -webkit-linear-gradient(bottom,'.$this->options['menu_title_selected_color_2'].','.$this->options['menu_title_selected_color_1'].');
					background-image: linear-gradient(bottom,#'.$this->options['menu_title_selected_color_2'].','.$this->options['menu_title_selected_color_1'].');
				}
				
				#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, #adminmenu li.current a.menu-top, #adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head {
					border-top-color: '.$this->options['menu_title_selected_color_1'].';
					border-bottom-color: '.$this->options['menu_title_selected_color_2'].';
				}
				#adminmenu .wp-has-current-submenu  .wp-menu-arrow div, #adminmenu .wp-menu-arrow div {
					background-color:'.$this->options['menu_title_selected_color_1'].';
					background-image: -ms-linear-gradient(right bottom,'.$this->options['menu_title_selected_color_2'].','.$this->options['menu_title_selected_color_1'].');
					background-image: -moz-linear-gradient(right bottom,'.$this->options['menu_title_selected_color_2'].','.$this->options['menu_title_selected_color_1'].');
					background-image: -o-linear-gradient(right bottom,'.$this->options['menu_title_selected_color_2'].','.$this->options['menu_title_selected_color_1'].');
					background-image: -webkit-gradient(linear,right bottom,left top,from('.$this->options['menu_title_selected_color_2'].'),to('.$this->options['menu_title_selected_color_1'].'));
					background-image: -webkit-linear-gradient(right bottom,'.$this->options['menu_title_selected_color_2'].','.$this->options['menu_title_selected_color_1'].');
					background-image: linear-gradient(right bottom,'.$this->options['menu_title_selected_color_2'].','.$this->options['menu_title_selected_color_1'].');
				}
								 </style>';
		}
	}
	function sub_menu_selected_color()
	{
		echo '<style type="text/css">
				 #adminmenu .wp-submenu li.current, #adminmenu .wp-submenu li.current a, #adminmenu .wp-submenu li.current a:hover {
    color: '.$this->options['sub_menu_selected_color'].';
}
				 </style>';
	}
	
}
?>