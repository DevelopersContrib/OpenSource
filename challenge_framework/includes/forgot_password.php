<?php
	include('login_function.php');
	$login_dir = new LoginDIR;
	
	$email = $_POST['email'];
	echo $login_dir->sendLoginDetails($email);
?>