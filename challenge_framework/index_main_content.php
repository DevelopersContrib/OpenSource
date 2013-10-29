<div class="container-fluid">
	<div class="row-fluid">
		<div class="container">
			<div class="row-fluid">
				<div class="span12">
					<div class="span4">
						<div class="row-fluid">
							<div id="third-sec">
								<h2 class="text-center">
									<img src="img/icon-home-how.png"/>
									<span>How it works</span>	
								</h2>
							</div>
							<div class="clearfix"></div>
							<div class="wrap-box-feature" style="padding: 10px;">
								<p class="text-center">
									<a class="brwse-challenge" href="/browse.html">Browse and Join Great Challenges!</a>
								</p>
							</div>
						</div>
					</div><!--End 1-->
					<div class="span4">
						<div class="row-fluid">
							<div id="third-sec">
								<h2 class="text-center">
									<img src="img/icon-home-stat.png"/>
									<span>Site Stats</span>	
								</h2>
							</div>
							<div class="clearfix"></div>
							<div class="wrap-box-feature" style="padding:10px;">
								<div class="row-fluid">
									<div class="span12">
										<div class="span6 text-center">
											<p><a style="font-size: 25px; font-weight: bold;" class="text-warning"><?=number_format($dir->GetTotalMembersCount());?></a></p>
											<span class="badge badge-info" style="font-size: 12px;text-transform: capitalize;font-weight: bold;">Challengers &amp; Sponsors</span>
										</div>
										<div class="span6 text-center">
											<p><a style="font-size: 25px; font-weight: bold;" class="text-info"><?=number_format($dir->GetTotalChallengeCount() * 15);?></a></p>
											<span class="badge badge-warning" style="font-size: 12px;text-transform: capitalize;font-weight: bold;">Challenge Total Posts</span>
										</div>
									</div>
								</div>
								<div class="row-fluid text-center" style="margin-top: 5px;">
									<span class="muted">TOTAL SPONSORSHIP</span>
									<p><a style="font-size: 25px; font-weight: bold;" class="text-error">$<?=number_format($dir->GetTotalSponsorAmount());?></a></p>
								</div>
							</div>
						</div>
					</div><!--end 2-->
					<div class="span4">
						<div class="row-fluid">
							<div id="third-sec">
								<h2 class="text-center">
									<img src="img/icon-home-employer.png"/>
									<span>Feature Challenge</span>	
								</h2>
							</div>
							<div class="clearfix"></div>
							<div class="wrap-box-feature" style="padding: 10px;">
								<? $featuredChallenge = $dir->GetFeaturedChallenge($categoryid); ?>
								<div class="pull-left">
									<p style="font-weight: bold;"><i><?=ucwords($featuredChallenge['title'])?></i></p>
									<p style="font-weight: normal;text-transform: "><i>"<?=$featuredChallenge['desc']?>" </i></p>
								</div>
								<div class="clearfix"></div>
								<div style="float:right;width: 190px;">
									<p style="line-height: 20px;margin: 0!important;"><i>Posted by : </i></p>
									<a style="line-height: 20px;font-size:15px;letter-spacing: normal;"><b><?=ucwords($featuredChallenge['username'])?></b></a><br/>
									<span style="line-height: 20px;font-size:15px;letter-spacing: normal;"><b><?=$featuredChallenge['country']?></b></span>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div><!--end 3-->
				</div>
			</div>
		</div>
	</div>
</div><!--3 box-->