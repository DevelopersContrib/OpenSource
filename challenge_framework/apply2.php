<?	
	include('header.php');
	
?>
<script type="text/javascript" src="/js/apply.js"></script>
<?php 
  $slug = $_GET['slug'];
  $challengeid = $dir->GetInfo('Challenges','ChallengeId', 'Slug', $slug);
  $category_id = $dir->GetInfo('Challenges','CategoryId', 'ChallengeId', $challengeid);
  $category = $dir->GetInfo('ChallengeCategory', 'CategoryName', 'ChallengeCategoryId', $category_id);
  $applications_count = $dir->GetTotal('Applications','ChallengeId',$challengeid);
  $photo = $dir->GetInfo('Challenges','Photo', 'ChallengeId', $challengeid);
  $challenge_title = $dir->GetInfo('Challenges','ChallengeTitle', 'ChallengeId', $challengeid);
  $challenge_desc = $dir->GetInfo('Challenges','ChallengeDesc', 'ChallengeId', $challengeid);
  $challenge_slug = $dir->GetInfo('Challenges','Slug', 'ChallengeId', $challengeid);
  $solved = $dir->GetInfo('Challenges','Solved', 'ChallengeId', $challengeid);
  

if(!isset($_SESSION['userid'])){ ?>
	<script>window.location="/login.html";</script>	<?
}

if($challengeid==""){ ?>
	<script>window.location="browse.html";</script>	<?
}

if($_POST['submit-button']=='send'){
	$name = mysql_escape_string($_POST['appli-name']);
	$desc = mysql_escape_string($_POST['appli-desc']);
	$slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9\-]/', '-', $name),'\-'));
	
	if($dir->AppCheckSlugIfExists($slug)===true){
		$slug = $slug.'-app';
	}
	
	$challengeid = $_POST['chall_id'];
	$userid = $_POST['userid'];
	$vid_cnt = $_POST['appli-vid-cnt'];
	$vid = $_POST['appli-vid'];
	
	if($appid = $dir->ApplicationSave($name,$desc,$challengeid,$userid,$slug)){
		$cnt = 0;
		while(list($key,$value) = each($_FILES['appli-image']['name'])){
			$cnt++;
			if(!empty($value)){
				$filename = $value;
				preg_match('/([^\\/\:*\?"<>|]+)(?:\.([^\\/\:*\?"<>|\.]+))$/',$filename,$matches);
				$ext = strtolower($matches[2]);
				
					$start = time();
					
					//$add = "uploads/submission/images/img_".$start."_".$cnt.".".$ext;
					$add = "uploads/submission/images/img_".$filename;
					
					
					copy($_FILES['appli-image']['tmp_name'][$key], $add);
					chmod("$add",0777);
					$add = $siteurl."/".$add;
					$dir->AppImageSave($appid,$add);
				
			}
		}
		$cnt2 = 0;
		while(list($key2,$value2) = each($_FILES['appli-file']['name'])){
			$cnt2++;
			if(!empty($value2)){
				$filename2 = $value2;
				preg_match('/([^\\/\:*\?"<>|]+)(?:\.([^\\/\:*\?"<>|\.]+))$/',$filename2,$matches2);
				$ext2 = strtolower($matches2[2]);
				$start2 = time();
				$add2 = "uploads/submission/files/file_".$start2."_".$cnt2.".".$ext2;
                      
				copy($_FILES['appli-file']['tmp_name'][$key2], $add2);
				chmod("$add2",0777);
				$add2 = $siteurl."/".$add2;
				$dir->AppFileSave($appid,$add2);
			}
		}
		
		for($i=0; $i<$vid_cnt; $i++){
			$vid_url = $vid[$i];
			if($vid_url!="")
				$dir->AppVideoSave($appid,$vid_url);
		}
		
		?>
			<script>window.location="<?php echo $siteurl?>/application/<?=$slug?>";</script>	
		<?
	}
}
?>

