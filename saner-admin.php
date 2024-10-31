<?php
/*
Plugin Name: Saner Admin Color
Plugin URI: http://sanerdesign.com/projects/wordpress-admin-colour-tool-saner-admin/
Description: Change the color of everything in the admin section of Wordpress. Also allows you to add a login logo and admin bar/header logo, remove Wordpress update reminder for none admins and also remove menu items that your client won't need. All the things I change regularly for clients, it's been useful for me so I hope you like it
Version: 1.1.4
Author: Hugo Saner
Author URI: http://sanerdesign.com
License: GPL2
*/

/*  Copyright 2012  Saner Design  (email : hugo@sanerdesign.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* version check */
global $wp_version;

$exit_msg='This plugin requires Wordpress version 3.0 or newer.
<a href="http://codex.wordpress.org/Upgrading_Wordpress">Please update!</a>';

if ( version_compare($wp_version, '3.0', '<' ))
{
	exit($exit_msg);
}
?>
<?php /* Load languages file */
	load_plugin_textdomain( 'saner-developer-admin-lang', false, basename( dirname( __FILE__ ) ) . '/languages' );
?>
<?php
new saner_admin;

class saner_admin {
	
	function saner_admin()
	{
		$this->__contruct();
		
		$this->options = get_option( 'saner_developer_settings' );
		$this->plugin = 'saner-admin';
	}
	
	function __contruct()
	{
		global $wp_version;
		
		if( !get_option( 'saner_developer_settings' ) )
		{
			$initial_setup = array(
															'dash_header_bg_col1' => '#464646',
															'dash_header_site_color' => '#CCCCCC',
															'dash_header_site_hover_color' => '#FFFFFF',
															'sidebar_color' => '#ECECEC',
															'menu_title_color' => '#21759B',
															'menu_title_color_hover' => '#E06821',
															'menu_title_bg_color' => '#ECECEC',
															'menu_topborder_color' => '#F9F9F9',
															'menu_bottomborder_color' => '#DFDFDF',
															'menu_title_bg_color_hover' => '#ECECEC',
															'menu_topborder_color_hover' => '#F9F9F9',
															'menu_bottomborder_color_hover' => '#DFDFDF',
															'sub_menu_title_color' => '#21759B',
															'sub_menu_bg_color' => '#FFFFFF',
															'sub_menu_title_hover_color' => '#333333',
															'sub_menu_title_hover_bg_color' => '#EAF2FA',
															'menu_title_selected_color' => '#DFFFFF',
															'menu_title_selected_color_1' => '#808080',
															'sub_menu_selected_color' => '#333333'
															);
		add_option( 'saner_developer_settings', $initial_setup );
		}
														
		/* add js script style helper to all admin pages not just plugin pages */
		add_action('admin_enqueue_scripts', array( &$this, 'add_js_style_helper') );
		
		/* add scripts and styles to just plugin page */
		if (isset($_GET['page']) && $_GET['page'] == 'saner-developer-admin') {
		add_action( 'admin_print_scripts', array( &$this, 'my_admin_scripts' ) );
		add_action( 'admin_print_styles', array( &$this, 'my_admin_styles' ) );
		}
		add_action( 'admin_menu', array( &$this, 'setup_settings_page' ) );
		/* add the forms */
		add_action( 'admin_init', array( &$this, 'setup_forms' ) );
		require_once( dirname(__FILE__).'/includes/saner_developer_logo.php' );
		require_once( dirname(__FILE__).'/includes/saner_developer_css2.php' );
		require_once( dirname(__FILE__).'/includes/saner_developer_WP_upgrade.php' );
		require_once( dirname(__FILE__).'/includes/saner_developer_menu_items.php' );
		require_once( dirname(__FILE__).'/includes/saner_developer_ajax.php' );
		new saner_developer_logo;
		new saner_developer_css2;
		new saner_developer_WP_upgrade;
		new saner_developer_menu_items;
		new saner_developer_ajax;
	}
	
	function my_admin_scripts() {
		wp_register_script( 'my-upload', WP_PLUGIN_URL.'/'.$this->plugin.'/js/saner_developer_script.js', array('jquery') );
		wp_enqueue_script( 'my-upload' );
		/*color picker*/
		wp_enqueue_script( 'farbtastic' );
	}
 
