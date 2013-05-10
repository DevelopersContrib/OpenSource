<?php
	/*
		surveyquestions.php
		shows the list of questions in each survey
	*/
?>

<link rel="stylesheet" href="/css/surveystyle.css" type="text/css" media="screen" />
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
	
	
	function refreshQuestionList(){
		$('#left').html('<img src="/images/loader.gif" alt="loading.."> ');
		var sid = $('#sid').val();
		$.post('/csurvey/Loadquestionlist',
		{sid:sid},
		function(data){
			$('#left').html(data);
		});
	}
	
	function showQuestion(sid,qid){
		$('#right').html('<img src="/images/loader.gif" alt="loading.."> ');
		$.post('/csurvey/getquestiondetails',{qid:qid,sid:sid},function(html_result){
			$('#right').html(html_result);
		});
	}
	
	function deleteSurvey(){
		$('#confirmdelete').dialog("open");
	}
	
	function AddQuestion(){
		$('#right').html('<img src="/images/loader.gif" alt="loading.."> ');
		var sid = $("#sid").val();
		$.post('/csurvey/addquestionform',{sid:sid},
		function(html_data){
			$('#right').html(html_data);
		});
	}
	
	function addQuestionSave(){
		var qtext = $('#qtext').val();
		var qtype = $('#qtype').val();
		var validation = $('#validation').val();
		var sid = $('#sid').val();
		var responses = $('#responses').val();
		
		$.post('/csurvey/addquestion',
		{question:qtext,qtype:qtype,qvalid:validation,options:responses,sid:sid},
		function(data){
			if(data == "OK"){
				alert("saved ");
				refreshQuestionList();
			}
			else{
				alert("error: "+data);
			}
		});
		
	}
	
	
	function updateQuestion(){
		var title = $('#title').val();
		var validation = $('#validation').val();
		var qtype = $('#qtype').val();
		var responses = $('#responses').val();
		var qid = $('#qid').val();
		var sid = $('#sid').val();

		
		$.post('/csurvey/editquestion',
			{title:title,validation:validation,qtype:qtype,responses:responses,qid:qid,sid:sid},
				function(data){
					if(data == "OK"){
						alert("Update successful.");
					}else{
						alert("An error occurred: "+data);
					}
			});
	}
	
	function deletequestion(qid){
		var sid = $('#sid').val();
		$.post('/csurvey/deletequestion',
		{qid:qid,sid:sid},
		function(data){
			if(data == "OK"){
				alert("deleted");
				refreshQuestionList();
				$('#right').html("Select from questions.");
			}
			else{
				alert("error "+data);
			}
		});
	}
	
	function updateSurveyDetails(){
		var surveytitle = $('#surveytitle').val();
		var template = $('#template').val();
		var sid = $('#sid').val();
		
		$.post('/csurvey/editsurvey',{title:surveytitle,sid:sid,template:template},function(data){
			if(data == "OK"){
				alert("Changes saved");
			}else{
				alert("ERROR: "+data);
			}
		});
		
	}
	
</script>
<div id="confirmdelete"><p>Are you sure you want to delete this survey?</p></div>



<div id="whole">
	<p class="url_link"><img src="http://survey.contrib.com/images/icons/web_16x16.gif" width="16" height="16" alt="Link to survey">The link to this survey is: 
	<a href="http://www.surveycontrib.applications.net/survey/survey.php?sid=<?=$sid?>">http://www.surveycontrib.applications.net/survey/survey.php?sid=<?=$sid?></a></p>
	
	
	<div class="top">
		<input type="text" name="surveytitle" id="surveytitle" class="maintitle" size="25" value="<?=$surveytitle?>">
		<select name="template" id="template" class="maintitle">
			<?foreach($templates as $t):?>
				<option value="<?=$t?>" <?echo $t == $template ? "selected":false ?>><?=$t?></option>
			<?endforeach;?>
		</select>
		<a href="javascript:updateSurveyDetails();"><img src="images/check.png" alt="save"></img></a>
	</div>
	
	<br class="spacer">
	
	<div id="buttons_block">
	<form action="javascript:deleteSurvey();">
		<input type="hidden" name="sid" id="sid" value="<?=$sid?>" />
		<button class="actionbutton">Delete this survey</button>
	</form>
	
	<form action="javascript:AddQuestion();">
		<button class="actionbutton">Add Question</button>
	</form>
	</div><!-- #buttons_block -->
	
	<div class="spacer"></div>
	<br /><br />
	<div id="left">
		<h3>Questionnaires</h3>
		<?if(sizeof($surveyquestions) > 0):?>
		<?$question_count = 1;
			foreach($surveyquestions AS $question):?>
				<p><a id="question<?=$question->questionid?>" href="javascript:showQuestion('<?=$sid?>','<?=$question->questionid?>')"><?=$question_count++?> <?=$question->questiontext?></a></p>
			<?endforeach;?>
		<?else:?>
			<p>There are no questions in this survey.</p>
		<?endif;?>
	</div><!-- left -->
	
	<div id="right">
		<p>Select from questions</p>
	</div><!-- right -->
	
	
</div><!-- whole -->



