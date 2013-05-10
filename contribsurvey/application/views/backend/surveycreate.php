<div class="top_header">
	<span class="top_main">Create New Survey</span><br>
	<span class="top_sub">Create a subtopic of your survey</span>
	<hr>
</div>

<div id="survey" class="addsurveyform">
	<form action="javascript:submitSurvey()">
		<?$this->load->view('backend/notes');?>
		
		<label>Write survey title<span class="small">Main topic of your survey</span></label>
		<input type="text" name="title" id="title" style="width:300px;"/>
	
		<div class="spacer"></div>
		
		<label>Choose template<span class="small">Select from contrib templates</span></label>
		<select name="template" id="template" style="width:300px;">
			<?foreach($templates AS $template):?>
				<option value="<?=$template?>"><?=$template?></option>
			<?endforeach;?>
		</select>
				
		<div class="spacer"></div>
		
		<div id="add_qstns" style="display:none;">
			<label>Questionnaires<span class="small">Create your survey questions</span></label>
			
			<div class="spacer"></div>
			
			<div class="qstn_box">
				<div class="qstn-left">
					<ul class="qstns">
						<li class="active">1. <span id="qstn1">Question 1</span></li>
					</ul>
				</div>
				<div class="qstn-right">
					<div class="qstn-right-inner">
						<p class="qstn-head-title"><b>Question 1</b><br>Create your first question</p>
						
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
						<input type="text" name="qtitle" id="qtitle" style="width: 465px;"/>
						
						<div class="spacer"></div>
						
						<label style="margin-right:20px;width: 275px;">Responses:<span class="small" style="width:275px">Single/Dropdown/Multi: each option on a new line</span></label>
						
						<label style="width: 275px;">Sample Responses:<span class="small" style="width:275px">Sample responses for 'What fruit do you like most?'</span></label>
						
						<div class="spacer"></div>
						<textarea name="responses" id="responses" style="width: 280px;height: 90px;margin-right:20px"></textarea>
						
						<textarea  style="width: 275px;height: 90px;" disabled>a. Apple
b. Mango
c. Banana</textarea>
					
						<div class="spacer"></div>
											
					</div>
				</div>
			</div>
			
			<div class="spacer"></div>
		</div>
		<br><br>
		<input type="hidden" id="sid" value="">
		<button type="submit" >Submit</button>
		
	</form>
</div>
