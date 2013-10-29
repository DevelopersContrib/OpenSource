<?php
	session_start();
	
	require_once('config.php');
	
	class LoginDIR {
	
		function verifyLogin($username,$password){
			$query = MYSQL_QUERY("SELECT * FROM `ChallengeMembers` WHERE Username = '".$username."' AND Password = '".$password."' ") OR DIE(MYSQL_ERROR());
			if($query){
				if(MYSQL_NUM_ROWS($query) > 0){
					$result = "2";
					
					while( $row = MYSQL_FETCH_ARRAY($query) ){
						if($row['Verified'] == '1'){
							$result = "1";
							$_SESSION['Username'] = $row['Username'];
							$_SESSION['ChallengeMemberId'] = $row['ChallengeMemberId'];
							$_SESSION['UserType'] = $row['UserType'];
							$_SESSION['userid'] = $row['ChallengeMemberId'];
							
						}
					}
					
					return $result;
				}else{
					return "3";
				}
			}
		}
		
		function sendLoginDetails($email){
			global $sitename;
			global $logo;
			
			$query = MYSQL_QUERY("SELECT `Username`,`Password` FROM `ChallengeMembers` WHERE `Email` = '".$email."' ") OR DIE(MYSQL_ERROR());
			if($query){
				if(MYSQL_NUM_ROWS($query)){
					while($row =  MYSQL_FETCH_ARRAY($query)){
						$userpassword = $row['Password'];
						$username = $row['Username'];
					}
					
					
					/*send email*/
						
						include('email_class.php');
						$em = new EmailTemplate;
						
						$subject = ucfirst($sitename)." Login Details";
						$headers = "From: ".ucwords($sitename)." <admin@domaindirectory.com> \r\n".'X-Mailer: PHP/' . phpversion();
						$headers .= 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
						
						$email_message = $username.",<br /><br /> Thank you for your interest in joining our challenges.
									<br /><br />
									The following are your login data:
									<br>
									Username : <b>".$username."</b><br />
									Password : <b>".$userpassword."</b>
									<br /><br />
									Thank you.<br />
									<b>".$sitename."</b>";
									
						$emailmessage = $em->get($logo,$sitename, $email_message);
						
						/*first send to guest */
						$sentmail = mail($email,$subject,$emailmessage,$headers);
					
					/*end of send email*/
					
					return "OK";
				}else{
					return $email. "not found in database.";
				}
			}else{
				return "Email not found in database.";
			}
		}
		
	} //end of class
?>