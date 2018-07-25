<?php
require_once('../config.php');
require_once('logincheck.php');
date_default_timezone_set('Asia/Manila');
$date = date('YmdHis');
$date_added = date('F d Y - h:i:s A');
$year = date('Y');
$month = date('n');
$posted_by = $loggeduser;
if(isset($_GET['table'])) {
	$table = $_GET['table'];
	if(isset($_GET['action'])) {
		$action = $_GET['action'];
		if($table == 'posts') {
			if($action == 'new') {
				$title = $_POST['title'];
				$message = $_POST['message'];
				mysql_query("INSERT INTO posts (title, message, date, date_added, posted_by, year, month) VALUES ('$title', '$message', '$date', '$date_added', '$posted_by', '$year', '$month')");
				header("Location: posts/");
			} elseif ($action == 'edit') {
				if(isset($_GET['id'])) {
					$id = $_GET['id'];
					if(isset($_POST['title']) || isset($_POST['message'])) {
						$title = $_POST['title'];
						$message = $_POST['message'];
						mysql_query("UPDATE posts SET title = '$title', message = '$message' WHERE id='$id' LIMIT 1");
						header("Location: posts/");
					}
				}
			} elseif ($action == 'delete') {
				if(isset($_GET['id'])) {
					$id = $_GET['id'];
					mysql_query("DELETE FROM posts WHERE id='$id'");  
					header("Location: posts/");
				}
			}
		} elseif ($table == 'tutorials') {
			if ($action == 'new') {
				$title = $_POST['title'];
				$message = $_POST['message'];
				$category = $_POST['category'];
				$send = $_POST['send_email'];
				$link_category = strtolower($category);
				$h = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',25)),0,25);
				$video = $_POST['video'];
				mysql_query("INSERT INTO tutorials (title, category, video, message, date, date_added, posted_by) VALUES ('$title', '$category', '$video', '$message', '$date', '$date_added', '$posted_by')");
				$sql = mysql_query("SELECT * FROM tutorials ORDER BY id DESC LIMIT 1");
				while($row = mysql_fetch_array($sql)) {
					$id = $row['id'];
				}
				$emailMessage = '<a href="http://www.jaweb.comze.com/watch.php?category='.$link_category.'&id='.$id.'&h='.$h.'" target="_blank">'.$title.'</a> | '.$message.'';
				$emailSubject = "JaWeb New Tutorial - ".$title;
				$query = mysql_query("SELECT * FROM subscriptions");
				while ($row = mysql_fetch_array($query)) {
					$dbemail = $row['email'];
					$emailContent = '<style type="text/css">#email_content {background:url(http://jaweb.comze.com/images/skin/default/bg/copyright.png) no-repeat center bottom #1c1c1c;padding:50px;width:500px;text-align:left;color:white;font-family:trebuchet ms;overflow:hidden;}#email_content #email_message {float:right;width:360px;border-bottom:3px dashed white;padding-bottom:20px;position:relative;}#email_content img {float:left;margin-right:20px;margin-bottom:20px;}#email_content #email_message #email_c {position:absolute;bottom:-30px;font-size:12px;font-style:italic;color:grey;}#email_content a {color:#aa1515;text-decoration:none;}p.posted_by{color:grey;font-size:14px;font-style:italic;margin-top:50px;}</style><br><br><center><div id="email_content"><img src="http://jaweb.comze.com/images/skin/default/logo/footer.png"><div id="email_message"><h3>'.$emailTitle.'</h3><p>JaWeb just uploaded a new tutorial!<br><br><p>'.$emailMessage.'</p><p class="posted_by">- '.$posted_by.'<div id="email_c">Copyright JaWeb 2012</div></div><a href="http://www.jaweb.comze.com/unsubscribe.php" style="font-size:14px;">Unsubscribe</a></div></center>';
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= "From: Juvar Abrera <contact@juvarabrera.comze.com>\r\n"; 
				}
				if($send == 'yes') {
					mail($dbemail, $emailSubject, $emailContent, $headers);
				}
				header("Location: tutorials/");
			} elseif ($action == 'edit') {
				if(isset($_GET['id'])) {
					$id = $_GET['id'];
					if(isset($_POST['title']) || isset($_POST['message'])) {
						$title = $_POST['title'];
						$message = $_POST['message'];
						$category = $_POST['category'];
						$video = $_POST['video'];
						mysql_query("UPDATE tutorials SET title = '$title', message = '$message', category='$category', video='$video' WHERE id='$id' LIMIT 1");
						header("Location: tutorials/");
					}
				}
			} elseif ($action == 'delete') {
				if(isset($_GET['id'])) {
					$id = $_GET['id'];
					mysql_query("DELETE FROM tutorials WHERE id='$id'");  
					header("Location: tutorials/");
				}
			}
		} elseif($table == 'subscription') {
			if($action == 'emailblast') {
				if (isset($_POST['subject']) && isset($_POST['message'])) {
					$emailTitle = $_POST['subject'];
					$emailMessage = nl2br($_POST['message']);
					$emailSubject = "JaWeb Newsletter - ".$emailTitle;
					$query = mysql_query("SELECT * FROM subscriptions");
					while ($row = mysql_fetch_array($query)) {
						$dbemail = $row['email'];
						$emailContent = '<style type="text/css">#email_content {background:url(http://jaweb.comze.com/images/skin/default/bg/copyright.png) no-repeat center bottom #1c1c1c;padding:50px;width:500px;text-align:left;color:white;font-family:trebuchet ms;overflow:hidden;}#email_content #email_message {float:right;width:360px;border-bottom:3px dashed white;padding-bottom:20px;position:relative;}#email_content img {float:left;margin-right:20px;margin-bottom:20px;}#email_content #email_message #email_c {position:absolute;bottom:-30px;font-size:12px;font-style:italic;color:grey;}#email_content a {color:#aa1515;text-decoration:none;}p.posted_by{color:grey;font-size:14px;font-style:italic;margin-top:50px;}</style><br><br><center><div id="email_content"><img src="http://jaweb.comze.com/images/skin/default/logo/footer.png"><div id="email_message"><h3>'.$emailTitle.'</h3><p>'.$emailMessage.'</p><p class="posted_by">- '.$posted_by.'<div id="email_c">Copyright JaWeb 2012</div></div><a href="http://www.jaweb.comze.com/unsubscribe.php" style="font-size:14px;">Unsubscribe</a></div></center>';
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= "From: Juvar Abrera <contact@juvarabrera.comze.com>\r\n"; 
						mail($dbemail, $emailSubject, $emailContent, $headers);
					}
					header("Location: subscriptions/");
				}
			} elseif($action == 'delete') {
				if(isset($_GET['id'])) {
					$id = $_GET['id'];
					mysql_query("DELETE FROM subscriptions WHERE id='$id'");  
					header("Location: subscriptions/");
				}
			}
		} elseif($table == 'contacts') {
			if($action == 'delete') {
				if(isset($_GET['id'])) {
					$id = $_GET['id'];
					mysql_query("DELETE FROM contacts WHERE id='$id'");  
					header("Location: contacts/");
				}
			} elseif ($action == 'new') {
				$emailTitle = $_POST['title'];
				$emailMessage = nl2br($_POST['message']);
				$emailSubject = "JaWeb - ".$emailTitle;
				$dbemail = $_POST['email'];
				$emailContent = '<style type="text/css">#email_content {background:url(http://jaweb.comze.com/images/skin/default/bg/copyright.png) no-repeat center bottom #1c1c1c;padding:50px;width:500px;text-align:left;color:white;font-family:trebuchet ms;overflow:hidden;}#email_content #email_message {float:right;width:360px;border-bottom:3px dashed white;padding-bottom:20px;position:relative;}#email_content img {float:left;margin-right:20px;margin-bottom:20px;}#email_content #email_message #email_c {position:absolute;bottom:-30px;font-size:12px;font-style:italic;color:grey;}#email_content a {color:#aa1515;text-decoration:none;}p.posted_by{color:grey;font-size:14px;font-style:italic;margin-top:50px;}</style><br><br><center><div id="email_content"><img src="http://jaweb.comze.com/images/skin/default/logo/footer.png"><div id="email_message"><h3>'.$emailTitle.'</h3><p><br><br><p>'.$emailMessage.'</p><p class="posted_by"><div id="email_c">Copyright JaWeb 2012</div></div></div></center>';
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From: Juvar Abrera <noreply@jaweb.comze.com>\r\n"; 
				mail($dbemail, $emailSubject, $emailContent, $headers);
				header("Location: contacts/");
			}
		} elseif($table == 'webquotes') {
			if($action == 'delete') {
				if(isset($_GET['id'])) {
					$id = $_GET['id'];
					mysql_query("DELETE FROM webquotes WHERE id='$id'");  
					header("Location: quotes/");
				}
			} elseif ($action == 'new') {
				$quote = $_POST['quote'];
				$quoted_by = $_POST['quoted_by'];
				mysql_query("INSERT INTO webquotes (quote, quoted_by) VALUES ('$quote', '$quoted_by')");
				header("Location: quotes/new.php");
			}
		}
	}
}
?>