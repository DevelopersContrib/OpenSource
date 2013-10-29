$(function(){
	$("#regTABchallenger").click(function() {
		$('#regTABcompany').attr('class','');
		$(this).attr('class','active');
		$('#usertype').val('1');
		$('#regTABtitle').html('Register as CHALLENGER');
		
	});
	$('#regTABcompany').click(function(){
		$('#regTABchallenger').attr('class','');
		$(this).attr('class','active');
		$('#usertype').val('2');	
		$('#regTABtitle').html('Register as SPONSOR');
	
	});
});

function verifyRegistration(){
	$('#log-loading').css('display','block');
	$('#log-loading').html('<img src="http://wellnesschallenge.com/images/loading-red.gif">Checking...');
	
	var username = $('#username').val();
	var fname = $('#fname').val();
	var lname = $('#lname').val();
	var password1 = $('#password').val();
	var password2 = $('#password2').val();
	var email = $('#email').val();
	var country = $('#country').val();
	var usertype = $('#usertype').val();
	
	
	if(username == ""){
		$('#log-loading').html('<div class="message-error"><span>Please enter username.</span></div>');
		$('#username').focus();
	}else if(isValid_uname(username) == false){
		$('#log-loading').html('<div class="message-error" style="height: 40px;"><span>Please use only alphabets and numbers for your username.</span></div>');
		$('#username').focus();
	}else if(username.length>12){
		$('#log-loading').html('<div class="message-error" style="height: 40px;"><span>Please limit username characters to 12.</span></div>');
		$('#username').focus();
	}else if(fname == ""){
		$('#log-loading').html('<div class="message-error"><span>Please enter first name.</span></div>');
		$('#fname').focus();
	}else if(isValid_name(fname) == false){
		$('#log-loading').html('<div class="message-error" style="height: 40px;"><span>Invalid characters on first name.</span></div>');
		$('#fname').focus();
	}else if(lname == ""){
		$('#log-loading').html('<div class="message-error"><span>Please enter last name.</span></div>');
		$('#lname').focus();
	}else if(isValid_name(lname) == false){
		$('#log-loading').html('<div class="message-error" style="height: 40px;"><span>Invalid characters on last name.</span></div>');
		$('#lname').focus();
	}else if(password1 == ""){
		$('#log-loading').html('<div class="message-error"><span>Please enter password.</span></div>');
		$('#password').focus();
	}else if(password2 == ""){
		$('#log-loading').html('<div class="message-error"><span>Please confirm password.</span></div>');
		$('#password2').focus();
	}else if(password1 != password2){
		$('#log-loading').html('<div class="message-error"><span>Passwords do not match.</span></div>');
		$('#password').focus();
	}else if(validateEmail(email) == false){
		$('#log-loading').html('<div class="message-error"><span>Email you entered is invalid.</span></div>');
		$('#email').focus();
	}else{
		$.post('/includes/register_attempt.php',
		{username:username,fname:fname,lname:lname,password:password1,email:email,country:country,usertype:usertype},
		function(data){
			if(data == "OK"){
				$('.register').html('<p style="font-size:18px;color:blue;line-height:25px;">Congratulations!<br /><div class="message-success" style="height:55px;"><span style="line-height:20px">You successfully registered.<br />Please check your email for verification message.</span></div>');
			}else{
				$('#log-loading').html('<div class="message-error"><span>'+data+'</span></div>');
			}
		});
	}
	
}

function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function isValid_uname(str){
 return !/[ ~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
}

function isValid_name(str){
 return !/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
}
