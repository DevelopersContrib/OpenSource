<?php


if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	include ('includes/challenger_function.php'); 
	$dir = new DIR_CHALLENGER();
	
	$id = $_REQUEST['id'];
	//echo $id;
	echo $dir->GetSearchChallProf($id);
	
}else{
	$rurl = $_SERVER['HTTP_HOST'];
	header("Location: http://$rurl");
	die();
}
?>