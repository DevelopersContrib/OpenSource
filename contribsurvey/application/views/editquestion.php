<?foreach($surveyquestions AS $question):?>
	<?if($question->questionid == $qid):?>
		<?
			$choices = "";
			if(sizeof($question->options) > 0 && ($question->type == "single" || $question->type == "multi" || $question->type == "dropdown")):
							foreach($question->options AS $option):
									$choices = $choices."\n".$option;
							endforeach;						
			endif;
		?>
	
		<div id="survey">	
			<form action="javascript:updateQuestion();">
			<label>Title
			<span class="small">Question Text</span>
			</label>
			<input type="text" name="title" id="title" value="<?=$question->questiontext?>" />
			
			<div class="spacer"></div>
			
			<label>This question is
			<span class="small">Optional or Required</span>
			</label>
			<select name="validation" id="validation">
						<option value="optional" <?if($question->validation == "optional") echo "selected='selected'";?>>optional</option>
						<option value="required" <?if($question->validation == "required") echo "selected='selected'";?>>required</option>
					</select>
			
			<div class="spacer"></div>
			
			<label>Question Type:
			<span class="small">&nbsp;</span>
			</label>
			<select name="qtype" id="qtype">
				<option name="single" <?echo $question->type == 'single' ?  "selected":false ?> >single</option>
				<option name="single" <?echo $question->type == 'dropdown' ?  "selected":false ?> >dropdown</option>
				<option name="single" <?echo $question->type == 'multi' ?  "selected":false ?> >multi</option>
				<option name="single" <?echo $question->type == 'bigbox' ?  "selected":false ?> >bigbox</option>
				<option name="single" <?echo $question->type == 'smallbox' ?  "selected":false ?> >smallbox</option>
				<option name="single" <?echo $question->type == 'pagebreak' ?  "selected":false ?> >pagebreak</option>
				<option name="single" <?echo $question->type == 'info' ?  "selected":false ?> >info</option>
			</select>
			
			<div class="spacer"></div>
			
			
				<label>Responses:
				<span class="small">Single/Dropdown/Multi: each option on a new line</span>
				</label>
				<textarea name="responses" id="responses">
					<?=$choices?>
				</textarea>
			
			
			<div class="spacer"></div>
			<input type="hidden" name="qid" id="qid" value="<?=$qid?>" />
		
			<button type="submit">Submit</button>&nbsp;&nbsp;<a title="delete this question" style="float:right" href="javascript:deletequestion(<?=$question->questionid?>);"><img src="/images/trash.png" alt="delete this question"></img></a>
			</form>
		</div>
	<?endif;?>	
<?endforeach;?>