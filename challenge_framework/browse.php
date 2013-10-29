<?include('header.php');?>
<script>
$(document).ready(function () {
	
	$('#btnsearch').click(function(){
		$('#searchform').submit();
	});

	$('#filter').change(function(){
		var f = $(this).val();
		switch (f){
			case 'challenge':
				window.location.href = "<?php echo $siteurl?>/browse.html";
			break;
			case 'submission':
				window.location.href = "<?php echo $siteurl?>/latestapplications.html";
			break;		 
		}
	});
	
});
</script>
<style>

	.done_challenge_icon{

		position: relative; z-index: 500; bottom: 0; float: right; margin-top: -16px;}

</style>
<div class="container-fliud wrap-ttle-blue">
	<div class="row-fluid">

  	<div class="container">
      
		<div class="page-header">
		<h1><?=$dir->GetTableInfo('ChallengeCategory','CategoryName','ChallengeCategoryId',$categoryid);?> Related Challenges</h1>
		</div>
    

								<? 
								 if (isset($_POST['searchkey'])){
								 	$browsearray = $dir->BrowseChallenges($categoryid,mysql_escape_string($_POST['searchkey']),$sitename);
								 }else {
								    $browsearray = $dir->BrowseChallenges($categoryid,null,$sitename);
								 } 
								
								?>
							
								<div class="row-fluid">
								    <div class="input-append">
								       <form action="" id="searchform" method="Post">
								        <input type="text" id="appendedInputButton" class="input-xxlarge pull-left" name="searchkey">
								        <button type="button" class="btn" id="btnsearch">Go!</button>
								       </form> 
								    </div>
									<select class="pull-right" id="filter">
									        <option value="challenge">Latest Challenges</option>
											<option value="submission">Latest Submissions</option>
									</select>
								</div>
								<br>
    </div>
	</div>
</div><!--blue section-->
<div class="container">

	<div class="row-fluid">

		<div class="span12 bckgrnd-pages">
		
			<div class="row-fluid">

				<div class="row-fluid" style="margin-bottom: 5px;">

					<a href="<?php echo $site_url?>/home.html" class="brdcrmb-link-deco">Home</a> 

					<b class="brdcrmb-meta-arrw">&raquo;</b> 

					<span class="brdcrmb-active">Category Related Challenges</span>

				</div><!--Breadcrumb-->

				<div class="row-fluid">

				
								<div class="row-fluid">

									<div class="span12">

										<div class="row-fluid">

											
											
											</div>

										<? for($i=0; $i < sizeof($browsearray) ; $i++){ ?>

											
 
											<? $__photo = $browsearray[$i]['Photo']; ?>

											<? $__title = $browsearray[$i]['ChallengeTitle']; ?>

											<? $__slug  = $browsearray[$i]['Slug']; ?>

											<? $__by  = $browsearray[$i]['postedby']; ?>

											<? $__closed = $browsearray[$i]['Solved']; ?>
											
											
											<?
											if (preg_match("/-/",$browsearray[$i]['Days']) || $browsearray[$i]['Days']=="") {
											  $days  = "0";
											} else { 
											  $days =  $browsearray[$i]['Days'];
											}
											?>

						
						<div class="row-fluid challenge-listing">
							<a href="<?=$siteurl?>/challenge/<?=$__slug?>" target="_blank">
								<div class="row-fluid">
									<div class="span12">
										<div class="span9 brdr-rgt-list">
											<div class="span12">
												<div class="span2">
													<div class="challenge-logo">
														<img style="width: 97%;height: 120px;" src="<?=$__photo;?>"/>
													</div>
												</div><!--span2-->
												<div class="span10 challenge-ttle">
													<h2><?=$__title;?></h2>
													<p class="posted-by"><?=$__by?></p>
													<p class="challenge-description"><?php echo stripcslashes($browsearray[$i]['Description']);?></p>
													<div class="row-fluid">
														<? if($__closed == "1"): ?>
														<div class="pull-left wrap-ribbon-solved">
															<div class="wrap-text-solved">
																<p class="p-solved">Solved!</p>
															</div>
															<img src="img/stat-graph-gold-1.png">
														</div>
														<div class="clearfix"></div>
													<? endif; ?>
													</div>
												</div><!--span10-->
											</div>
										</div><!--span9-->
										<div class="span3">
											<div class="row-fluid" style="margin-top: 10px;">
												<div class="pull-left">
													<img src="img/star.png"/>
												</div>
												<div class="pull-left">
													<span class="value">in kind</span>
													<span class="action">in prizes</span>
												</div>
											</div><!--End star-->
											<div class="row-fluid" style="margin-top: 25px;">
												<div class="pull-left">
													<img src="img/clock.png"/>
												</div>
												<div class="pull-left">
													<span class="value">
														<?if($__closed == "1"){ 
															echo '0 days';
														}else{
															echo($days<0)?'0 days':$days.' days'; 															
														}?>
													</span>
													<span class="action">to submit</span>
												</div>
											</div><!--End Clock-->
										</div><!--span3-->
									</div>
								</div>
							</a>
						</div><!--End of static challenges-->
											

												

										<?} ?>

										</div>

									</div><!--Image container-->

								</div>

					

				</div>

			</div>
			
		</div>

	</div>

</div>



<?include('footer.php');?>

