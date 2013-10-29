<?include('header.php');?>

<?php 

	
  $slug = $_GET['slug'];
  $appid = $dir->GetInfo('Applications','AppId', 'Slug', $slug);
  
  $app_name = $dir->GetInfo('Applications','AppName', 'AppId', $appid);
  $app_desc = $dir->GetInfo('Applications','AppDesc', 'AppId', $appid);
  $app_image = $dir->GetInfo('AppImages','ImagePath', 'AppId', $appid);
  $galls = $dir->GetGallery2($appid);
  $member_id = $dir->GetInfo('Applications','ChallengeMemberId', 'AppId', $appid);
  $submitted_by = $dir->GetInfo('ChallengeMembers','Username', 'ChallengeMemberId', $member_id);
  $challengeid = $dir->GetInfo('Applications','ChallengeId', 'AppId', $appid);
  $category_id = $dir->GetInfo('Challenges','CategoryId', 'ChallengeId', $challengeid);
  $category = $dir->GetInfo('ChallengeCategory', 'CategoryName', 'ChallengeCategoryId', $category_id);
  $applications_count = $dir->GetTotal('Applications','ChallengeId',$challengeid);
  $photo = $dir->GetInfo('Challenges','Photo', 'ChallengeId', $challengeid);
  $challenge_title = $dir->GetInfo('Challenges','ChallengeTitle', 'ChallengeId', $challengeid);
  $challenge_desc = $dir->GetInfo('Challenges','ChallengeDesc', 'ChallengeId', $challengeid);
  $challenge_slug = $dir->GetInfo('Challenges','Slug', 'ChallengeId', $challengeid);
  $solved = $dir->GetInfo('Challenges','Solved', 'ChallengeId', $challengeid);
  $app_files = $dir->GetAppFiles2($appid);
  $app_videos = $dir->GetAppVideos2($appid);
  
  // $app_files2 = $dir->GetAppFiles2($appid);
  // echo "<pre>";print_r($app_files2);echo "</pre>";
  // $app_videos2 = $dir->GetAppVideos2($appid);
  // echo "<pre>";print_r($app_videos2);echo "</pre>";
  
  $app_date = $dir->reformatdate($dir->GetInfo('Applications','AppDatePosted', 'AppId', $appid));
  $ifappwinner = $dir->CheckExist('Applications','AppId',$appid,'AppWinner','1');
  
  $days_left = $dir->GetDaysLeft($challengeid);
  $bg_color = $dir->GetInfo('Challenges','bg_color', 'ChallengeId', $challengeid);
  $desc_font_size = $dir->GetInfo('Challenges','font_size', 'ChallengeId', $challengeid);
  $desc_font_style = $dir->GetInfo('Challenges','font_style', 'ChallengeId', $challengeid);
  
  if($bg_color=='') $bg_color='#262727';
  if($desc_font_size=='') $desc_font_size='22';
  if($desc_font_style=='') $desc_font_style='arial';
  
  
  if($_POST['submit-button']=='send' && isset($_SESSION['Username'])){
	$submit = true;
	$image = $_POST['fbox'];
	$name = mysql_escape_string($_POST['appli-name']);
	$desc = mysql_escape_string($_POST['appli-desc']);
	$slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9\-]/', '-', $name),'\-'));
	$c_slug = $slug;
	
	if($name != $app_name){
		if($dir->AppCheckSlugIfExists($slug)===true){
			$slug = $slug.'-app';
		}
	}
	$vid_cnt = $_POST['appli-vid-cnt'];
	$vid = $_POST['appli-vid'];
	
	if($dir->ApplicationUpdate($appid,$name,$desc,$slug)){
		
		if(isset($image)){
				foreach($image as $value){
						$add = $siteurl."/server/php/files/".$value;
						$dir->AppImageSave($appid,$add);
					
				}
	
		}
		
		
		
		$cnt2 = 0;
		while(list($key2,$value2) = each($_FILES['appli-file']['name'])){
			$cnt2++;
			if(!empty($value2)){
				$filename2 = $value2;
				preg_match('/([^\\/\:*\?"<>|]+)(?:\.([^\\/\:*\?"<>|\.]+))$/',$filename2,$matches2);
				$ext2 = strtolower($matches2[2]);
				$start2 = time();
				$add2 = "uploads/submission/files/file_".$start2."_".$cnt2.".".$ext2;
                      
				copy($_FILES['appli-file']['tmp_name'][$key2], $add2);
				chmod("$add2",0777);
				$add2 = $siteurl."/".$add2;
				$dir->AppFileSave($appid,$add2);
			}
		}
		
		for($i=0; $i<$vid_cnt; $i++){
			$vid_url = $vid[$i];
			if($vid_url!="")
				$dir->AppVideoSave($appid,$vid_url);
		}
		
	}
}

