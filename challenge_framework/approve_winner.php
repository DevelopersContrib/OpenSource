<?include('header.php');?>

<?php 
  $slug = $_GET['slug'];
  $appid = $dir->GetInfo('Applications','AppId', 'Slug', $slug);
  $app_name = $dir->GetInfo('Applications','AppName', 'AppId', $appid);
  $app_desc = $dir->GetInfo('Applications','AppDesc', 'AppId', $appid);
  $app_image = $dir->GetInfo('AppImages','ImagePath', 'AppId', $appid);
  $galls = $dir->GetGallery($appid);
  $challengeid = $dir->GetInfo('Applications','ChallengeId', 'AppId', $appid);
  $challenge_slug = $dir->GetInfo('Challenges','Slug', 'ChallengeId', $challengeid);
  $dir->ApproveWinner($appid, $challengeid);
   
?>
<script>window.location="<?php echo $siteurl?>/challenge/applications/<?=$challenge_slug?>";</script>
