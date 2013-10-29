<?php
//include 'includes/config2.php';
include('includes/functions.php');
$dir = new DIR_LIB;

function reformatdate($date_to_reformat){
	$temp_date = date_create($date_to_reformat);
    $date_reformatted = date_format($temp_date, "Y-m-d");
	return $date_reformatted;
}

//general info
$challengeid = $_POST['challengeid'];
$slug = $_POST['slug'];
$challenge_name = mysql_real_escape_string($_POST['title']);
$challenge_category = $_POST['category'];
$challenge_description = mysql_real_escape_string($_POST['description']);
$challenge_more_description = mysql_real_escape_string($_POST['more_description']);
$challenge_urlname = mysql_real_escape_string($_POST['urlvalue']);
	
$image=$_FILES['image']['name'];

if ($challenge_name==""){
  echo "* Please provide a name for your challenge *";
}
else if($dir->CheckIfExist("SELECT * from Challenges WHERE URLName = '".$challenge_urlname."' and NOT ChallengeId = '".$challengeid."'") == true){
	echo "* URL name already taken. *";
}
elseif ($challenge_category==""){
  echo "* Please select a category for your challenge *";
}
else {

   if ($image){
   
		$filename = stripslashes($_FILES['image']['name']);
	 
		preg_match('/([^\\/\:*\?"<>|]+)(?:\.([^\\/\:*\?"<>|\.]+))$/',$filename,$matches);
		$ext = strtolower($matches[2]);
		
		if (($ext != "jpg") && ($ext != "jpeg") && ($ext != "png") && ($ext != "gif")){
			echo "<p><b class=\"err\">Can't upload file because of unknown extension but details were saved!</b></p>";
		}else {    
			$start = time();
			$f = $start.".".$ext;
			$newname = "uploads/challenge/".$f;
			$copied = move_uploaded_file($_FILES["image"]["tmp_name"],$newname);
			$fileName = $siteurl."/".$newname;  
			if (!$copied){
			 echo "<p><b class=\"err\">A problem occured file uploading logo but details were saved!</b></p>";
			}   
		}
	   
		$query = mysql_query("UPDATE Challenges SET `Photo` = '".$fileName."' WHERE `ChallengeId` = '".$challengeid."' ") or die(mysql_error());
	}

	$timelineid = $_POST['timelineid'];
	$submission_from = reformatdate($_POST['submission_from']);
	$submission_to = reformatdate($_POST['submission_to']);
	$judging_from = reformatdate($_POST['judging_from']);
	$judging_to = reformatdate($_POST['judging_to']);
	$announcement_date = reformatdate($_POST['announcement_date']);
	
	$dir->SaveChallengeEdit($challenge_name,$challenge_category,$challenge_description,$challenge_more_description,$challenge_urlname,$challengeid,$submission_from,$submission_to,$judging_from,$judging_to,$announcement_date,$timelineid);

		//get and update prizes
			$prizesarray = $_POST['prizesid'];
			//echo "size of original prizes: ".sizeof($prizesarray)."<br>";
			for($i = 0; $i < sizeof($prizesarray) ; $i++){
				//echo $prizesarray[$i]. "=" .$_POST['prize'.$i]."<br>";
				mysql_query("UPDATE ChallengePrizes SET `PrizeDescription` = '".$_POST['prize'.$i]."' WHERE PrizeId = '".$prizesarray[$i]."' ") or die(mysql_error());
			}

		//get and update criteria
			$criteriaarray = $_POST['criteriaid'];
			//echo "size of original criteria: ".sizeof($criteriaarray)."<br>";
			for($i = 0; $i < sizeof($criteriaarray) ; $i++){
				//echo $criteriaarray[$i]. "=" .$_POST['criteria'.$i]."<br>";
				
				mysql_query("UPDATE ChallengeCriteria SET `CriteriaDescription` = '".$_POST['prize'.$i]."' WHERE CriteriaId = '".$prizesarray[$i]."' ") or die(mysql_error());
			
			}

		//get and update how to
			$howtoarray = $_POST['howtoid'];
			//echo "size of original how to: ".sizeof($howtoarray)."<br>";
			for($i = 0; $i < sizeof($howtoarray) ; $i++){
				//echo $howtoarray[$i]. "=" .$_POST['howto'.$i]."<br>";
				
				mysql_query("UPDATE ChallengeHowToEnter SET `HowToDesc` = '".$_POST['howto'.$i]."' WHERE HowToId = '".$howtoarray[$i]."' ") or die(mysql_error());
			
			}	
}

if($_POST['IfPrizesAdded'] == '1'){
	$prizearray = $_POST['fieldcnt'] + 1;
	//echo "<br> value of prize array = ".$prizearray;
	for($p = 0; $p < $prizearray ; $p++){
		mysql_query("INSERT INTO ChallengePrizes(`ChallengeId`,`PrizeDescription`) VALUES('".$challengeid."','".$_POST['prizeadded'.$p]."') ") or die(mysql_error());
		//echo "I inserted prize ".$p.", ".$_POST['prizeadded'.$p]."<br>";
	}
}
if($_POST['IfCriteriaAdded'] == '1'){
	$criteriaarray = $_POST['fieldcntcriteria'] + 1;
	//echo "<br> value of criteria array = ".$criteriaarray;
	for($c = 0; $c < $criteriaarray ; $c++){
		mysql_query("INSERT INTO ChallengeCriteria(`ChallengeId`,`CriteriaDescription`) VALUES('".$challengeid."','".$_POST['criteriaadded'.$c]."') ") or die(mysql_error());
		//echo "I inserted criteria ".$c.", ".$_POST['criteriaadded'.$c]."<br>";
	}
	
}
if($_POST['IfHowToAdded'] == '1'){
	
	$howtoarray = $_POST['fieldcnthowto'] + 1;
	//echo "<br> value of how to array = ".$howtoarray;
	for($h = 0; $h < $howtoarray ; $h++){
		mysql_query("INSERT INTO ChallengeHowToEnter(`ChallengeId`,`HowToDesc`) VALUES('".$challengeid."','".$_POST['howtoadded'.$h]."') ") or die(mysql_error());
		//echo "I inserted how to ".$h.", ".$_POST['howtoadded'.$h]."<br>";
	}
}

header('Location: challenge/'.$slug)
?>