<?php
/*
Plugin Name: iPhone theme switch
Plugin URI: http://www.jonasvorwerk.com/
Description: This plugin detects if your site is being viewed by iPhone (or iPod) and switches to an iPhone / iPod  theme. You can get the iUI theme from my website. 
Version: 0.2
Author: Jonas Vorwerk
Author URI: http://www.jonasvorwerk.com/
*/

/*  Copyright 2009  Jonas Vorwerk  (email : info@jonasvorwerk.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
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