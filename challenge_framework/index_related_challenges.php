<?if(sizeof($related_sites_list) > 0):?>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="container">
			<div class="row-fluid">
				<h2 class="section-title"><span class="t2">Powering challenges by</span></h2>
				<div class="span12">
					<?foreach($related_sites_list AS $related):?>
						<div class="span3">
							<div class="row-fluid">
								<a href="http://<?=$related['name']?>" target="_blank">
									<img style="width:250px" class="logo-photochallenge" src="<?=$related['logo']?>" alt="<?=$related['name']?>">
								</a>
							</div>
						</div>
					<?endforeach;?>
					
				</div>
			</div>
		</div>
	</div>
</div><!--top challenges sites-->
<?endif;?>