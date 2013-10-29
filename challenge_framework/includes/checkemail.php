<?
include ('functions.php'); 
$dir = new DIR_LIB();

$email = $_REQUEST['email'];

$ifexist = $dir->CheckIfExist('Select * from ChallengeMembers where Email ="'.$email.'"');

if($ifexist===true)
	echo 'true';
else
	echo 'false';


?>