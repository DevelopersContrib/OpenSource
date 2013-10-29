<?php
session_start();
include ('functions.php');
include ('sponsor_function.php');
$sdir = new SPONSORDIR();


$sponsor_id = $_POST['sponsor_id'];
$sponsorshiptype = $_POST['type'];
$message = mysql_real_escape_string($_POST['message']);
$amount = mysql_real_escape_string($_POST['amount']);
$challengeid = $_POST['challengeid'];
$emailsponsor = $_POST['emailsponsor'];
$sponsor_name = mysql_real_escape_string($_POST['sponsor_name']);
$sponsor_url = mysql_real_escape_string($_POST['sponsor_url']);
$image = $_POST['image'];
$image = str_replace($siteurl."/server/php/files/", "", $image);
if ($image != ""){
	if (substr($image, -1)==","){
	  $image = substr($image, 0, -1);
	}  
	$image = $siteurl."/server/php/files/".$image;
}


$sdir->updateSponsor($sponsor_id, $sponsorshiptype, $message, $challengeid, $sponsor_name, $sponsor_url, $image);
echo "OK";


