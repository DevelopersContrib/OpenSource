<?
/*config already included in header.php*/

	
class DIR_PROFILE {
	function getSponsorshipsCount($sponsor_id){
		$query = MYSQL_QUERY("SELECT COUNT(*) AS total FROM `Challenges` WHERE `CompanyId` = '".$sponsor_id."' AND `Approved` = '1' ") OR DIE(MYSQL_ERROR());
		if($query){
			if(MYSQL_NUM_ROWS($query) > 0){
				while($row = MYSQL_FETCH_ARRAY($query)){
					$total = $row['total'];
				}
				return $total;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}
	
	function getChallengerSubmissionsCount($challenger_id){
		$query = MYSQL_QUERY("SELECT COUNT(*) AS total FROM `Applications` WHERE `ChallengeMemberId` = '".$challenger_id."' ") OR DIE(MYSQL_ERROR());
		if($query){
			if(MYSQL_NUM_ROWS($query) > 0){
				while($row = MYSQL_FETCH_ARRAY($query)){
					$total = $row['total'];
				}
				return $total;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}
	
	function getChallengerSubmissionsWinCount($challenger_id){
		$query = MYSQL_QUERY("SELECT COUNT(*) AS total FROM `Applications` WHERE `ChallengeMemberId` = '".$challenger_id."' AND `AppWinner` = '1' ") OR DIE(MYSQL_ERROR());
		if($query){
			if(MYSQL_NUM_ROWS($query) > 0){
				while($row = MYSQL_FETCH_ARRAY($query)){
					$total = $row['total'];
				}
				return $total;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}
	
	function getSponsoredChallengesClosedCount($challenger_id){
		$query = MYSQL_QUERY("SELECT COUNT(*) AS total FROM `Challenges` WHERE `CompanyId` = '".$sponsor_id."' AND `Solved` = '1' ") OR DIE(MYSQL_ERROR());
		if($query){
			if(MYSQL_NUM_ROWS($query) > 0){
				while($row = MYSQL_FETCH_ARRAY($query)){
					$total = $row['total'];
				}
				return $total;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}
	
	function getTotalMonetarySponsorship($challenger_id){
		$total_sponsorship = 0;
		$query = MYSQL_QUERY("SELECT SUM(Amount) AS total_sponsorship FROM SponsorContact WHERE SponsorId = '".$challenger_id."'");
			if($row = MYSQL_FETCH_ARRAY($query)){
				$total_sponsorship = $row['total_sponsorship'];
			}
		return $total_sponsorship;
	}
	
	
}//end of class

?>