	function my_admin_styles() {
		wp_enqueue_style( 'thickbox' );
		/*color picker*/
		wp_enqueue_style( 'farbtastic' );
		wp_register_style( 'saner_developer_admin_style', WP_PLUGIN_URL.'/'.$this->plugin.'/css/saner_developer_admin_style.css', array('farbtastic') );
		wp_enqueue_style( 'saner_developer_admin_style' );
	}
	
	function add_js_style_helper()
	{
		wp_register_script( 'saner_developer_css_helper', WP_PLUGIN_URL.'/'.$this->plugin.'/js/saner_developer_style_help.js', array('jquery') );
		wp_enqueue_script( 'saner_developer_css_helper' );
	}
	
	function setup_settings_page()
	{
		add_submenu_page( 'options-general.php', __( 'Saner Admin Settings', 'saner-developer-admin-lang' ), __( 'Saner Admin', 'saner-developer-admin-lang' ), 'manage_options', 'saner-developer-admin', array( &$this, 'admin_page' ) );
	}

	function admin_page()
	{

		/* display error message in page if someone tries to access it without correct permissions */	
		if(!current_user_can('manage_options')) {  
		wp_die( __( 'You do not have sufficient permissions to access this page.', 'saner-developer-admin-lang' ) );  
	}
	/* create all the information on the page and instigate the settings api */ 
	?>
		<div class="wrap">
		<?php screen_icon('options-general'); ?><h2><?php _e( 'Saner Color and Admin Settings', 'saner-developer-admin-lang' ); ?></h2><div class="saner_donate"><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="XAWCS4SXBNFKU">
<input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>
<img src="<?php echo WP_PLUGIN_URL.'/'.$this->plugin.'/images/medonation.png'; ?>" alt="<?php _e( 'please donate to help me maintain this plugin', 'saner-developer-admin-lang' ); ?>" />
</div>
<div class="clear"></div>

		<form action="options.php" method="post">
		<?php settings_fields('saner_developer_settings'); ?>
		<?php do_settings_sections('admin_plugin'); ?>
		 
		<input id="saner_developer_admin_submit" name="Submit" type="submit" value="<?php esc_attr_e( 'Save Changes', 'saner-developer-admin-lang'); ?>" />
		</form>	
		</div>
<?php
	}
	function setup_forms()
	{
		register_setting( 'saner_developer_settings', 'saner_developer_settings' );
		/* logo settings section */
		add_settings_section( 'saner_developer_logo', __( 'Logo Settings', 'saner-developer-admin-lang' ), array( &$this, 'logo_section' ), 'admin_plugin' );
		/* logo settings fields */
		add_settings_field( 'saner_developer_login_logo', __( 'Remove Wordpress Login Logo', 'saner-developer-admin-lang' ), array( &$this, 'remove_login_logo' ), 'admin_plugin', 'saner_developer_logo' );
		add_settings_field( 'saner_developer_login_logo_add', '', array( &$this, 'add_login_logo' ), 'admin_plugin', 'saner_developer_logo' );
		add_settings_field( 'saner_developer_admin_logo', __( 'Remove Wordpress Logo in Admin', 'saner-developer-admin-lang' ), array( &$this, 'remove_admin_logo' ), 'admin_plugin', 'saner_developer_logo' );
		add_settings_field( 'saner_developer_admin_logo_add', '', array( &$this, 'add_admin_logo' ), 'admin_plugin', 'saner_developer_logo' );
		/* Dashbord Header Colors section */
		add_settings_section( 'saner_developer_dash_colors', __( 'Dashboard Colors', 'saner-developer-admin-lang' ), array( &$this, 'dash_colors_section' ), 'admin_plugin' );
		/* Dashboard Header Colors Fields */
		add_settings_field( 'saner_developer_dash_header_bg_col', __( 'Header Background Color', 'saner-developer-admin-lang' ), array( &$this, 'header_background_color' ), 'admin_plugin', 'saner_developer_dash_colors' );
		add_settings_field( 'saner_developer_dash_header_site_name', __( 'Site Heading Text', 'saner-developer-admin-lang' ), array( &$this, 'site_heading_color' ), 'admin_plugin', 'saner_developer_dash_colors' );
		add_settings_field( 'saner_developer_dash_header_site_name_hover', __( 'Site Heading Text Hover', 'saner-developer-admin-lang' ), array( &$this, 'site_heading_hover_color' ), 'admin_plugin', 'saner_developer_dash_colors' );
		/* Menu Colors */
		add_settings_field( 'saner_developer_sidebar_color', __( 'Sidebar Background', 'saner-developer-admin-lang' ), array( &$this, 'sidebar_color' ), 'admin_plugin', 'saner_developer_dash_colors' );
		add_settings_field( 'saner_developer_menu_title_color', __( 'Menu Title Text', 'saner-developer-admin-lang' ), array( &$this, 'menu_title_color' ), 'admin_plugin', 'saner_developer_dash_colors' );
		add_settings_field( 'saner_developer_menu_title_color_hover', __( 'Menu Title Text Hover', 'saner-developer-admin-lang' ), array( &$this, 'menu_title_color_hover' ), 'admin_plugin', 'saner_developer_dash_colors' );
		add_settings_field( 'saner_developer_menu_title_bg_color', __( 'Menu Title Background', 'saner-developer-admin-lang' ), array( &$this, 'menu_title_bg_color' ), 'admin_plugin', 'saner_developer_dash_colors' );
		add_settings_field( 'saner_developer_menu_title_bg_color_hover', __( 'Menu Title Background Hover', 'saner-developer-admin-lang' ), array( &$this, 'menu_title_bg_color_hover' ), 'admin_plugin', 'saner_developer_dash_colors' );
		add_settings_field( 'saner_developer_sub_menu_title_color', __( 'Sub Menu Title Text', 'saner-developer-admin-lang' ), array( &$this, 'sub_menu_title_color' ), 'admin_plugin', 'saner_developer_dash_colors' );
		add_settings_field( 'saner_developer_sub_menu_title_hover_color', __( 'Sub Menu Title Text Hover', 'saner-developer-admin-lang' ), array( &$this, 'sub_menu_title_hover_color' ), 'admin_plugin', 'saner_developer_dash_colors' );
		add_settings_field( 'saner_developer_menu_selected_color', __( 'Selected Menu Text', 'saner-developer-admin-lang' ), array( &$this, 'menu_title_selected_color' ), 'admin_plugin', 'saner_developer_dash_colors' );
		add_settings_field( 'saner_developer_menu_selected_bg_color', __( 'Selected Menu Background', 'saner-developer-admin-lang' ), array( &$this, 'menu_title_selected_bg_color' ), 'admin_plugin', 'saner_developer_dash_colors' );
		add_settings_field( 'saner_developer_sub_menu_selected_color', __( 'Selected Sub Menu Text', 'saner-developer-admin-lang' ), array( &$this, 'sub_menu_selected_color' ), 'admin_plugin', 'saner_developer_dash_colors' );
		/* WP Upgrade Hide */
		add_settings_section( 'saner_developer_WP_upgrade', __( 'Wordpress Upgrade Reminder', 'saner-developer-admin-lang' ), array( &$this, 'wordpress_upgrade' ), 'admin_plugin' );
		/* WP Upgrade Fields */
		add_settings_field( 'saner_developer_remove_WP_upgrade', __( 'Remove?', 'saner-developer-admin-lang' ), array( &$this, 'remove_WP_upgrade' ), 'admin_plugin', 'saner_developer_WP_upgrade' );
		/* Remove Menu Items */
		add_settings_section( 'saner_developer_menu_items', __( 'Wordpress Menu Items', 'saner-developer-admin-lang' ), array( &$this, 'wordpress_menu' ), 'admin_plugin' );
		/* Remove Menu Items Fields */
		add_settings_field( 'saner_developer_menu_remove_dashboard', __( 'Dashboard', 'saner-developer-admin-lang' ), array( &$this, 'remove_menu_dashboard' ), 'admin_plugin', 'saner_developer_menu_items' );
		add_settings_field( 'saner_developer_menu_remove_posts', __( 'Posts', 'saner-developer-admin-lang' ), array( &$this, 'remove_menu_posts' ), 'admin_plugin', 'saner_developer_menu_items' );
		add_settings_field( 'saner_developer_menu_remove_media', __( 'Media', 'saner-developer-admin-lang' ), array( &$this, 'remove_menu_media' ), 'admin_plugin', 'saner_developer_menu_items' );
		add_settings_field( 'saner_developer_menu_remove_links', __( 'Links', 'saner-developer-admin-lang' ), array( &$this, 'remove_menu_links' ), 'admin_plugin', 'saner_developer_menu_items' );
		add_settings_field( 'saner_developer_menu_remove_pages', __( 'Pages', 'saner-developer-admin-lang' ), array( &$this, 'remove_menu_pages' ), 'admin_plugin', 'saner_developer_menu_items' );
		add_settings_field( 'saner_developer_menu_remove_comments', __( 'Comments', 'saner-developer-admin-lang' ), array( &$this, 'remove_menu_comments' ), 'admin_plugin', 'saner_developer_menu_items' );
		add_settings_field( 'saner_developer_menu_remove_tools', __( 'Tools', 'saner-developer-admin-lang' ), array( &$this, 'remove_menu_tools' ), 'admin_plugin', 'saner_developer_menu_items' );
		add_settings_field( 'saner_developer_menu_remove_settings', __( 'Settings', 'saner-developer-admin-lang' ), array( &$this, 'remove_menu_settings' ), 'admin_plugin', 'saner_developer_menu_items' );
	}
	
