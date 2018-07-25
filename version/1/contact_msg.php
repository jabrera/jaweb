<?php
require_once('config.php');
if(isset($_GET['webaction'])) {
	$webaction = $_GET['webaction'];
	if($webaction == 'contact') {
		if(isset($_POST['title']) || isset($_POST['message']) || isset($_POST['fullname']) || isset($_POST['email'])) {
			$title = mysql_real_escape_string($_POST['title']);
			$message = mysql_real_escape_string($_POST['message']);
			$fullname = mysql_real_escape_string($_POST['fullname']);
			$email = mysql_real_escape_string($_POST['email']);
			$ans = mysql_real_escape_string($_POST['ans']);
			$searchEmailAt = strpos($email, '@');
			$searchEmailDot = strpos($email, '.');
			$verify = mysql_real_escape_string($_POST['verify']);
			if(!$title || !$message) {
				header("Location: ../contact.php?error=1");
			} elseif ($ans != $verify) {
				header("Location: ../contact.php?error=2");
			} elseif ($searchEmailAt == 0) {
				header("Location: ../contact.php?error=3");
			} elseif ($searchEmailDot == 0) {
				header("Location: ../contact.php?error=3");
			} else {
				date_default_timezone_set('Asia/Manila');
				$date = date('YmdHis');
				$read_e = 0;
				$date_added = date('F d Y - h:i:s A');
				mysql_query("INSERT INTO contacts (title, fullname, email, message, date, date_added, read_e) VALUES ('$title', '$fullname', '$email', '$message', '$date', '$date_added', '$read_e')");
				$emailTitle = $title;
				$emailMessage = nl2br($message);
				$emailSubject = "JaWeb Contact - ".$emailTitle;
				$webmaster = 'juvarabrera@jaweb.comze.com';
				$emailContent = '<style type="text/css">#email_content {background:url(http://www.jaweb.comze.com/images/skin/default/bg/copyright.png) no-repeat center bottom #1c1c1c;padding:50px;width:500px;text-align:left;color:white;font-family:trebuchet ms;overflow:hidden;}#email_content #email_message {float:right;width:360px;border-bottom:3px dashed white;padding-bottom:20px;position:relative;}#email_content img {float:left;margin-right:20px;margin-bottom:20px;}#email_content #email_message #email_c {position:absolute;bottom:-30px;font-size:12px;font-style:italic;color:grey;}#email_content a {color:#aa1515;text-decoration:none;}p.posted_by{color:grey;font-size:14px;font-style:italic;margin-top:50px;}</style><br><br><center><div id="email_content"><img src="http://www.jaweb.comze.com/images/skin/default/logo/footer.png"><div id="email_message"><h3>'.$emailTitle.'</h3><p>'.$emailMessage.'</p><p class="posted_by">- '.$fullname.'<br>'.$email.'<div id="email_c">Copyright JaWeb 2012</div></div></div></center>';
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From: Juvar Abrera <contact@juvarabrera.comze.com>\r\n"; 
				mail($webmaster, $emailSubject, $emailContent, $headers);
				header("Location: ../contact.php?success=1");
			}
		}
	}
} else {
	header("Location: ../errors/error403.php");
}
?>