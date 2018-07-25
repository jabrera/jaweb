<?php
session_set_cookie_params(0);
session_start();
require_once('config.php');
date_default_timezone_set('Asia/Manila');
$actiond = date('YmdHis');
mysql_connect($mysql_host,$mysql_user,$mysql_pass);
mysql_select_db($mysql_data);
$ok = 0;
if(isset($_SESSION['username']) || isset($_SESSION['password'])) {
	$ok = 1;
	$loggeduser = $_SESSION['username'];
	$sql = mysql_query("SELECT * FROM users WHERE username='$loggeduser'");
	while($row = mysql_fetch_array($sql)) {
		$last_action = $row['last_action'];
		$user_account_profile_id = $row['id'];
		$user_account_profile_forum_pos = $row['forumpos'];
		$cookie = $actiond - $last_action;
		if($_SESSION['login'] == 1) {
			if($cookie > 300) {
				header("Location: logout.php");	
			}
		}
		if($_SESSION['firstlogin'] == 0) {
			$_SESSION['login'] = 1;
		}
	}
	mysql_query("UPDATE users SET status = 1, last_action='$actiond' WHERE username='$loggeduser' LIMIT 1");
}
// offline all accounts
$asql = mysql_query("SELECT * FROM users WHERE status=1");
while($row = mysql_fetch_array($asql)) {
	$account_last_action = $row['last_action'];
	$cookie = $actiond - $account_last_action;
	$username = $row['username'];
	if($cookie > 500) {
		mysql_query("UPDATE users SET status = 0 WHERE username='$username' LIMIT 1");
	}
}
?>