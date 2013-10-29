<?php include('header.php');?>
<?php
if(isset($_GET['username'])){
	$username = $_GET['username'];
	if($dir->CheckExist('ChallengeMembers','Username',$username) == true){
		$profile_userid = $dir->GetTableInfo('ChallengeMembers','ChallengeMemberId','Username',$username);
		$usertype = $dir->GetUserInfo('UserType',$profile_userid);
	}else{
		//header('location: /home.html');
		?>
			<script type="text/javascript">
				window.location = "/home.html"
			</script>
		<?
		die();
	}
}else{?>
		<script type="text/javascript">
				window.location = "/home.html"
			</script>
	<?
	header('location: /home.html');
	die();
}
include('includes/profile_function.php');
$prof = new DIR_PROFILE;

$avatar_url = $dir->GetUserInfo('Photo',$profile_userid);
if($avatar_url == null || $avatar_url == ""){
	$avatar_url = 'http://wellnesschallenge.com/img/user.png';
}
?>
<div class="container-fluid wrap-ttle-blue ">
		<div class="row-fluid">
			<div class="container">
				<div class="row-fluid">
					<div class="wrap-user-profile">
						<div id="user-avatar">
							<img class="image-replacement" alt="image" src="<?=$avatar_url?>"/>
						</div><!--User Avatar-->
						<div class="three col user-info">
							<div class="row-fluid">
								<div class="user-name">
									<?=$username?>
								</div>
							</div>
							<div class="row-fluid">
								<p style="color:#f8e829;font-size: 1.275em;"><b><?=$dir->reformatdate($dir->GetUserInfo('DateSigned',$profile_userid))?></b><small style="display: block;">member since</small></p>
								<p style="color:#f8e829;font-size: 1.275em;"><b><?=$dir->GetUserInfo('Country',$profile_userid);?></b><small style="display: block;">country</small></p>
								<? if($dir->GetUserInfo('Website',$profile_userid)!=''){?>
								<p style="color:#f8e829;font-size: 1.275em;"><b><?=$dir->GetUserInfo('Website',$profile_userid);?></b><small style="display: block;">website</small></p>
								<? } ?>
							</div>
						</div>
						<div class="clearfix"></div>
					</div><!--End of Wrap-user-profile-->
				</div>
			</div><!--Avatar container and username-->
			<div class="container wrap-brdr-white">
				<div class="row-fluid">&nbsp;</div>
			</div><!--border-->
		</div><!--Wrap-ttle-blue-->
	</div><!--Wrap blue-->
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="container wrap-user-content">
				<div class="row-fluid">
					<div class="span12">
						<div class="span6">
							<div class="wrap-main-content">
								<div class="page-header">
									<h2>Challenge Statistic</h2>
								</div>
								<div class="row-fluid">
									<div class="span12">
										<div class="span6">
											<div class="sub-stat stat-graph-1">
												<span class="sub-stat-title">Submissions</span>
												<span class="sub-stat-result">
													<a href="#"><?=$prof->getChallengerSubmissionsCount($profile_userid)?></a>
												</span>
											</div>
										</div>
										<div class="span6">
											<div class="sub-stat stat-graph-2">
												<span class="sub-stat-title">Approved Solutions</span>
												<span class="sub-stat-result">
													<a href="#"><?=$prof->getChallengerSubmissionsWinCount($profile_userid)?></a>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!--left-->
						<div class="span6">
							<div class="wrap-main-content">
								<div class="page-header">
									<h2>About</h2>
								</div>
								<p class="meta-info"><?=nl2br($dir->GetUserInfo('Minibio',$profile_userid))?></p>
							</div>
						</div><!--right-->
					</div>
				</div>
			</div>
		</div>
	</div><!--End of user content-->
	

<?include('footer.php');?>