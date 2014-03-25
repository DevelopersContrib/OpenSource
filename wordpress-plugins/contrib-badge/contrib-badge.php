<?php
/*
Plugin Name: Contrib Badge
Plugin URI:
Description: Contrib Badge
Author: Zipsite
Version: 1
Author URI:
*/
function badge_widget_init() { 

    global $wpdb;

    if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
        return;

    function badge_widget_control() {
        global $wpdb;
        $options = $newoptions = get_option('badge_widget_logo');
        if ( $_POST['badge-widget-submit'] ) {
            $newoptions = $_POST['badge-widget-logo'];
        }
        if ( $options != $newoptions ) {
            $options = $newoptions;
            update_option('badge_widget_logo', $options);
        }
		
		$optionstop = $newoptionstop = get_option('badge_widget_top');
        if ( $_POST['badge-widget-submit'] ) {
            $newoptionstop = $_POST['badge-widget-top'];
        }
        if ( $optionstop != $newoptionstop ) {
            $optionstop = $newoptionstop;
            update_option('badge_widget_top', $optionstop);
        }
		
		$optionsright = $newoptionsright = get_option('badge_widget_right');
        if ( $_POST['badge-widget-submit'] ) {
            $newoptionsright = $_POST['badge-widget-right'];
        }
        if ( $optionsright != $newoptionsright ) {
            $optionsright = $newoptionsright;
            update_option('badge_widget_right', $optionsright);
        }
		
        ?>
        <div style="text-align:left">
			
			<label for="badge-widget-title" style="line-height:35px;display:block;"><?php _e('Logo'); ?>:<br />
			<?php
				$op = array('http://referrals.contrib.com/banners/badge-contrib-2.png',
					'http://referrals.contrib.com/banners/badge-contrib-3.png',
					'http://referrals.contrib.com/banners/badge-contrib-heart5.png',
					'http://referrals.contrib.com/banners/badge-contrib-4.png');
			?>
			<select name="badge-widget-logo" id="badge-widget-logo">
				<option <?php echo $newoptions == $op[0] ?'SELECTED' : '' ?>  value="<?php echo $op[0];?>">Proud Member Logo</option>
				<option <?php echo $newoptions == $op[1] ?'SELECTED' : '' ?>  value="<?php echo $op[1];?>">Member Logo</option>
				<option <?php echo $newoptions == $op[2] ?'SELECTED' : '' ?>  value="<?php echo $op[2];?>">I love Logo</option>
				<option <?php echo $newoptions == $op[3] ?'SELECTED' : '' ?>  value="<?php echo $op[3];?>">Member White Logo</option>				
			</select>
			<!--
			<label for="badge-widget-top" style="line-height:35px;display:block;"><?php _e('CSS Top'); ?>:<br />
			<input id="badge-widget-top" name="badge-widget-top" value="<?php echo (!empty($optionstop)?$optionstop:'0px') ; ?>" type="text" style="width:95%;">
			
			<label for="badge-widget-right" style="line-height:35px;display:block;"><?php _e('CSS Right'); ?>:<br />
			<input id="badge-widget-right" name="badge-widget-right" value="<?php echo (!empty($optionsright)?$optionsright:'90px') ; ?>" type="text" style="width:95%;">
			-->
			<input type="hidden" name="badge-widget-submit" id="badge-widget-submit" value="1" />
        </div>
        <?php
    }
    
    function badge_widget($args) {
        global $wpdb, $current_site;
        extract($args);

        $badge_widget_logo = get_option('badge_widget_logo');
		//$optionsright = get_option('badge_widget_right');
		//$optionstop = get_option('badge_widget_top');
		
		$url = "http://api.contrib.com/request/getdomainaffiliateid?domain=".$_SERVER['SERVER_NAME']."&key=".md5('acting.com');
		$return = file_get_contents($url);
		$data = json_decode($return);
		if($data->success){
			$affiliate_id = $data->affiliate_id;
		}
        $str = '<div id="badge-container" style="position:relative;display:none;"><div id="badge" class="badge-postn" >
			<a alt="Contrib" target="_blank" href="http://referrals.contrib.com/idevaffiliate.php?id='.$affiliate_id."&url=http://www.contrib.com/signup/firststep?domain=".$_SERVER['SERVER_NAME'].'">
				<img src="'.$badge_widget_logo.'">
			</a>
		</div></div>';
		$str .= '<style>
			/* CONTRIB BANNERS */
			.animated {
				-webkit-animation-duration: 1s;
				animation-duration: 1s;
				-webkit-animation-fill-mode: both;
				animation-fill-mode: both;
			}
			@-webkit-keyframes rotateIn {
				0% {
					-webkit-transform-origin: center center;
					transform-origin: center center;
					-webkit-transform: rotate(-200deg);
					transform: rotate(-200deg);
					opacity: 0;
				}
				
				100% {
					-webkit-transform-origin: center center;
					transform-origin: center center;
					-webkit-transform: rotate(0);
					transform: rotate(0);
					opacity: 1;
				}
			}
			
			@keyframes rotateIn {
				0% {
					-webkit-transform-origin: center center;
					-ms-transform-origin: center center;
					transform-origin: center center;
					-webkit-transform: rotate(-200deg);
					-ms-transform: rotate(-200deg);
					transform: rotate(-200deg);
					opacity: 0;
				}
				
				100% {
					-webkit-transform-origin: center center;
					-ms-transform-origin: center center;
					transform-origin: center center;
					-webkit-transform: rotate(0);
					-ms-transform: rotate(0);
					transform: rotate(0);
					opacity: 1;
				}
			}
			.rotateIn {
				-webkit-animation-name: rotateIn;
				animation-name: rotateIn;
			}
			.r-d{
				-webkit-animation-delay: 2.5s;
				-moz-animation-delay: 2.5s;
				-ms-animation-delay: 2.5s;
				-o-animation-delay: 2.5s;
				animation-delay: 2.5s;
			}
			/*.badge-postn {
				position: absolute;
				top: '.(!empty($optionstop)?$optionstop:'0px;').';
				right: '.(!empty($optionsright)?$optionsright:'90px;').';
				z-index: 8888;
			}*/
			</style>
			';
			$str .= '
				<script type="text/javascript">
				jQuery( document ).ready( function() {
					//jQuery("body").prepend(jQuery("#badge-container"));
					jQuery("#badge-container").show();
					jQuery("#badge").addClass("animated rotateIn r-d ");
				});
			</script>
					';
		echo $str;
        // echo $after_widget;
    }

    register_sidebar_widget(array(__('Contrib Badge'), 'widgets'), 'badge_widget');
    register_widget_control(array(__('Contrib Badge'), 'widgets'), 'badge_widget_control');

}
add_action('widgets_init', 'badge_widget_init');