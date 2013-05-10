<link rel="stylesheet" href="/css/surveystyle.css" type="text/css" media="screen" />
<script type="text/javascript">
	$(document).ready(function(){
		$('#qtitle').keyup(function(){
			var text = $(this).val();
			if(text=='')
				$('#qstn1').html('Question 1');
			else
				$('#qstn1').html(text);
		});
		$('#qtip_validatn_btn,#qtip_validatn').click(function(){
			$('#qtip_validatn').toggle('slow');
			$('#qtip_qtype').hide('slow');
		});
		$('#qtip_qtype_btn,#qtip_qtype').click(function(){
			$('#qtip_qtype').toggle('slow');
			$('#qtip_validatn').hide('slow');
		});
	});
	
	function submitSurvey(){
		var title = $('#title').val();
		var template = $('#template').val();
		var sid = $('#sid').val();
		//alert(sid);
		if(sid==''){
			if(title==''){
				$('#title').focus();
			}else{
				$.post('/csurvey/createsurvey',{title:title,template:template},function(data){
					if(data.indexOf(':true:') != -1){
						refreshSurveyList();
						str = data.replace(":true:","");
						$('#add_qstns').show('slow');
						$('#sid').val(str);
					}else{
						alert('Something went wrong. Please try again.');
					}
				});
				
			}
		}else{
			var qtype = $('#qtype').val();
			var validation = $('#validation').val();
			var qtitle = $('#qtitle').val();
			var responses = $('#responses').val();
		
			if(qtitle==''){
				$('#qtitle').focus();
			}else if(qtype=='single' && responses==''){
				$('#responses').focus();
			}else if(qtype=='dropdown' && responses==''){
				$('#responses').focus();
			}else if(qtype=='multi' && responses==''){ 
				$('#responses').focus();
			}else{
				
				
				$('#load_content').html('<div class="loader"><img src="/images/loader.gif"></div>');
				
				$.post('/csurvey/addquestion',{question:qtitle,qtype:qtype,qvalid:validation,options:responses,sid:sid},function(data){
					if(data == "OK"){
						alert("survey saved.");
						var url = 'http://www.surveycontrib.applications.net/csurvey/getquestions?sid='+sid;
						$('#survmenu').children().attr('class','');
						$('#'+sid).addClass('active');
						$.post(url,{},function(res){
							$('#load_content').html(res);
						});
					}
					else
						alert("error: "+data);	
				});
				
			}
		}
		
	}
	
</script>

<div style="margin-bottom: 20px;">
	<span style="font: bold 18px arial;">Create New Survey</span><br>
	<span style="font: normal 11px arial;color: gray;">Create a subtopic of your survey</span>
	<hr>
</div>

