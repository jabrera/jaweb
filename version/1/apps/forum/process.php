<?php
require_once('config.php');
require_once('logincheck.php');
date_default_timezone_set('Asia/Manila');
$date_added = date('F d Y - h:i:s A');
$date_added = $date_added.' (+8 GMT)';
$posted_by = $loggeduser;
$url = $_SERVER['REQUEST_URI'];
if(isset($_GET['table'])) {
	$table = $_GET['table'];
	if(isset($_GET['action'])) {
		$action = $_GET['action'];
		if($table == 'posts') {
			if($action == 'new') {
				if(isset($_POST['title']) || isset($_POST['message'])) {
					$title = htmlspecialchars($_POST['title'],ENT_COMPAT);
					$message = htmlspecialchars($_POST['message'],ENT_COMPAT);
					$f = mysql_real_escape_string($_POST['f']);
					if($title != '') {
						if($message != '') {
							mysql_query("INSERT INTO posts (title, message, posted_by, date_posted, under) VALUES ('$title', '$message', '$posted_by', '$date_added', '$f')");
							$gotonewpost = mysql_query("SELECT * FROM posts ORDER BY id DESC LIMIT 1");
							while ($row = mysql_fetch_array($gotonewpost)) {
								$id = $row['id'];
							}
							header("Location: viewpost.php?postid=".$id);
						} else {
							header("Location: http://www.jaweb.comze.com/errors/error403.php");
						}
					} else {
						header("Location: http://www.jaweb.comze.com/errors/error403.php");
					}
				} else {
					header("Location: http://www.jaweb.comze.com/errors/error403.php");
				}
			} elseif($action =='edit') {
				if(isset($_POST['title']) || isset($_POST['message'])) {
					$title = htmlspecialchars($_POST['title'],ENT_COMPAT);
					$message = htmlspecialchars($_POST['message'],ENT_COMPAT);
					$postid = $_GET['postid'];
					if($title != '') {
						if($message != '') {
							mysql_query("UPDATE posts SET title = '$title', message = '$message' WHERE id='$postid' LIMIT 1");
							header("Location: viewpost.php?postid=".$postid);
						} else {
							header("Location: http://www.jaweb.comze.com/errors/error403.php");
						}
					} else {
						header("Location: http://www.jaweb.comze.com/errors/error403.php");
					}
				} else {
					header("Location: http://www.jaweb.comze.com/errors/error403.php");
				}
			} elseif($action == 'delete') {
				if(isset($_GET['postid'])) {
					$postid = $_GET['postid'];
					$sql = mysql_query("SELECT * FROM posts WHERE id='$postid'");
					while($row = mysql_fetch_array($sql)) {
						$posted_by2 = $row['posted_by'];
					}
					if($posted_by2 == $loggeduser) {
						mysql_query("DELETE FROM posts WHERE id='$postid'");
						mysql_query("DELETE FROM replies WHERE postid='$postid'");
						header("Location: index.php");
					} else {
						header("Location: http://www.jaweb.comze.com/errors/error403.php");
					}
				} else {
					header("Location: http://www.jaweb.comze.com/errors/error403.php");
				}
			} else {
				header("Location: http://www.jaweb.comze.com/errors/error403.php");
			}
		} elseif($table == 'replies') {
			if($action == 'add') {
				if(isset($_GET['postid'])) {
					$postid = $_GET['postid'];
					if(isset($_POST['message'])) {
						$message = htmlspecialchars($_POST['message'],ENT_COMPAT);
						$f = $_POST['f'];
						if($message != '') {
							echo 'yey';
							mysql_query("INSERT INTO replies (message, posted_by, date_posted, under, postid) VALUES ('$message', '$posted_by', '$date_added', '$f', '$postid')");
							header("Location: viewpost.php?postid=".$postid);
						} else {
							header("Location: http://www.jaweb.comze.com/errors/error403.php");
						}
					} else {
						header("Location: http://www.jaweb.comze.com/errors/error403.php");
					}
				} else {
					header("Location: http://www.jaweb.comze.com/errors/error403.php");
				}
			} elseif ($action == 'edit') {
				if(isset($_POST['message'])) {
					$message = htmlspecialchars($_POST['message'],ENT_COMPAT);
					if(isset($_GET['commentid'])) {
						$commentid = $_GET['commentid'];
						if($message != '') {
							mysql_query("UPDATE replies SET message = '$message' WHERE id='$commentid' LIMIT 1");
							$gotopost = mysql_query("SELECT * FROM replies WHERE id = '$commentid'");
							while($row = mysql_fetch_array($gotopost)) {
								$postid = $row['postid'];
							}
							header("Location: viewpost.php?postid=".$postid);
						} else {
							header("Location: http://www.jaweb.comze.com/errors/error403.php");
						}
					} else {
						header("Location: http://www.jaweb.comze.com/errors/error403.php");
					}
				} else {
					header("Location: http://www.jaweb.comze.com/errors/error403.php");
				}
			} elseif ($action == 'delete') {
				if(isset($_GET['commentid'])) {
					$commentid = $_GET['commentid'];
					$sql = mysql_query("SELECT * FROM replies WHERE id='$commentid'");
					while($row = mysql_fetch_array($sql)) {
						$posted_by2 = $row['posted_by'];
					}
					if($posted_by2 == $loggeduser) {
						$gotopost = mysql_query("SELECT * FROM replies WHERE id = '$commentid'");
						while($row = mysql_fetch_array($gotopost)) {
							$postid = $row['postid'];
						}
						mysql_query("DELETE FROM replies WHERE id='$commentid'");
						header("Location: viewpost.php?postid=".$postid);
					} else {
						header("Location: http://www.jaweb.comze.com/errors/error403.php");
					}
				} else {
					header("Location: http://www.jaweb.comze.com/errors/error403.php");
				}
			} else {
				header("Location: http://www.jaweb.comze.com/errors/error403.php");
			}
		} else {
			header("Location: http://www.jaweb.comze.com/errors/error403.php");
		}
	} else {
		header("Location: http://www.jaweb.comze.com/errors/error403.php");
	}
} else {
	header("Location: http://www.jaweb.comze.com/errors/error403.php");
}
?>