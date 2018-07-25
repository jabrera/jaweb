<?php
require_once('config.php');
session_set_cookie_params(0);
session_start();
$loggeduser = $_SESSION['username'];
mysql_query("UPDATE users SET status = 0 WHERE username='$loggeduser' LIMIT 1");
session_destroy();
header("Location: index.php");
?>