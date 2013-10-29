<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
	$(document).ready(function (){ 
	$('[rel=tooltip]').tooltip();
	});
</script>
						<div class="row-fluid">
						</div>
						<div class="post-right-content">
							<div class="row-fluid">
								<div class="wrap-post-right-content">
									<a class="browse" href="<?=$siteurl?>/browse.html">
										<h2>Browse</h2>
										<p>Find and support challenges which interests you the most. </p>
									</a>
								</div>
							</div><!--End Browse-->
							<div class="row-fluid">
								<div class="wrap-post-right-content">
									<h2>Latest Challengers</h2>
									<ul class="inline" id="latest-challnger">
										
											<? $latestusers = $dir->GetLatestUsers();?>
											<? for($i=0; $i < sizeof($latestusers) ; $i++){?>
											<li>
											<div class="profile-row">
											<a href="<?=$siteurl?>/user/<?=$latestusers[$i]['Username']?>" target="_blank" rel="tooltip" title="<?=$latestusers[$i]['Username']?>" style="display: inline-block;">
												<img src="<?=$latestusers[$i]['Photo']?>"/>
											</a>
											</div>
											</li>
											<? } ?>
											
									</ul>
								</div>
							</div><!--End Challenger-->
							<div class="row-fluid">
								<div class="wrap-post-right-content">
									<h2>Sponsors</h2>
									<div class="row-fluid text-center">
									
										<!--<img src="http://d2qcctj8epnr7y.cloudfront.net/images/marvinpogi/banner-250x250-globalventures1.png"/>-->
										
										
										<iframe id='aeb5b817' name='aeb5b817' src='http://adring.ecorp.com/www/delivery/afr.php?zoneid=1&amp;target=_blank&amp;cb=INSERT_RANDOM_NUMBER_HERE' frameborder='0' scrolling='no' width='250' height='250' allowtransparency='true'><script type='text/javascript'>
						<!--// <![CDATA[
						   document.write ("<nolayer>");
						   document.write ("<a href='http://adring.ecorp.com/www/delivery/ck.php?n=a5718b60&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://adring.ecorp.com/www/delivery/avw.php?zoneid=1&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a5718b60' border='0' alt='' /></a>");
						   document.write ("</nolayer>");
						   document.write ("<ilayer id='layeraeb5b817' visibility='hidden' width='250' height='250'></ilayer>");
						// ]]> -->
						</script><noscript>
						  <a href='http://adring.ecorp.com/www/delivery/ck.php?n=aeb5b817' target='_blank'>
						  <img src='http://adring.ecorp.com/www/delivery/avw.php?zoneid=1&target=_blank&cb=INSERT_RANDOM_NUMBER_HERE' border='0' alt='' /></a></noscript></iframe>


						<!-- Placement Comment -->
						<layer src='http://adring.ecorp.com/www/delivery/afr.php?n=aeb5b817&zoneid=1&target=_blank&cb=INSERT_RANDOM_NUMBER_HERE&rewrite=0' width='250' height='250' visibility='hidden' onload="moveToAbsolute(layeraeb5b817.pageX,layeraeb5b817.pageY);clip.width=250;clip.height=250;visibility='show';"></layer>
                                    </div>   
								
									  	<?php 
								      $sponsors = $dir->GetSponsorByChallenge($challengeid);
									  if (count($sponsors)>0):
									  
									?>
									<div class="row-fluid text-center" style="padding-top:10px;">
										<?php for ($i=0;$i<count($sponsors);$i++):?>
										
										 
										    <a href="<?php echo $sponsors[$i]['url']?>" target="_blank"><img src="<?php echo $sponsors[$i]['image']?>"></a>
										    
										<?php endfor;?>
										</div>
										<?php endif?>
										
										
									
								</div>
							</div><!--End Sponsors-->
						</div>			