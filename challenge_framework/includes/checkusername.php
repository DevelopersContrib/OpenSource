<?
include ('functions.php'); 
$dir = new DIR_LIB();

$uname = $_REQUEST['uname'];

$ifexist = $dir->CheckIfExist('Select * from ChallengeMembers where Username ="'.$uname.'"');

if($ifexist===true)
	echo 'true';
else
	echo 'false';


?>