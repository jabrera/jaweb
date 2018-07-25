<?php
$h = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',10)),0,10);
date_default_timezone_set('Asia/Manila');
$ip = $_SERVER['REMOTE_ADDR'];
$date = date('Ymd');
$wdate = date('F d Y');
$page = $_SERVER['REQUEST_URI'];
$query = mysql_query("SELECT * FROM blocked_ip WHERE ip = '$ip'");
$num_result = mysql_num_rows($query);
/* if($num_result == 1) {
	header("Location: http://jaweb.comze.com/blank.php");
} */
mysql_query("INSERT INTO visitors (hashcode, date, page, ip, wdate) VALUES ('$h', '$date', '$page', '$ip', '$wdate')");
?>