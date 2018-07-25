<?php
session_start();

$ok = 0;
if(isset($_SESSION['username']) || isset($_SESSION['password'])) {
	$ok = 1;
	$loggeduser = $_SESSION['username'];
	$loggedpass = $_SESSION['password'];
}

?>