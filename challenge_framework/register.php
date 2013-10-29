<?
session_start();
include ('includes/functions.php'); 
$dir = new DIR_LIB();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register - <?=ucwords($domain)?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="/css/sign-up.css"/>
	<link rel="stylesheet" href="/css/theme-<?=$color?>.css"/>
	<link rel="stylesheet" href="/css/bootstrap.css"/>
	<link rel="stylesheet" href="/css/bootstrap-responsive.css"/>
</head>
<body class="sign-up-bckgrnd">

<div class="container-fluid sign-up-bckgrnd">
	<div class="row-fluid">
		<form id="user-signup" class="form-horizontal">
			<div class="container">				
				<div class="row-fluid">
					<div class="row-fluid">
						<div class="wrap-links">
							<a href="/" class="pull-left links"><i class="icon-home icon-white"></i> Home</a>
							<a href="/login.html" class="pull-right links"><i class="icon-cog icon-white"></i> Login</a>
						</div>
					</div>
					<div id="signup-box">
						<header class="text-center">
							<h1>Sign up for <?=ucwords($domain)?></h1>							
							<h4 class="text-subtitle">			
							Now, you can harness the power of gamification to engage your community 
							<br>
							and get rewarded with ideas and solutions from the crowd by taking part on <?=ucwords($domain)?> challenges. 
							</h4>							
						</header>
						<div style="margin:0 auto; width:600px;">
							<div id="wrap1">
								<div class="control-group">
									<input type="text" id="username" placeholder="Username" />	
									<div id="load1" class="input_loader"></div>
									<div class="input_warning" id="warn1">Required</div>
								</div>
							</div>
							<div id="wrap2" style="display:none">
								<div class="control-group">
									<input type="text" id="fname" placeholder="First Name" value="<? echo $_SESSION['firstname'] ?>"/>
									<input type="hidden" id="provider" value="<? echo $_SESSION['provider'] ?>" />
									<input type="hidden" id="identifier" value="<? echo $_SESSION['identifier'] ?>" />
									<div id="load2" class="input_loader"></div>
									<div class="input_warning" id="warn2">Required</div>
									<input type="hidden" id="fname_check" value="false">
								</div>
								<div class="control-group">
									<input type="text" id="lname" placeholder="Last Name" value="<? echo $_SESSION['lastname'] ?>" />
									<div id="load3" class="input_loader"></div>
									<div class="input_warning" id="warn3">Required</div>
									<input type="hidden" id="lname_check" value="false">								
								</div>
							</div>
							<div id="wrap3" style="display:none">
								<div class="control-group">
									<input type="text" id="email" placeholder="E-mail" value="<? echo $_SESSION['email']?>" />
									<div id="load4" class="input_loader"></div>
									<div class="input_warning" id="warn4">Required</div>
									<input type="hidden" id="email_check" value="false">								
								</div>
								<div class="control-group">
									<select id="country"><option value="">Country</option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Antarctica">Antarctica</option><option value="Antigua Barbuda">Antigua Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia Herzegovina">Bosnia Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option><option value="Brazil">Brazil</option><option value="British Indian">British Indian</option><option value="British Virgin Islands">British Virgin Islands</option><option value="Brunei">Brunei</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Rep">Central African Rep</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option><option value="Cocos Islands">Cocos Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo">Congo</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="East Timor">East Timor</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Falkland Islands">Falkland Islands</option><option value="Faroe Islands">Faroe Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern">French Southern</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard/McDonald Islands">Heard/McDonald Islands</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Ivory Coast">Ivory Coast</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macau">Macau</option><option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia">Micronesia</option><option value="Moldova">Moldova</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Myanmar">Myanmar</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="North Korea">North Korea</option><option value="Northern Mariana">Northern Mariana</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn Island">Pitcairn Island</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option><option value="Romania">Romania</option><option value="Russia">Russia</option><option value="Rwanda">Rwanda</option><option value="S. Georgia/S. Sandwich">S. Georgia/S. Sandwich</option><option value="Saint Kitts &amp; Nevis">Saint Kitts &amp; Nevis</option><option value="Saint Lucia">Saint Lucia</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia and Montenegro">Serbia and Montenegro</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Korea">South Korea</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="St. Helena">St. Helena</option><option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option><option value="St. Vincent Grenadines">St. Vincent Grenadines</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard Jan May. Islnd">Svalbard Jan May. Islnd</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syria">Syria</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks/Caicos Islands">Turks/Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="U.S. Min.Outlying Islands">U.S. Min.Outlying Islands</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="United States of America">United States of America</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Vatican City">Vatican City</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnam</option><option value="Virgin Islands">Virgin Islands</option><option value="Wallis/Futuna Islands">Wallis/Futuna Islands</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Zaire">Zaire</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option></select>
									<div id="load5" class="input_loader" style="margin: -33px 45px 0 0;"></div>
									<div class="input_warning" id="warn5">Required</div>
									<input type="hidden" id="country_check" value="false">
								</div>
							</div>
							<div id="wrap4" style="display:none">
								<div class="control-group">
									<input type="password" id="pass" placeholder="Password"/>		
									<div id="load6" class="input_loader"></div>
									<div class="input_warning" id="warn6">Required</div>
									<input type="hidden" id="pass_check" value="false">
								</div>
								<div class="control-group">
									<input type="password" id="cpass" placeholder="Confirm Password"/>	
									<div id="load7" class="input_loader"></div>
									<div class="input_warning" id="warn7">Required</div>
									<input type="hidden" id="cpass_check" value="false">
								</div>
							</div>					
							<div id="wrap5" style="display:none;margin-top: -25px;">
								<ul class="ca-menu">                    
									<li id="challenger" style="margin-left:2%">
										<a href="javascript:;" >
										 <span class="ca-icon">H</span>
											<div class="ca-content">
												<h2 class="ca-main">Take the Challenge?</h2>
											</div>
										</a>
																   
									</li>
									<li id="sponsor">
										<a href="javascript:;" >
											<span class="ca-icon" id="heart">N</span>
											<div class="ca-content">
												<h2 class="ca-main">Sponsor a Challenge?</h2>
											</div>
										</a>
									</li>	
								</ul>
								<input type="hidden" id="type" value="">
							</div>		
							<div class="control-group">
								<div style="text-align: center;">
									<button class="btn btn-warning btn-large next" id="next1" disabled="disabled"> Next <b>&gt;&gt;</b></button>
									<button class="btn btn-warning btn-large next" id="next2" disabled="disabled" style="display:none">Next <b>&gt;&gt;</b></button>
									<button class="btn btn-warning btn-large next" id="next3" disabled="disabled" style="display:none">Next <b>&gt;&gt;</b></button>
									<button class="btn btn-warning btn-large next" id="next4" disabled="disabled" style="display:none;">Next <b>&gt;&gt;</b></button>
									<button class="btn btn-warning btn-large next" id="next5" disabled="disabled" style="display:none;margin-top: 50px;">Next <b>&gt;&gt;</b></button>
									<img src="http://www.contrib.com/images/loadingAnimation.gif" id="f_loader" style="display:none;"/>
								</div>
							</div>
						</div>
					</div>
					<div id="result-box" style="display:none">
						<header class="text-center">
							<h1>Registration Complete!</h1>							
							<h4 class="text-subtitle">			
							You successfully registered to <?=ucwords($domain)?>. Please check your email to verify your account. Thank you!
							</h4>							
						</header>
					</div>
					<div id="error-box" style="display:none">
						<header class="text-center">
							<h1>Something went wrong...</h1>							
							<h4 class="text-subtitle" id="error-msg"></h4>
							<h4 class="text-subtitle">			
								<a href="/register.html">TRY AGAIN</a>
							</h4>							
						</header>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
