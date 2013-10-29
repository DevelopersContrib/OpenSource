<?php
include ('includes/functions.php'); 
$dir = new DIR_LIB();
$sponsor_id = $_POST['sponsor_id'];
$dir->DeleteSponsor($sponsor_id);