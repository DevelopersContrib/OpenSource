<div id="survey" class="myform">
	<form action="javascript:addQuestionSave()">
	<h1>Add question</h1>
	<p>Add new question to this survey</p>

	
	<label>Title
	<span class="small">Question Text</span>
	</label>
	<input type="text" name="qtext" id="qtext" />

	<div class="spacer"></div>
	
	<label>This question is 
	<span class="small">Optional or Required</span>
	</label>
		<select name="validation" id="validation">
						<option value="optional" >optional</option>
						<option value="required" >required</option>
		</select>

	<div class="spacer"></div>
	
	<label>Question Type:
			<span class="small">&nbsp;</span>
			</label>
			<select name="qtype" id="qtype">
				<option name="single" >single</option>
				<option name="single" >dropdown</option>
				<option name="single" >multi</option>
				<option name="single" >bigbox</option>
				<option name="single" >smallbox</option>
				<option name="single" >pagebreak</option>
				<option name="single" >info</option>
			</select>
			
	<div class="spacer"></div>
	
	<label>Responses:
		<span class="small">Single/Dropdown/Multi: each option on a new line</span>
	</label>
	<textarea name="responses" id="responses"></textarea>
	<input type="hidden" name="sid" id="sid" value="<?=$sid?>" />
	<div class="spacer"></div>
	
	<button type="submit">Submit</button>
	<div class="spacer"></div>

	</form>
</div>
