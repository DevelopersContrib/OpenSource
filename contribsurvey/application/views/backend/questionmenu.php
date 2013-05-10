
				<?if(sizeof($surveyquestions) > 0):?>
					<ul class="qstns">
						<li id="q-stat" class="" onclick="javascript:ShowReports();" >
							<img src="<?=base_url()?>images/statistics.png" style="margin: 0 5px -2px 0;width: 15px;">
							<a href="javascript:;" style="color: #666666;">Survey Statistics</a>
						</li>
						<li id="q-create" class="<?=$qid==''?'active':''?>" onclick="javascript:AddQuestion();">
							<img src="http://maps.simcoe.ca/TourismDataList/images/plusButton.gif" style="margin: 0 5px -2px 0;">
							<a href="javascript:;" style="color: #666666;">Add New Question</a>
						</li>
						<li style="padding: 5px 0;"><div style="border-bottom: solid 1px #b7ddf2;width:100%;"></div></li>
						<?$question_count = 0;
						foreach($surveyquestions AS $question):?>
							<?$question_count++;?>
							<li id="q-<?=$question->questionid?>" class="<?=$qid==$question->questionid?'active':''?>" onclick="javascript:showQuestion('<?=$sid?>','<?=$question->questionid?>')"><a id="question<?=$question->questionid?>" href="javascript:;" style="color: #666666;"><b><?=$question_count?>.</b> <?=$question->questiontext?></a></li>
						<?endforeach;?>
					</ul>
				<?else:?>
					<p>There are no questions in this survey.</p>
				<?endif;?>
