
				<form action="javascript:addQuestionSave()">
						
					<div class="qstn-right-inner">
						<p class="qstn-head-title"><b>Add Question</b><br>Add new question to this survey</p>
						
						<label style="width: 110px;">Question Type<span class="small" style="width: 110px;">Select question type</span></label>
						<select id="qtype" name="qtype" style="width: 150px;">
							<option value="single">single</option>
							<option value="dropdown">dropdown</option>
							<option value="multi">multi</option>
							<option value="bigbox">bigbox</option>
							<option value="smallbox">smallbox</option>
							<option value="pagebreak">pagebreak</option>
							<option value="info">info</option>
						</select>
						<img src="http://survey.contrib.com/images/icons/help_16x16.gif" id="qtip_qtype_btn">
						
						<label style="width: 110px;">This question is<span class="small" style="width: 110px;">Optional or Required</span></label>
						<select name="validation" id="validation" style="width: 150px;">
							<option value="optional">Optional</option>
							<option value="required">Required</option>
						</select>
						<img src="http://survey.contrib.com/images/icons/help_16x16.gif" id="qtip_validatn_btn">
					
						<div class="spacer"></div>
					
						<label style="width: 110px;">Question Title<span class="small">Type your question</span></label>
						<input type="text" name="qtext" id="qtext" style="width: 465px;"/>
						
						<div class="spacer"></div>
						
						<label style="margin-right:20px;width: 275px;">Responses:<span class="small" style="width:275px">Single/Dropdown/Multi: each option on a new line</span></label>
						
						<label style="width: 275px;">Sample Responses:<span class="small" style="width:275px">Sample responses for 'What fruit do you like most?'</span></label>
						
						<div class="spacer"></div>
						<textarea name="responses" id="responses" style="width: 280px;height: 90px;margin-right:20px"></textarea>
						
						<textarea  style="width: 275px;height: 90px;" disabled>a. Apple
b. Mango
c. Banana</textarea>
	
						<div class="spacer"></div>
						
						<input type="hidden" name="sid" id="sid" value="<?=$sid?>" />
						
						<button type="submit">Submit</button>
						
						<div class="spacer"></div>
											
					</div>	

				</form>