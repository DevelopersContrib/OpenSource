<?php
session_start();
include ('includes/functions.php');
include ('includes/sponsor_function.php');
$sdir = new SPONSORDIR();


$sponsorshiptype = $_POST['type'];
$message = mysql_real_escape_string($_POST['message']);
$amount = mysql_real_escape_string($_POST['amount']);
$challengeid = $_POST['challengeid'];
$emailsponsor = $_POST['emailsponsor'];
$sponsor_id = $_SESSION['userid'];
$sdir->saveSponsor($sponsorshiptype, $message, $sponsor_id, $challengeid,$emailsponsor,$amount);
echo "OK";