	/* logo settings section */
	function logo_section()
	{
		echo '<i>'.__( 'Remove the Wordpress logo from the login page and dashboard', 'saner-developer-admin-lang' ).'</i>';
	}
	/* logo settings fields */
	function remove_login_logo()
	{
		$checked = ( isset($this->options['login_logo']) ? 'checked="yes"' : '' );
		echo '<input id="saner_developer_login_logo" name="saner_developer_settings[login_logo]" type="checkbox" value="1" '.$checked.'" />';
	}
	function add_login_logo()
	{
		if( isset( $this->options['login_logo_new'] ) )
		{
			$logo =  $this->options['login_logo_new'];
		}
		else {
			$logo = '';
		}
		echo '<div id="sd_login_image_upload">
					<input id="saner_developer_login_logo_add" type="text" size="36" name="saner_developer_settings[login_logo_new]" value="'.$logo.'" />
					<img src="'.$logo.'" class="saner_developer_image_sample" />
					<br>'.__( 'Add your own logo file url 310 x 70 px max.', 'saner-developer-admin-lang' ).'
					<br>'.__( 'If you have used media uploader you can get the image url by going to media and finding your image. Just copy and paste it here', 'saner-developer-admin-lang' ).'
					<br><i>'.__( 'Leave it blank to have no logo.', 'saner-developer-admin-lang' ).'</i>
					</div>';
	}
	function remove_admin_logo()
	{
		$checked = ( isset( $this->options['admin_logo'] ) ? 'checked="yes"' : '' );
		echo '<input id="saner_developer_admin_logo" name="saner_developer_settings[admin_logo]" type="checkbox" value="1" '.$checked.'" />';
	}
	function add_admin_logo()
	{
		if( isset( $this->options['admin_logo_new'] ) )
		{
			$logo =  $this->options['admin_logo_new'];
		}
		else {
			$logo = '';
		} 
		echo '<div id="sd_admin_image_upload">
					<input id="saner_developer_admin_logo_add" type="text" size="36" name="saner_developer_settings[admin_logo_new]" value="'.$logo.'" />
					<img src="'.$logo.'" class="saner_developer_image_sample" />
					<br>'.__( 'Add your own logo file url 16 x 16 px.', 'saner-developer-admin-lang' ).'
					<br>'.__( 'If you have used media uploader you can get the image url by going to media and finding your image. Just copy and paste it here', 'saner-developer-admin-lang' ).'
					<br><i>'.__( 'Leave it blank to have no logo.', 'saner-developer-admin-lang' ).'</i>
					</div>';
	
	}
	/* dashboard colors section */
	function dash_colors_section()
	{
		echo '<i>'. __( 'Change the colors on your dashboard by using hex colors e.g. #ffffff or the color chart', 'saner-developer-admin-lang' ).'</i>';
	}
	/* dashboard header color fields */

