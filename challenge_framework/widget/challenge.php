<?php 
$challengeid = $_GET['challenge_id'];
include "../includes/functions.php";
$dir = new DIR_LIB();
$challenge_title = $dir->GetInfo('Challenges','ChallengeTitle', 'ChallengeId', $challengeid);
$challenge_desc = $dir->GetInfo('Challenges','ChallengeDesc', 'ChallengeId', $challengeid);
$slug = $dir->GetInfo('Challenges','Slug', 'ChallengeId', $challengeid);
$photo = $dir->GetInfo('Challenges','Photo', 'ChallengeId', $challengeid);
$link = $site_url."/challenge/".$slug;
?>
var html = '<style type="text/css">'
+'.main{ width: 100%; font-family:arial; font-size:13px; padding-top: 10px; padding-bottom: 10px; padding-left:10px; padding-right:10px; box-shadow: inset 0 0 .4em #999; border-radius:3px; background: rgb(255,255,255); /* Old browsers */ background: -moz-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(229,229,229,1) 0%); /* FF3.6+ */ background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,1)), color-stop(0%,rgba(229,229,229,1))); /* Chrome,Safari4+ */ background: -webkit-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(229,229,229,1) 0%); /* Chrome10+,Safari5.1+ */ background: -o-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(229,229,229,1) 0%); /* Opera 11.10+ */ background: -ms-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(229,229,229,1) 0%); /* IE10+ */ background: linear-gradient(to bottom, rgba(255,255,255,1) 0%,rgba(229,229,229,1) 0%); /* W3C */'
+'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=#ffffff, endColorstr=#e5e5e5,GradientType=0 ); /* IE6-9 */ }'
+'@media (min-width: 280px) { .main .inner{ width: 130px; } }'
+'@media (min-width: 320px) { .main .inner{ width: 260px; } }'
+'@media (min-width: 480px) { .main .inner{ width: 390px; } }'
+'@media (min-width: 640px) { .main .inner{ width: 520px; } }'
+'@media (min-width: 800px) { .main .inner{ width: 780px; } }'
+'.logo { background:#fff; padding:4px 0px 6px 0px; margin-bottom:5px;width:100%}'
+'.erb-image-wrapper img{ max-width:100% !important; height:auto; display:block; }'
+'.wid-title{ padding: 1px 0 1px 0; background: rgb(255,255,255); /* Old browsers */ background: -moz-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(246,246,246,1) 47%, rgba(237,237,237,1) 100%); /* FF3.6+ */ background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,1)), color-stop(47%,rgba(246,246,246,1)), color-stop(100%,rgba(237,237,237,1))); /* Chrome,Safari4+ */ background: -webkit-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(246,246,246,1) 47%,rgba(237,237,237,1) 100%); /* Chrome10+,Safari5.1+ */ background: -o-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(246,246,246,1) 47%,rgba(237,237,237,1) 100%); /* Opera 11.10+ */ background: -ms-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(246,246,246,1) 47%,rgba(237,237,237,1) 100%); /* IE10+ */ background: linear-gradient(to bottom, rgba(255,255,255,1) 0%,rgba(246,246,246,1) 47%,rgba(237,237,237,1) 100%); /* W3C */filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=#ffffff, endColorstr=#ededed,GradientType=0 ); /* IE6-9 */ }'
+'.wid-title p { font-size:19px; font-weight:bold; color:#555; padding:8px; margin-top:-1px; margin-bottom:-1px; }'
+'.wid-desc{ padding: 1px 0 1px 0; background:#fff; color:#222; }'
+'.wid-desc p{ 	padding:8px; 	margin-top:-1px; 	margin-bottom:-1px; }'
+'.links { text-align:center; }'
+'a.btn-widget { display: inline-block; width:180px; margin-top:5px; color: #666; text-transform: uppercase; text-decoration:none; letter-spacing: 2px; font-size: 12px; padding: 10px 30px; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px; border: 1px solid rgba(0,0,0,0.3); border-bottom-width: 3px; background: rgb(255,255,255); /* Old browsers */ background: -moz-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(241,241,241,1) 50%, rgba(225,225,225,1) 51%, rgba(246,246,246,1) 100%); /* FF3.6+ */ background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,1)), color-stop(50%,rgba(241,241,241,1)), color-stop(51%,rgba(225,225,225,1)), color-stop(100%,rgba(246,246,246,1))); /* Chrome,Safari4+ */ background: -webkit-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(241,241,241,1) 50%,rgba(225,225,225,1) 51%,rgba(246,246,246,1) 100%); /* Chrome10+,Safari5.1+ */background: -o-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(241,241,241,1) 50%,rgba(225,225,225,1) 51%,rgba(246,246,246,1) 100%); /* Opera 11.10+ */ background: -ms-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(241,241,241,1) 50%,rgba(225,225,225,1) 51%,rgba(246,246,246,1) 100%); /* IE10+ */ background: linear-gradient(to bottom, rgba(255,255,255,1) 0%,rgba(241,241,241,1) 50%,rgba(225,225,225,1) 51%,rgba(246,246,246,1) 100%); /* W3C */ filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=#ffffff, endColorstr=#f6f6f6,GradientType=0 ); /* IE6-9 */ }'
+'a.btn-widget:hover { background-color: #e3e3e3; border-color: rgba(0,0,0,0.5); }'
+'a.btn-widget:active { background-color: #CCC; border-color: rgba(0,0,0,0.9); }'
+'</style>'
+'<div class="main">'
+'<div class="inside">'
+'<div class="logo erb-image-wrapper">'
+'<img src="<?php echo $logo?>">'
+'</div>'
+'<div class="logo erb-image-wrapper">'
+'<img src="<?php echo $photo?>">'
+'</div>'
+'<div class="wid-title">'
+'<p><?php echo stripcslashes($challenge_title)?></p>'
+'</div>'
+'<div class="wid-desc">'
+'<p><?php echo stripcslashes($challenge_desc)?></p>'
+'</div>'
+'<div class="links">'
+'<a href="<?php echo $link?>" class="btn-widget" target="_blank">Timeline</a>'
+'<a href="<?php echo $link?>" class="btn-widget" target="_blank">Prizes</a>'
+'<a href="<?php echo $link?>" class="btn-widget" target="_blank">Timeline</a>'
+'<a href="<?php echo $link?>" class="btn-widget" target="_blank">Criteria For Judging</a>'
+'<a href="<?php echo $link?>" class="btn-widget" target="_blank">Sponsors</a>'				
+'</div>'
+'</div>'
+'</div>';
document.write(html);