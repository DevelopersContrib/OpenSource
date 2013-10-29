<?php
	include('register_function.php');
	$register_dir = new RegisterDIR;
	
	$username = $_POST['username'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$country = $_POST['country'];
	$usertype = $_POST['usertype'];
	
	$register_attempt = $register_dir->registerSave($username,$fname,$lname,$password,$email,$country,$usertype);
	echo $register_attempt;
?>