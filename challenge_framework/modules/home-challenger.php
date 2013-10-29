<? $applications_array = $dir->GetMyApplications($_SESSION['ChallengeMemberId'],$categoryid,$sitename);?>						
<div class="row-fluid">														
  <? if($applications_array == 0){ ?>													
  <div class="page-header">		
  <h3 class="dashboard-header-ttle">My Applications </h3>							
  </div>
  <p>You have not applied to any challenges yet.
  </p>														
  <? }else{ ?>
  														
  	<div class="page-header">
		<h3 class="dashboard-header-ttle">My Applications 
    <span class="badge badge-warning" style="vertical-align: middle;"><?=sizeof($applications_array)?></span></h3>
	</div>
	
				
  <div class="row-fluid">									
    <div class="span12">										
      <div class="row-fluid">																					
        <? for($i=0; $i < sizeof($applications_array) ; $i++){ ?>																						
        <? $__photo = $dir->GetTableInfo('AppImages','ImagePath','AppId',$applications_array[$i]['AppId']); ?>											
        <? $__title = $applications_array[$i]['AppName']; ?>
		<? $__description = $applications_array[$i]['AppDesc'];?>											
		<? $__chall_solved = $applications_array[$i]['ChallengeSolved'];?>											
		<? $__winner = $applications_array[$i]['AppWinner'];?>											
        <? $__slug  = $dir->GetTableInfo('Applications','Slug','AppId',$applications_array[$i]['AppId']); ?>											
        <? $__byID  = $dir->GetTableInfo('Applications','ChallengeMemberId','AppId',$applications_array[$i]['AppId']); ?>											
        <? $__by  = $dir->GetUserInfo('Username',$__byID); ?>																						
		<div class="row-fluid application-listing">
			<div class="wrap-listing">
				<div class="row-fluid">
					<div class="span12">
						<div class="span4">
							<img id="content" name="#content-target" src="<?=$__photo;?>" style="height: 100px;">
						</div><!--End of my app image-->
						<div class="span8 application-ttle ">
							<div class="row-fluid">
								<a href="<?=$siteurl?>/application/<?=$__slug?>" target="_blank" class="sub-app-link"><b><?=$__title;?></b></a>
							</div>
							<div class="row-fluid">
								<!--<a class="sub-app-by" target="_blank" href="#"><p>Submitted for: Name of submitted application</p></a>-->
							</div>
							<div class="row-fluid">
								<p><? $limit = 200;											
								if(strlen($__description) > $limit){
									$__description = substr($__description, 0, strrpos(substr($__description, 0, $limit),' ')).'...';
								}
									echo stripslashes($__description); ?></p>
							</div>
							<?if($__chall_solved==0){?>
								<div class="row-fluid">
								   <a href="<?php echo $siteurl?>/application/edit/<?php echo $__slug?>"> <button class="btn btn-small btn-warning">Edit Application</button></a>
								</div>
							<?}else if($__winner==1){?>
								<img src="http://photochallenge.com/img/winner.png" style="height: auto;width: auto;border: none;">
								<span style="color: orange;"><b> Challenge Winner!</b></span>
							<?}else{?>
								<span style="color: green;">* This application is already closed. A challenge winner has been selected. *</span>
							<?}?>
						</div><!--End of my app content-->
					</div>
				</div>
			</div>
		</div><!--End of row-fluid my application-->
		
		
        <?} ?>										
      </div>									
    </div>
    <!--Image container-->								
  </div>							
  <? } ?>													
</div>					
<br>
						<? include ($_SERVER['DOCUMENT_ROOT']).'/modules/home-latest-challenges.php'; ?>