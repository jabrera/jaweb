<?php
header("Location: http://www.jaweb.comze.com/errors/websiteclosed.php"); 
ini_set('display_errors', 0);
error_reporting(0);

$mysql_host = "mysql5.000webhost.com";
$mysql_database = "a2633614_db";
$mysql_user = "a2633614_ja";
$mysql_password = "j41F01a996";
/*
$mysql_host = "localhost";
$mysql_database = "jawebtest";
$mysql_user = "root";
$mysql_password = "juvarabrera";*/
mysql_connect($mysql_host, $mysql_user, $mysql_password);
mysql_select_db($mysql_database);
?>