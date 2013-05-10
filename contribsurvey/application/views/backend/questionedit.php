<?foreach($surveyquestions AS $question): ?>
	<?if($question->questionid == $qid):
		$choices = "";
		if(sizeof($question->options) > 0 && ($question->type == "single" || $question->type == "multi" || $question->type == "dropdown")):
			foreach($question->options AS $option):
				$choices = $choices."\n".$option;
			endforeach;						
		endif; ?>

		
			<form action="javascript:updateQuestion();">
				<div class="qstn-right-inner">
						<p class="qstn-head-title"><b>Question Details</b><br>Modify question to this survey</p>
						
						<label style="width: 110px;">Question Type<span class="small" style="width: 110px;">Select question type</span></label>
						<select id="qtype" name="qtype" style="width: 150px;">
							<option name="single" <?echo $question->type == 'single' ?  "selected":false ?> >single</option>
							<option name="single" <?echo $question->type == 'dropdown' ?  "selected":false ?> >dropdown</option>
							<option name="single" <?echo $question->type == 'multi' ?  "selected":false ?> >multi</option>
							<option name="single" <?echo $question->type == 'bigbox' ?  "selected":false ?> >bigbox</option>
							<option name="single" <?echo $question->type == 'smallbox' ?  "selected":false ?> >smallbox</option>
							<option name="single" <?echo $question->type == 'pagebreak' ?  "selected":false ?> >pagebreak</option>
							<option name="single" <?echo $question->type == 'info' ?  "selected":false ?> >info</option>
						</select>
						<img src="http://survey.contrib.com/images/icons/help_16x16.gif" id="qtip_qtype_btn">
						
						<label style="width: 110px;">This question is<span class="small" style="width: 110px;">Optional or Required</span></label>
						<select name="validation" id="validation" style="width: 150px;">
							<option value="optional" <?if($question->validation == "optional") echo "selected='selected'";?>>optional</option>
							<option value="required" <?if($question->validation == "required") echo "selected='selected'";?>>required</option>
						</select>
						<img src="http://survey.contrib.com/images/icons/help_16x16.gif" id="qtip_validatn_btn">
						<div class="spacer"></div>
					
						<label style="width: 110px;">Question Title<span class="small">Type your question</span></label>
						<input type="text" name="title" id="title" value="<?=$question->questiontext?>"  style="width: 465px;"/>
						<div class="spacer"></div>
						
						<label style="margin-right:20px;width: 275px;">Responses:<span class="small" style="width:275px">Single/Dropdown/Multi: each option on a new line</span></label>
						
						<label style="width: 275px;">Sample Responses:<span class="small" style="width:275px">Sample responses for 'What fruit do you like most?'</span></label>
						
						<div class="spacer"></div>
						
						<textarea name="responses" id="responses" style="width: 280px;height: 90px;margin-right:20px"><?=$choices?></textarea>
						
						<textarea  style="width: 275px;height: 90px;" disabled>a. Apple
b. Mango
c. Banana</textarea>
											
						<div class="spacer"></div>
						
						<input type="hidden" name="qid" id="qid" value="<?=$qid?>" />
					
						<button type="submit">Update</button>&nbsp;&nbsp;
						
						<a title="delete this question" style="float:right" href="javascript:deletequestion(<?=$question->questionid?>);"><img src="/images/trash.png" alt="delete this question"></img></a>
						
						<div class="spacer"></div>
				</div>
			</form>
	
	<?endif;?>	
<?endforeach;?>