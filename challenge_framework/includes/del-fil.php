<?php
session_start();
if(isset($_SESSION['Username'])){
	include ('functions.php'); 
	$dir = new DIR_LIB();
	$id = mysql_escape_string($_POST['id']);
	$id = explode("-",$id);
	echo $dir->DeleteAppFiles($id[0],$id[1]);
}
?>