<div class="container-fluid footer-bckgrnd">
	<div class="row-fluid">
		<div class="container">
			<div class="row-fluid">
				<div class="wrap-site-map">
					<div class="site-map">
						<a href="<?=$siteurl?>/about.html">About</a>
						<a href="<?=$siteurl?>/howtosponsor.html">How to Sponsor</a>
						<a href="<?=$siteurl?>">Home</a>
						<a href="<?=$siteurl?>/login.html">Login</a>
						<a href="<?=$siteurl?>/register.html">Register</a>
						<a href="<?=$siteurl?>/staffing.html">We're Hiring</a>
						<a href="<?=$siteurl?>/contact.html">Contact us</a>
					</div>
					<div class="legal">
						<span class="copyright">&copy; <?=date("Y")?> <?=ucfirst($sitename)?></span>
						<a href="/policy.html">Privacy Policy</a>
						<a href="/terms.html">Terms and Conditions</a>
						<a href="/faq.html">FAQ</a>
						<a href="/sitemap.html">Sitemap</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" name="domain_name" id="domain_name" value="<?=$sitename?>" />

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		var domain_name = $('#domain_name').val();
		getsocial(domain_name,'fb');
		getsocial(domain_name,'twitter');
		getsocial(domain_name,'gtube');
		getsocial(domain_name,'linkedin');
		getsocial(domain_name,'gplus');
		getsocial(domain_name,'pinterest');
	});
	
	
	function getsocial(domain_name,social){
		$.getJSON('http://manage.vnoc.com/socialmedia/getDomainSocialsAPI/'+domain_name+'/'+social,function(data){
						var socialdata = data[0];
						if(socialdata.error == true){
							//do nothing
						}else if(socialdata.profile_url == ""){
							//do nothing
						}else if(socialdata.profile_url == "null" || socialdata.profile_url == null){
							//do nothing
						}else{
							$('#socials_container').append('<a href="'+socialdata.profile_url+'"><img src="http://domaindirectory.com/servicepage/css/images/'+social+'.png"></a>');
						}		
		});
	}

</script>


</body>
</html>