<li id="createNew" class="active" style="margin-bottom: 12px;"><img src="/survey/images/icons/database_form_(add)_16x16.gif" width="15" height="15" >Create New Survey</li>
				<?foreach($surveylist AS $survey):?>
					<li id="<?=$survey->sid?>"><img src="/survey/images/icons/database_form_16x16.gif" width="15" height="15" ><?=$survey->title?></li>
				<?endforeach;?>	