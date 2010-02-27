<?php
/*
Plugin Name: iPhone theme switcher
Plugin URI: http://wordpress.org/extend/plugins/iphone-theme-switch/
Description: This plugin detects if your site is being viewed by iPhone (or iPod) and switches to an selected iPhone theme.
Version: 0.41
Author: Jonas Vorwerk
Author URI: http://www.jonasvorwerk.com/
*/

if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') !== FALSE || strpos($_SERVER['HTTP_USER_AGENT'], 'iPod') !== FALSE){ 
	add_filter('stylesheet', 'getTemplateStyle');
	add_filter('template', 'getTemplateStyle');
} 

function getTemplateStyle(){
	$iphonetheme =  get_option('iphonetheme');
    $themes = get_themes();
	foreach ($themes as $theme_data) {
	  if ($theme_data['Name'] == $iphonetheme) {
	      return $theme_data['Stylesheet'];
	  }
	}	
}

function its_admin_actions() { 
	if (current_user_can('activate_plugins')) { 
		add_theme_page("iPhone theme switcher", "iPhone theme switcher", 1, "iPhone theme switcher", "its_show_admin");
	}
} 

function its_show_admin(){
	include('iphone-theme-switcher_admin.php'); 
}

add_action('admin_menu', 'its_admin_actions'); 

?>