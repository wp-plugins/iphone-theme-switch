<?php
/*
Plugin Name: iPhone theme switch
Plugin URI: http://wordpress.org/extend/plugins/iphone-theme-switch/
Description: This plugin detects if your site is being viewed by iPhone (or iPod) and switches to an, by admin selectable, iPhone theme. THIS WILL BE THE LAST REVISION OF THIS PLUGIN USE THE "MOBILE THEME SWITCH" plugin instead: http://wordpress.org/extend/plugins/mobile-theme-switcher/
Version: 0.55
Author: Jonas Vorwerk
Author URI: http://www.jonasvorwerk.com/
*/
session_start();

if($_GET['mobile'] == "off"){
	$_SESSION[$JVmobile] = "off"; 
	unset( $_SESSION[$JVmobile] ); 
} else if($_GET['mobile'] == "on"){
	$_SESSION[$JVmobile] = "on";
}

$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
/*
$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
$iemobile = strpos($_SERVER['HTTP_USER_AGENT'],"iemobile");
*/

if (($iphone || $android || $palmpre || $ipod || $berry || $iemobile == true) || $_SESSION[$JVmobile] == "on") { 
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
	if (current_user_can('manage_options'))  {
		add_theme_page("iPhone theme switch", "iPhone theme switch", 'manage_options', "iPhone-theme-switch", "its_show_admin");
	}
} 

function its_show_admin(){
	include('iphone-theme-switch_admin.php'); 
}

add_action('admin_menu', 'its_admin_actions'); 

?>