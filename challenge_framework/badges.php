<?include('header.php');?>
<script type="text/javascript">
$(document).ready(function(){
		$('#badges_container textarea').focus(function() {
		var $this = $(this);

		$this.select();

		window.setTimeout(function() {
			$this.select();
		}, 1);

		// Work around WebKit's little problem
		$this.mouseup(function() {
			// Prevent further mouseup intervention
			$this.unbind("mouseup");
			return false;
		});
	});
});
</script>	
<?php 
$slug = $_GET['slug'];
$challengeid = $dir->GetInfo('Challenges','ChallengeId', 'Slug', $slug);
$challenge_title = $dir->GetInfo('Challenges','ChallengeTitle', 'ChallengeId', $challengeid);
$link = $site_url."/challenge/".$slug;
?>
<div class="container">
	<div class="row-fluid">
		<div class="span12 bckgrnd-pages">
			<div class="span8" style="padding-top: 10px;">
				<div class="row-fluid">
					<a href="<?php echo $site_url?>/home.html" class="brdcrmb-link-deco">Home</a> 
					<b class="brdcrmb-meta-arrw">&raquo;</b> 
					<span class="brdcrmb-active">Badges</span>
				</div><!--Breadcrumb-->
				<div class="row-fluid" style="margin-bottom: 10px;">
					<h3 class="left-content-title">BADGES</h3>
					  <div class="row-fluid">
					  
					  <h3 class="side-meta-title"><a href="<?php echo $link?>"><?php echo stripcslashes($challenge_title)?> BADGE</a></h3>
					  
					  <table width="100%">
					    <tr valign="top">
					       <td> 
					       <div  style="width:250px">
					        <script type="text/javascript" src="<?php echo $siteurl?>/badges/challenge/<?php echo $challengeid?>"></script>
					       </div>
					       </td>
					       <td style="vertical-align:top !important;">
					       <span><b>Corresponding HTML Code:</b></span>
							<br /><br>
							<div id="badges_container">
							  <textarea style="width:300px;height:80px;"> <script type="text/javascript" src="<?php echo $siteurl?>/badges/challenge/<?php echo $challengeid?>"></script></textarea>
							</div>
					       </td>
					    </tr>
					  </table>
					   
				  </div>
				</div>
			</div>
			<div class="span4" style="padding-top:50px;">
				<? include('sidebar.php'); ?>
			</div>
		</div>
	</div>
</div>
<?include('footer.php');?>