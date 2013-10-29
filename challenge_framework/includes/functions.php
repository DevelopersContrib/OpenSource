<?
require_once(dirname(__FILE__) . '/config.php');

class DIR_LIB {

	function GetUserInfo($field,$userid){
		$sql = mysql_query("SELECT `$field` as result FROM `ChallengeMembers` WHERE `ChallengeMemberId` = '".$userid."' ") or die();
		
		while($row = mysql_fetch_array($sql)){
			$returnfield = $row['result'];
		}
		
		return $returnfield;
	}
	
	function GetTableInfo($table,$field,$wherefield,$val){
		$query = "SELECT `$field` as val FROM `$table` where `$wherefield` = '$val'";
		$result = mysql_query($query);
		if (!$result) {
      	$return = 'GetTableInfo:: Invalid query: ' . mysql_error();
		}else{
			$row = mysql_fetch_array($result);
			$return = $row['val'];
		}
		return $return;
	}

	function GetAllChallengers(){
		$result = mysql_query("SELECT * FROM `ChallengeMembers` where not Photo='' and UserType='1' order by DateSigned desc") or die();
		
			$returnval = array();
			
			while($row = mysql_fetch_array($result)){
				$data['username'] = $row['Username']; 
				$data['country'] = $row['Country']; 
				$data['photo'] = $row['Photo']; 
				
				$returnval[] = $data;				
			}
		
		return $returnval;
	}
	
	function GetChallenge($categoryid){
		$result = mysql_query("SELECT * FROM `Challenges` where CategoryId='$categoryid' and Approved='1'") or die();
		
			$returnval = array();
			
			while($row = mysql_fetch_array($result)){
				$data['id'] = $row['ChallengeId']; 
				$data['title'] = $row['ChallengeTitle']; 
				$data['desc'] = $row['ChallengeDesc']; 
				$data['photo'] = $row['Photo']; 
				
				$returnval[] = $data;				
			}
		
		return $returnval;
	}
	
	function GetMyChallenges($userid,$categoryid){
		$result = mysql_query("SELECT * FROM `Challenges` where CompanyId='$userid' and CategoryId='$categoryid' and Approved='1'") or die();
		
			$returnval = array();
			
			while($row = mysql_fetch_array($result)){
				$data['id'] = $row['ChallengeId']; 
				$data['title'] = $row['ChallengeTitle']; 
				$data['desc'] = $row['ChallengeDesc']; 
				$data['photo'] = $row['Photo']; 
				
				$returnval[] = $data;				
			}
		
		return $returnval;
	}
	
	function GetFeaturedChallenge($categoryid){
		$result = mysql_query("SELECT * FROM `Challenges` where CategoryId='$categoryid' and Approved='1' Order by RAND() limit 1") or die();
					
			while($row = mysql_fetch_array($result)){
				$companyID = $row['CompanyId']; 
				$data['id'] = $row['ChallengeId']; 
				$data['title'] = $row['ChallengeTitle']; 
				$data['desc'] = substr($row['ChallengeDesc']."..",0,70); 
				$data['userid'] = $companyID; 
				$data['username'] = $this->GetUserInfo('Username',$companyID); 
				$data['country'] = $this->GetUserInfo('Country',$companyID); 
				$data['minibio'] = $this->GetUserInfo('Minibio',$companyID); 
				
				$returnval = $data;				
			}
		
		return $returnval;
	}
	
	function date_diff($date1, $date2) { 
		$current = $date1; 
		$datetime2 = $date2; 
		$count = 0; 
		while(date_create($current) < $datetime2){ 
			$current = gmdate("Y-m-d", strtotime("+1 day", strtotime($current))); 
			$count++; 
		} 
		return $count; 
	}
	
