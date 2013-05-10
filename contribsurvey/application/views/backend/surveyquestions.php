<!-- shows list of questions in each survey -->

<script type="text/javascript">
	$(document).ready(function(){	
		$('#question_title').text("select from questions");
		$('#confirmdelete').dialog({
			autoOpen:false,
			resizable: false,
			height: 200,
			width: 300,
			buttons: {
				"Yes": function() {
				  var sid = $('#sid').val();
				  
				  $.post('/csurvey/deletesurvey',{sid:sid},function(data){
					if(data == "OK"){
						$('#confirmdelete').html("This survey has been deleted.");
						location.reload();
					}
					else{
						alert(data);
					}
				  });
				},
				Cancel: function() {
				  $( this ).dialog( "close" );
				}
			  }
		});
		
		AddQuestion();
	});
</script>
<div id="confirmdelete"><p>Are you sure you want to delete this survey?</p></div>

<div id="whole">
		
	<div class="top_header">
		<span class="top_main">Survey Details</span><br>
		<span class="top_sub"><img src="http://survey.contrib.com/images/icons/web_16x16.gif" width="16" height="16" alt="Link to survey" style="padding-right: 5px;margin-bottom: -3px;">The link to this survey is: 
		<a href="http://www.surveycontrib.applications.net/survey/survey.php?sid=<?=$sid?>">http://www.surveycontrib.applications.net/survey/survey.php?sid=<?=$sid?></a></span>
		<hr>
	</div>
	
	<div id="survey" style="padding: 14px;">
	
		<?$this->load->view('backend/notes');?>
		
		<label>Survey title<span class="small">Main topic of your survey</span></label>
		<input type="text" name="surveytitle" id="surveytitle" style="width:300px;" value="<?=$surveytitle?>"/>

		<div class="spacer"></div>
		
		<label>Survey template<span class="small">Select from contrib templates</span></label>
		<select name="template" id="template" style="width:300px;">
			<?foreach($templates as $t):?>
			<option value="<?=$t?>" <?echo $t == $template ? "selected":false ?>><?=$t?></option>
			<?endforeach;?>
		</select>
		<div class="spacer"></div>
		<div style="width:48%;">			
			<div id="buttons_block">
				<button class="actionbutton" onclick="javascript:updateSurveyDetails();" style="float:right;margin-left: 20px;">Save Changes</button>
			</div>
			<div id="buttons_block">
				<form action="javascript:deleteSurvey();" style="float: right;margin-left: 20px;">
					<input type="hidden" name="sid" id="sid" value="<?=$sid?>" />
					<button class="actionbutton">Delete this survey</button>
				</form>
			</div>
		</div>
		<div class="spacer"></div>
		<br /><br />
		<label>Questionnaires<span class="small">Your survey questions</span></label>
		
		<div class="spacer"></div>
			
		<div class="qstn_box">
			<div id="left"  class="qstn-left">
				<?if(sizeof($surveyquestions) > 0):?>
					<ul class="qstns">
						<li id="q-stat" class="" onclick="javascript:ShowReports();">
							<img src="<?=base_url()?>images/statistics.png" style="margin: 0 5px -2px 0;width: 15px;">
							<a href="javascript:;" style="color: #666666;">Survey Statistics</a>
						</li>
						<li id="q-create" class="active" onclick="javascript:AddQuestion();">
							<img src="<?=base_url()?>images/plusButton.gif" style="margin: 0 5px -2px 0;">
							<a href="javascript:;" style="color: #666666;">Add New Question</a>
						</li>
						<li style="padding: 5px 0;"><div style="border-bottom: solid 1px #b7ddf2;width:100%;"></div></li>
						<?$question_count = 0;
						foreach($surveyquestions AS $question):?>
							<?$question_count++;?>
							<li id="q-<?=$question->questionid?>" onclick="javascript:showQuestion('<?=$sid?>','<?=$question->questionid?>')"><a id="question<?=$question->questionid?>" href="javascript:;" style="color: #666666;"><b><?=$question_count?>.</b> <?=$question->questiontext?></a></li>
						<?endforeach;?>
					</ul>
				<?else:?>
					<p>There are no questions in this survey.</p>
				<?endif;?>
				
			</div>
			
			
			<div id="right" class="qstn-right">
					<div class="qstn-right-inner">
						<p>Select from questions</p>
					</div><!-- right -->
			</div>
			
		</div>
	
	</div>	<!-- #survey-->
</div><!-- whole -->



