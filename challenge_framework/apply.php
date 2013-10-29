<?	
	include('header.php');
	
?>

<?php 
  $slug = $_GET['slug'];
  $challengeid = $dir->GetInfo('Challenges','ChallengeId', 'Slug', $slug);
  $category_id = $dir->GetInfo('Challenges','CategoryId', 'ChallengeId', $challengeid);
  $category = $dir->GetInfo('ChallengeCategory', 'CategoryName', 'ChallengeCategoryId', $category_id);
  $applications_count = $dir->GetTotal('Applications','ChallengeId',$challengeid);
  $photo = $dir->GetInfo('Challenges','Photo', 'ChallengeId', $challengeid);
  $challenge_title = $dir->GetInfo('Challenges','ChallengeTitle', 'ChallengeId', $challengeid);
  $challenge_desc = $dir->GetInfo('Challenges','ChallengeDesc', 'ChallengeId', $challengeid);
  $challenge_slug = $dir->GetInfo('Challenges','Slug', 'ChallengeId', $challengeid);
  $solved = $dir->GetInfo('Challenges','Solved', 'ChallengeId', $challengeid);
  $submit = false;
  
  $days_left = $dir->GetDaysLeft($challengeid);
  $bg_color = $dir->GetInfo('Challenges','bg_color', 'ChallengeId', $challengeid);
  $desc_font_size = $dir->GetInfo('Challenges','font_size', 'ChallengeId', $challengeid);
  $desc_font_style = $dir->GetInfo('Challenges','font_style', 'ChallengeId', $challengeid);
  
  if($bg_color=='') $bg_color='#262727';
  if($desc_font_size=='') $desc_font_size='22';
  if($desc_font_style=='') $desc_font_style='arial';

if(!isset($_SESSION['userid'])){ ?>
	<script>window.location="/login.html";</script>	<?
}

if($challengeid==""){ ?>
	<script>window.location="browse.html";</script>	<?
}

if($_POST['submit-button']=='send'){
	$submit = true;
	$c_slug = $slug;
	$name = mysql_escape_string($_POST['appli-name']);
	$desc = mysql_escape_string($_POST['appli-desc']);
	$image = $_POST['fbox'];
	$slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9\-]/', '-', $name),'\-'));
	
	
	if($dir->AppCheckSlugIfExists($slug)===true){
		$slug = $slug.'-app';
	}
	
	$challengeid = $_POST['chall_id'];
	$userid = $_POST['userid'];
	$vid_cnt = $_POST['appli-vid-cnt'];
	$vid = $_POST['appli-vid'];
	
	if($appid = $dir->ApplicationSave($name,$desc,$challengeid,$userid,$slug,$domain)){
		
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
		
		?>
			
		<?
	}
}
?>

