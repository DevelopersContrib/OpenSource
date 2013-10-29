<?php 
$chs = $dir->GetLatestChallenge($categoryid,3,$sitename);
?>
<div class="page-header">
	<h3 class="dashboard-header-ttle">Latest Challenges</h3>
</div>
								<div class="row-fluid">
									<div class="span12">
										<div class="row-fluid">
											<?php if (count($chs)>0):?>
											   <?php foreach ($chs as $key=>$val):?>
											   	
	<div class="row-fluid application-listing">
			<div class="wrap-listing">
				<div class="row-fluid">
					<div class="span12">
						<div class="span4">
							<img id="content" name="#content-target" src="<?php echo $val['photo']?>"  style="height: 100px;">
						</div><!--End of app image-->
						<div class="span8 application-ttle ">
							<div class="row-fluid">
								<a class="sub-app-link" href="<?=$siteurl?>/challenge/<?php echo $val['slug']?>" target="_blank" ><b><?php echo $val['title']?></b></a>
							</div>
							<div class="row-fluid">
								<!--<a class="sub-app-by" target="_blank" href="#"><p>Submitted for: Name of submitted application</p></a>-->
								<a class="sub-app-by" target="_blank"><p><?=$val['postedby']?></p></a>
								
							</div>
							<div class="row-fluid">
							
								<p><?
								$limit = 200;
																			
																			
									if(strlen($val['desc']) > $limit){	
									$val['desc'] = substr($val['desc'], 0, strrpos(substr($val['desc'], 0, $limit),' ')).'...';
									}
									
									echo $val['desc'];
								
								?></p>
							</div>
						</div><!--End of app content-->
					</div>
				</div>
			</div>
		</div><!--End of row-fluid app style-->
											   <?php endforeach;?>
											<?php endif?>
										</div>
									</div><!--Image container-->
</div>