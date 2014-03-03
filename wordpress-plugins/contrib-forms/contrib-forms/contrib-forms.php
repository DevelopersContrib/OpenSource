<?php
/*
Plugin Name: Contrib Forms
Plugin URI:
Description: Contrib Forms
Author: Zipsite
Version: 1
Author URI:
*/
 
function contribform_func( $atts ) {
	extract( shortcode_atts( array(
		'form' => '',
	), $atts ) );

	$page = '';
	$str = '';
	switch($form){
		case "inquiry":
			$page = 'inquiry';
		break;		
		case "partnership":
			$page = 'partnership';
		break;		
		case "offer":
			$page = 'offer';
		break;		
		case "staffing":
			$page = 'staffing';
		break;
	}
	if(!empty($page)){
		$url = "http://www.contrib.com/signup/$page/".$_SERVER['HTTP_HOST'];
		$str = "<iframe src='$url' scrolling='no' frameborder='no' style='width:332px;height:435px;border: none;'></iframe>";
	}
	return $str;
}
add_shortcode( 'contribform', 'contribform_func' );