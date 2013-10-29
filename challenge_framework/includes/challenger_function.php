<?php
	require_once(dirname(__FILE__) . '/config.php');
	
	class DIR_CHALLENGER{
		
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
		
		function GetMyApplications($challengerid){
			$sql = mysql_query("SELECT * FROM Applications WHERE ChallengeMemberId = '".$challengerid."' ");
			if($sql){
				$returnarray = array();
				for($i = 0; $row = mysql_fetch_array($sql) ; $i++){
						$returnarray[$i]['AppId'] = $row['AppId'];
						$returnarray[$i]['AppName'] = $row['AppName'];
						$returnarray[$i]['ChallengeId'] = $row['ChallengeId'];
				}
				
				return $returnarray;
			}else{
				return 0;
			}
		}
		
		function GetSearchChallProf($id){
			$query = "Select * from `Challenges` where ChallengeId = '$id'";
			$result = mysql_query($query);
			if (!$result) {
				$return = 'GetSearchChallProf:: Invalid query: ' . mysql_error();
			}else{
				$i=0;
				while($row = mysql_fetch_array($result)){
					$i++;
					$return .='
						<div style="width:100%;float:left">
							<p><img src="'.$row['Photo'].'" width="100%"></p>
							<p>'.$row['ChallengeDesc'].'</p>
							<p>
								<button id="beAsponsor" onclick="beAsponsor('.$id.')">BE A SPONSOR !</button>
								<input type="hidden" id="beAsponsorID-'.$id.'">
							</p>
						</div>
					';
				}
			}
			return $return;
		}
	
	}/*end of class*/
?>