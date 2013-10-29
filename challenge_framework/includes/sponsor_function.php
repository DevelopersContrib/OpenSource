<?php
	
	class SPONSORDIR extends DIR_LIB{
		
		function SendMail($to,$from, $message, $username,$username_from){
			global $sitename;
			global $logo;
			
			include('email_class.php');
			$em = new EmailTemplate;
			
			
			$subject = ucfirst($sitename)." Challenge Sponsorship";
			$headers = "From: ".$username_from." ".$from."\r\n".'X-Mailer: PHP/' . phpversion();
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
			
			$email_message = "Hi ".$username.",<br /><br /> ".ucfirst($username_from)." has submitted sponsorship. And sent the message:
						<br /><br />
						$message
						<br /><br />
						<b>".$sitename."</b>";
						
			$emailmessage = $em->get($logo,$sitename, $email_message);
			
			/*first send to guest */
			if (mail($to,$subject,$emailmessage,$headers)){
				return true;
			}else {
				return false;
			}
	        		
			
	
		} //sendemailVerification
	
		function saveSponsor($type,$message,$sponsorid,$challengeid,$emailsponsor,$sponsor_name,$sponsor_url,$image,$amount=""){
			global $domainid;

		$owner_id = $this->GetInfo('Challenges', 'CompanyId', 'ChallengeId', $challengeid,$s);	
		$saved = mysql_query("INSERT INTO SponsorContact(SponsorshipType,ChallengeId,SponsorId,Message,Amount,DateSubmit,SponsorName,SponsorUrl,SponsorImage) VALUES('".$type."','".$challengeid."','".$sponsorid."','".$message."','".$amount."',NOW(),'".$sponsor_name."','".$sponsor_url."','".$image."')");
		if(!$saved){
			echo "An error occurred. Please try again. <br>Error: ".mysql_error();
		}else{
				
			  
				if($emailsponsor == '1'){
					
					$to = $this->GetUserInfo('Email', $owner_id);
					$username = $this->GetUserInfo('Username',$owner_id);
					$from = $this->GetUserInfo('Email', $sponsorid);
					$username_from = $this->GetUserInfo('Username',$sponsorid);
					
					if ($this->SendMail($to,$from, $message, $username,$username_from)===true){
						return true;
					}else {
						return false;
					}
					
				}else {
					return true;
				}
				
			
		  }
		}
		
		function updateSponsor($sponsorid,$type,$message,$challengeid,$sponsor_name,$sponsor_url,$image,$amount=""){
				$saved = mysql_query("Update SponsorContact set SponsorshipType='$type',
				Message='$message',Amount='$amount',SponsorName='$sponsor_name',SponsorUrl='$sponsor_url',
				SponsorImage='$image' where SponsorshipId = $sponsorid");
				
				if(!$saved){
					echo "An error occurred. Please try again. <br>Error: ".mysql_error();
					return false;
				}else {
					return true;
				}
		}
	}
?>