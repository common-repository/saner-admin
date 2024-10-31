jQuery(document).ready(function() {
	var data = {
		'action': 'sd_css_callback'
	}; 
	// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
	jQuery.post(ajaxurl, data, function(e) {
		/* takes the colors from the ajax call and adds them to variables */
		var menu_title_hover = e.menu_title_color_hover;
		
		/* menu stays highlighted when sub menu in versions >= 3.3 is hovered over. I like the effect and I don't know a way of achieving this with CSS */
	jQuery("#adminmenu .wp-submenu, .wp-menu-arrow").hover(function(){
	jQuery(this).parents('li').find('a.menu-top').css('color', menu_title_hover);
},
function(){
	jQuery(this).parents('li').find('a.menu-top').css('color', '');
});
	}, 'json');


});