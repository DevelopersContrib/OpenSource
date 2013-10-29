$(function(){
	$('#settings_form').submit(function(){
		var password1 = $('#password1').val();
		var password2 = $('#password2').val();
		if(password1 != password2){
			$('#settings_notif_error').html('<div class="message-warning"><span>Passwords don&rsquo;t match.</span></div>');
			return false;
		}else{
			return true;
		}
	});
});