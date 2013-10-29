<?include('header.php');?>
<script type="text/javascript" src="/js/sponsor_edit.js"></script>
<?php 
  $slug = $_GET['slug'];
  $sponsor_id = $_GET['sponsor_id'];
  $challengeid = $dir->GetInfo('Challenges','ChallengeId', 'Slug', $slug);
  $category_id = $dir->GetInfo('Challenges','CategoryId', 'ChallengeId', $challengeid);
  $category = $dir->GetInfo('ChallengeCategory', 'CategoryName', 'ChallengeCategoryId', $category_id);
  $applications_count = $dir->GetTotal('Applications','ChallengeId',$challengeid);
  $photo = $dir->GetInfo('Challenges','Photo', 'ChallengeId', $challengeid);
  $challenge_title = $dir->GetInfo('Challenges','ChallengeTitle', 'ChallengeId', $challengeid);
  $challenge_desc = $dir->GetInfo('Challenges','ChallengeDesc', 'ChallengeId', $challengeid);
  $challenge_slug = $dir->GetInfo('Challenges','Slug', 'ChallengeId', $challengeid);
  $solved = $dir->GetInfo('Challenges','Solved', 'ChallengeId', $challengeid);
  $days_left = $dir->GetDaysLeft($challengeid);
  $bg_color = $dir->GetInfo('Challenges','bg_color', 'ChallengeId', $challengeid);
  $desc_font_size = $dir->GetInfo('Challenges','font_size', 'ChallengeId', $challengeid);
  $desc_font_style = $dir->GetInfo('Challenges','font_style', 'ChallengeId', $challengeid);
  
  if($bg_color=='') $bg_color='#262727';
  if($desc_font_size=='') $desc_font_size='22';
  if($desc_font_style=='') $desc_font_style='arial';
  
  
  $sponsor_name = $dir->GetInfo('SponsorContact','SponsorName', 'SponsorshipId', $sponsor_id);
  $sponsor_url = $dir->GetInfo('SponsorContact','SponsorUrl', 'SponsorshipId', $sponsor_id);
  $sponsor_image = $dir->GetInfo('SponsorContact','SponsorImage', 'SponsorshipId', $sponsor_id);
  $message = $dir->GetInfo('SponsorContact','Message', 'SponsorshipId', $sponsor_id);
  $sponsor_type = $dir->GetInfo('SponsorContact','SponsorshipType', 'SponsorshipId', $sponsor_id);
  $amount = $dir->GetInfo('SponsorContact','Amount', 'SponsorshipId', $sponsor_id);
  
  

  
  
if(!isset($_SESSION['userid'])){ ?>
	<script>window.location="/login.html";</script>	<?
}

if($challengeid==""){ ?>
	<script>window.location="/browse.html";</script>	<?
}

if($_SESSION['UserType'] == "1"){ ?>  
<script>window.location="/home.html";</script>
<?}

?>

