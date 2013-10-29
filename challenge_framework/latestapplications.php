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
		<h1>Latest Applications</h1>
		</div>
    

									<? 
								 if (isset($_POST['searchkey'])){
								 	$latestAPParray = $dir->GetLatestApplications($categoryid,9,mysql_escape_string($_POST['searchkey']),$sitename);
								 }else {
								    $latestAPParray = $dir->GetLatestApplications($categoryid,9,null,$sitename);
								 } ?>
							
								<div class="row-fluid">
								    <div class="input-append">
								       <form action="" id="searchform" method="Post">
								        <input type="text" id="appendedInputButton" class="input-xxlarge pull-left" name="searchkey">
								        <button type="button" class="btn" id="btnsearch">Go!</button>
								       </form> 
								    </div>
									<select class="pull-right" id="filter">
									        <option value="submission">Latest Submissions</option>
									        <option value="challenge">Latest Challenges</option>
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

					<span class="brdcrmb-active">Latest Applications</span>

				</div><!--Breadcrumb-->

				<div class="row-fluid">

				
								<div class="row-fluid">

									<div class="span12">

										<div class="row-fluid">

											
											
											</div>

										
										   <? for($i=0; $i < sizeof($latestAPParray) ; $i++){ ?>
											
											<? $__photo = $latestAPParray[$i]['Photo']; ?>
											<? $__title = $latestAPParray[$i]['AppName']; ?>
											<? $__slug  = $latestAPParray[$i]['Slug']; ?>
											<? $__by  = $latestAPParray[$i]['postedby']; ?>
											<? $__chaID  = $latestAPParray[$i]['ChallengeId']; ?>
										
                                          <?php 
                                            if ($latestAPParray[$i]['Days'] == 0){
                                              $days = "this day";	
                                            }else {
                                              $days = $latestAPParray[$i]['Days']." days ago";
                                            }
                                          ?>

						
							<div class="row-fluid challenge-listing">
							<a href="<?=$siteurl?>/application/<?=$__slug?>" target="_blank">
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
													<p class="challenge-description"><?php echo stripcslashes($latestAPParray[$i]['Description']);?></p>
												</div><!--span10-->
											</div>
										</div><!--span9-->
										<div class="span3">
											<div class="row-fluid" style="margin-top: 10px;">
												<div class="pull-left">
													<img src="img/star.png"/>
												</div>
												<div class="pull-left">
													<span class="value">challenge</span>
													<span class="action"><?php echo $latestAPParray[$i]['C_Title']?></span>
												</div>
											</div><!--End star-->
											<div class="row-fluid" style="margin-top: 25px;">
												<div class="pull-left">
													<img src="img/clock.png"/>
												</div>
												<div class="pull-left">
													<span class="value"><?php echo $days;?></span>
													<span class="action">uploaded</span>
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

<?include('footer.php');?>

