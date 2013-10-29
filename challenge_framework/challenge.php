<?include('header.php');?>

<?php 
  $slug = $_GET['slug'];
  $challengeid = $dir->GetInfo('Challenges','ChallengeId', 'Slug', $slug);
  $category_id = $dir->GetInfo('Challenges','CategoryId', 'ChallengeId', $challengeid);
  $category = $dir->GetInfo('ChallengeCategory', 'CategoryName', 'ChallengeCategoryId', $category_id);
  $applications_count = $dir->GetTotal('Applications','ChallengeId',$challengeid);
  $photo = $dir->GetInfo('Challenges','Photo', 'ChallengeId', $challengeid);
  $owner_id = $dir->GetInfo('Challenges','CompanyId', 'ChallengeId', $challengeid);
  $challenge_title = $dir->GetInfo('Challenges','ChallengeTitle', 'ChallengeId', $challengeid);
  $challenge_desc = $dir->GetInfo('Challenges','ChallengeDesc', 'ChallengeId', $challengeid);
  $solved = $dir->GetInfo('Challenges','Solved', 'ChallengeId', $challengeid);
  $more_details = $dir->GetInfo('Challenges','MoreDetails', 'ChallengeId', $challengeid);
  $timeline = $dir->GetTimeLine($challengeid);
  $price_desc = $dir->GetInfo('Challenges','MoreDetails', 'ChallengeId', $challengeid);
  $prizes = $dir->GetPrizes($challengeid);
  $criteria = $dir->GetCriteria($challengeid);
  $enter = $dir->GetHowToEnter($challengeid);
  $sponsors = $dir->GetChallSponsorship($challengeid);
  
  $bg_color = $dir->GetInfo('Challenges','bg_color', 'ChallengeId', $challengeid);
  $desc_font_size = $dir->GetInfo('Challenges','font_size', 'ChallengeId', $challengeid);
  $desc_font_style = $dir->GetInfo('Challenges','font_style', 'ChallengeId', $challengeid);
  
  if($bg_color=='') $bg_color='#262727';
  if($desc_font_size=='') $desc_font_size='22';
  if($desc_font_style=='') $desc_font_style='arial';
  
  $owner_username = $dir->GetUserInfo('Username', $owner_id);
  $owner_photo = $dir->GetUserInfo('Photo', $owner_id);
  if($owner_photo=='') $owner_photo = $siteurl."/img/user.png";
  
  if ($solved=="1"){
	$challengewinner = $dir->GetChallengeWinner($challengeid);
  }
  
  /*get total sponsorships*/
  $total_sponsorship = 0;
  $sponsorship_query = MYSQL_QUERY("SELECT SUM(Amount) AS total_sponsorship FROM SponsorContact WHERE ChallengeId = '".$challengeid."'") OR DIE(MYSQL_ERROR);
  if($row = MYSQL_FETCH_ARRAY($sponsorship_query)){
	$total_sponsorship = $row['total_sponsorship'];
  }
  
  /*get days left*/
	$days_left = $dir->GetDaysLeft($challengeid);
											
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
							<h2><a href="#" class="post-title"><?php echo stripcslashes($challenge_title)?></a>
							<div class="pull-right">
									<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
										<a class="addthis_button_preferred_1"></a>
										<a class="addthis_button_preferred_2"></a>
										<a class="addthis_button_preferred_3"></a>
										<a class="addthis_button_preferred_4"></a>
										<a class="addthis_button_compact"></a>
										<a class="addthis_counter addthis_bubble_style"></a>
										</div>
										<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
										<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4fe9167f4e8be743"></script>
										<!-- AddThis Button END -->
									</div>
							</div>
						<div class="clearfix"></div>
						</h2>
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
										<h1 class="challenge_desc"><?=stripslashes($challenge_desc)?></h1>					
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
										<!-- AddThis Button BEGIN -->
									
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
											<h2>Challenge Details
												
												<div class="pull-right">
													<script type="text/javascript" src="http://www.contrib.com/widgets?ma=rating2"></script>
												</div>
							
											<div class="clearfix"></div>
											</h2>
											<?php echo stripslashes($challenge_desc)?>
										</div>
									</div><!--End Details-->
									<div class="row-fluid">
										<div class="wrap-post-main-content profile-row">
											<h2>More Details</h2>
											<?=nl2br(stripslashes($more_details))?>
										</div>
									</div><!--End More Details-->
									<div class="row-fluid">
										<div class="wrap-post-main-content profile-row">
											<h2 style="background-image: url('../img/prize_ico.gif');background-repeat: no-repeat;padding-left: 70px;height: 35px;padding: 20px 0 0 55px;">Prizes</h2>											
											<?php if (count($prizes)> 0):?>
												<?php for ($i=0;$i<count($prizes);$i++):?>
													<!--div class="jbox-price"--><?php echo $prizes[$i]['PrizeDescription']?><!--/div-->
												<?php endfor;?>
											<?php else: ?>
												<!--div class="jbox-price"-->Not yet attached.<!--/div-->
											<?php endif;?>
										  
										  <?if($total_sponsorship > 0):?>
											<!--div class="jbox-price"-->Total Prizes from sponsors: $ <?=$total_sponsorship?><!--/div-->
										  <?endif;?>											
										</div>
									</div><!--End Prizes-->
									<div class="row-fluid">
										<div class="wrap-post-main-content">
											<h2>Timeline</h2>
											<?php if (count($timeline)> 0):?>
											<ul class="inline" id="timeline">
												<li>
													<h6 class="timeline-ttle">Submission in Schedule</h6>
													<p class="timeline-p">From: <?php echo $timeline[0]['Submission_From']?></p>
													<p class="timeline-p">To: <?php echo $timeline[0]['Submission_To']?></p>
												</li>
												<li>
													<h6 class="timeline-ttle">Judging</h6>
													<p class="timeline-p">Start: <?php echo $timeline[0]['Judging_From']?></p>
													<p class="timeline-p">End: <?php echo $timeline[0]['Judging_To']?></p>
												</li>
												<li>
													<h6 class="timeline-ttle">Announcement of Winners</h6>
													<p class="timeline-p"><?php echo $timeline[0]['Winners_Announced']?></p>
													<br>
												</li>
											</ul>
											<?php endif;?>
										</div>
									</div><!--End Timeline-->
									<div class="row-fluid">
										<div class="wrap-post-main-content">
											<h2>Criteria for judging</h2>											
											<?php if (count($criteria)> 0):?>
												<?php for ($i=0;$i<count($criteria);$i++):?>
													<div class="jbox_info"><!--span class="rank"><?=$i+1?></span--><?php echo stripslashes($criteria[$i]['CriteriaDescription'])?></div>										
												<?php endfor;?>
										  <?php else: ?>
												<div class="jbox_info"><!--span class="rank">1</span-->There is no criteria set for this challenge.</div>
										  <?php endif;?>
										</div>
									</div><!--End Criteria-->
									<div class="row-fluid">
										<div class="wrap-post-main-content">
											<h2>How to Enter</h2>
											<?php if (count($enter)> 0):?>
												<?php for ($i=0;$i<count($enter);$i++):?>											
												 <div class="jbox_info"><!--span class="rank"><?=$i+1?></span--><?php echo stripslashes($enter[$i]['HowToDesc'])?></div>											
												<?php endfor;?>
											<?php else: ?>
												<div class="jbox_info"><!--span class="rank">1</span-->There are no guidelines yet.</div>
											<?php endif;?>
										</div>
									</div><!--End How to Enter-->
									<div class="row-fluid">
										<div class="wrap-post-main-content profile-row">
											<h2>Sponsors</h2>
											<div class="row-fluid">
												<table style="margin-right: 20px;width:30%;float: left;">
													<tbody><tr>
													<td>
														<a href="<?=$siteurl?>/user/<?=$owner_username?>" target="_blank">
															<img src="<?=$owner_photo?>" class="img-circle"style="width:40px;height:40px">
														</a>
													</td>
													<td style="vertical-align:top;">
														<table style="margin-top: 10px;">
															<tbody><tr><td><a href="" target="_blank"><b><?=$owner_username?></b></a></td></tr>
															<tr><td>Challenge Sponsor</td></tr>
														</tbody></table>
													</td>
													</tr>
													</tbody>
												</table>
										
												<?php if (count($sponsors)>0):?>
												   <?php for ($i=0;$i<count($sponsors);$i++):?>
														<?php 
															$s_photo = $dir->GetInfo('ChallengeMembers','Photo','Username', $sponsors[$i]['Username']);
															if($s_photo=='') $s_photo = $siteurl."/img/user.png";
														?>
														<table style="margin-right: 20px;width:30%;float: left;">
															<tbody>
															<tr>
															<td>
																<a href="<?=$siteurl?>/user/<?=$sponsors[$i]['Username']?>" target="_blank">
																	<img src="<?=$s_photo?>" class="img-circle"style="width:40px;height:40px">
																</a>
															</td>
															<td style="vertical-align:top;">
																<table style="margin-top: 10px;">
																	<tbody><tr><td><a href="" target="_blank"><b><?=$sponsors[$i]['Username']?></b></a></td></tr>
																	<tr><td>
																	<?php if ($sponsors[$i]['Type']=="1"):?>
																		 <?php echo "Monetary Sponsorship<br>Amount : $".$sponsors[$i]['Amount']?>
																		 <?php else:?>
																		 <?php echo "Another Sponsorship"?>
																	 <?php endif;?>
																	</td></tr>
																</tbody></table>
															</td>
															</tr>
															</tbody>
														</table>
												   <?php endfor;?>
												<?php endif;?>
											</div>
										</div>
									</div><!--End Sponsors-->
									
									<div class="row-fluid">
									<div class="wrap-post-main-content">
									
									
									</div>
									</div><!----End Disqus--->
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
							<? include('sidebar_challenge.php'); ?>
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