<?include('header.php');?>

<?php 
  $slug = $_GET['slug'];
  $appid = $dir->GetInfo('Applications','AppId', 'Slug', $slug);
  $app_name = stripslashes($dir->GetInfo('Applications','AppName', 'AppId', $appid));
  $app_desc = stripslashes($dir->GetInfo('Applications','AppDesc', 'AppId', $appid));
  $app_image = $dir->GetInfo('AppImages','ImagePath', 'AppId', $appid);
  $galls = $dir->GetGallery($appid);
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
  $app_files = $dir->GetAppFiles($appid);
  $app_videos = $dir->GetAppVideos($appid);
  $app_date = $dir->reformatdate($dir->GetInfo('Applications','AppDatePosted', 'AppId', $appid));
  $ifappwinner = $dir->CheckExist('Applications','AppId',$appid,'AppWinner','1');
  
  $days_left = $dir->GetDaysLeft($challengeid);
  $bg_color = $dir->GetInfo('Challenges','bg_color', 'ChallengeId', $challengeid);
  $desc_font_size = $dir->GetInfo('Challenges','font_size', 'ChallengeId', $challengeid);
  $desc_font_style = $dir->GetInfo('Challenges','font_style', 'ChallengeId', $challengeid);
  
  if($bg_color=='') $bg_color='#262727';
  if($desc_font_size=='') $desc_font_size='22';
  if($desc_font_style=='') $desc_font_style='arial';
  
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
							<li class="inactive-tab">
								<a class="tab-link" href="/home.html" target="_blank">
									<span class="tabs-text">
										<i class="icon-home icon-white"></i>
									</span>
								</a>
							</li>
							
							<? if($dir->CheckIfGallery($challengeid) == true){ ?>
							<li class="active-tab">
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
										<div class="wrap-post-main-content profile-row">
											<h2>Submission <i class="icon-chevron-right"></i> <?php echo ucwords($app_name)?>
											
											<div class="pull-right">
													<script type="text/javascript" src="http://www.contrib.com/widgets?ma=rating2"></script>
												</div>
							
											<div class="clearfix"></div>
							
											</h2>
											
											<div class="row-fluid" style="margin: 10px 0 10px;">											
												<p>Submitted by: <a href="<?php echo $site_url?>/user/<?php echo $submitted_by?>"><?php echo $submitted_by?></a> 
												&mdash; <?=$app_date?> &nbsp; <?php if ($ifappwinner===true){ echo ' <img src="'.$siteurl.'/img/winner.png" style="height: auto;width: auto;border: none;"> <span style="color: orange;"><b> Challenge Winner!</b></span>'; }?>
												</p>											
											</div>
										
										   <div class="row-fluid">
                       
											<h5>Images</h5>
												<?php if (count($galls)>0):?>
												   <?php for ($i=0;$i<count($galls);$i++):?>									      
														<a href="<?php echo $galls[$i]['ImagePath']?>" title="" class="thickbox">
														<img class="img-rounded" style="width:200px;height:200px;" src="<?php echo $galls[$i]['ImagePath']?>">
														</a>
												   <?php endfor;?>
												<?php endif;?>
											</div>
										  <?php if (count($app_videos )>0):?>
											<div class="row-fluid" style="margin: 0 0 20px 0;">
													<h5>Video :</h5>
												<div class="well">
													<ol style="-webkit-padding-start: 20px;">
														<?php for ($i=0;$i<count($app_videos);$i++):?>
														<li><a href="<?=$app_videos[$i]['Url']?>"><?=$app_videos[$i]['Url']?></a></li>
														<?php endfor;?>
													</ol>
												</div>
											</div>
											<?php endif;?>
																	
											<div class="row-fluid" style="margin: 20px 0 20px;">
                      <h5>Details</h5>
                      <div class="well">
                      <p style="font-size: 14px"><?php echo stripslashes($app_desc)?></p>
                      </div>  
											</div>
										
											<?php if (count($app_files )>0):?>
												<div class="row-fluid" style="margin: 0 0 20px 0;">
                        	<h5>Supporting Files :</h5>
                          <div class="well">
													<ol style="-webkit-padding-start: 20px;">
														<?php for ($i=0;$i<count($app_files);$i++):?>
														<li><a href="<?=$app_files[$i]['FilePath']?>">Document <?=$i+1?></a></li>
														<?php endfor;?>
													</ol>
                          </div>
												</div>
											<?php endif;?>
											
											
											<div class="row-fluid">
									<div class="wrap-post-main-content">
									<h2>Leave a comment</h2>	
											<div id='fb-root'></div>
                                           <script src="http://connect.facebook.net/en_US/all.js#appId=166463816857095&amp;xfbml=1"></script>
                                          <fb:comments href="<?php echo $siteurl?>/application/<?php echo $slug?>" num_posts="10" width="500"></fb:comments>
											</div>
										</div>	
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
 
<?include('footer.php');?>