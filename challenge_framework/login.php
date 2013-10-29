<?include('header.php');?>
<script type="text/javascript" src="/js/loginVerify.js"></script>
<div class="container">
	<div class="row-fluid">
  	<div class="span12 bckgrnd-pages" style="min-height: 475px;">
    
      <div class="span6">  
      <br />
      <br />  
					<img src="http://d2qcctj8epnr7y.cloudfront.net/images/2013/desc-join-challenge1.png" alt="Join Challenges">
          <img src="http://d2qcctj8epnr7y.cloudfront.net/images/2013/desc-sponsor-challenge1.png" alt="Join Challenges">
          <br />
          <br />
	 </div>    
		 <div class="span4 offset2">
			 <br /><br />
      <div class="row"> 
      	<div class="well">
       <legend>Sign in to <?=ucwords($domain)?></legend>
				<div id="log-loading" style="color:red;display:none">
									<img src="http://<?=$domain?>/images/loading-red.gif">Checking...
				</div>
				<form action = "javascript:loginVerify();">
        <div class="row-fluid">
          <input placeholder="Username" class="span12" type="text" name="username" id="username">
          </div>
        <div class="row-fluid">
          
            <input placeholder="Password" class="span12"  type="password" name="password" id="password">
         </div>    
            <label class="checkbox">
                <input type="checkbox" name="remember" value="1"> Remember Me  &nbsp;|&nbsp;	<a href="forgotpassword.html">Forgot Password?</a>
            </label>
           <div class="row-fluid text-center">
           <small> Don't have an account? <a href="register.html" class="form-link">Register here</a></small>
           </div>
						
								<input type="hidden" name="domainid" id="domainid" size="20" value="<?=$domainid?>" />
								<input type="hidden" name="domainidUrl" id="domainUrl" size="20" value="<?=$domainUrl?>" />
				
            <button class="btn btn-info btn-block" type="submit">Login</button>      
	
					</div>
				</form>
		    <br />
      </div>  
     </div> 			
				
		</div>
	</div>
</div>

<?include('footer.php');?>