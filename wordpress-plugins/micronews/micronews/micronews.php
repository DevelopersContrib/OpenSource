<?php
/*
Plugin Name: Micronews
Plugin URI:
Description: Micronews
Author: Zipsite
Version: 1
Author URI:
*/
?>

<?php
function micronews_widget_init() { 

    global $wpdb;

    if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
        return;

    function micronews_widget_control() {
        global $wpdb;
        $options = $newoptions = get_option('micronews_widget_title');
        if ( $_POST['micronews-widget-submit'] ) {
            $newoptions = $_POST['micronews-widget-title'];
           
        }
        if ( $options != $newoptions ) {
            $options = $newoptions;
            update_option('micronews_widget_title', $options);
        }
		
		/*$optionsid = $newoptionsid = get_option('micronews_widget_id');
        if ( $_POST['micronews-widget-submit'] ) {
            $newoptionsid = $_POST['micronews-widget-id'];
           
        }
        if ( $optionsid != $newoptionsid ) {
            $optionsid = $newoptionsid;
            update_option('micronews_widget_id', $optionsid);
        }*/

        ?>
        <div style="text-align:left">
			
			<label for="micronews-widget-title" style="line-height:35px;display:block;"><?php _e('Title'); ?>:<br />
			<input id="micronews-widget-title" name="micronews-widget-title" value="<?php echo (!empty($options)?$options:'') ; ?>" type="text" style="width:95%;">
			<!--
			<label for="micronews-widget-id" style="line-height:35px;display:block;"><?php _e('Domain ID'); ?>:<br />
			<input id="micronews-widget-id" name="micronews-widget-id" value="<?php echo (!empty($optionsid)?$optionsid:'') ; ?>" type="text" style="width:95%;">
			-->
			<input type="hidden" name="micronews-widget-submit" id="micronews-widget-submit" value="1" />
        </div>
        <?php
    }
    
    function micronews_widget($args) {
        global $wpdb, $current_site;
        extract($args);

        $micronews_widget_title = get_option('micronews_widget_title');
		//$micronews_widget_id = get_option('micronews_widget_id');

		echo $before_widget;
		echo $before_title;
		echo ($micronews_widget_title);
		echo $after_title;
		
		//echo '<script type="text/javascript" src="http://contrib.com/widgets?ma=micronews&d='.$micronews_widget_id.'&domain='.$_SERVER['HTTP_HOST'].'"></script>';
		echo '<script type="text/javascript" src="http://contrib.com/widgets?ma=micronews&dn='.$_SERVER['HTTP_HOST'].'"></script>';
        
        echo $after_widget;
    }

    register_sidebar_widget(array(__('Micronews'), 'widgets'), 'micronews_widget');
    register_widget_control(array(__('Micronews'), 'widgets'), 'micronews_widget_control');

}
add_action('widgets_init', 'micronews_widget_init');