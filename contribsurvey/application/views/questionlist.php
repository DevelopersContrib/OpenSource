<h3>Questionnaires</h3>
	<?if(sizeof($surveyquestions) > 0):?>
		<?$question_count = 1;
			foreach($surveyquestions AS $question):?>
				<p><a href="javascript:showQuestion('<?=$sid?>','<?=$question->questionid?>')"><?=$question_count++?> <?=$question->questiontext?></a></p>
			<?endforeach;?>
	<?else:?>
		<p>There are no questions in this survey.</p>
	<?endif;?>