<style>
/*SUBMISSION*/
.appli-box{margin-bottom:30px;line-height:20px}
.appli-box .in-name{width:100%}
.appli-box .in-desc{width:100%}
.appli-box #image-upload-gallery{padding: 10px 0 0 10px;background: #F6F6F6;overflow: hidden;border: 1px solid #CCC;margin-top: 10px;}
.appli-box #image-upload-gallery li{position: relative;float: left;margin: 0 13px 13px 0;line-height: 0;cursor: move;}
.appli-sidebar{width: 230px;float: right;border-left: 2px solid #CCC;padding-left: 10px;min-height: 690px;}
</style>

<div class="container">
	<div class="row-fluid">
		<div class="span12" style="background-color: #fff;border-radius:10px;min-height: 400px;margin: 30px 0 30px 0;padding:20px;border:1px solid rgb(231, 231, 231)">
		
			<div class="span8">
				<div class="row-fluid">
									
					<div class="row-fluid">
						<a href="<?php echo $site_url?>/browse.html" class="brdcrmb-link-deco">Browse</a> 
						<b class="brdcrmb-meta-arrw">&raquo;</b> 
						<a href="<?php echo $site_url?>/challenge/<?php echo $challenge_slug?>" class="brdcrmb-link-deco"><?php echo $challenge_title?></a> 
						<b class="brdcrmb-meta-arrw">&raquo;</b> 
						<span class="brdcrmb-active">Submit your Application</span>
					</div><!--Breadcrumb-->
					<div class="row-fluid" style="margin-top: 10px;">
						<div class="span12" style="padding-top: 8px;">
							<div class="ch-nav">
								<a href="#"><i class="icon-home"></i></a>
							</div>
							<div class="ch-nav">
								<span class="join-ch-ttleclr"><?php echo $category?></span>
							</div>
							<div class="ch-nav">
								<a href="<?php echo $site_url?>/challenge/applications/<?php echo $slug?>" class="join-ch-ttleclr">View Application Gallery</a>
							</div>
						</div>
					</div><!--challenge-nav-->
					
					<div class="row-fluid">
						<div class="span12">
							
								<div class="row-fluid">
									<div class="span12 ch-bckgrnd">
										<div class="row-fluid">
											<div class="span6">
												<img style="margin: 10px 0 10px 0;" src="<?php echo $photo?>"/>										
											</div>
											<div class="span6">
												<h1 class="ch-ttl-hdr"><?php echo $challenge_title?></h1>
												<h4 class="ch-ttl-desc"><?php echo $challenge_desc?></h4>
												<br>
												<?php if ($dir->CheckExist('Applications','ChallengeId',$challengeid,'ChallengeMemberId',$_SESSION['userid'])===TRUE && $_SESSION['UserType'] == '1' && $solved == '0'):?>
													  <div class="message-warning"><span>You have already submitted an application to this challenge.</span></div>
												<?php endif;?>
												
												<?php if ($solved=="1"):?>
													<div class="message-warning"><span>This challenge is closed.</span></div>
												<?php endif;?>
																								
												<?php if ($solved!="1" && $_SESSION['UserType'] == '2' && $dir->CheckExist('Challenges','ChallengeId',$challengeid,'CompanyId',$_SESSION['userid'])===true):?>
													<a href="<?=$siteurl?>/challenge/edit/<?php echo $slug?>"> <button class="btn btn-small btn-warning">Edit Challenge</button></a>
												<?php endif;?>
											</div>
										</div>
									</div>
								</div>
								<div class="row-fluid" style="margin: 10px 0 20px;">
									<div class="row-fluid" style="margin: 10px 0 10px;">
										<h3 class="left-content-title">Submit an Application</h3>
										
										<script type="text/javascript" src="<?=$siteurl?>/js/submission.js"></script>
										<form method="POST" enctype="multipart/form-data" >
											<div class="appli-box">
												<h5>Name *</h5>
												<span>Give a name to your application. This is required.</span><br>
												<input type="text" name="appli-name" id="appli-name" class="in-name" />
											</div>
											<div class="appli-box">
												<h5>Description * </h5>
												<span>Add a summary of your application. This will appear on the entry page. This is required.</span><br>
												<textarea name="appli-desc" id="appli-desc" class="in-desc"></textarea>
											</div>
											<div class="appli-box">
												<h5>Image * </h5>
												<span>The first image is used for your entry in listing pages. Upload several and we'll make them into a gallery.
												They should be jpg, gif or png files no larger than 2mb.</span><br>
												<span id="img-add-box" >
													<input type="file" name="appli-image[]" id="appli-image-1" />
												</span>
												<br> <button id="img-more" style="float:right">+ Add more</button>
											</div>
											<div class="appli-box">
												<h5>Video</h5>
												<span>You can add one or more videos by providing the embed script of the video. This is not required but this may increase the validation of your application.</span><br>
												<span id="vid-add-box">Paste embed script here:<textarea name="appli-vid[]" id="appli-vid-1" class="in-desc"></textarea></span>
												<button id="vid-more" style="float:right">+ Add more</button>
											</div>
											<div class="appli-box">
												<h5>File</h5>
												<span>This is not required but this may increase the validation of your application. Files should not be larger than 5mb.</span><br>
												<span id="file-add-box"><input type="file" name="appli-file[]" id="appli-file-1" size="45" /></textarea></span>
												<button id="file-more" style="float:right">+ Add more</button>
											</div>
											<div class="appli-box">
												Note: Please thoroughly check all the fields. Once it is submitted, you can not modify the data.<br>
												<input type="checkbox" name="accept"> I have read and understand the above condition.	
											</div>
											<input type="hidden" id="chall_id" name="chall_id" value="<?=$challengeid?>">
											<input type="hidden" id="userid" name="userid" value="<?=$_SESSION['userid']?>">
											<input type="hidden" id="appli-image-cnt" name="appli-image-cnt" value="1" />
											<input type="hidden" id="appli-vid-cnt" name="appli-vid-cnt" value="1" />
											<input type="hidden" id="appli-file-cnt" name="appli-file-cnt" value="1" />
											<button name="submit-button" id="submit" value="send">Submit Application</button>
										</form>
										
										
										
										
										
										
										
										  
									</div>
									
								</div>
							
							
						</div>
					</div>
					
			
		
				</div>
			</div>
			
			<? include('sidebar.php'); ?>
		
		</div>
	</div>
</div>

<?include('footer.php');?>