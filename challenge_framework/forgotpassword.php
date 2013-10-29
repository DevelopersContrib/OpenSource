<?include('header.php');?>
<script type="text/javascript" src="/js/loginVerify.js"></script>
	<div class="container">
	<div class="row-fluid">
		<div class="span12" style="background-color: #fff;border-radius:10px;min-height: 400px;margin: 30px 0 30px 0;padding:20px;border:1px solid rgb(231, 231, 231)">
			
			<div class="form-box" style="margin:0 130px">
				<h1>Forgot Password</h1>
				<div id="log-loading" style="color:red;display:none">
									<img src="http://<?=$domain?>/images/loading-red.gif">Checking...
				</div>
				<div class="message-info" id="intro" style="height:43px"><span>Provide your email address and we will send your login data.</span></div>
				<form action = "javascript:sendPassword();">
					<div class="form-box-hold">
						<div class="form-box-text">EMAIL:</div>
						<div class="form-box-input"><input name="forgot_password_email" id="forgot_password_email" type="text" /></div>
					</div>

					<div class="form-box-hold">
						<div class="form-box-text">&nbsp;</div>
						<div class="form-box-input">
								<button type="submit" class="btn" />SUBMIT</button>
						</div>
					</div>
						
				</form>
			</div><!--form-box -->
			
			<div>
				<br><br>
				<img src="http://d2qcctj8epnr7y.cloudfront.net/images/marvinpogi/desc-mychallenge1.png">
			</div>
		
			
		
		</div>
	</div>
</div>
<?include('footer.php');?>