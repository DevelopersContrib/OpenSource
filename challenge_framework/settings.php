<?php include('header.php');?>
<?

if(!isset($_SESSION['ChallengeMemberId']))
	echo '<script>window.location="index.html"</script>';

$save_result = "";
if(isset($_POST['submit_settings_button'])){
	$minibio = $_POST['minibio'];
	$website = $_POST['website'];
	$skypeid = $_POST['skypeid'];
	$password = $_POST['password1'];
	$country = $_POST['country'];
	$error_msg = "";
	
	$update_query = MYSQL_QUERY("UPDATE ChallengeMembers SET `Minibio` = '".$minibio."',`Website` = '".$website."',
	`SkypeID` = '".$skypeid."', `Country` = '".$country."',`Password` = '".$password."' WHERE `ChallengeMemberId` = '".$_SESSION['ChallengeMemberId']."' ") OR DIE(MYSQL_ERROR());
	
		if(file_exists($_FILES['uploadedfile']['tmp_name']) || is_uploaded_file($_FILES['uploadedfile']['tmp_name'])) {
			
						$filename  = basename($_FILES['uploadedfile']['name']);
						$extension = pathinfo($filename, PATHINFO_EXTENSION);
						$new       = $_SESSION['ChallengeMemberId'].'.'.$extension;

						$target_path = "images/";
						$target_path = $target_path.$new; 

			if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
				//call api
				/*
					http://mychallenge.com/api/upload.php?url=http://beta.wellnesschallenge.com/uploads/submission/files/file_1372337965_2.txt&type=file
					param types: 
					file, challenge, profile, application
				*/
				
				
				$target_path = $domainUrl.'/'.$target_path;
				
				$max_redirect = 3;  // Skipable: default => 3
				$client_file = new Curl_Client(array(

					CURLOPT_FRESH_CONNECT => 1,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_USERAGENT => ''

				), $max_redirect);
				$mychallenge_api = "http://mychallenge.com/api/upload.php?type=profile&url=".$target_path;
				$client_file->get($mychallenge_api);
					$result = $client_file->currentResponse('body');
					$file_arr = json_decode($result,true);
					$error = 0;
					
					if (!$file_arr['error']){
						$new_avatar_filename = $logo = $file_arr['url'];;
						$update_avatar = MYSQL_QUERY("UPDATE `ChallengeMembers` SET Photo = '".$new_avatar_filename."' WHERE ChallengeMemberId = '".$_SESSION['ChallengeMemberId']."' ") OR DIE(MYSQL_ERROR());
					}else{
						$error_msg = "Mychallenge API error.";
						$new_avatar_filename = $target_path;
						$update_avatar = MYSQL_QUERY("UPDATE `ChallengeMembers` SET Photo = '".$new_avatar_filename."' WHERE ChallengeMemberId = '".$_SESSION['ChallengeMemberId']."' ") OR DIE(MYSQL_ERROR());
					}
			} else{
				$error_msg = "There was an error uploading the file, please try again!";
			}	
		}
	
		
	
	
	
	if($update_query){
		$save_result = '<div class="message-success"><span>You successfully updated your profile. '.$error_msg.'</span></div>';
	}
	
	
}else{
	$minibio = $dir->GetUserInfo('Minibio',$_SESSION['ChallengeMemberId']);
	$website = $dir->GetUserInfo('Website',$_SESSION['ChallengeMemberId']);
	$skypeid = $dir->GetUserInfo('SkypeID',$_SESSION['ChallengeMemberId']);
	$password = $dir->GetUserInfo('Password',$_SESSION['ChallengeMemberId']);
	$country = $dir->GetUserInfo('Country',$_SESSION['ChallengeMemberId']);
	$photo_image = $dir->GetUserInfo('Photo',$_SESSION['ChallengeMemberId']);
}?>
<style>
/*SUBMISSION*/
.appli-box{margin-bottom:30px;line-height:20px}
.appli-box .in-name{width:100%}
.appli-box .in-desc{width:100%}
.appli-box #image-upload-gallery{padding: 10px 0 0 10px;background: #F6F6F6;overflow: hidden;border: 1px solid #CCC;margin-top: 10px;}
.appli-box #image-upload-gallery li{position: relative;float: left;margin: 0 13px 13px 0;line-height: 0;cursor: move;}
.appli-sidebar{width: 230px;float: right;border-left: 2px solid #CCC;padding-left: 10px;min-height: 690px;}
h5 { font-size:15px !important;}
.appli-box span{font-size:12px !important;}
</style>
<script type="text/javascript" src="/js/settings.js"></script>
<div class="container">
	<div class="row-fluid">
		<div class="span12" style="background-color: #fff;border-radius:10px;min-height: 400px;margin: 30px 0 30px 0;padding:20px;border:1px solid rgb(231, 231, 231)">
			
			<div class="span8">
			
				<div class="row-fluid">
					<a href="/home.html" class="brdcrmb-link-deco">Home</a> 
					<b class="brdcrmb-meta-arrw">&raquo;</b> 
					<span class="brdcrmb-active">Account Settings</span>
				</div>
			
					<div class="row-fluid">
							
							<div class="row-fluid">
								<h3 class="left-content-title">Account Settings</h3>
								<br>
								<div id="settings_notif"><?=$save_result?></div>
								<br>
								<form action="#" enctype="multipart/form-data" id="settings_form" method="POST">
									<div class="appli-box">
										<h5>Username</h5>
										<span>This value is required and can not be changed.</span><br>
										<input type="text" name="appli-name" id="appli-name" class="in-name" value="<?=$_SESSION['Username']?>" disabled/>
									</div>
									
									<div class="appli-box">
										<h5>Background </h5>
										<span>Provide a description of yourself.</span><br>
										<textarea name="minibio" id="minibio" class="in-desc" style="height: 150px;"><?=$minibio?></textarea>
									</div>
									
									<div class="appli-box">
										<h5>Website</h5>
										<span>URL of your website (If any)</span><br>
										<input type="text" name="website" id="website" class="in-name" value="<?=$website?>" />
									</div>
									
									<div class="appli-box">
										<h5>Skype ID</h5>
										<span>You may also share your skype ID.</span><br>
										<input type="text" name="skypeid" id="skypeid" class="in-name" value="<?=$skypeid?>" />
									</div>
									
									<div class="appli-box">
										<h5>Country</h5>
										<span>Select your country</span><br>
										<select id="country" name="country"><option value="<?=$country?>"><?=$country?></option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Antarctica">Antarctica</option><option value="Antigua Barbuda">Antigua Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia Herzegovina">Bosnia Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option><option value="Brazil">Brazil</option><option value="British Indian">British Indian</option><option value="British Virgin Islands">British Virgin Islands</option><option value="Brunei">Brunei</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Rep">Central African Rep</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option><option value="Cocos Islands">Cocos Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo">Congo</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="East Timor">East Timor</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Falkland Islands">Falkland Islands</option><option value="Faroe Islands">Faroe Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern">French Southern</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard/McDonald Islands">Heard/McDonald Islands</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Ivory Coast">Ivory Coast</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macau">Macau</option><option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia">Micronesia</option><option value="Moldova">Moldova</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Myanmar">Myanmar</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="North Korea">North Korea</option><option value="Northern Mariana">Northern Mariana</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn Island">Pitcairn Island</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option><option value="Romania">Romania</option><option value="Russia">Russia</option><option value="Rwanda">Rwanda</option><option value="S. Georgia/S. Sandwich">S. Georgia/S. Sandwich</option><option value="Saint Kitts &amp; Nevis">Saint Kitts &amp; Nevis</option><option value="Saint Lucia">Saint Lucia</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia and Montenegro">Serbia and Montenegro</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Korea">South Korea</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="St. Helena">St. Helena</option><option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option><option value="St. Vincent Grenadines">St. Vincent Grenadines</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard Jan May. Islnd">Svalbard Jan May. Islnd</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syria">Syria</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks/Caicos Islands">Turks/Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="U.S. Min.Outlying Islands">U.S. Min.Outlying Islands</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="United States of America">United States of America</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Vatican City">Vatican City</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnam</option><option value="Virgin Islands">Virgin Islands</option><option value="Wallis/Futuna Islands">Wallis/Futuna Islands</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Zaire">Zaire</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option></select>
									</div>
									
									<div class="appli-box">
										<h5>Profile Avatar</h5>
										<span>Upload your profile avatar.</span><br>
										<input type="file" name="uploadedfile" id="uploadedfile" class="in-name" value="<?=$_SESSION['Username']?>" />
										<?php 
										if ($photo_image != ""){
											echo '<img src="'.$photo_image.'" style="border: 3px solid #EEEEEE;height: 100px;width: 100px;">';
										}
										?>
									</div>
									
									<div class="appli-box">
										<h5>Password</h5>
										<span>Enter your preferred new password.</span><br>
										<input type="password" name="password1" id="password1" class="in-name" value="<?=$password?>" />
									</div>
									
									<div class="appli-box">
										<h5>Confirm Password</h5>
										<span>Verify your new password.</span><br>
										<input type="password" name="password2" id="password2" class="in-name" value="<?=$password?>" />
									</div>
									
									<div id="settings_notif_error"></div>
									<button name="submit_settings_button" class="btn btn-info">Save Changes</button>
								</form>
							</div>
					  </div>
				</div><!--Left content-->
			
			<div class="span4">
			<? include('sidebar.php'); ?>
			</div>
		</div>
	</div>
</div>

<?include('footer.php');?>