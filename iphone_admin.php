<?php 
if($_POST['form_hidden'] == 'Y') {
	//Form data sent
	$mobiletheme = $_POST['mobiletheme'];
	update_option('mobiletheme', $mobiletheme);
	
	//$pages_arg = $_POST['pages_arg'];
	//update_option('pages_arg', $pages_arg);
	
	//$posts_arg = $_POST['posts_arg'];
	//update_option('posts_arg', $posts_arg);
	?>
	<div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
	<?php
} else {
	//Normal page display
	//$pages_arg = get_option('pages_arg');
	//$posts_arg = get_option('posts_arg');
	$mobiletheme = get_option('mobiletheme');
}	
?>

<div class="wrap">
	<?php    echo "<h2>" . __( 'iPhone theme switch', 'jv_mobiletheme' ) . "</h2>"; ?>
	<!-- <h4>Theme for iPhone</h4> -->
	<form name="mobiletheme_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<?php
  $themes = get_themes();
  $default_theme = get_current_theme();
  
  if (count($themes) > 1) {
      $theme_names = array_keys($themes);
      natcasesort($theme_names); 
      $html = 'iPhone theme: <select name="mobiletheme">' . "\n";
      foreach ($theme_names as $theme_name) {              
          if (($mobiletheme == $theme_name) || (($mobiletheme == '') && ($theme_name == $default_theme))) {
              $html .= '<option value="' . $theme_name . '" selected="selected">' . htmlspecialchars($theme_name) . '</option>' . "\n";
          } else {
              $html .= '<option value="' . $theme_name . '">' . htmlspecialchars($theme_name) . '</option>' . "\n";
          }
      }
      $html .= '</select>' . "\n\n";
  }
  echo $html;
  
   ?>
		<!--<input type="hidden" name="form_hidden" value="Y">
		<h4>Optional options</h4>
		<p>get_pages arguments: <input type="text" name="pages_arg" value="<?php echo $pages_arg; ?>" size="20"> <i>for example: exclude=9&sort_column=menu_order <a href="http://codex.wordpress.org/Function_Reference/get_pages" target="_blank">get_pages reference</a></i> </p>
		<p>get_posts arguments: <input type="text" name="posts_arg" value="<?php echo $posts_arg; ?>" size="20"> <i>for example: cat=4&orderby=date&numberposts=10 <a href="http://codex.wordpress.org/Template_Tags/get_posts" target="_blank">get_posts reference</a></i></p>-->
	
		<p class="submit">
		<input type="submit" name="Submit" value="<?php _e('Update Options', 'jv_mobiletheme' ) ?>" />
		</p>
		<p>This plugin is developed by <a href="http://www.jonasvorwerk.com" target="_blank">Jonas Vorwerk</a></p>
	</form>
</div>