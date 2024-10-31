jQuery(document).ready(function() {

/* show login logo upload.... or not */
if ( jQuery('#saner_developer_login_logo').attr('checked') )
	{
		jQuery('#sd_login_image_upload').show();
	}
	else {
	jQuery('#sd_login_image_upload').hide();
}	
jQuery('#saner_developer_login_logo').click(function() {
	if ( jQuery('#saner_developer_login_logo').attr('checked') )
	{
		jQuery('#sd_login_image_upload').show();
	}
	else {
	jQuery('#sd_login_image_upload').hide();
}
});

/* show admin logo upload... or not */
if ( jQuery('#saner_developer_admin_logo').attr('checked') )
	{
		jQuery('#sd_admin_image_upload').show();
	}
	else {
	jQuery('#sd_admin_image_upload').hide();
}	
jQuery('#saner_developer_admin_logo').click(function() {
	if ( jQuery('#saner_developer_admin_logo').attr('checked') )
	{
		jQuery('#sd_admin_image_upload').show();
	}
	else {
	jQuery('#sd_admin_image_upload').hide();
}
});

/* color picker */

		jQuery(".sd_color").each(function(i){
			
			var sd_id = jQuery(this).attr("id");
			i = i +1;
			jQuery("#ilctabscolorpicker" + i).farbtastic("#" + sd_id);
			jQuery("#ilctabscolorpicker" + i).hide();
			
			jQuery(this).click(function(){
				jQuery(".ilctabscolorpicker_sub_container").children().hide();	
				jQuery("#ilctabscolorpicker" + i).toggle();			
			});
		});

});