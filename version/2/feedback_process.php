<?php
require_once('config.php');
require_once('visit.php');
if(isset($_POST['like']) && isset($_POST['comments'])) {
	$like = $_POST['like'];
	$comments = $_POST['comments'];
	if($like == '') {
		header("Location: http://www.jaweb.comze.com/version/2/");
	} else {
		$comments = mysql_real_escape_string($comments);
		date_default_timezone_set('Asia/Manila');
		$date = date('YmdHis');
		$read_e = 0;
		$title = "Feedback Form";
		$fullname = "none";
		$email = "none";
		$message= 'Feedback: '.$like.'<br>Comments:<br>'.$comments;
		$date_added = date('F d Y - h:i:s A');
		mysql_query("INSERT INTO contacts (title, fullname, email, message, date, date_added, read_e) VALUES ('$title', '$fullname', '$email', '$message', '$date', '$date_added', '$read_e')");
		header("Location: http://www.jaweb.comze.com/version/2/");
	}
}
?>