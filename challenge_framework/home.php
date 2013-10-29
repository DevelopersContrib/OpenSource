<?include('header.php');?>

<?
include('includes/profile_function.php');
$prof = new DIR_PROFILE;
?>

<?if(!isset($_SESSION['userid'])){ ?>
	<script>window.location="login.html";</script>	<?
}?>

<div class="container">
	<div class="row-fluid">
		<div class="span12" style="background-color: #fff;min-height: 400px;margin: 30px 0 30px 0;">
			
			<div class="span8 post-body-content">
			
			
				<div class="row-fluid">
					
					<?
					switch($_SESSION['UserType']){
						case '1':{
							if($prof->getChallengerSubmissionsCount($_SESSION['ChallengeMemberId']) > 0){
							
								echo '
								<div class="row-fluid">
									<a href="'.$site_url.'/home.html" class="brdcrmb-link-deco">Home</a> 
									<b class="brdcrmb-meta-arrw">&raquo;</b> 
									<span class="brdcrmb-active">Your Challenge Applications</span>
								</div><!--Breadcrumb-->
								';						
								include ($_SERVER['DOCUMENT_ROOT']).'/modules/home-challenger.php';
							
							}else{
							
								echo '
								<div class="row-fluid">
									<a href="'.$site_url.'/home.html" class="brdcrmb-link-deco">Home</a> 
									<b class="brdcrmb-meta-arrw">&raquo;</b> 
									<span class="brdcrmb-active">Introduction</span>
								</div><!--Breadcrumb-->
								';
								include ($_SERVER['DOCUMENT_ROOT']).'/modules/home-howto.php';
							}
							break;
						}
						case '2':{
							echo '
							<div class="row-fluid">
								<a href="'.$site_url.'/home.html" class="brdcrmb-link-deco">Home</a> 
								<b class="brdcrmb-meta-arrw">&raquo;</b> 
								<span class="brdcrmb-active">Your Challenge Sponsorships</span>
							</div><!--Breadcrumb-->
							';
							include ($_SERVER['DOCUMENT_ROOT']).'/modules/home-sponsor.php';
							break;
						}
						default:{
							echo '
							<div class="row-fluid">
								<a href="'.$site_url.'/home.html" class="brdcrmb-link-deco">Home</a> 
								<b class="brdcrmb-meta-arrw">&raquo;</b> 
								<span class="brdcrmb-active">Introduction</span>
							</div><!--Breadcrumb-->
							';
							include ($_SERVER['DOCUMENT_ROOT']).'/modules/home-howto.php';
							break;
						}
						
					}
					?>
					
				</div>
			</div>
			
			<div class="span4">
			<? include('sidebar.php'); ?>
			</div>
			
		</div>
	</div>
</div>

<?include('footer.php');?>