	function header_background_color()
	{
		$color1 = $this->option_test( 'dash_header_bg_col1', '#464646' );
		$color2 = $this->option_test( 'dash_header_bg_col2', 'color' );
		echo '<table class="sd_table"><tbody><tr><th>'.__( 'Top Gradient Color or Solid Colour', 'saner-developer-admin-lang' ).'</th><th>'.__( 'Bottom Gradient Color', 'saner-developer-admin-lang' ).
		'<br />'.__( '(leave blank for solid color)', 'saner-developer-admin-lang' ).'</th></tr>
					<tr><td><input class="sd_color" id="saner_developer_dash_header_bg_col" type="text" size="36" name="saner_developer_settings[dash_header_bg_col1]" value="'.$color1.'" /></td>
					<td><div id="saner_developer_dash_header_bg_col2_title"><input class="sd_color" id="saner_developer_dash_header_bg_col2" type="text" size="36" name="saner_developer_settings[dash_header_bg_col2]" value="'.$color2.'" /></div></td></tr></tbody></table>
					<div id="ilctabscolorpicker_container"><div class="ilctabscolorpicker_sub_container">
																	<div id="ilctabscolorpicker1"></div>
																	<div id="ilctabscolorpicker2"></div>
																	<div id="ilctabscolorpicker3"></div>
																	<div id="ilctabscolorpicker4"></div>
																	<div id="ilctabscolorpicker5"></div>
																	<div id="ilctabscolorpicker6"></div>
																	<div id="ilctabscolorpicker7"></div>
																	<div id="ilctabscolorpicker8"></div>
																	<div id="ilctabscolorpicker9"></div>
																	<div id="ilctabscolorpicker10"></div>
																	<div id="ilctabscolorpicker11"></div>
																	<div id="ilctabscolorpicker12"></div>
																	<div id="ilctabscolorpicker13"></div>
																	<div id="ilctabscolorpicker14"></div>
																	<div id="ilctabscolorpicker15"></div>
																	<div id="ilctabscolorpicker16"></div>
																	<div id="ilctabscolorpicker17"></div>
																	<div id="ilctabscolorpicker18"></div>
																	<div id="ilctabscolorpicker19"></div>
																	<div id="ilctabscolorpicker20"></div>
																	<div id="ilctabscolorpicker21"></div></div></div>';			
	}

