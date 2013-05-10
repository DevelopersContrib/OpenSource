<!DOCTYPE html>
<html>
<head>
<title>Contrib Survey</title>
<link href="http://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
<link href="/css/survey.css" rel="stylesheet">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"type="text/css" media="all"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
$(function(){	
	$('#load_content').html('<div class="loader"><img src="/images/loader.gif"></div>');

	$.post('http://www.surveycontrib.applications.net/csurvey/showAddSurvey',{},function(res){
		$('#load_content').html(res);
	});
			
	$('ul.menu li').click(function(){
		var sid = $(this).attr('id');
		$('#survmenu').children().attr('class','');
		$('#'+sid).addClass('active');
		
		$('#load_content').html('<div class="loader"><img src="/images/loader.gif"></div>');
		
		if(sid=='createNew'){
			var url = 'http://www.surveycontrib.applications.net/csurvey/showAddSurvey';
			$.post(url,{},function(res){
				$('#load_content').html(res);
			});
		}else{
			var url = 'http://www.surveycontrib.applications.net/csurvey/getquestions?sid='+sid;
			$.post(url,{},function(res){
				$('#load_content').html(res);
			});
		}
		
	});
});

function refreshSurveyList(){
	$.post('/csurvey/LoadSurveyList',function(html_data){
		$('#survmenu').html(html_data);
	});
}

</script>
</head>
<body>
	<header><br><br><br></header>
	<section>
		<div class="left-container">
			<h1 class="header">My Surveys</h1>
			<ul id="survmenu" class="menu">
				<li id="createNew" class="active" style="margin-bottom: 12px;"><img src="/survey/images/icons/database_form_(add)_16x16.gif" width="15" height="15" >Create New Survey</li>
				<?foreach($surveylist AS $survey):?>
					<li id="<?=$survey->sid?>"><img src="/survey/images/icons/database_form_16x16.gif" width="15" height="15" ><?=$survey->title?></li>
				<?endforeach;?>			
			</ul>
		</div>
		<div class="right-container">
			<div id="load_content"></div>
		</div>
	</section>
	<footer class="footer"><p class="center"> Copyright 2013</p></footer>
</body>

</html>