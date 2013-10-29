<script>
$(document).ready(function(){
	$(".deleteSponsor").click(function() {
		   var id = jQuery(this).attr('id');
		   var div = jQuery(this).parents('.application-listing');
		   var sponsor_id = id.replace('s_','');

		   if (confirm("Are you sure?")===true)
		     {
			   $.post("<?echo $siteurl?>/sponsordelete.php",
						{
						 sponsor_id:sponsor_id
						},
						function(data){
						 		div.fadeOut();  
						   	}
						);   
		     }
		   
	});
});
</script>

<style>
	.done_challenge_icon{
		position: relative; z-index: 500; bottom: 0;}
</style>

						<? $sponsorshiparray = $dir->GetMySponsorship($_SESSION['ChallengeMemberId'],$categoryid,$sitename); ?>

						<div class="row-fluid">
							
							<? if($sponsorshiparray == 0){ ?>
							
								<div class="page-header">		
  								<h3 class="dashboard-header-ttle">My Sponsorships </h3>
								</div>
								<p>You have not sponsored a challenge yet.</p>
								
								<img src="http://d2qcctj8epnr7y.cloudfront.net/images/2013/desc-sponsor-challenge2.png"/>
							
							<? }else{ ?>
							
								<div class="page-header">		
  								<h3 class="dashboard-header-ttle">My Sponsorships <span class="badge badge-warning" style="vertical-align: middle;"><?=sizeof($sponsorshiparray)?></span></h3>
								</div>
								<div class="row-fluid">
									<div class="span12">
										<div class="row-fluid">
											
										<? for($i=0; $i < sizeof($sponsorshiparray) ; $i++){
											if($sponsorshiparray[$i]['SponsorshipType'] == '1'){ $type = "Monetary $".$sponsorshiparray[$i]['Amount']; }
											if($sponsorshiparray[$i]['SponsorshipType'] == '2'){ $type = "Miscellaneous"; } ?>
											
											<? $__photo = $dir->GetTableInfo('Challenges','Photo','ChallengeId',$sponsorshiparray[$i]['ChallengeId']); ?>
											<? $__title = $dir->GetTableInfo('Challenges','ChallengeTitle','ChallengeId',$sponsorshiparray[$i]['ChallengeId']); ?>
											<? $__slug  = $dir->GetTableInfo('Challenges','Slug','ChallengeId',$sponsorshiparray[$i]['ChallengeId']); ?>
											<? $__closed  = $dir->GetTableInfo('Challenges','Solved','ChallengeId',$sponsorshiparray[$i]['ChallengeId']); ?>

		<div class="row-fluid application-listing">
			<div class="wrap-listing">
				<div class="row-fluid">
					<div class="span12">
						<div class="span4">
							<img id="content" name="#content-target" src="<?=$__photo;?>" style="height: 100px;">
						</div><!--End of my app image-->
						<div class="span8 application-ttle ">
							<div class="row-fluid">
								<a href="<?=$siteurl?>/challenge/<?=$__slug?>" target="_blank" class="sub-app-link"><b><?=$__title;?></b></a> 
							</div>
							<div class="row-fluid">
								<p class="entryp">Sponsor Name:&nbsp;<?php echo $sponsorshiparray[$i]['SponsorName']?> | Type: &nbsp;<?=$type?> <?echo $__closed == '1' ? '<img class="done_challenge_icon" src="http://d2qcctj8epnr7y.cloudfront.net/sheina/wellnesschallenge/trophy_gold_icon.png" alt="closed"/>':''?></p>
							</div>
							
							<div class="row-fluid">
							   <a href="<?php echo $siteurl?>/sponsor/edit/<?php echo $__slug?>/<?php echo $sponsorshiparray[$i]['SponsorshipId']?>"> <button class="btn btn-large btn-warning">Edit</button></a>&nbsp;
							   <button class="btn btn-danger deleteSponsor btn-large" type="button" id="s_<?php echo $sponsorshiparray[$i]['SponsorshipId']?>">Delete</button>
							</div>
						</div><!--End of my app content-->
					</div>
				</div>
			</div>
		</div><!--End of row-fluid my application-->
											
											
												
										<?} ?>
										</div>
									</div><!--Image container-->
								</div>
							<? } ?>
							
						</div>
						<br>
						<? include ($_SERVER['DOCUMENT_ROOT']).'/modules/home-latest-challenges.php'; ?>
					