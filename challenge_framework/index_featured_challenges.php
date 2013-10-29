<div class="container-fluid featured-challenge-bckgrnd">

	<div class="row-fluid">

		<div class="container">

			<div class="row-fluid">

				<h2 class="section-title"><span>Featured Challenges</span></h2>

				<? $index_featured = $dir->GetFeaturedOpenChallenge($categoryid,'2',$sitename); ?>

					<?if(!$index_featured == ""):?>

						<?foreach($index_featured AS $feat_chall):?>

							<div class="row-fluid challenge-listing">

									<a href="/challenge/<?=$feat_chall['slug']?>">

										<div class="row-fluid">

											<div class="span12">

												<div class="span9 brdr-rgt-list">

													<div class="span12">

														<div class="span2">

															<div class="challenge-logo">

																<img style="width: 97%;height: 120px;" src="<?=$feat_chall['photo']?>"/>

															</div>

														</div>

														<div class="span10 challenge-ttle">

															<h2><?=stripslashes($feat_chall['title'])?></h2>

															<p class="posted-by"><?=$feat_chall['username']?></p>

															<p class="challenge-description"><?=stripslashes($feat_chall['desc'])?></p>

														</div>

													</div>

												</div>

												<div class="span3">

													<div class="row-fluid" style="margin-top: 10px;">

														<div class="pull-left">

															<img src="img/star.png"/>

														</div>

														<div class="pull-left">

															<span class="value">in kind</span>

															<span class="action">in prizes</span>

														</div>

													</div>

													<div class="row-fluid" style="margin-top: 25px;">

														<div class="pull-left">

															<img src="img/clock.png"/>

														</div>

														<div class="pull-left">

															<span class="value"><?=($feat_chall['remaining_time']<0)?'0 days':$feat_chall['remaining_time']?></span>

															<span class="action">to submit</span>

														</div>

													</div>

												</div>

											</div>

										</div>

									</a>

								</div>

						<?endforeach;?>

					<?endif;?>

		
				<div class="row-fluid" style="margin-bottom: 20px;">

					<div class="text-center">

						<a href="/browse.html" class="btn btn-primary btn-large">View more challenges</a>

					</div>

				</div><!--button-->

			</div>

		</div>

	</div>

</div><!--challenge list-->