<div id="survey" class="addsurveyform">
	<form action="javascript:submitSurvey()">
		<div id="qtip_validatn" style="display:none;cursor:pointer;width: 400px;margin: -10px 28px -80px 0;border: 1px dashed gray;padding: 10px 10px 0 10px;background: rgb(255, 244, 224);z-index: 1;position: absolute;right: 0;">
			<span style="color: #41627E;"><b style="border-bottom: solid 1px #b7ddf2;">Notes<i>!</i></b></span>
			<p style="padding-bottom:0;border-bottom: 0;"><b>Validation:</b><br>To ensure respondents enter a response to a question, you can define a question as 'required'. This will present an on-screen message to respondents alerting them that an answer is required.</p>
		</div>
		
		<div id="qtip_qtype" style="display:none;cursor:pointer;width: 400px;margin: -30px 28px -80px 0;border: 1px dashed gray;padding: 10px 10px 0 10px;background: rgb(255, 244, 224);z-index: 1;position: absolute;right: 0;">
			<span style="color: #41627E;"><b style="border-bottom: solid 1px #b7ddf2;">Notes<i>!</i></b></span>
			<p style="padding-bottom:0;border-bottom: 0;margin-bottom: 0;"><b>Question types:</b></p>
			<ul style="font-size: 11px;  color: #666666;-webkit-padding-start: 20px;">
			<li><span style="text-decoration:underline;">Single</span>: a question with a list of options presented as radio buttons from which respondents can choose one</li>
			<li><span style="text-decoration:underline;">Dropdown</span>: a question with a list of options presented as a dropdown menu from which respondents can choose one</li>
			<li><span style="text-decoration:underline;">Multi</span>: a question with a list of options (tick boxes) from which a respondent can choose as many as apply</li>
			<li><span style="text-decoration:underline;">Smallbox</span>: a one-line text box for short written answers</li>
			<li><span style="text-decoration:underline;">Bigbox</span>: a multi-line text box with scroll bar for longer written answers</li>
			<li><span style="text-decoration:underline;">Pagebreak</span>: marks the end of the current page of questions</li>
			<li><span style="text-decoration:underline;">Info</span>: a text-only message or instruction</li>
			</ul>
		</div>
		
		<div>
			<label>Write a survey title
			<span class="small">Main topic of your survey</span>
			</label>
			<input type="text" name="title" id="title" style="width:300px;"/>
		</div>
		
		<div class="spacer"></div>
		
		<div>
			<label>Choose a template
			<span class="small">Select from contrib templates</span>
			</label>
			<select name="template" id="template" style="width:300px;">
				<?foreach($templates AS $template):?>
					<option value="<?=$template?>"><?=$template?></option>
				<?endforeach;?>
			</select>
		</div>
		
		<div class="spacer"></div>
		
		<div id="add_qstns" style="display:none;">
			<label>Questionnaires
				<span class="small">Create your survey questions</span>
			</label>
			
			<div class="spacer"></div>
			
			<div  style="width:97%;float: left;background: #ECF2F5;color: #666666;">
				<div style="width: 20%;float:left;">
					<ul class="qstns">
						<li class="active">1. <span id="qstn1">Question 1</span></li>
					</ul>
				</div>
				<div class="qstn-right" style="width: 77%;float:left;">
					<div style="margin: 10px 0;border-left: solid 1px #b7ddf2;padding-left: 10px;">
						<p style="margin-top: 0;"><b style="font-size: 13px;">Question 1</b><br>Create your first question</p>
						
						<label>Question Type
							<span class="small">Select question type</span>
						</label>
						<select id="qtype" name="qtype">
							<option value="single">single</option>
							<option value="dropdown">dropdown</option>
							<option value="multi">multi</option>
							<option value="bigbox">bigbox</option>
							<option value="smallbox">smallbox</option>
							<option value="pagebreak">pagebreak</option>
							<option value="info">info</option>
						</select>
						<img src="http://survey.contrib.com/images/icons/help_16x16.gif" id="qtip_qtype_btn" style="float:left;margin: 7px 40px 0 0;cursor:pointer;">
						
						<label>This question is
							<span class="small">Optional or Required</span>
						</label>
						<select name="validation" id="validation">
							<option value="optional">Optional</option>
							<option value="optional">Required</option>
						</select>
						<img src="http://survey.contrib.com/images/icons/help_16x16.gif" id="qtip_validatn_btn" style="cursor:pointer;margin:7px 0 0 0">
					
						<div class="spacer"></div>
					
						<label>Question Title 
							<span class="small">Type your question</span>
						</label>
						<div class="spacer"></div>
						<textarea name="qtitle" id="qtitle" style="width: 580px;"></textarea>
						
						<div class="spacer"></div>
						
						<label style="margin-right:20px;width: 275px;">Responses:
							<span class="small" style="width:275px">Single/Dropdown/Multi: each option on a new line</span>
						</label>
						
						<label style="width: 275px;">Sample Responses:
							<span class="small" style="width:275px">Sample responses for 'What fruit do you like most?'</span>
						</label>
						
						<div class="spacer"></div>
						<textarea name="responses" id="responses" style="width: 270px;height: 90px;margin-right:20px"></textarea>
						
						<textarea  style="width: 270px;height: 90px;" disabled>a. Apple
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
