<?php
	include ('login_function.php');
	$login_dir = new LoginDIR;
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$login_attempt = $login_dir->verifyLogin($username,$password);
	echo $login_attempt;
?>