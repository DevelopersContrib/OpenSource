$(document).ready(function(){
	
});

function sendPassword(){
	$('#log-loading').css('display','block');
	$('#log-loading').html('<img src="/images/loading-red.gif">Checking...');
	
	var email = $('#forgot_password_email').val();
	if(email == ""){
		$('#log-loading').html('<div class="message-error"><span>It&rsquo;s either you&rsquo;re a scumbag or just testing.<br /> Eitherway, please enter an email address before hitting the submit button.</span></div>');
		$('#email').focus();
	}else if(validateEmail(email) == false){
		$('#log-loading').html('<div class="message-error"><span>The email you entered is invalid.</span></div>');
		$('#email').focus();
	}else{
		$('#log-loading').css('display','block');
		$('#log-loading').html('<img src="/images/loading-red.gif">Checking...');
		
		$.post('/includes/forgot_password.php',{email:email},function(data){
			if(data == "OK"){
				$('#intro').hide("slow");
				$('#log-loading').html('<div class="message-success"><span>Please check your email for your login access.</span></div>');
			}else{
				$('#log-loading').html('<div class="message-error"><span>'+data+'</span></div>');
			}
		});
	}
	
}


function loginVerify(){
	$('#log-loading').css('display','block');
	$('#log-loading').html('<img src="/images/loading-red.gif">Checking...');
	
	var username = $('#username').val();
	var password = $('#password').val();
	
	if(username == "" || password == ""){
		$('#log-loading').html('<div class="message-warning"><span>Provide username and password</span></div>');
	}else{
		$.post('/includes/login_attempt.php',
		{username:username,password:password},
		function(data){
			if(data == "1"){
				window.location.replace("/home.html");
			}else if(data == "2"){
				$('#log-loading').html('<div class="message-error"><span>Account not yet verified</span></div>');
			}else if(data == "3"){
				$('#log-loading').html('<div class="message-error"><span>Username and password do not match. Try again.</span></div>');
			}else{
				$('#log-loading').html('<div class="message-error"><span>An error ocurred: '+data+'</span></div>');
			}
		});
	}
	
}


function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}