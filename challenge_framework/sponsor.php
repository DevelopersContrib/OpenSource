<?include('header.php');?>

<?if($_SESSION['ChallengeMemberId'] == ""){ ?>  
<script>window.location="index.html";</script>
<?}?>
<?if($_SESSION['UserType'] == "1"){ ?>  
<script>window.location="home.html";</script>
<?}?>

		<script type="text/javascript">
			$(document).ready(function() {
				$(".myTable tr:even").addClass("alt");
				$(".myTable tr:odd").addClass("alt_odd");
	
				$("input[name$='sponsorship']").click(function() {
						$('#def').css('display','none');
						var choice = $(this).val();
						if(choice == 1){
							$('#monetary').css('display','block');
							$('#type2').css('display','none');
							$('#hiddentype').val(1);
						}
						else if(choice == 2){
							$('#monetary').css('display','none');
							$('#type2').css('display','block');
							$('#hiddentype').val(2);
						}
				});
				
				var def_id = $('#def_id').val();
				var domainUrl = $('#domainUrl').val();
				
					
			});
		</script>


<div class="container">
	<div class="row-fluid">
		<div class="span12" style="background-color: #fff;border-radius:10px;min-height: 400px;margin: 30px 0 30px 0;padding:20px;border:1px solid rgb(231, 231, 231)">
			
			<div class="span8">
			
				<div class="row-fluid">
					<a href="<?php echo $site_url?>/home.html" class="brdcrmb-link-deco">Home</a> 
					<b class="brdcrmb-meta-arrw">&raquo;</b> 
					<span class="brdcrmb-active">Sponsor a Challenge</span>
				</div><!--Breadcrumb-->
			
				<div class="row-fluid">
					
					<h3 class="left-content-title">MY SPONSORSHIPS</h3>
	
					<br>
					<div class="row-fluid">
						<div class="span12">
							<div class="row-fluid">
								<input type="hidden" id="domainUrl" value="<?=$siteurl?>">			
								<?
								$mylist = $dir->GetMySponsorship($_SESSION['ChallengeMemberId']);
								
								if($mylist == 0){ 
									
									echo "You have not sponsored a challenge yet.";
								
								}else{
									$html = '<table class="table table-striped">
											  <tr>
											  <th>#</th>
											  <th>Challenge Posts</th>
											  <th>Amount</th>
											  <th>Message</th>
											  </tr>';
									
									for($i=0; $i < sizeof($mylist) ; $i++ ){
										if($mylist[$i]['SponsorshipType'] == 1){ 
											$amountstring = 'Amount: '.$mylist[$i]['Amount']; 
										}
										else{ $amountstring = 'Other'; }
										
										$slug = $dir->GetInfo('Challenges','Slug','ChallengeId',$mylist[$i]['ChallengeId']);
										
										 $html .= '
											  <tr>
												<td > <span class="rank" style="color: white;padding: 8px;width:20px;margin-top: 2px;">'.($i+1).'</span></td>
												<td style="width: 40%;"> <a href="'.$siteurl.'/challenge/'.$slug.'" target="_blank" style="font-size: 13px;"><b>'.$dir->GetTableInfo('Challenges','ChallengeTitle','ChallengeId',$mylist[$i]['ChallengeId']).'</b></a></td>
												<td > '.$amountstring.'</td>
												<td style="width: 35%;"> '.$mylist[$i]['Message'].'</td>
											  </tr>
										 ';
									}
									$html .= '</table>';
									echo $html;
								}
								
								?>		
								
						   
							<input type="hidden" id="def_id" value="<?=$def_id?>">
							<input type="hidden" id="ser_id" value="<?=$ser_id?>">
								
							</div>
						</div><!--Image container-->
					</div>
					
				</div>
			</div>
			
			<? include('sidebar.php'); ?>
			
		</div>
	</div>
</div>

<style>
.contact-hold{font-size:12px;font-weight: bold;}
#submit {height:40px !important;width:100px !important;float:right} 
.contact-hold input.c-in {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #BAC2C7;
    color: #000000;
    font-size: 12px;
    height: 26px;
    padding: 0 10px;
    width: 230px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	-o-border-radius: 5px;
	border-radius: 5px;
}

.j-search-inp {
		-webkit-border-radius:8px;
		-moz-border-radius:8px;
		width:350px;
		border:1px solid #CCC;
		background-color:#F15421;
		padding:10px;
	
	}
	
.j-column {
	font-size: 12px;
	-moz-column-width: 13em;
	-webkit-column-width: 13em;
	-moz-column-gap: 1em;
	-webkit-column-gap: 1em;
	list-style: square;
	padding: 20px;
	margin-left: 20px;
}
	
	.j-col-addcss{
		margin-bottom:20px;float:left;width:80%;height:110px;margin:10px;
	}
	
	.j-col-addcss img {
		
		width:90%;
		height:60px;
	}
	
	
	.j-column-sec {
		border-left:0px !important;
		margin-bottom:20px;
		margin-left: 30px;
	}
	
	
	.j-column-sec div {	
		border-left:0px #000;
	}
	
	
	.j-column-sec img {
	   padding:5px;   
	}
	
	table.myTable {
		font-family:Arial, Helvetica, sans-serif;
		font-size:12px;
		font-weight:normal; 	
		width:100%
	}
	tr.alt td {
		background-color: #F0F0F0;
	}
	.alt_odd {	
		background-color:#E2E2E2;
	}
	.td_spon{
		padding:10px; font-size:13px;
		color: black;
		text-shadow: 2px 2px 2px white;
	}
	
</style>


<?include('footer.php');?>
