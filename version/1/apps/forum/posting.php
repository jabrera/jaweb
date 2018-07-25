<?php
require_once('config.php');
require_once('logincheck.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>JaWeb - Web Tutorials</title>
	<link rel="stylesheet" type="text/css" media="all" href="styles/default/6a617765626373737374796c657368656574.css">
	<!--[if IE]>
	<link rel="stylesheet" type="text/css" media="all" href="http://jaweb.comze.com/styles/default/6a617765626373737374796c657368656574666f726965.css">
	<![endif]-->
</head>
<body><center>
<div id="container">
	<div id="top">
		<div id="top_base">
			<a href="http://jaweb.comze.com/"><div id="logo">
			
			</div></a>
			<div id="search">
			<form action="http://jaweb.comze.com/search.php" method="get">
				<input type="text" name="q" placeholder="Search Tutorials">
			</form>
			</div>
			<div id="navigation">
				<a href="http://jaweb.comze.com/" class="main"><div class="main">Home</div></a>
				<a href="http://jaweb.comze.com/about.php" class="main"><div class="main">About</div></a>
				<a href="http://jaweb.comze.com/tutorials.php" class="main"><div class="main">Tutorials</div>
				<a href="http://jaweb.comze.com/contact.php" class="main"><div class="main">Contact</div></a>
			</div>
		</div>
	</div>
	<div id="content">
		<div id="forum_content">
			<div id="wrapper">
				<?php
				if($ok == 1) {
					echo '
				<table width="100%">
					<tr>
						<td><input type="text" class="text" placeholder="Search Topics" style="border-radius:10px 0px 0px 10px;"> <input type="submit" class="button" value="Search" style="width:100;border-radius:0px 10px 10px 0px;"></td>
						<td><p align="right">Welcome, <a href="member.php?mode=viewprofile&profileid='.$user_account_profile_id.'">'.$loggeduser.'</a> | <a href="logout.php">Log out</a></p></td>
					</tr>
				</table><hr class="small_line"><br><br>
					';
				} else {
					echo '
				<table width="100%">
					<tr>
						<td><input type="text" class="text" placeholder="Search Topics" style="border-radius:10px 0px 0px 10px;"> <input type="submit" class="button" value="Search" style="width:100;border-radius:0px 10px 10px 0px;"></td>
						<td><p align="right"><a href="login.php">Log in</a> | <a href="register.php">Register</a></p></td>
					</tr>
				</table><hr class="small_line"><br><br>
					';
				}
				?>
				<?php
				if($ok == 1) {
					if(isset($_GET['mode'])) {
						$mode = $_GET['mode'];
						if($mode == 'newtopic') {
							if(isset($_GET['f'])) {
								$f = $_GET['f'];
								if($f == 2) {
									if($user_account_profile_forum_pos == 3 OR $user_account_profile_forum_pos == 2) {
										echo '
					<form action="process.php?table=posts&action=new" method="post">
					<table class="forum_table">
						<tr valign="top">
							<td class="user_info"><a href="member.php?mode=viewprofile&profileid='.$user_account_profile_id.'">'.$loggeduser.'</a></td><td><p>Post Title:<br><input type="text" class="forum_text" maxlength="40" name="title"></p>
							<p>Message: <br><textarea class="forum_text" name="message"></textarea></p>
							<input type="hidden" name="f" value="'.$f.'">
							<input type="submit" class="button" value="Post"></td>
						</tr>
					</table>
					</form>
					';
						exit;
									} else {
										header("Location: http://www.jaweb.comze.com/errors/error403.php");
									}
								}
								echo '
					<form action="process.php?table=posts&action=new" method="post">
					<table class="forum_table">
						<tr valign="top">
							<td class="user_info"><a href="member.php?mode=viewprofile&profileid='.$user_account_profile_id.'">'.$loggeduser.'</a></td><td><p>Post Title:<br><input type="text" class="forum_text" maxlength="40" name="title"></p>
							<p>Message: <br><textarea class="forum_text" name="message"></textarea></p>
							<input type="hidden" name="f" value="'.$f.'">
							<input type="submit" class="button" value="Post"></td>
						</tr>
					</table>
					</form>
					';
							}
						} elseif($mode == 'editpost') {
							if(isset($_GET['postid'])) {
								$postid = $_GET['postid'];
								$sql = mysql_query("SELECT * FROM posts WHERE id='$postid'");
								while ($row = mysql_fetch_array($sql)) {
									$title = $row['title'];
									$message = $row['message'];
									$posted_by = $row['posted_by'];
								}
								if($posted_by == $loggeduser) {
									echo '
					<form action="process.php?table=posts&action=edit&postid='.$postid.'" method="post">
					<table class="forum_table">
						<tr valign="top">
							<td class="user_info">'.$posted_by.'</td><td><p>Post Title:<br><input type="text" class="forum_text" maxlength="40" name="title" value="'.$title.'"></p>
							<p>Message: <br><textarea class="forum_text" name="message">'.$message.'</textarea></p>
							<input type="submit" class="button" value="Edit"></td>
						</tr>
					</table>
					</form>
					';
								} else {
									echo 'You are not him!';
								}
							}
						} elseif ($mode == 'addreply') {
							if(isset($_GET['postid'])) {
								$postid = $_GET['postid'];
								if(isset($_GET['f'])) {
									$f = $_GET['f'];
									echo '
					<form action="process.php?table=replies&action=add&postid='.$postid.'" method="post">
					<table class="forum_table">
						<tr valign="top">
							<td class="user_info"><a href="member.php?mode=viewprofile&profileid='.$user_account_profile_id.'">'.$loggeduser.'</a></td><td>
							<p>Message: <br><textarea class="forum_text" name="message"></textarea></p>
							<input type="hidden" name="f" value="'.$f.'">
							<input type="submit" class="button" value="Post"></td>
						</tr>
					</table>
					</form>
					';
								}
							}
						} elseif ($mode == 'editreply') {
							if(isset($_GET['commentid'])) {
								$commentid = $_GET['commentid'];
								$sql = mysql_query("SELECT * FROM replies WHERE id='$commentid'");
								while ($row = mysql_fetch_array($sql)) {
									$message = $row['message'];
									$posted_by = $row['posted_by'];
								}
								if($posted_by == $loggeduser) {
									echo '
					<form action="process.php?table=replies&action=edit&commentid='.$commentid.'" method="post">
					<table class="forum_table">
						<tr valign="top">
							<td class="user_info"><a href="member.php?mode=viewprofile&profileid='.$user_account_profile_id.'">'.$loggeduser.'</a></td><td>
							<p>Message: <br><textarea class="forum_text" name="message">'.$message.'</textarea></p>
							<input type="submit" class="button" value="Edit"></td>
						</tr>
					</table>
					</form>
					';
								} else {
									echo 'You are not him!';
								}
							}
						} else {
						header("Location: index.php");
						}
					}
				} else {
					$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
					
					header("Location: login.php?_reurl=".urlencode($url));
				}
				?>
			</div>
		</div>
	</div>
	<div id="footer">
		<div id="copyright">
		<center><img src="http://jaweb.comze.com/images/skin/default/logo/footer.png"><br><br><br>Copyright JaWeb 2012.<br><br>
		<q>Watch, Learn, Listen</q><br><br>Website developed and designed by Juvar Abrera.<br><br><br><br><br><br>
		<span>
			<a href="http://jaweb.comze.com/">Home</a> | 
			<a href="http://jaweb.comze.com/tutorials.php">Tutorials</a> | 
			<a href="http://jaweb.comze.com/privacy.php">Privacy Policy</a> | 
			<a href="http://jaweb.comze.com/about.php#thiswebsite">About This Website</a> | 
			<a href="http://jaweb.comze.com/about.php#webowner">Web Owner</a>
		</span></center>
		<a href="http://jaweb.comze.com/administration_panel/"><div id="admin">
		</div></a>
		</div>
		<div id="forum_stats" style="right:30px;">
		<h2>Forum Stats</h2>
		<?php
		$sql01 = mysql_query("SELECT * FROM posts");
		$sql02 = mysql_query("SELECT * FROM replies");
		$sql03 = mysql_query("SELECT * FROM users");
		$sql04 = mysql_query("SELECT * FROM users WHERE status = 1");
		echo '
		<span class="desc">Total Forum Post: '.mysql_num_rows($sql01).' | Total Forum Replies: '.mysql_num_rows($sql02).' | Total Members: '.mysql_num_rows($sql03).' | Total Members Online: '.mysql_num_rows($sql04).' | Online Members: ';
		$sql04 = mysql_query("SELECT * FROM users WHERE status=1 LIMIT 10");
		$an = 0;
		while($row = mysql_fetch_array($sql04)) {
			$onlineuser = $row['username'];
			$profileid = $row['id'];
			echo '<a href="member.php?mode=viewprofile&profileid='.$profileid.'">'.$onlineuser.'</a> | ';
			$an = 1;
		}
		if($an==0) {
			echo 'No users online | ';
		}
		echo 'Newest Member: ';
		$sql05 = mysql_query("SELECT * FROM users ORDER BY id DESC LIMIT 1");
		while($row = mysql_fetch_array($sql05)) {
			$newestuser = $row['username'];
			$profileid = $row['id'];
			echo '<a href="member.php?mode=viewprofile&profileid='.$profileid.'">'.$newestuser.'</a>';
		}
		?>
		</div>
	</div>
</div>
<div id="ie_container"><br><br><br>Sorry but this website is not available in internet explorer.</div>
</body>
</html>