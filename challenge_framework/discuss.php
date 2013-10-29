<?include('header.php');?>

<?php 
  $slug = $_GET['slug'];
  $challengeid = $dir->GetInfo('Challenges','ChallengeId', 'Slug', $slug);
  $category_id = $dir->GetInfo('Challenges','CategoryId', 'ChallengeId', $challengeid);
  $category = $dir->GetInfo('ChallengeCategory', 'CategoryName', 'ChallengeCategoryId', $category_id);
  $applications_count = $dir->GetTotal('Applications','ChallengeId',$challengeid);
  $photo = $dir->GetInfo('Challenges','Photo', 'ChallengeId', $challengeid);
  $challenge_title = stripslashes($dir->GetInfo('Challenges','ChallengeTitle', 'ChallengeId', $challengeid));
  $challenge_desc = stripslashes($dir->GetInfo('Challenges','ChallengeDesc', 'ChallengeId', $challengeid));
  $challenge_slug = $dir->GetInfo('Challenges','Slug', 'ChallengeId', $challengeid);
  $solved = $dir->GetInfo('Challenges','Solved', 'ChallengeId', $challengeid);
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
							<li class="inactive-tab">
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
							<li class="active-tab">
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
											<h2>Discuss <?php echo $challenge_title?></h2>
											
											<div id='fb-root'></div>
											<script src="http://connect.facebook.net/en_US/all.js#appId=166463816857095&amp;xfbml=1"></script>
											<fb:comments href="<?php echo $siteurl?>/challenge/<?php echo $slug?>" num_posts="10" width="690"></fb:comments>	
											
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
<?include('footer.php');?>