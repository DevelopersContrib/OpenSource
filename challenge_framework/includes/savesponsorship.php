<?php
session_start();
include ('functions.php');
include ('sponsor_function.php');
$sdir = new SPONSORDIR();


$sponsorshiptype = $_POST['type'];
$message = mysql_real_escape_string($_POST['message']);
$amount = mysql_real_escape_string($_POST['amount']);
$challengeid = $_POST['challengeid'];
$emailsponsor = $_POST['emailsponsor'];
$sponsor_name = mysql_real_escape_string($_POST['sponsor_name']);
$sponsor_url = mysql_real_escape_string($_POST['sponsor_url']);
$image = $_POST['image'];
if ($image != ""){
	$image = substr($image, 0, -1);  
	$image = $siteurl."/server/php/files/".$image;
}

$sponsor_id = $_SESSION['userid'];
$sdir->saveSponsor($sponsorshiptype, $message, $sponsor_id, $challengeid,$emailsponsor,$sponsor_name,$sponsor_url,$image,$amount);
echo "OK";