?>
  <style>
   .padding-inner{padding:10px;}
   .wrap-header-bckgrnd{
		background-color: <?=$bg_color?> !important;
		background-image: url(<?=$photo?>) !important;
   }
   .challenge_desc{
		font-size: <?=$desc_font_size?>px !important;
		font-family: <?=$desc_font_style?>,sans-serif !important;
		line-height: 30px !important;
		text-shadow: 0px 0px 5px black !important;
   }
   .warning-span{
		color: rgb(207, 1, 1);background-color: #FFF2B6;padding: 5px;width: 170px !important;
   }
  </style>
  
<?include('fonts.php');?>
<link href="/css/photochallenge-post.css" rel="stylesheet" type="text/css"> 
<link rel="stylesheet" href="<?php echo $site_url?>/css/thickbox.css" type="text/css" media="screen" />
<script language="javascript" type="text/javascript" src="<?php echo $site_url?>/js/thickbox.js"></script>

<div class="row-fluid colortheme-inverse">
	<div class="clearfix"></div>

	<div class="container">
		<div class="span12 padding-inner">
			<div class="row-fluid">
				<!--start of challenge header-->
				<div class="row-fluid">
					<a href="/browse.html"  class="brdcrmb-link-deco">Browse</a> 
					<b class="brdcrmb-meta-arrw">&raquo;</b> 
					<span class="brdcrmb-active"><a href="<?php echo $site_url?>/challenge/<?php echo $challenge_slug?>">Join the <?php echo stripcslashes($challenge_title)?>challenge</span>			
				</div><!--Breadcrumb--> 

				
				<!-- start challenge details-->
				<div class="row-fluid">
					<div class="row-fluid">
						<div class="wrap-header-post">
							<h2><a href="#" class="post-title"><?php echo stripslashes($challenge_title)?></a></h2>
						</div>
					</div><!--Banner-->
					<div class="row-fluid">
						<ul id="post-tabs" class="inline">
							<li class="active-tab">
								<a class="tab-link" href="/home.html" target="_blank">
									<span class="tabs-text">
										<i class="icon-home icon-white"></i>
									</span>
								</a>
							</li>
							
							<? if($dir->CheckIfGallery($challengeid) == true){ ?>
							<li class="inactive-tab">
								<a class="tab-link" href="/challenge/applications/<?=$challenge_slug?>" target="_blank">
									<span class="tabs-text">
										View Submissions
									</span>
								</a>
							</li>
							<? } ?>
							
							<li class="inactive-tab">
								<a class="tab-link" href="/badges/<?=$challenge_slug?>" target="_blank">
									<span class="tabs-text">
										Badges
									</span>
								</a>
							</li>
							<li class="inactive-tab">
								<a class="tab-link" href="/discuss/<?=$challenge_slug?>" target="_blank">
									<span class="tabs-text">
										Discuss
									</span>
								</a>
							</li>
						</ul>
						
						<div id="header" class="wrap-header-bckgrnd">
							<div class="header-header-module">
								<div>
									<div class="header-content">
										
										<h1 class="challenge_desc"><?php echo stripslashes($challenge_desc)?></h1>					
										<?php if($solved=="1"):?>
											<div class="message-warning"><span class="warning-span" style="width: 212px !important;"><i class="icon-warning-sign" style="background-color: #FFEEA0;"></i>This challenge is already solved.</span></div>
										<?php elseif($days_left<0):?>
											<div class="message-warning"><span class="warning-span"><i class="icon-warning-sign" style="background-color: #FFEEA0;"></i>This challenge is closed.</span></div>
										<?php else:?>
											
											<?if(isset($_SESSION['ChallengeMemberId'])):?>
												<?php if ($dir->CheckExist('Applications','ChallengeId',$challengeid,'ChallengeMemberId',$_SESSION['userid'])===TRUE && $_SESSION['UserType'] == '1' && $solved == '0'):?>
													  <div class="message-warning"><span class="warning-span" style="width:375px !important"><i class="icon-warning-sign" style="background-color: #FFEEA0;"></i>You have already submitted an application to this challenge.</span></div>
												<?php endif;?>								
												
												<?php if ($dir->CheckExist('Applications','ChallengeId',$challengeid,'ChallengeMemberId',$_SESSION['userid'])===FALSE && $_SESSION['UserType'] == '1' && $solved == '0'):?>
													 <a href="<?=$siteurl?>/challenge/apply/<?php echo $challenge_slug?>"> <button class="btn btn-large btn-warning">Submit Application</button></a>
												<?php endif;?>
												
												<?php if ($solved!="1" && $_SESSION['UserType'] == '2' ):?>
													<a href="<?=$siteurl?>/challenge/sponsor/<?php echo $challenge_slug?>"> <button class="btn btn-large btn-warning">Sponsor This Challenge</button></a>
												<?php endif;?>
											<?php else: ?>
												<a href="<?=$siteurl?>/challenge/apply/<?php echo $challenge_slug?>"> <button class="btn btn-large btn-warning">Submit Application</button></a>
											<?php endif;?>
											
										<?php endif;?>
									</div>
								</div>
							</div>
						</div>
					</div><!--header bckgrnd-->
					<div class="row-fluid wrap-post-content">
						<div class="span12 padding-content">
							<div class="span8 post-body-content">
								<div class="post-left-content">
									<div class="row-fluid">
										<?php if ($submit):?>
											
											<div class="alert alert-success">
												<button type="button" class="close" data-dismiss="alert">&times;</button>
											  You successfully updated application. Preview your application <a href="<?php echo $siteurl?>/application/<?php echo $slug?>">here</a>.<br>
											  <!--Go back to <a href="<?php echo $siteurl?>/challenge/<?php echo $c_slug?>"><?php echo $challenge_title?></a><br>-->
											  Share your application:
											  <div class="addthis_toolbox addthis_default_style" addthis:url="<?php echo $siteurl?>/application/<?php echo $slug?>" addthis:title="<?php echo $name?>" addthis:description="<?php echo $desc?>">
												<a class="addthis_button_preferred_1"></a>
												<a class="addthis_button_preferred_2"></a>
												<a class="addthis_button_preferred_3"></a>
												<a class="addthis_button_preferred_4"></a>
												<a class="addthis_button_compact"></a>
												<a class="addthis_counter addthis_bubble_style"></a>
												</div>
												<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
												<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-517895f814f07260"></script>
											</div>
										<?php else:?>
										<div class="wrap-post-main-content profile-row">
											<h2>Edit Submission <i class="icon-chevron-right"></i> <?php echo ucwords($app_name)?>
											
											<div class="pull-right">
													<script type="text/javascript" src="http://www.contrib.com/widgets?ma=rating2"></script>
												</div>
							
											<div class="clearfix"></div>
							
											</h2>
											
											<div class="row-fluid" style="margin: 10px 0 10px;">											
												<p>Submitted by: <a href="<?php echo $site_url?>/user/<?php echo $submitted_by?>"><?php echo $submitted_by?></a> 
												&mdash; <?=$app_date?> &nbsp; <?php if ($ifappwinner===true){ echo ' <img src="'.$siteurl.'/img/winner.png" style="margin: 10px 0 -12px;"> <span style="color: orange;"><b> Challenge Winner!</b></span>'; }?>
												</p>											
											</div>
											<form method="POST" enctype="multipart/form-data" >
										   <div class="row-fluid">                       
												<h5>Application Name</h5>	
												<input id="appli-name" name="appli-name" type="text" style="font-size: 14px;width: 98%;" id="" value="<?php echo $app_name?>">												
											</div>
											
											<div class="row-fluid" style="margin: 20px 0 20px;">
												<h5>Details</h5>
												<textarea id="appli-desc" name="appli-desc" style="font-size: 14px;width: 98%;height: 100px;" id=""><?php echo stripcslashes(stripslashes($app_desc));?></textarea>												 
											</div>
											
											<div class="row-fluid">                       
												<h5>Images</h5>
												<?php if (count($galls)>0):?>
												   <?php for ($i=0;$i<count($galls);$i++):?>
														<div style="float:left;">
														<a href="<?php echo $galls[$i]['ImagePath']?>" title="" class="thickbox">
														<img class="img-rounded" style="width:200px;height:200px;" src="<?php echo $galls[$i]['ImagePath']?>">
														</a>
														<br>
														<a id="<?php echo $galls[$i]['id'].'-'.$appid;?>" class="delete-img btn btn-mini btn-warning" href="javascript:;">Delete</a>
														</div>
												   <?php endfor;?>
												<?php endif;?>
											</div>
											
											<div class="appli-box">

													<span>The first image is used for your entry in listing pages. Upload several and we'll make them into a gallery.
													They should be jpg, gif or png files no larger than 2mb.</span><br>
													
													<span class="btn btn-success fileinput-button">
														<i class="glyphicon glyphicon-plus"></i>
														<span>Select images...</span>
														<!-- The file input field used as target for the file upload widget -->
														<input id="appli-image-1" type="file" name="files[]" multiple>
													</span>
													<br>
													<br>
													<!-- The global progress bar -->
													<div id="progress" class="progress" style="width:100%" >
														<div style="background-color:red;width:0px;text-align: center;" class="progress-bar progress-bar-success">&nbsp;</div>
													</div>
													<!-- The container for the uploaded files -->
													<div id="files" class="files"></div>
													<br>
													<br>
												<!-------------------------------------------------------------------------------------------------->
											</div>
											
											
											
											<div class="row-fluid" style="margin: 20px 0 20px;">
												<h5>Supporting Video :</h5>
												<?php if (count($app_videos )>0):?>												
													<div class="well">
														<ol style="-webkit-padding-start: 20px;">
															<?php for ($i=0;$i<count($app_videos);$i++):?>
															<li><a href="<?=$app_videos[$i]['Url']?>"><?=$app_videos[$i]['Url']?></a>  - <a id="<?php echo $app_videos[$i]['id'].'-'.$appid;?>" class="delete-vid btn btn-mini btn-warning" href="javascript:;">Delete</a></li>
															<?php endfor;?>
														</ol>
													</div>												
												<?php endif;?>
												
												<span>You can add one or more video links by providing the url of the video. This is not required but this may increase the validation of your application.</span><br>
												<span id="vid-add-box">Paste video url here:<textarea name="appli-vid[]" id="appli-vid-1" class="in-desc"></textarea></span>
												<!--<button id="vid-more" style="float:right">+ Add more</button>-->
												<button id="vid-more" class="btn btn-success btn-small">
														 <i class="icon-plus-sign icon-white"></i> Add more
												</button>
												<!--<input type="file" id="">-->
											</div>						
											
											<div class="row-fluid" style="margin: 20px 0 20px;">
												<h5>Supporting Files</h5>
												<?php if (count($app_files )>0):?>												
													<div class="well">
														<ol style="-webkit-padding-start: 20px;">
															<?php for ($i=0;$i<count($app_files);$i++):?>
															<li><a href="<?=$app_files[$i]['FilePath']?>">Document <?=$i+1?></a> - <a id="<?php echo $app_files[$i]['id'].'-'.$appid;?>" class="delete-doc btn btn-mini btn-warning" href="javascript:;">Delete</a></li>
															<?php endfor;?>
														</ol>
													</div>												
												<?php endif;?>
												<!--<input type="file" id="">-->
												<span>This is not required but this may increase the validation of your application. Files should not be larger than 5mb.</span><br>
												<span id="file-add-box"><input type="file" name="appli-file[]" id="appli-file-1" size="45" /></span>
												<!--<button id="file-more" style="float:right">+ Add more</button>-->
												<button id="file-more" class="btn btn-success btn-small">
														 <i class="icon-plus-sign icon-white"></i> Add more
												</button>
											</div>
											<input type="hidden" id="appli-vid-cnt" name="appli-vid-cnt" value="1" />
											<input type="hidden" id="appli-file-cnt" name="appli-file-cnt" value="1" />
											<button class="btn btn-primary" value="send" id="submit" name="submit-button">Update Application</button>
											
											</form>
										</div>
										<?php endif;?>
									</div><!--End Details-->
								</div>
							</div>
							<div class="span4">
								<div class="row-fluid">
									<h1 class="trtri">
										
										<?if($solved=="1"):?>
											Already solved.
										<?elseif($days_left<0):?>
											This is closed.
										<?else:?>
											<?=$days_left;?> days to submit 
										<?endif;?>										
										
										
										<? if($dir->CheckIfGallery($challengeid) == true){ ?>
											<br><a href="<?php echo $site_url?>/challenge/applications/<?php echo $challenge_slug?>">(View all Challenge Submissions)</a>
										<? } ?> 
									</h1>
								</div>
							<? include('sidebar.php'); ?>
							</div>
						</div>
					</div><!--Content-->
				</div>
				<!-- end challenge details-->
				
			</div>
		</div>
	</div><!--container-->
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?=$siteurl?>/js/vendor/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?=$siteurl?>/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?=$siteurl?>/js/jquery.fileupload.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
 <script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
   /* var url = window.location.hostname === 'http://photochallenge.com' ?
                '//jquery-file-upload.appspot.com/' : 'server/php/';*/

    var url = '<?php echo $siteurl?>/server/php/index.php';            
    $('#appli-image-1').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
				var indicator = '<input type="hidden" id="appli-image-cnt" name="appli-image-cnt" value="1" />';
                var box = '<input id="appli-image-2" type="hidden" name="fbox[]" value="'+file.name+'">';
                $('#files').append(box);
                jQuery('<p><img src="/server/php/files/'+file.name+'" />'+file.name+'</p>').appendTo('#files');
            });
			
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
			$('#progress .progress-bar').html(progress+'%');
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
    $(document).ready(function () {
		$('#submit').click(function(){
			if($('.delete-img').length<1 && $('#appli-image-2').length<1){
				alert('Please upload atleast one image.');
				return false;
			}
			return true;
		});
		
		$('#img-more').click(function(){
			var x = $('#appli-image-cnt').val();
			var y = parseInt(x) + 1;
			$('#appli-image-cnt').val(y)
			$('#img-add-box').append('<input type="file" name="appli-image[]" id="appli-image-'+y+'"/>');
			
			return false;
		});
		
		$('#vid-more').click(function(){
			var x = $('#appli-vid-cnt').val();
			var y = parseInt(x) + 1;
			$('#appli-vid-cnt').val(y)
			$('#vid-add-box').append('<br>Paste video url here:<textarea name="appli-vid[]" id="appli-vid-'+y+'" class="in-desc"></textarea>');
			
			return false;
		});
		
		$('#file-more').click(function(){
			var x = $('#appli-file-cnt').val();
			var y = parseInt(x) + 1;
			$('#appli-file-cnt').val(y)
			$('#file-add-box').append('<input type="file" name="appli-file[]" id="appli-file-'+y+'"/>');
			
			return false;
		});
		
		$('.delete-img').click(function(){
			var obj = $(this);
			var id = obj.attr('id');
			obj.parent().append('<img style="width:130px;height:100%" src="/images/loadingAnimation.gif"/>');
			$.post('/includes/del-img.php',{id:id},function(){
				obj.parent().remove();
			});
		});
		
		$('.delete-vid').click(function(){
			var obj = $(this);
			var id = obj.attr('id');
			obj.parent().append('<img style="width:130px;height:100%" src="/images/loadingAnimation.gif"/>');
			$.post('/includes/del-vid.php',{id:id},function(){
				obj.parent().remove();
			});
		});
		
		$('.delete-doc').click(function(){
			var obj = $(this);
			var id = obj.attr('id');
			obj.parent().append('<img style="width:130px;height:100%" src="/images/loadingAnimation.gif"/>');
			$.post('/includes/del-fil.php',{id:id},function(){
				obj.parent().remove();
			});
		});
		
	});
</script>
 
<?include('footer.php');?>