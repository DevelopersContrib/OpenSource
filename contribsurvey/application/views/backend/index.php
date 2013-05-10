<!DOCTYPE html>
<html>
<head>
<title>Contrib Survey</title>
<link href="http://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
<link href="<?=base_url();?>css/survey.css" rel="stylesheet">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"type="text/css" media="all"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/survey.js"></script>
<script type="text/javascript">
$(function(){	
	$('#load_content').html('<div class="loader"><img src="/images/loader.gif"></div>');
	$.post('<?=base_url();?>csurvey/showAddSurvey',{},function(res){
		$('#load_content').html(res);
	});
});
</script>
</head>
<body>

	<header>
		<br><br><br>
	</header>
	
	<section>
		<div class="left-container">
			<h1 class="header">
				My Surveys
			</h1>
			<ul id="survmenu" class="menu">
				<li id="createNew" class="active">
					<img src="/survey/images/icons/database_form_(add)_16x16.gif">
					Create New Survey
				</li>
				<?foreach($surveylist AS $survey):?>
					<li id="<?=$survey->sid?>">
						<img src="/survey/images/icons/database_form_16x16.gif">
						<?=$survey->title?>
					</li>
				<?endforeach;?>			
			</ul>
		</div>
		<div class="right-container">
			<div id="load_content">
				<!-- contents to be loaded here -->
			</div>
		</div>
	</section>
	
	<footer class="footer">
		<p class="center"> 
			Copyright 2013
		</p>
	</footer>
	
</body>

</html>