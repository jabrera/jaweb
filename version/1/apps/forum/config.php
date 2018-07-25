<?php
ini_set('display_errors', 0);
error_reporting(0);

$mysql_host = "mysql5.000webhost.com";
$mysql_database = "a2633614_jwf";
$mysql_user = "a2633614_jw";
$mysql_password = "j41F01a996";
/*
$mysql_host = "localhost";
$mysql_database = "jwf";
$mysql_user = "root";
$mysql_password = "";*/
mysql_connect($mysql_host, $mysql_user, $mysql_password);
mysql_select_db($mysql_database);
?>