	function site_heading_color()
	{
		$color = $this->option_test( 'dash_header_site_color', '#CCCCCC' );
		echo '<input class="sd_color" id="saner_developer_dash_header_site_name" type="text" size="36" name="saner_developer_settings[dash_header_site_color]" value="'.$color.'" />';
	}
	function site_heading_hover_color()
	{
		$color = $this->option_test( 'dash_header_site_hover_color', '#FFFFFF' );
		echo '<input class="sd_color" id="saner_developer_dash_header_site_name_hover" type="text" size="36" name="saner_developer_settings[dash_header_site_hover_color]" value="'.$color.'" />';
	}
	function sidebar_color()
	{
		$color = $this->option_test( 'sidebar_color', '#ECECEC' );
		echo '<input class="sd_color" id="saner_developer_sidebar_color" type="text" size="36" name="saner_developer_settings[sidebar_color]" value="'.$color.'" />';
	}
	function menu_title_color()
	{
		$color = $this->option_test( 'menu_title_color', '#21759B' );
		echo '<input class="sd_color" id="saner_developer_menu_title_color" type="text" size="36" name="saner_developer_settings[menu_title_color]" value="'.$color.'" />';
	}
	function menu_title_color_hover()
	{
		$color = $this->option_test( 'menu_title_color_hover', '#E06821' );
		echo '<input class="sd_color" id="saner_developer_menu_title_color_hover" type="text" size="36" name="saner_developer_settings[menu_title_color_hover]" value="'.$color.'" />';
	}
	function menu_title_bg_color()
	{
		$color1 = $this->option_test( 'menu_title_bg_color', '#ECECEC' );
		$color2 = $this->option_test( 'menu_topborder_color', '#F9F9F9' );
		$color3 = $this->option_test( 'menu_bottomborder_color', '#DFDFDF' );
		echo '<table class="sd_table"><tbody><tr><th>'.__( 'Background Color', 'saner-developer-admin-lang' ).'</th><th>'.__( 'Top Border Color', 'saner-developer-admin-lang' ).'</th><th>'.__( 'Bottom Border Color', 'saner-developer-admin-lang' ).'</th></tr>
		<tr><td><input class="sd_color" id="saner_developer_menu_bg_color" type="text" size="36" name="saner_developer_settings[menu_title_bg_color]" value="'.$color1.'" /></td>
		<td><input class="sd_color" id="saner_developer_menu_topborder_color" type="text" size="36" name="saner_developer_settings[menu_topborder_color]" value="'.$color2.'" /></td>
		<td><input class="sd_color" id="saner_developer_menu_bottomborder_color" type="text" size="36" name="saner_developer_settings[menu_bottomborder_color]" value="'.$color3.'" /></td></tr></tbody></table>';
	}
	function menu_title_bg_color_hover()
	{
		$color1 = $this->option_test( 'menu_title_bg_color_hover', '#ECECEC' );
		$color2 = $this->option_test( 'menu_topborder_color_hover', '#F9F9F9' );
		$color3 = $this->option_test( 'menu_bottomborder_color_hover', '#DFDFDF' );
		echo '<table class="sd_table"><tbody><tr><th>'.__( 'Background Hover Color', 'saner-developer-admin-lang' ).'</th><th>'.__( 'Top Border Hover Color', 'saner-developer-admin-lang' ).'</th><th>'.__( 'Bottom Border Hover Color', 'saner-developer-admin-lang' ).'</th></tr>
		<tr><td><input class="sd_color" id="saner_developer_menu_bg_color_hover" type="text" size="36" name="saner_developer_settings[menu_title_bg_color_hover]" value="'.$color1.'" /></td>
		<td><input class="sd_color" id="saner_developer_menu_topborder_color_hover" type="text" size="36" name="saner_developer_settings[menu_topborder_color_hover]" value="'.$color2.'" /></td>
		<td><input class="sd_color" id="saner_developer_menu_bottomborder_color_hover" type="text" size="36" name="saner_developer_settings[menu_bottomborder_color_hover]" value="'.$color3.'" /></td></tr></tbody></table>';
	}
	function sub_menu_title_color()
	{
		$color1 = $this->option_test( 'sub_menu_title_color', '#21759B' );
		$color2 = $this->option_test( 'sub_menu_bg_color', '#FFFFFF' );
		echo '<table class="sd_table"><tbody><tr><th>'.__( 'Font Color', 'saner-developer-admin-lang' ).'</th><th>'.__( 'Background Color', 'saner-developer-admin-lang' ).'</th></tr>
		<tr><td><input class="sd_color" id="saner_developer_sub_menu_title_color" type="text" size="36" name="saner_developer_settings[sub_menu_title_color]" value="'.$color1.'" /></td>
		<td><input class="sd_color" id="saner_developer_sub_menu_title_color_bg" type="text" size="36" name="saner_developer_settings[sub_menu_bg_color]" value="'.$color2.'" /></td></tr></tbody></table>';
	}
	function sub_menu_title_hover_color()
	{
		$color1 = $this->option_test( 'sub_menu_title_hover_color', '#333333' );
		$color2 = $this->option_test( 'sub_menu_title_hover_bg_color', '#EAF2FA' );
		echo '<table class="sd_table"><tbody><tr><th>'.__( 'Font Color', 'saner-developer-admin-lang' ).'</th><th>'.__( 'Background Color', 'saner-developer-admin-lang' ).'</th></tr>
		<tr><td><input class="sd_color" id="saner_developer_sub_menu_title_hover_color" type="text" size="36" name="saner_developer_settings[sub_menu_title_hover_color]" value="'.$color1.'" /></td>
		<td><input class="sd_color" id="saner_developer_sub_menu_title_hover_bg_color" type="text" size="36" name="saner_developer_settings[sub_menu_title_hover_bg_color]" value="'.$color2.'" /></td></tr></tbody></table>';
	}
	function menu_title_selected_color()
	{
		$color = $this->option_test( 'menu_title_selected_color', '#DFFFFF' );
		echo '<input class="sd_color" id="saner_developer_menu_selected_color" type="text" size="36" name="saner_developer_settings[menu_title_selected_color]" value="'.$color.'" />';
	}
	function menu_title_selected_bg_color()
	{
		$color1 = $this->option_test( 'menu_title_selected_color_1', '#808080' );
		$color2 = $this->option_test( 'menu_title_selected_color_2' );
		echo '<table class="sd_table"><tbody><tr><th>'.__( 'Top Gradient Color or Solid Color', 'saner-developer-admin-lang' ).'</th><th>'.__( 'Bottom Gradient Color', 'saner-developer-admin-lang' ).'<br />'.__( '(leave blank for solid color)', 'saner-developer-admin-lang' ).'</th></tr>
		<tr><td><input class="sd_color" id="saner_developer_menu_selected_color_1" type="text" size="36" name="saner_developer_settings[menu_title_selected_color_1]" value="'.$color1.'" /></td>
		<td><input class="sd_color" id="saner_developer_menu_selected_color_2" type="text" size="36" name="saner_developer_settings[menu_title_selected_color_2]" value="'.$color2.'" /></td></tr></tbody></table>';
	}
	function sub_menu_selected_color()
	{
		$color = $this->option_test( 'sub_menu_selected_color', '#333333' );
		echo '<input class="sd_color" id="saner_developer_sub_menu_selected_color" type="text" size="36" name="saner_developer_settings[sub_menu_selected_color]" value="'.$color.'" />';
	}
	
