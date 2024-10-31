<?php class saner_developer_ajax
{
	function saner_developer_ajax()
	{
		$this__construct();
	}
	
	function __construct()
	{
		/* get the database */
		global $wpdb;
		/* loads up the options from the plugin */
		$this->options = get_option( 'saner_developer_settings' );
		/* creates ajax call for js css fix */
		add_action( 'wp_ajax_sd_css_callback', array( &$this, 'sd_css_action_callback' ) );
	}
	function sd_css_action_callback() {
		
		/* get the color for the different sections */
		
		$menu_title_hover = $this->options['menu_title_color_hover'];
		
		$response = json_encode( array( 'menu_title_color_hover' => $menu_title_hover ) );
		
		echo $response;
	
		die(); // this is required to return a proper result
	}
}
?>