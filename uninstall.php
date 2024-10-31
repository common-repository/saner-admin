<?php
/* remove data from database when user uninstalls the plugin */

/* for old versions */
if( !defined('WP_UNINSTALL_PLUGIN') )
{
	exit();
}

/* delete option data */
delete_option( 'saner_developer_settings' );

?>