$(function(){
	var request;
	var letters = /^[a-zA-Z ]+$/; 
	var alphanumeric = /^[a-zA-Z0-9]+$/; 
	var emailfilter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	$('#username').focus();
	
	$('.input_warning').hide();
	
	$('#username').keyup(function(){
		var uname = $(this).val();
		$('#warn1').hide();
		$('#load1').html('<img src="http://manage.vnoc.com/images/loaders/loader3.gif">');		
		$('#next1').attr('disabled','disabled');
		
		if(typeof request !== 'undefined') {
			request.abort();
		}
		
		if(uname==''){
			$('#warn1').show();
			$('#warn1').html('Username is required.');
			$('#load1').html('');	
		}else if(!alphanumeric.test(uname)){
			$('#warn1').show();
			$('#warn1').html('Invalid characters found. Letters and numbers only.');
			$('#load1').html('');
		}else{
			request = $.post('/includes/checkusername.php',{uname:uname},function(res){
				if(res=='true'){
					$('#warn1').show();
					$('#warn1').html(' Username already taken. Please try a different one.');
					$('#load1').html('');	
				}else{
					$('#load1').html('<i class="icon-ok"></i>');
					$('#next1').removeAttr('disabled');
				}							
			});
		}
		
	});


	$('#fname').keyup(function(){
		var fname = $(this).val();
		var lname_check = $('#lname_check').val();
		
		$('#warn2').hide();
		$('#load2').html('<img src="http://manage.vnoc.com/images/loaders/loader3.gif">');	
		$('#next2').attr('disabled','disabled');
		
		if(fname==''){
			$('#warn2').show();
			$('#warn2').html('First name is required.');
			$('#load2').html('');
		}else if(fname.replace(/ /g,'')==''){
			$('#warn2').show();
			$('#warn2').html('First name should NOT consists of only spaces. Try again.');
			$('#load2').html('');
		}else if(!letters.test(fname)){
			$('#warn2').show();
			$('#warn2').html('Invalid characters found. Letters and spaces only.');
			$('#load2').html('');			
		}else{
			$('#load2').html('<i class="icon-ok"></i>');
			$('#fname_check').val('true');
			if(lname_check=='true'){
				$('#next2').removeAttr('disabled');
			}
		}
		
	});

	<?php if ($_SESSION['firstname']!=""):?>
	   $('#fname').keyup();
	<?php endif?>
	
	
	$('#lname').keyup(function(){
		var lname = $(this).val();
		var fname_check = $('#fname_check').val();
		$('#next2').attr('disabled','disabled');
		
		$('#warn3').hide();
		$('#load3').html('<img src="http://manage.vnoc.com/images/loaders/loader3.gif">');	
		
		if(lname==''){
			$('#warn3').show();
			$('#warn3').html('Last name is required.');
			$('#load3').html('');
		}else if(lname.replace(/ /g,'')==''){
			$('#warn3').show();
			$('#warn3').html('Last name should NOT consists of only spaces. Try again.');
			$('#load3').html('');
		}else if(!letters.test(lname)){
			$('#warn3').show();
			$('#warn3').html('Invalid characters found. Letters and spaces only.');
			$('#load3').html('');
		}else{
			$('#load3').html('<i class="icon-ok"></i>');
			$('#lname_check').val('true');
			if(fname_check=='true'){
				$('#next2').removeAttr('disabled');
			}
		}	
	});


	<?php if ($_SESSION['lastname']!=""):?>
	   $('#lname').keyup();
	<?php endif?>
	
	
	$('#email').keyup(function(){
		var email = $(this).val();
		var country_check = $('#country_check').val();
		$('#next3').attr('disabled','disabled');
		
		$('#warn4').hide();
		$('#load4').html('<img src="http://manage.vnoc.com/images/loaders/loader3.gif">');	
		
		if(typeof request !== 'undefined') {
			request.abort();
		}
		
		if(email==''){
			$('#warn4').show();
			$('#warn4').html('Last name is required.');
			$('#load4').html('');
		}else if(!emailfilter.test(email)){
			$('#warn4').show();
			$('#warn4').html('Invalid email format found.');
			$('#load4').html('');
		}else{
			request = $.post('/includes/checkemail.php',{email:email},function(res){
				if(res=='true'){
					$('#warn4').show();
					$('#warn4').html(' Email already registered. Please try a different one or login with the registered email.');
					$('#load4').html('');	
				}else{					
					$('#load4').html('<i class="icon-ok"></i>');
					$('#email_check').val('true');
					if(country_check=='true'){
						$('#next3').removeAttr('disabled');
					}
				}							
			});
		}
	});

	<?php if ($_SESSION['email']!=""):?>
	   $('#email').keyup();
	<?php endif?>
	
	
	$('#country').change(function(){
		var country = $(this).val();
		var email_check = $('#email_check').val();
		$('#next3').attr('disabled','disabled');
		
		$('#warn5').hide();
		$('#load5').html('<img src="http://manage.vnoc.com/images/loaders/loader3.gif">');	
		
		if(country==''){
			$('#warn5').show();
			$('#warn5').html('Choose your country.');
			$('#load5').html('');
		}else{
			$('#load5').html('<i class="icon-ok"></i>');
			$('#country_check').val('true');
			if(email_check=='true'){
				$('#next3').removeAttr('disabled');
			}
		}
	});
	
	$('#pass').keyup(function(){
		var pass = $(this).val();
		var cpass_check = $('#cpass_check').val();
		$('#next4').attr('disabled','disabled');
		
		$('#warn6').hide();
		$('#load6').html('<img src="http://manage.vnoc.com/images/loaders/loader3.gif">');	
		
		if(pass==''){
			$('#warn6').show();
			$('#warn6').html('Password is required.');
			$('#load6').html('');
		}else if(pass.replace(/ /g,'')==''){
			$('#warn6').show();
			$('#warn6').html('Password should NOT consists of only spaces. Try again.');
			$('#load6').html('');
		}else if(!alphanumeric.test(pass)){
			$('#warn6').show();
			$('#warn6').html('Invalid characters found. Letters and numbers only.');
			$('#load6').html('');
		}else{
			$('#load6').html('<i class="icon-ok"></i>');
			$('#pass_check').val('true');
			if(cpass_check=='true'){
				$('#next4').removeAttr('disabled');
			}
		}	
	});
	
	$('#cpass').keyup(function(){
		var pass = $('#pass').val();
		var cpass = $(this).val();
		var pass_check = $('#pass_check').val();
		$('#next4').attr('disabled','disabled');
		
		$('#warn7').hide();
		$('#load7').html('<img src="http://manage.vnoc.com/images/loaders/loader3.gif">');	
		
		if(cpass==''){
			$('#warn7').show();
			$('#warn7').html('Password is required.');
			$('#load7').html('');
		}else if(!alphanumeric.test(cpass)){
			$('#warn7').show();
			$('#load7').html('');
			$('#warn7').html('Invalid characters found. Letters and numbers only.');
		}else if(pass!=cpass){
			$('#warn7').show();
			$('#load7').html('');
			$('#warn7').html('Confirm password did not match.');
		}else{
			$('#load7').html('<i class="icon-ok"></i>');
			$('#cpass_check').val('true');
			if(pass_check=='true'){
				$('#next4').removeAttr('disabled');
			}
		}	
	});

	$('#challenger, #sponsor').click(function(){
		var type = $(this).attr('id');
		$(this).addClass('active');
		
		if(type=='challenger')
			$('#sponsor').removeClass('active');
		else
			$('#challenger').removeClass('active');
			
		$('#type').val(type);
		$('#next5').removeAttr('disabled');
		
	});
	
	$('.next').click(function(){
		var id = $(this).attr('id');
		var btn = id.replace('next','');
		var nxt = parseInt(btn)+1;
		
		$('#wrap'+btn).hide();
		$('#wrap'+nxt).show();
		$('#next'+btn).hide();
		$('#next'+nxt).show();
		
		if(nxt==2)
			$('#fname').focus();
		else if(nxt==3)
			$('#email').focus();
		else if(nxt==4)
			$('#pass').focus();
		
		return false;
	});

	$('#next5').click(function(){
		var username = $('#username').val();
		var fname = $('#fname').val();
		var lname = $('#lname').val();
		var password1 = $('#pass').val();
		var password2 = $('#cpass').val();
		var email = $('#email').val();
		var country = $('#country').val();
		var type = $('#type').val();
		var provider = $('#provider').val();
		var identifier = $('#identifier').val();
		var usertype = 0;
		
		if(type=='challenger'){
			usertype = 1;
		}else if(type=='sponsor'){
			usertype = 2;
		}
		
		$('#next5').hide();
		$('#f_loader').show();
		
		$.post('/includes/register_attempt.php',
		{username:username,fname:fname,lname:lname,password:password1,email:email,country:country,usertype:usertype,provider:provider,identifier:identifier},
		function(data){
			if(data == "OK"){
				$('#signup-box').hide();
				$('#result-box').show();
			}else{
				$('#signup-box').hide();
				$('#error-msg').html('Error: '+data);
				$('#error-box').show();
			}
		});
	});
});
</script>
</body>
</html>