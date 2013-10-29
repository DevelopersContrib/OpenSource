<?include('header.php');?>
<script type="text/javascript" src="/js/loginVerify.js"></script>
<div class="container">
	<div class="row-fluid">
		<div class="span12" style="background-color: #fff;border-radius:10px;min-height: 400px;margin: 30px 0 30px 0;padding:20px;border:1px solid rgb(231, 231, 231)">
		
		
			<div style="margin:0 130px">
				<?php
					$verification_code = $_GET['code'];
					
					$checkIfEmailVerified = $dir->CheckIfVerified($verification_code);
					if($checkIfEmailVerified == true){
						?>
							
							<div class="form-box" style="margin:0 130px">
								<h1>LOGIN NOW</h1>
								<p style="color:blue;font-size:14px;">You successfully verified your email!</p>
								<form action = "javascript:loginVerify();">
									<div class="form-box-hold">
										<div class="form-box-text">USERNAME:</div>
										<div class="form-box-input"><input name="username" id="username" type="text" /></div>
									</div>
									<div class="form-box-hold">
										<div class="form-box-text">PASSWORD:</div>
										<div class="form-box-input"><input name="password" id="password" type="password" /></div>
									</div>
									<div class="form-box-hold">
										<div class="form-box-right">
											<span class="form-check"><input name="" type="checkbox" value="" /></span> 
											Remember me 
											<span class="form-space">|</span>
											<a href="forgotpassword.html">Forgot Password?</a>
										</div>
									</div>
									<div class="form-box-hold">
										<div class="form-box-right">Don't have account? <a href="register.html" class="form-link">Register here</a></div>
									</div>
									<div class="form-box-hold">
										<div class="form-box-text">&nbsp;</div>
										<div class="form-box-right">
												<input type="hidden" name="domainid" id="domainid" size="20" value="<?=$domainid?>" />
												<input type="hidden" name="domainidUrl" id="domainUrl" size="20" value="<?=$domainUrl?>" />
												<button type="submit" class="btn btn-info" />LOGIN</button>
												<span id="log-loading" style="color:red;display:none">
													<img src="http://<?=$domain?>/images/loading-red.gif">Checking...
												</span>
												<span class="form-warning"></span>
										</div>
									</div>
								</form>
							</div><!--form-box -->
						<?
					}else{
						?>
							<p style="color:red">
								Verification failed.
							</p>
						<?
					}
				?>
			</div>
			
			<div>
				<br><br>
				<img src="http://d2qcctj8epnr7y.cloudfront.net/images/marvinpogi/desc-mychallenge1.png">
			</div>
		
			
		
		</div>
	</div>
</div>

<?include('footer.php');?>