<style>
/*SUBMISSION*/
.appli-box{margin-bottom:30px;line-height:20px}
.appli-box .in-name{width:96%}
.appli-box .in-desc{width:96%;height:100px}
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
						<div id="header" class="wrap-header-bckgrnd">
							<div class="header-header-module">
								<div>
									<div class="header-content">
										<h1 class="challenge_desc"><?php echo stripcslashes($challenge_desc)?></h1>
																			
										<?php if($solved=="1"):?>
											<div class="message-warning"><span class="warning-span"><i class="icon-warning-sign" style="background-color: #FFEEA0;"></i>This challenge is closed.</span></div>
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
											<h2>Edit Sponsorship</h2>
											<br clear="all"><br clear="all">
											<div class="message-error" style="display:none;color:red"><span>Error messages</span></div>
											<div class="message-success" style="display:none;color:green"><span>Successfull messages</span></div>
									    
											<form method="POST" enctype="multipart/form-data" id="sponsorform" action = "javascript:updateSponsorship()">
											    <div class="appli-box" >
													<h5>Sponsor Name * </h5>
													<input type="text" name="sponsor_name" id="sponsor_name" class="in-name" value="<?php echo $sponsor_name?>"/>
													<div class="message-error" id="error1" style="display:none;color:red"><span>Error messages</span></div>
												</div>
												
												<div class="appli-box" >
													<h5>Sponsor URL * </h5>
													<input type="text" name="sponsor_url" id="sponsor_url" class="in-name" value="<?php echo $sponsor_url?>"/>
													<div class="message-error" id="error2" style="display:none;color:red"><span>Error messages</span></div>
												</div>
											    
											    <div class="appli-box">
													<h5>Sponsor Image * </h5>
													<span>The first image is used for your entry in listing pages. Upload several and we'll make them into a gallery.
													They should be jpg, gif or png files no larger than 2mb.</span><br>
												
													<span class="btn btn-success fileinput-button">
														<i class="glyphicon glyphicon-plus"></i>
														<span>Select files...</span>
														<!-- The file input field used as target for the file upload widget -->
														<input id="fileupload" type="file" name="files[]" multiple>
													</span>
													<br>
													
													<!-- The container for the uploaded files -->
													<div id="files" class="files"></div>
													<br>
													<img src="<?php echo $sponsor_image?>" style="width:150px;height:150px" id="spic">										    	
												</div>
												
												<div class="appli-box">
													<h5>Sponsorship *</h5>
													<?php if ($sponsor_type == 1):?>
													
													<input type="radio" name="sponsorship" id="sponsorship" value="1"  checked/> Monetary Sponsorship <br>
													<input type="radio" name="sponsorship" id="sponsorship" value="2" /> Another Sponsorship
													  <?php else:?>
													<input type="radio" name="sponsorship" id="sponsorship" value="1"  /> Monetary Sponsorship <br>
													<input type="radio" name="sponsorship" id="sponsorship" value="2" checked/> Another Sponsorship
													<?php endif?>
												</div>
											
											
											
												<div id="type_1" <?php if ($sponsor_type == 2):?>style="display:none;<?php endif?>">
													<div class="appli-box" >
														<h5>Amount (in USD) * </h5>
														<input type="text" name="amount" id="amount" class="in-name" />
														<div class="message-error" id="error3" style="display:none;color:red"><span>Error messages</span></div>
													</div>
													<div class="appli-box" >
														<h5>Message * </h5>
														<textarea name="appli-desc" id="message_type1" class="in-desc"></textarea>
														<div class="message-error" id="error4" style="display:none;color:red"><span>Error messages</span></div>
													</div>												
												</div>
											
												<div id="type_2" <?php if ($sponsor_type == 1):?>style="display:none;<?php endif?>">
													<div class="appli-box" >
														<h5>Message * </h5>
														<textarea name="appli-desc" id="message_type2" class="in-desc"><?php echo stripcslashes($message)?></textarea>
														<div class="message-error" id="error5" style="display:none;color:red"><span>Error messages</span></div>
													</div>												
												</div>
											
												
												<input type="hidden" id="chall_id" name="chall_id" value="<?=$challengeid?>">
												<input type="hidden" id="slug" name="slug" value="<?=$slug?>">
												<input type="hidden" id="sponsor_id" name="sponsor_id" value="<?=$sponsor_id?>">
												<input type="hidden" id="siteurl" name="siteurl" value="<?=$siteurl?>">
												<button class="btn btn-small btn-warning" id="submit" >Update</button>
												<br>
												<span id="log-loading" style="color:red;display:none">
													<img src="<?php echo $siteurl?>/images/loading-red.gif">Checking...
												</span>
									        
											</form>
																			
										</div>
									</div><!--End-->
									
									
								</div>
							</div>
							<div class="span4">
								<div class="row-fluid">
									<h1 class="trtri">
										<?=$days_left;?> days to submit <br>
										<? if($dir->CheckIfGallery($challengeid) == true){ ?>
											<a href="<?php echo $site_url?>/challenge/applications/<?php echo $slug?>">(View all Challenge Submissions)</a>
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
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                jQuery('<p/>').text(file.name).appendTo('#files');
            });
			
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>
<?include('footer.php');?>