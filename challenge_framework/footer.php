


</div><!--wrap -->  

<div class="container-fluid footer-bckgrnd">
	<div class="row-fluid">
		<div class="container">
      <div class="row-fluid">
         	 <?php if ($footer_banner!=""):?>
			            <div class="footer-banner">
							<?php echo $footer_banner?>
						</div><!-- ads div -->
              <?php endif;?>
      </div>
			<div class="row-fluid">
				<div class="wrap-site-map">
					<div class="site-map">
						<a href="<?=$siteurl?>/about.html">About</a>
						<a href="<?=$siteurl?>/howtosponsor.html">How to Sponsor</a>
						<a href="<?=$siteurl?>">Home</a>
            	<?if(!isset($_SESSION['Username'])){?>
						<a href="<?=$siteurl?>/login.html">Login</a>
						<a href="<?=$siteurl?>/register.html">Register</a>
            	<?}?>
						<a href="<?=$siteurl?>/staffing.html">We're Hiring</a>
						<a href="<?=$siteurl?>/contact.html">Contact us</a>
					</div>
					<div class="legal">
						<span class="copyright">&copy; <?=date("Y")?> <?=ucfirst($sitename)?></span>
						<a href="/policy.html">Privacy Policy</a>
						<a href="/terms.html">Terms and Conditions</a>
						<a href="/sitemap.html">Sitemap</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?=$siteurl?>/js/clear_textbox.js"></script>
<script type="text/javascript" src="<?=$siteurl?>/js/jcarousellite.js"></script>
<script type="text/javascript" src="<?=$siteurl?>/js/jcarousellite-set.js"></script>
<script src="<?=$siteurl?>/js/bootstrap.min.js"></script>
</body>
</html>