	/* wp upgrade reminder */
	function wordpress_upgrade()
	{
		echo '<i>'. __( 'Remove WP ugrade reminder for non admins', 'saner-developer-admin-lang' ).'</i>';
	}
	/* wp upgrade reminder field */
	function remove_WP_upgrade()
	{
		$checked = ( isset( $this->options['remove_WP_upgrade'] ) ? 'checked="yes"' : '');
		echo '<input id="saner_developer_remove_WP_upgrade" name="saner_developer_settings[remove_WP_upgrade]" type="checkbox" value="1" '.$checked.'" />';
	}
	
	/* Wordpress Menu */
	function wordpress_menu()
	{
		echo '<i>'. __( 'Check the box of the appropriate menu item to remove it for non administrators', 'saner-developer-admin-lang' ).'</i>';
	}
	/* Wordpress Menu Fields */
	function remove_menu_dashboard()
	{
		$checked = ( isset( $this->options['remove_menu']['dash'] ) ? 'checked="yes"' : '');
		echo '<input id="saner_developer_remove_menu_dash" name="saner_developer_settings[remove_menu][dash]" type="checkbox" value="1" '.$checked.'" />';
	}
	function remove_menu_posts()
	{
		$checked = ( isset( $this->options['remove_menu']['posts'] ) ? 'checked="yes"' : '');
		echo '<input id="saner_developer_remove_menu_posts" name="saner_developer_settings[remove_menu][posts]" type="checkbox" value="1" '.$checked.'" />';
	}
	function remove_menu_media()
	{
		$checked = ( isset( $this->options['remove_menu']['media'] ) ? 'checked="yes"' : '');
		echo '<input id="saner_developer_remove_menu_media" name="saner_developer_settings[remove_menu][media]" type="checkbox" value="1" '.$checked.'" />';
	}
	function remove_menu_links()
	{
		$checked = ( isset( $this->options['remove_menu']['links'] ) ? 'checked="yes"' : '');
		echo '<input id="saner_developer_remove_menu_links" name="saner_developer_settings[remove_menu][links]" type="checkbox" value="1" '.$checked.'" />';
	}
	function remove_menu_pages()
	{
		$checked = ( isset( $this->options['remove_menu']['pages'] ) ? 'checked="yes"' : '');
		echo '<input id="saner_developer_remove_menu_pages" name="saner_developer_settings[remove_menu][pages]" type="checkbox" value="1" '.$checked.'" />';
	}
	function remove_menu_tools()
	{
		$checked = ( isset( $this->options['remove_menu']['tools'] ) ? 'checked="yes"' : '');
		echo '<input id="saner_developer_remove_menu_tools" name="saner_developer_settings[remove_menu][tools]" type="checkbox" value="1" '.$checked.'" />';
	}
	function remove_menu_comments()
	{
		$checked = ( isset( $this->options['remove_menu']['comments'] ) ? 'checked="yes"' : '');
		echo '<input id="saner_developer_remove_menu_comments" name="saner_developer_settings[remove_menu][comments]" type="checkbox" value="1" '.$checked.'" />';
	}
	function remove_menu_settings()
	{
		$checked = ( isset( $this->options['remove_menu']['settings'] ) ? 'checked="yes"' : '');
		echo '<input id="saner_developer_remove_menu_settings" name="saner_developer_settings[remove_menu][settings]" type="checkbox" value="1" '.$checked.'" />';
	}
/* function to test if the option is set or is empty */
	function option_test( $option, $default='color' )
	{
		if( !isset( $this->options[$option] ) || $this->options[$option] == '' )
		{
			$test = $default;
		}
		else {
			$test = $this->options[$option];
		}
		return $test;
	}
}
?>