<?php
	include('config.php');
	
	class RegisterDIR{
		
		function registerSave($username,$fname,$lname,$password,$email,$country,$usertype){
			global $domainid;
			//check if username exists
			$query = MYSQL_QUERY("SELECT * FROM ChallengeMembers WHERE Username = '".$username."' ") OR DIE(MYSQL_ERROR());
			if(MYSQL_NUM_ROWS($query) > 0){
				return "Username you entered is already taken.";
			}else{
				$query = MYSQL_QUERY("SELECT * FROM ChallengeMembers WHERE Email = '".$email."' ") OR DIE(MYSQL_ERROR());
					if(MYSQL_NUM_ROWS($query) > 0){
						return "Email you entered is already registered.";
					}else{
						
						$verification_code = md5($email).$this->generateRandomString(5);
						$query = MYSQL_QUERY("INSERT INTO ChallengeMembers(Username,FirstName,LastName,Password,Email,Country,DomainId,UserType,Verified,VerificationCode,DateSigned)
						VALUES('".$username."','".$fname."','".$lname."','".$password."','".$email."','".$country."','".$domainid."','".$usertype."','0','".$verification_code."',NOW())") OR DIE(MYSQL_ERROR());
						
						$this->sendemailVerification($username,$email,$verification_code);
						
						return "OK";
					}
			}
		}
		
		
		function generateRandomString($length = 5) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, strlen($characters) - 1)];
			}
			return $randomString;
		}
		
		function sendemailVerification($username,$email,$verification_code){
			global $sitename;
			global $logo;
			
			include('email_class.php');
			$em = new EmailTemplate;
			
			$subject = ucfirst($sitename)." Registration";
			$headers = "From: ".ucwords($sitename)." <admin@domaindirectory.com> \r\n".'X-Mailer: PHP/' . phpversion();
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
			
			$email_message = $username.",<br /><br /> Thank you for your interest in joining our challenges.
						<br /><br />
						To verify your account, please click <a href='http://".$sitename."/verify.html?code=".$verification_code."'>here</a>.
						<br /><br />
						<b>".$sitename."</b>";
						
			$emailmessage = $em->get($logo,$sitename, $email_message);
			
			/*first send to guest */
			$sentmail = mail($email,$subject,$emailmessage,$headers);
			
			
			
		} //sendemailVerification
		
		
		function CheckIfVerified($code){                           
			$query = MYSQL_QUERY("SELECT `ChallengeMemberId` FROM `ChallengeMembers` WHERE VerificationCode = '".$code."' ") OR DIE(MYSQL_ERROR());
			if(MYSQL_NUM_ROWS($query) > 0){
				while($row = MYSQL_FETCH_ARRAY($query)){
					$member_id = $row['ChallengeMemberId'];
					$result = MYSQL_QUERY("UPDATE `ChallengeMembers` SET `Verified` = '1' WHERE `ChallengeMemberId` = '".$member_id."' ") OR DIE(MYSQL_ERROR());
				}
				return true;
			}else{
				return false;
			}
		}
		
	}
?>