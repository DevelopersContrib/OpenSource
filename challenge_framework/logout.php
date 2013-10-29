<?php
include ('includes/config.php');
session_start();
session_destroy();
unset($_SESSION['username']);
unset($_SESSION['userid']);
unset($_SESSION['login_error']);
unset($_SESSION['register_error']);
header('Location: '.$siteurl);
exit;
?>