<style>
/*SUBMISSION*/
.appli-box{margin-bottom:30px;line-height:20px}
.appli-box .in-name{width:100%}
.appli-box .in-desc{width:100%}
.appli-box #image-upload-gallery{padding: 10px 0 0 10px;background: #F6F6F6;overflow: hidden;border: 1px solid #CCC;margin-top: 10px;}
.appli-box #image-upload-gallery li{position: relative;float: left;margin: 0 13px 13px 0;line-height: 0;cursor: move;}
.appli-sidebar{width: 230px;float: right;border-left: 2px solid #CCC;padding-left: 10px;min-height: 690px;}

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

<div class="row-fluid colortheme-inverse">
	<div class="clearfix"></div>

	<div class="container">
		<div class="span12 padding-inner">
			<div class="row-fluid">
				<!--start of challenge header-->
				<div class="row-fluid">
					<a href="/browse.html"  class="brdcrmb-link-deco">Browse</a> 
					<b class="brdcrmb-meta-arrw">&raquo;</b> 
					<span class="brdcrmb-active"><a href="<?php echo $site_url?>/challenge/<?php echo $slug?>">Join the <?php echo stripcslashes($challenge_title)?>challenge</span>			
				</div><!--Breadcrumb--> 

				
				<!-- start challenge details-->
				<div class="row-fluid">
					<div class="row-fluid">
						<div class="wrap-header-post">
							<h2><a href="#" class="post-title"><?php echo stripcslashes($challenge_title)?></a></h2>
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
								<a class="tab-link" href="/challenge/applications/<?=$slug?>" target="_blank">
									<span class="tabs-text">
										View Submissions
									</span>
								</a>
							</li>
							<? } ?>
							
							<li class="inactive-tab">
								<a class="tab-link" href="/badges/<?=$slug?>" target="_blank">
									<span class="tabs-text">
										Badges
									</span>
								</a>
							</li>
							<li class="inactive-tab">
								<a class="tab-link" href="/discuss/<?=$slug?>" target="_blank">
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
													 <a href="<?=$siteurl?>/challenge/apply/<?php echo $slug?>"> <button class="btn btn-large btn-warning">Submit Application</button></a>
												<?php endif;?>
												
												<?php if ($solved!="1" && $_SESSION['UserType'] == '2' ):?>
													<a href="<?=$siteurl?>/challenge/sponsor/<?php echo $slug?>"> <button class="btn btn-large btn-warning">Sponsor This Challenge</button></a>
												<?php endif;?>
											<?php else: ?>
												<a href="<?=$siteurl?>/challenge/apply/<?php echo $slug?>"> <button class="btn btn-large btn-warning">Submit Application</button></a>
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
										<div class="wrap-post-main-content profile-row">
											<h2>Submit an Application</h2>
											
											<?php if ($submit):?>
											
											<div class="alert alert-success">
												<button type="button" class="close" data-dismiss="alert">&times;</button>
											  You successfully submitted application. Preview your application <a href="<?php echo $siteurl?>/application/<?php echo $slug?>">here</a>.<br>
											  Go back to <a href="<?php echo $siteurl?>/challenge/<?php echo $c_slug?>"><?php echo $challenge_title?></a><br>
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
											
											<script type="text/javascript" src="<?=$siteurl?>/js/submission.js"></script>
											<form method="POST" enctype="multipart/form-data" >
											<br>
												
												<div class="appli-box">
													<h5>Name *</h5>
													<span>Give a name to your application. This is required.</span><br>
													<input type="text" name="appli-name" id="appli-name" class="in-name" />
												</div>
												
												<div class="appli-box">
													<h5>Description * </h5>
													<span>Add a summary of your application. This will appear on the entry page. This is required.</span><br>
													<textarea name="appli-desc" id="appli-desc" class="in-desc"></textarea>
												</div>
												
												<h2>Media</h2>											
												<br>
												<div class="appli-box">
													<h5>Image * </h5>
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
												<div class="appli-box">
													<h5>Video</h5>
													<span>You can add one or more video links by providing the url of the video. This is not required but this may increase the validation of your application.</span><br>
													<span id="vid-add-box">Paste video url here:<textarea name="appli-vid[]" id="appli-vid-1" class="in-desc"></textarea></span>
													<button id="vid-more" style="float:right">+ Add more</button>
												</div>
												
												<div class="appli-box">
													<h5>File</h5>
													<span>This is not required but this may increase the validation of your application. Files should not be larger than 5mb.</span><br>
													<span id="file-add-box"><input type="file" name="appli-file[]" id="appli-file-1" size="45" /></span>
													<button id="file-more" style="float:right">+ Add more</button>
												</div>
												
												
												<h2>Agreement</h2>
												<br>
												<div class="appli-box">
													Note: Please thoroughly check all the fields. Once it is submitted, you can not modify the data.<br>
													<input type="checkbox" name="accept"> I have read and understand the above condition.	
												</div>
												<input type="hidden" id="chall_id" name="chall_id" value="<?=$challengeid?>">
												<input type="hidden" id="userid" name="userid" value="<?=$_SESSION['userid']?>">
												<input type="hidden" id="appli-vid-cnt" name="appli-vid-cnt" value="1" />
												<input type="hidden" id="appli-file-cnt" name="appli-file-cnt" value="1" />
												<button name="submit-button" id="submit" value="send" class="btn btn-primary">Submit Application</button>
											</form>
											
											<?php endif?>
											
										</div>
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
											<br><a href="<?php echo $site_url?>/challenge/applications/<?php echo $slug?>">(View all Challenge Submissions)</a>
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
</script>

<?include('footer.php');?>