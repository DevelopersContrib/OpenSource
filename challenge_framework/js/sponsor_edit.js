$(function(){
	$("input[name$='sponsorship']").click(function() {
		$('#def').css('display','none');
		var choice = $(this).val();
		if(choice == 1){
			$('#type_1').css('display','block');
			$('#type_2').css('display','none');
			
			$('#hiddentype').val(1);
		}
		else if(choice == 2){
			$('#type_1').css('display','none');
			$('#type_2').css('display','block');
			$('#hiddentype').val(2);
		}
		
		$('#submit').show();
		$('#btn-check').show();
  });
});

function updateSponsorship(){
	
	 
	$('#log-loading').css('display','block');
	$('.message-error').css('display','none');
	
	var sponsortype =  $("input[type='radio']#sponsorship:checked").val();
	var amount = $("#amount").val();
	var chall_id = $('#chall_id').val();
	
	var message = $('#message_type'+sponsortype).val();
	var slug = $('#slug').val();
	var sponsor_name = $('#sponsor_name').val();
	var sponsor_url = $('#sponsor_url').val();
	var sponsor_id = $('#sponsor_id').val();
	var siteurl = $('#siteurl').val();
	var files = ''; 
	var numbers = /^[0-9.]+$/; 
	var letters = /^[a-zA-Z. ]+$/; 
	var urlpatt = /^[a-zA-Z.:\/ ]+$/; 
	
    var success = '<div class="alert  alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><center><strong>You successfully updated sponsorship!</strong><br><a href="'+siteurl+'/challenge/'+slug+'"> View Challenge</a><br><a href="'+siteurl+'/sponsor/edit/'+slug+'/'+sponsor_id+'"> Edit sponsorship</a></center></div>'; 
	    $('.files p').each(function() {
	  	    files += jQuery(this).text()+",";
		});
	
	
	    if (files == ""){
	    	files = $('#spic').attr('src');
	    }
	
	
   if (sponsortype == '1'){
	   if (sponsor_name==""){
		    $('#log-loading').hide();
			$('#error1').show();
			$('#error1').html('<span>Please enter sponsor name.</span>');
			$('#sponsor_name').focus();
	   }else if(!letters.test(sponsor_name)){
		    $('#log-loading').hide();
			$('#error1').show();
			$('#error1').html('<span>Please enter a valid name. Invalid characters found.</span>');
			$('#sponsor_name').focus();
	   }else if (sponsor_url==""){
		    $('#log-loading').hide();
			$('#error2').show();
			$('#error2').html('<span>Please enter sponsor url.</span>');
			$('#sponsor_url').focus();	  
		}else if (!urlpatt.test(sponsor_url)){
		    $('#log-loading').hide();
			$('#error2').show();
			$('#error2').html('<span>Please enter a valid url.</span>');
			$('#sponsor_url').focus();	   		
	   }else if(amount == ""){
			$('#log-loading').hide();
			$('#error3').show();
			$('#error3').html('<span>Please enter amount.</span>');
			$('#amount').focus();
		}else if(!numbers.test(amount)){
			$('#log-loading').hide();
			$('#error3').show();
			$('#error3').html('<span>Please enter a valid amount. Invalid characters found.</span>');
			$('#amount').focus();			
		}else if (message == ""){
			$('#log-loading').hide();
			if(sponsortype=='1'){
				$('#error4').show();
				$('#error4').html('<span>Please enter message.</span>');
			}else{
				$('#error5').show();
				$('#error5').html('<span>Please enter message.</span>');
			}
			$('#message_type'+sponsortype).focus();			
		}else {
			$('.message-error').hide();
			$.post("/includes/updatesponsorship.php",
					{
					type:sponsortype,
					message:message,
					amount:amount,
					challengeid:chall_id,
					sponsor_name:sponsor_name,
					sponsor_url:sponsor_url,
					sponsor_id:sponsor_id,
					image:files
					
					},function(data){
					        $('#log-loading').hide();
							$('.message-success').show();
							$('.message-success').html(success);
							$('#sponsorform').hide();
							
					  
				});
		}
		
   }else {
	   if (sponsor_name==""){
		    $('#log-loading').hide();
			$('.message-error').show();
			$('.message-error').html('<span>Please enter sponsor name.</span>');
			$('#sponsor_name').focus();
	   }else if (sponsor_url==""){
		    $('#log-loading').hide();
			$('.message-error').show();
			$('.message-error').html('<span>Please enter sponsor url.</span>');
			$('#sponsor_url').focus();
	   		
	   }else if (message == ""){
		    $('#log-loading').hide();
			$('.message-error').show();
			$('.message-error').html('<span>Please enter message.</span>');
			$('#message_type'+sponsortype).focus();
			return false;
		}else {
			$('.message-error').hide();
			$.post("/includes/updatesponsorship.php",
					{
					type:sponsortype,
					message:message,
					amount:amount,
					challengeid:chall_id,
					sponsor_name:sponsor_name,
					sponsor_url:sponsor_url,
					sponsor_id:sponsor_id,
					image:files
					},function(data){
					  if (data=="OK"){
						     $('#log-loading').hide();
							$('.message-success').show();
							$('.message-success').html(success);
							$('#sponsorform').hide();
							
					  }
				});
		}
	   
   }
	
	
	
			
}

