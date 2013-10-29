<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	include ('../../includes/function.php'); 
	$dir = new DIR_LIB_2();
	
	$q = rawurldecode($_REQUEST['q']);
	echo json_encode(array("result"=>$dir->GetChallengesByStr($q)));
}else{
	$rurl = $_SERVER['HTTP_HOST'];
	header("Location: http://$rurl");
	die();
	//echo "else";
}


?>