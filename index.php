<?php
/*
Plugin Name: iPhone theme switch
Plugin URI: http://wordpress.org/extend/plugins/iphone-theme-switch/
Description: This plugin detects if your site is being viewed by iPhone (or iPod) and switches to an iPhone / iPod  theme. You can get the iUI theme from my website. 
Version: 0.2
Author: Jonas Vorwerk
Author URI: http://www.jonasvorwerk.com/
*/

if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') !== FALSE || strpos($_SERVER['HTTP_USER_AGENT'], 'iPod') !== FALSE){ 
	add_filter('stylesheet', 'getTemplateStyle');
	add_filter('template', 'getTemplateStyle');
} 

function getTemplateStyle(){
	$mobiletheme =  get_option('mobiletheme');
    $themes = get_themes();
      
	foreach ($themes as $theme_data) {
	  if ($theme_data['Name'] == $mobiletheme) {
	      return $theme_data['Stylesheet'];
	  }
	}	
}

function admin_actions() { 
	add_options_page("iPhone theme switch", "iPhone theme switch", 1, "iPhone theme switch", "show_admin");
} 

function show_admin(){
	include('iphone_admin.php'); 
}

add_action('admin_menu', 'admin_actions'); 

?>