	function GetFeaturedOpenChallenge($categoryid,$limit,$domain=null){
		$returnval = "";
		$data = array();
		if ($this->CheckIfExist("SELECT * FROM ChallengeDomains WHERE domain_name='$domain'")===true){
			$result = mysql_query("SELECT Challenges.CompanyId, Challenges.ChallengeId,Challenges.ChallengeTitle,Challenges.Slug,Challenges.ChallengeDesc,Challenges.Photo,
DATEDIFF(ChallengeTimeline.`Submission_To`,NOW()) AS days_left FROM `Challenges`
LEFT JOIN ChallengeTimeline ON (ChallengeTimeline.`ChallengeId` = Challenges.`ChallengeId`)
LEFT JOIN `ChallengeDomains` ON (`ChallengeDomains`.`challenge_id` = `Challenges`.`ChallengeId`)
 WHERE Approved='1' AND solved = '0'  AND `ChallengeDomains`.`domain_name` = '$domain'
 ORDER BY Challenges.ChallengeId DESC LIMIT 0,$limit") or die();
		}else {
		$result = mysql_query("SELECT Challenges.CompanyId, Challenges.ChallengeId,Challenges.ChallengeTitle,Challenges.Slug,Challenges.ChallengeDesc,Challenges.Photo,
DATEDIFF(ChallengeTimeline.`Submission_To`,NOW()) AS days_left FROM `Challenges`
LEFT JOIN ChallengeTimeline ON (ChallengeTimeline.`ChallengeId` = Challenges.`ChallengeId`)
 WHERE CategoryId='$categoryid' AND Approved='1' AND solved = '0' 
 ORDER BY Challenges.ChallengeId DESC LIMIT 0,$limit") or die();
		}
			
			for($i=0; $row = mysql_fetch_array($result); $i++){
				$now = date_create('Y-m-d');
				$exp = date_create($row['Submission_To']);
				$diff = $this->date_diff($now,$exp);
				 
				$companyID = $row['CompanyId']; 
				$data[$i]['id'] = $row['ChallengeId']; 
				$data[$i]['title'] = ucfirst($row['ChallengeTitle']); 
				$data[$i]['slug'] = ucfirst($row['Slug']); 
				$data[$i]['desc'] = $row['ChallengeDesc'];
				$data[$i]['remaining_time'] =  $row['days_left']." days";
				$data[$i]['photo'] = $row['Photo'];
				$data[$i]['userid'] = $companyID; 
				$data[$i]['username'] = ucfirst($this->GetUserInfo('Username',$companyID)); 
				$data[$i]['country'] = $this->GetUserInfo('Country',$companyID); 
				$data[$i]['minibio'] = $this->GetUserInfo('Minibio',$companyID); 			
			}
			
		$returnval = $data;
		
		return $returnval;
	}
	
	function GetChallengeCount($categoryid){
		$result = mysql_query("SELECT * FROM `Challenges` where CategoryId='$categoryid' and Approved='1'") or die();
		
			$returnval = mysql_num_rows($result);	
		
		return $returnval;
	}

	function GetTotalMembersCount(){
		$result = mysql_query("SELECT * FROM `ChallengeMembers`") or die();
	
			$returnval = mysql_num_rows($result);
		
		return $returnval;
	}
	
	function GetTotalChallengeCount(){
		$result = mysql_query("SELECT * FROM `Challenges` where Approved='1'") or die();
		
			$returnval = mysql_num_rows($result);
		
		return $returnval;
	}
	
	function GetTotalSponsorAmount(){
		$result = mysql_query("SELECT amount FROM `SponsorContact` where SponsorshipType='1'") or die();
		$returnval = 0;
		
			while($row = mysql_fetch_array($result)){
				$returnval = $returnval + $row['amount'];
			}
		
		return $returnval;
	}
	
   function GetInfo($table,$field,$field2,$value){
		$result = mysql_query("SELECT `$field` as val FROM `$table` where `$field2`='$value' ") or die();
			$val = "";		
			while($row = mysql_fetch_array($result)){
				
				$val = $row['val']; 
			}
		return $val;
	}
	
   function GetTotal($table,$key=null,$value=null){
   	   if ($key && $value){
   	   	$result = mysql_query("SELECT * FROM  `$table` WHERE `$key` = '$value'") or die();
   	   }else {
		$result = mysql_query("SELECT * FROM  `$table`") or die();
   	   }
			$returnval = mysql_num_rows($result);
		
		return $returnval;
	}
	
   function CheckExist($table,$key=null,$value=null,$key2=null,$value2=null){
   	   $exists = false;
   	   if ($key2 && $value2){
   	   	$result = mysql_query("SELECT * FROM  `$table` WHERE `$key` = '$value' AND `$key2` = '$value2'") or die();
   	   }else if ($key && $value){
   	   	$result = mysql_query("SELECT * FROM  `$table` WHERE `$key` = '$value'") or die();
   	   }else {
		$result = mysql_query("SELECT * FROM  `$table`") or die();
   	   }
		
   	    $returnval = mysql_num_rows($result);
		if ($returnval > 0){
			$exists = true;
		}
	    return $exists;
	}
	
	function GetMySponsorship($companyid,$category=null,$domain=null){
		
		if ($this->CheckIfExist("SELECT * FROM ChallengeDomains WHERE domain_name='$domain'")===true){
			$results = mysql_query("SELECT * FROM SponsorContact 
LEFT JOIN `ChallengeDomains` ON (`ChallengeDomains`.`challenge_id` = SponsorContact.`ChallengeId`)
WHERE SponsorId = '$companyid' AND ChallengeDomains.`domain_name` = '$domain'");
		}else {
			$results = mysql_query("SELECT * FROM SponsorContact 
LEFT JOIN `Challenges` ON (`Challenges`.`ChallengeId` = `SponsorContact`.`ChallengeId`)
WHERE SponsorId = '$companyid' AND `Challenges`.`CategoryId`='$category'");
		}
		
		if(!$results){
			return mysql_error();
		}else{
			if(mysql_num_rows($results) == 0){
				return 0;
			}else{
				$resultarray = array();
				for($i = 0; $row = mysql_fetch_array($results) ; $i++){
					$resultarray[$i]['SponsorshipType'] = $row['SponsorshipType'];
					$resultarray[$i]['Amount'] = $row['Amount'];
					$resultarray[$i]['ChallengeId'] = $row['ChallengeId'];
					$resultarray[$i]['Message'] = $row['Message'];
					$resultarray[$i]['SponsorshipId'] = $row['SponsorshipId'];
					$resultarray[$i]['SponsorName'] = $row['SponsorName'];
					
				}
				return $resultarray;
			}
		}
	}
	
    function reformatdate($date_to_reformat){
			$temp_date = date_create($date_to_reformat);
			$date_reformatted = date_format($temp_date, "F d, Y");
			return $date_reformatted;
		}
		
    function GetTimeLine($challengeid){
		$results = mysql_query("SELECT * FROM ChallengeTimeline WHERE ChallengeId='".$challengeid."' ");
		if(!$results){
			return mysql_error();
		}else{
			if(mysql_num_rows($results) == 0){
				return 0;
			}else{
				$resultarray = array();
				for($i = 0; $row = mysql_fetch_array($results) ; $i++){
					$resultarray[$i]['Submission_From'] = $this->reformatdate($row['Submission_From']);
					$resultarray[$i]['Submission_To'] = $this->reformatdate($row['Submission_To']);
					$resultarray[$i]['Judging_From'] = $this->reformatdate($row['Judging_From']);
					$resultarray[$i]['Judging_To'] = $this->reformatdate($row['Judging_To']);
					$resultarray[$i]['Winners_Announced'] = $this->reformatdate($row['Winners_Announced']);
				}
				return $resultarray;
			}
		}
	}
	
   function GetPrizes($challengeid){
		$results = mysql_query("SELECT * FROM ChallengePrizes WHERE ChallengeId='".$challengeid."' ");
		$resultarray = array();
		if(!$results){
			return mysql_error();
		}else{
			if(mysql_num_rows($results) == 0){
				
			}else{				
				for($i = 0; $row = mysql_fetch_array($results) ; $i++){
					$resultarray[$i]['PrizeDescription'] = stripcslashes($row['PrizeDescription']);
				}				
			}
			return $resultarray;
		}
	}
	
   function GetCriteria($challengeid){
		$results = mysql_query("SELECT * FROM ChallengeCriteria WHERE ChallengeId='".$challengeid."'");
		$resultarray = array();
		if(!$results){
			return mysql_error();
		}else{
			if(mysql_num_rows($results) == 0){
				
			}else{				
				for($i = 0; $row = mysql_fetch_array($results) ; $i++){
					$resultarray[$i]['CriteriaDescription'] = stripcslashes($row['CriteriaDescription']);
				}				
			}
			return $resultarray;
		}
	}
	
	function GetHowToEnter($challengeid){
		$results = mysql_query("SELECT * FROM ChallengeHowToEnter WHERE ChallengeId='".$challengeid."'");
		$resultarray = array();
		if(!$results){
			return mysql_error();
		}else{
			if(mysql_num_rows($results) == 0){
				
			}else{				
				for($i = 0; $row = mysql_fetch_array($results) ; $i++){
					$resultarray[$i]['HowToDesc'] = stripcslashes($row['HowToDesc']);
				}
			}
			return $resultarray;
		}
	}
	
	function GetMyApplications($challengerid,$category=null,$domain=null){
		//$sql = mysql_query("SELECT * FROM Applications WHERE ChallengeMemberId = '".$challengerid."' ");
		if ($this->CheckIfExist("SELECT * FROM ChallengeDomains WHERE domain_name='$domain'")===true){
			$sql = mysql_query("SELECT Applications.*,Challenges.ChallengeId AS ID,Challenges.Solved AS ChallengeSolved  
FROM `Applications` INNER JOIN `Challenges` ON (Applications.ChallengeId = Challenges.ChallengeId)
LEFT JOIN `ChallengeDomains` ON (`ChallengeDomains`.`challenge_id` = Challenges.`ChallengeId`)
WHERE Applications.ChallengeMemberId='$challengerid' AND `ChallengeDomains`.`domain_name`='$domain' ORDER BY Applications.AppId DESC ");
		}else {
		   $sql = mysql_query("SELECT Applications.*,Challenges.ChallengeId AS ID,Challenges.Solved AS ChallengeSolved  
FROM `Applications` INNER JOIN `Challenges` ON (Applications.ChallengeId = Challenges.ChallengeId)
WHERE Applications.ChallengeMemberId='$challengerid' AND `Challenges`.`CategoryId`='$category' ORDER BY Applications.AppId desc");
		}
		if($sql){
			$returnarray = array();
			for($i = 0; $row = mysql_fetch_array($sql) ; $i++){
				$returnarray[$i]['AppId'] = $row['AppId'];
				$returnarray[$i]['AppName'] = $row['AppName'];
				$returnarray[$i]['ChallengeId'] = $row['ChallengeId'];
				$returnarray[$i]['AppDesc'] = $row['AppDesc'];
				$returnarray[$i]['AppDesc'] = $row['AppDesc'];
				$returnarray[$i]['AppWinner'] = $row['AppWinner'];
				$returnarray[$i]['ChallengeSolved'] = $row['ChallengeSolved'];
			}
			
			return $returnarray;
		}else{
			return 0;
		}
	}
	
	function GetLatestApplications($categoryid,$limit=10,$search=null,$domain=null){
	    $where = "";
		if ($search != ""){
			$where = " AND (`AppName` LIKE '%$search%' OR `AppDesc` LIKE '%$search%') ";
		}
		
		if ($this->CheckIfExist("SELECT * FROM ChallengeDomains WHERE domain_name='$domain'")===true){
			$result = mysql_query("SELECT Applications.*,Challenges.ChallengeId AS ID ,DATEDIFF(NOW(),`Applications`.`AppDatePosted`) AS days_posted,
Challenges.`ChallengeTitle` AS c_title,Challenges.`Slug` AS c_slug  
FROM `Applications` INNER JOIN `Challenges` 
ON Applications.ChallengeId = Challenges.ChallengeId 
LEFT JOIN ChallengeDomains ON (ChallengeDomains.`challenge_id` = Challenges.`ChallengeId`)
WHERE ChallengeDomains.`domain_name` = '$domain' $where
ORDER BY Applications.AppId DESC LIMIT $limit");
		}else {
		$result = mysql_query("SELECT Applications.*,Challenges.ChallengeId AS ID ,DATEDIFF(NOW(),`Applications`.`AppDatePosted`) AS days_posted,
		Challenges.`ChallengeTitle` AS c_title,Challenges.`Slug` AS c_slug  
FROM `Applications` INNER JOIN `Challenges` 
ON Applications.ChallengeId = Challenges.ChallengeId 
WHERE Challenges.`CategoryId` = $categoryid $where
ORDER BY Applications.AppId DESC LIMIT $limit");
		}
		if(!$result){
			return 0;
		}else{
			$returnarray = array();
			for($i = 0; $row = mysql_fetch_array($result) ; $i++){
				$returnarray[$i]['AppId'] = $row['AppId'];
				$returnarray[$i]['AppName'] = $row['AppName'];
				$returnarray[$i]['ChallengeId'] = $row['ChallengeId'];
				$returnarray[$i]['Slug'] = $row['Slug'];
				$returnarray[$i]['Description'] = $row['AppDesc'];
				$returnarray[$i]['Days'] = $row['days_posted'];
				$returnarray[$i]['C_Title'] = $row['c_title'];
				$returnarray[$i]['C_Slug'] = $row['c_slug'];
				$returnarray[$i]['postedby'] = $this->GetUserInfo('Username',$row['ChallengeMemberId']);
				$returnarray[$i]['Photo'] = $this->GetTableInfo('AppImages','ImagePath','AppId',$row['AppId']);
				
			}
			return $returnarray;
		}
	}
	
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
	
      function BrowseChallenges($categoryid,$search=NULL,$domain=null){
		
		$where = "";
		
		if ($search != ""){
			$where = " AND (`ChallengeTitle` LIKE '%$search%' OR `ChallengeDesc` LIKE '%$search%' OR `MoreDetails` LIKE '%$search%') ";
		}
		
		if ($this->CheckIfExist("SELECT * FROM ChallengeDomains WHERE domain_name='$domain'")===true){
		   $query = "SELECT Challenges.*, DATEDIFF(ChallengeTimeline.`Submission_To`,NOW()) AS days_left FROM `Challenges` 
LEFT JOIN `ChallengeTimeline` ON (ChallengeTimeline.`ChallengeId` = Challenges.`ChallengeId`)
LEFT JOIN `ChallengeDomains` ON (`ChallengeDomains`.`challenge_id` = Challenges.`ChallengeId`)
WHERE ChallengeDomains.`domain_name`='$domain' AND Approved = '1' $where ORDER BY `DatePosted` DESC";    	
		}else {
			$query = "SELECT Challenges.*, DATEDIFF(ChallengeTimeline.`Submission_To`,NOW()) AS days_left FROM `Challenges` 
LEFT JOIN `ChallengeTimeline` ON ChallengeTimeline.`ChallengeId` = Challenges.`ChallengeId`
WHERE CategoryId='$categoryid' AND Approved = '1' $where ORDER BY `DatePosted` DESC";
		}
		
		    $result = mysql_query($query) or die(mysql_error());
					
			for($i = 0; $row = mysql_fetch_array($result) ; $i++){
				$returnarray[$i]['postedby'] = $this->GetTableInfo('ChallengeMembers','Username','ChallengeMemberId',$row['CompanyId']);
				$returnarray[$i]['ChallengeId'] = $row['ChallengeId'];
				$returnarray[$i]['Photo'] = $row['Photo'];
				$returnarray[$i]['ChallengeTitle'] = mysql_real_escape_string(substr($row['ChallengeTitle'],0,25));
				$returnarray[$i]['CategoryName'] = $this->GetTableInfo("ChallengeCategory","CategoryName","ChallengeCategoryId",$row['CategoryId']);;	
				$returnarray[$i]['Slug'] = $row['Slug'];	
				$returnarray[$i]['Solved'] = $row['Solved'];	
				$returnarray[$i]['Days'] = $row['days_left'];
				$returnarray[$i]['Description'] = $row['ChallengeDesc'];
			}  
		
		return $returnarray;
	}
	
	function GetDaysLeft($challengeid){
		$days = 0;
		
		$result = mysql_query("SELECT DATEDIFF(ChallengeTimeline.`Submission_To`,NOW()) AS days_left FROM `Challenges` 
		LEFT JOIN `ChallengeTimeline` ON ChallengeTimeline.`ChallengeId` = Challenges.`ChallengeId`
		WHERE Challenges.ChallengeId='$challengeid' AND Approved = '1'") or die(mysql_error());
		if(MYSQL_NUM_ROWS($result) > 0){
			$row = mysql_fetch_array($result);
			$days = $row['days_left'];
		}
		
		return $days;
		
	}
	
    function GetGallery($appid){
		$sql = mysql_query("select * from AppImages where AppId = '$appid'");
		if($sql){
			$returnarray = array();
			for($i = 0; $row = mysql_fetch_array($sql) ; $i++){
				$returnarray[$i]['ImagePath'] = $row['ImagePath'];
			}
			return $returnarray;
		}else{
			return 0;
		}
	}
	
	function GetGallery2($appid){
		$sql = mysql_query("select * from AppImages where AppId = '$appid'");
		if($sql){
			$returnarray = array();
			for($i = 0; $row = mysql_fetch_array($sql) ; $i++){
				//$returnarray[$i]['ImagePath'] = $row['ImagePath'];
				$returnarray[] = array("id"=>$row['ImageId'],"ImagePath" => $row['ImagePath']);
			}
			return $returnarray;
		}else{
			return 0;
		}
	}
	
    function GetAppFiles($appid){
		$sql = mysql_query("select * from AppFiles where AppId = '$appid'");
		if($sql){
			$returnarray = array();
			for($i = 0; $row = mysql_fetch_array($sql) ; $i++){
				$returnarray[$i]['FilePath'] = $row['FilePath'];
			}
			return $returnarray;
		}else{
			return 0;
		}
	}
	
    function GetAppVideos($appid){
		$sql = mysql_query("select * from AppVideo where AppId = '$appid'");
		if($sql){
			$returnarray = array();
			for($i = 0; $row = mysql_fetch_array($sql) ; $i++){
				$returnarray[$i]['Url'] = $row['Url'];
			}
			return $returnarray;
		}else{
			return 0;
		}
	}
	
	function GetAppFiles2($appid){
		$sql = mysql_query("select * from AppFiles where AppId = '$appid'");
		if($sql){
			$returnarray = array();
			for($i = 0; $row = mysql_fetch_array($sql) ; $i++){
				//$returnarray[$i]['FilePath'] = $row['FilePath'];
				$returnarray[] = array("id"=>$row['FileId'],"FilePath" => $row['FilePath']);
			}
			return $returnarray;
		}else{
			return 0;
		}
	}
	
    function GetAppVideos2($appid){
		$sql = mysql_query("select * from AppVideo where AppId = '$appid'");
		if($sql){
			$returnarray = array();
			for($i = 0; $row = mysql_fetch_array($sql) ; $i++){
				//$returnarray[$i]['Url'] = $row['Url'];
				$returnarray[] = array("id"=>$row['VideoId'],"Url" => $row['Url']);
			}
			return $returnarray;
		}else{
			return 0;
		}
	}
	
	function DeleteAppImages($fileId, $appId){
		$sql = "Delete from AppImages where ImageId = '$fileId' and AppId = '$appId' ";
		echo $sql;
		return  mysql_query($sql);
	}
	
	function DeleteAppFiles($fileId, $appId){
		$sql = "Delete from AppFiles where FileId = '$fileId' and AppId = '$appId' ";
		echo $sql;
		return  mysql_query($sql);
	}
	
	function DeleteAppVideos($videoId, $appId){
		$sql = "Delete from AppVideo where VideoId = '$videoId' and AppId = '$appId' ";
		echo $sql;
		return  mysql_query($sql);
	}
	
	function GetLatestUsers(){
		$sql = mysql_query("SELECT * FROM ChallengeMembers WHERE UserType='1' and NOT Photo='' ORDER BY ChallengeMemberId DESC LIMIT 10") or die(mysql_error()); 
		
		for($i = 0; $row = mysql_fetch_array($sql) ; $i++){
			$returnarray[$i]['Username'] = $row['Username'];
			$returnarray[$i]['Photo'] = $row['Photo'];
		}
		return $returnarray;
	}
	
	function ApplicationSave($name,$desc,$challengeid,$userid,$slug,$domain){
		$query = "Insert into Applications (AppName,AppDesc,AppDatePosted,ChallengeId,ChallengeMemberId,Slug,domain_name) values ('$name','$desc',NOW(),'$challengeid','$userid','$slug','$domain')";
		$result = mysql_query($query);
		if (!$result) {
			return 0;
		}else {
			$message = mysql_insert_id();     
			return $message;
        }
	}
	
	function ApplicationUpdate($appId,$name,$desc,$slug){
		$query = sprintf("UPDATE `Applications` SET `AppName` = '%s', 
				`AppDesc` = '%s',
				`Slug` = '%s'
                WHERE `AppId` = '$appId'",
            mysql_real_escape_string($name),mysql_real_escape_string($desc),mysql_real_escape_string($slug));

		$result = mysql_query($query);
		return $result;
		
	}
	
	function AppImageSave($appid,$path){
		global $client;
		$url = "http://mychallenge.com/api/upload.php?url=$path&type=application";
		$client->get($url);
		$result = $client->currentResponse('body');
		$img = json_decode($result,true);
		if ($img['url']){
			  $path = $img['url']; 
		}
		
		$query = "Insert into AppImages (AppId,ImagePath) values ('$appid','$path')";
		$result = mysql_query($query);
		if (!$result) {
			return mysql_error();
		}
	}
	function AppVideoSave($appid,$url){
		$query = "Insert into AppVideo (AppId,Url) values ('$appid','$url')";
		$result = mysql_query($query);
		if (!$result) {
			return mysql_error();
		}
	}
	function AppFileSave($appid,$path){
		global $client;
	    $url = "http://mychallenge.com/api/upload.php?url=$path&type=file";
		$client->get($url);
		$result = $client->currentResponse('body');
		$img = json_decode($result,true);
		if ($img['url']){
			  $path = $img['url']; 
		}
		$query = "Insert into AppFiles (AppId,FilePath) values ('$appid','$path')";
		$result = mysql_query($query);
		if (!$result) {
			return mysql_error();
		}
	}
	
	function AppCheckSlugIfExists($slug){
		$query = "Select Slug from Applications where Slug='$slug'";
		$result = mysql_query($query);
		if (mysql_num_rows($result)>0) {
			return true;
		}else{
			return false;
		}
	}
	
	function GetSubmissions($challengeid){
		$result = mysql_query("SELECT * FROM `Applications` WHERE ChallengeId='".$challengeid."' ") or die(mysql_error());
		
			for($i = 0; $row = mysql_fetch_array($result) ; $i++){
				$returnarray[$i]['AppId'] = 	$row['AppId'];
				$returnarray[$i]['AppName'] = 	$row['AppName'];
				$returnarray[$i]['AppWinner'] = $row['AppWinner'];
				$returnarray[$i]['AppDesc'] =   $row['AppDesc'];
				$returnarray[$i]['Slug'] = 		$row['Slug'];
				$returnarray[$i]['Photo'] = 	$this->GetTableInfo('AppImages','ImagePath','AppId',$row['AppId']);
				$returnarray[$i]['postedby'] = 	$this->GetTableInfo('ChallengeMembers','UserName','ChallengeMemberId',$row['ChallengeMemberId']);
			} 
			
		return $returnarray;
	}
	
	function GetChallengeCategories(){
		$cat = array();
		$query = "SELECT * from ChallengeCategory order by CategoryName";
		$result = mysql_query($query);
		if (!$result) {
		   die('GetChallengeCategories:: Invalid query: ' . mysql_error());
		}
		$num_rows = mysql_num_rows($result);
		$i = 0;
		if ($num_rows > 0){
			while($res = mysql_fetch_array($result)){
				$cat[$i]['id'] = $res['ChallengeCategoryId'];
				$cat[$i]['name'] = $res['CategoryName'];
				$i++;
			}
		} 
		return $cat;
	}
	
	function CheckIfExist($sql){
		$result = mysql_query($sql);
		if(mysql_num_rows($result) == 0){
			return false;
		}else{
			return true;
		}
	}
	
	function SaveChallengeEdit($challenge_name,$challenge_category,$challenge_description,$challenge_more_description,$challenge_urlname,$challengeid,$submission_from,$submission_to,$judging_from,$judging_to,$announcement_date,$timelineid){
		$query = mysql_query("UPDATE Challenges SET 
			`ChallengeTitle` = '".$challenge_name."',
			`CategoryId` = '".$challenge_category."',
			`ChallengeDesc` = '".$challenge_description."',
			`MoreDetails` = '".$challenge_more_description."',
			`URLName` = '".$challenge_urlname."'
			WHERE `ChallengeId` = '".$challengeid."'
			") or die(mysql_error());

				
		$query2 = mysql_query("UPDATE ChallengeTimeline SET 
			`Submission_From` = '".$submission_from."',
			`Submission_To` = '".$submission_to."',
			`Judging_From` = '".$judging_from."',
			`Judging_To` = '".$judging_to ."',
			`Winners_Announced` = '".$announcement_date."'
			WHERE TimelineId = '".$timelineid."'
			") or die(mysql_error());

	}
	
		
	function GetChallengesByStr($str='',$limit=NULL){
		$arr = array();
		$limit = !empty($limit)?" limit $limit":'';
		$query = "Select * from `Challenges` where ChallengeTitle like '%$str%' or ChallengeDesc like '%$str%' order by ChallengeId $limit ";
		$result = mysql_query($query);
		if (!$result) {
			 die('GetLatestApplications:: Invalid query: ' . mysql_error());
		}
		$num_rows = mysql_num_rows($result);
		if ($num_rows > 0){
			while($row = mysql_fetch_array($result)){
				$descLimit = 100;
				$Desc = $row['ChallengeDesc'];
				if (preg_match('/^.{1,'.$descLimit.'}\b/s', strip_tags( $Desc ), $match)){
					$Desc= $match[0];
				}else{
					$Desc= substr( strip_tags( $Desc ), 0, $descLimit );
				}
				$arr[] = array(
					"ChallengeId" => $row['ChallengeId'],
					"CompanyId" => $row['CompanyId'],
					"ChallengeTitle" => $row['ChallengeTitle'],
					"ChallengeDesc" => $row['ChallengeDesc'],
					"ShortDesc" => $Desc,
					"MoreDetails" => $row['MoreDetails'],
					"Photo" => $row['Photo'],
					"DatePosted" => $row['DatePosted']
				);
			}
		} 
		return $arr;
	}

	function CheckIfGallery($challengeid){
		$sql = mysql_query("SELECT `ChallengeId` FROM `Applications` WHERE ChallengeId = '".$challengeid."' ") or die(mysql_error());
		if(mysql_num_rows($sql) > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function ApproveWinner($appid,$challengeid){
	   $query = mysql_query("UPDATE `Challenges` SET `Solved` = '1' WHERE `ChallengeId` = '".$challengeid."' ");
		if($query){
			$query2 = mysql_query("UPDATE `Applications` SET `AppWinner` = '1' WHERE `AppId` = '".$appid."' ");
		}
	}
	
     function GetChallSponsorship($challengeid){
		$results = mysql_query("Select ChallengeMembers.Username, SponsorContact.SponsorshipType, SponsorContact.Amount, SponsorContact.Message,
SponsorContact.DateSubmit,SponsorName,SponsorUrl from SponsorContact Left Join ChallengeMembers
On (ChallengeMembers.ChallengeMemberId =SponsorContact.SponsorId) where SponsorContact.ChallengeId = $challengeid
		");
		$resultarray = array();
		
		if(!$results){
			return mysql_error();
		}else{
			if(mysql_num_rows($results) == 0){
				
			}else{
				
				for($i = 0; $row = mysql_fetch_array($results) ; $i++){
					$resultarray[$i]['Username'] = $row['Username'];
					$resultarray[$i]['Type'] = $row['SponsorshipType'];
					$resultarray[$i]['Amount'] = $row['Amount'];
					$resultarray[$i]['Message'] = $row['Message'];
					$resultarray[$i]['Date'] = $row['DateSubmit'];
					$resultarray[$i]['Name'] = $row['SponsorName'];
					$resultarray[$i]['Url'] = $row['SponsorUrl'];
					
				}
				
			}
			return $resultarray;
		}
	}
	
	function GetChallengeWinner($challengeid){
		$result = mysql_query("SELECT * FROM `Applications` where ChallengeId='$challengeid' and AppWinner='1'") or die(mysql_error());
		$row = mysql_fetch_array($result);
		$return['AppName'] = $row['AppName'];
		$return['AppDesc'] = $row['AppDesc'];
		$return['AppDatePosted'] = $row['AppDatePosted'];
		$return['AppPhoto'] = $this->GetTableInfo('AppImages','ImagePath','AppId',$row['AppId']);
		$return['Username'] = $this->GetUserInfo('Username',$row['ChallengeMemberId']);
		$return['Slug'] = $row['Slug'];
		return $return;
	}
	
       function GetLatestChallenge($categoryid,$limit=10,$domain=''){
       	
       	if ($this->CheckIfExist("SELECT * FROM ChallengeDomains WHERE domain_name='$domain'")===true){
       		 $result = mysql_query("SELECT * FROM `Challenges` 
LEFT JOIN `ChallengeDomains` ON (`ChallengeDomains`.`challenge_id` = Challenges.`ChallengeId`)
WHERE ChallengeDomains.`domain_name`='$domain' AND Approved='1' AND Solved = '0' order by ChallengeId DESC LIMIT $limit") or die();
       	}else {
             $result = mysql_query("SELECT * FROM `Challenges` where CategoryId='$categoryid' and Approved='1' and Solved = '0' order by ChallengeId DESC LIMIT $limit") or die();       		
       	}
		
		
			$returnval = array();
			
			while($row = mysql_fetch_array($result)){
				$data['id'] = $row['ChallengeId']; 
				$data['title'] = $row['ChallengeTitle']; 
				$data['desc'] = $row['ChallengeDesc']; 
				$data['photo'] = $row['Photo']; 
				$data['slug'] = $row['Slug']; 
				$data['postedby']= $this->GetTableInfo('ChallengeMembers','Username','ChallengeMemberId',$row['CompanyId']);
				$returnval[] = $data;				
			}
		
		return $returnval;
	}
	
function GetSponsorByChallenge($challenge_id){
		$result = mysql_query("Select * from SponsorContact where ChallengeId = $challenge_id and SponsorImage !=''") or die();
		
			$returnval = array();
			$data=array();
		    $i=0;	
			while($row = mysql_fetch_array($result)){
				
				$data[$i]['image'] = $row['SponsorImage'];
				$data[$i]['url'] = $row['SponsorUrl'];
				$i++;				
			}
		
		return $data;
	}
	
function DeleteSponsor($sponsor_id){
		$sql = "Delete from SponsorContact where SponsorshipId = '$sponsor_id'";
		return  mysql_query($sql);
	}
}
?>