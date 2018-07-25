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
				</table><hr class="small_line"><br>
					';
				} else {
					echo '
				<table width="100%">
					<tr>
						<td><input type="text" class="text" placeholder="Search Topics" style="border-radius:10px 0px 0px 10px;"> <input type="submit" class="button" value="Search" style="width:100;border-radius:0px 10px 10px 0px;"></td>
						<td><p align="right"><a href="login.php">Log in</a> | <a href="register.php">Register</a></p></td>
					</tr>
				</table><hr class="small_line"><br>
					';
				}
				?>
				<?php
				if(isset($_GET['postid'])) {
					$postid = $_GET['postid'];
					
					 // \\\\\\\\\\\\\\\\\\\\\\\\ POST  \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
					 
					$aq = mysql_query("SELECT * FROM posts WHERE id='$postid' LIMIT 1");
					$n = 0;
					while ($r = mysql_fetch_array($aq)) {
						$postid = $r['id'];
						$title = $r['title'];
						$message = $r['message'];
						$posted_by = $r['posted_by'];
						$date_posted = $r['date_posted'];
						$under = $r['under'];
						$cq = mysql_query("SELECT * FROM category WHERE id='$under'");
						while($r = mysql_fetch_array($cq)) {
							$f = $r['id'];
							$catname = $r['catname'];
						}
						$user_id_post = mysql_query("SELECT * FROM users WHERE username = '$posted_by'");
						while($row = mysql_fetch_array($user_id_post)) {
							$user_id_post_r = $row['id'];
							$forumpos = $row['forumpos'];
							switch($forumpos) {
								case 3:
									$forumpos_t = '<span style="color:#aa1616;font-weight:bold;">Administrator</span>';
									break;
								case 2:
									$forumpos_t = '<span style="color:green;">Moderator</span>';
									break;
								case 1:
									$forumpos_t = 'Member';
									break;
							}
						}
						$qtup = mysql_query("SELECT * FROM posts WHERE posted_by = '$posted_by'");
						$tup = mysql_num_rows($qtup);
						$qtup1 = mysql_query("SELECT * FROM replies WHERE posted_by = '$posted_by'");
						$tup+=mysql_num_rows($qtup1);
						echo '
				<table width="100%">
					<tr>
						<td><h2>'.$title.'</h2><span class="desc">'.$desc.'</span></td>
						<td><p class="post_info"><br><br><br><a href="index.php">Forum</a> > <a href="viewforum.php?f='.$f.'">'.$catname.'</a> > <a href="viewpost.php?postid='.$postid.'">'.$title.'</a><a href="posting.php?mode=addreply&f='.$f.'&postid='.$postid.'" style="color:white"><div id="new_tr_b">New Reply</div></a>
				</p></td>
					</tr>
				</table>
				<table class="forum_table">
					<tr valign="top">
						<td class="user_info"><a href="member.php?mode=viewprofile&profileid='.$user_id_post_r.'">'.$posted_by.'</a><br><span style="font-size:11px;color:grey;">Position: '.$forumpos_t.'<br>Posts: '.$tup.'</span></td>
						<td>';
						if($posted_by == $loggeduser) {
							echo '<p class="post_info"><a href="posting.php?mode=editpost&postid='.$postid.'">Edit</a> | <a href="process.php?table=posts&action=delete&postid='.$postid.'">Delete</a> | '.$date_posted.'</p><br><br><hr class="small_line"><p>'.$message.'</p>';
						} else {
							echo '<p class="post_info">'.$date_posted.'</p><br><br><hr class="small_line"><p>'.$message.'</p>';
						}
						echo '</td>
					</tr>
				</table>
					';
					
					    // \\\\\\\\\\\\\\\\\\\\\\\\ REPLIES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
					
						$bq = mysql_query("SELECT * FROM replies WHERE postid='$postid' ORDER BY id");
						$postreply = 0;
						while ($r = mysql_fetch_array($bq)) {
							$commentid = $r['id'];
							$message = $r['message'];
							$message = nl2br($message);
							$posted_by = $r['posted_by'];
							$date_posted = $r['date_posted'];
							$qtup = mysql_query("SELECT * FROM posts WHERE posted_by = '$posted_by'");
							$tup = mysql_num_rows($qtup);
							$qtup1 = mysql_query("SELECT * FROM replies WHERE posted_by = '$posted_by'");
							$tup+=mysql_num_rows($qtup1);
							echo '<br>
				<table class="forum_table">
					<tr valign="top">
						<td class="user_info"><a href="member.php?mode=viewprofile&profileid='.$user_id_post_r.'">'.$posted_by.'</a><br><span style="font-size:11px;color:grey;">Position: '.$forumpos_t.'<br>Posts: '.$tup.'</span></td>
						<td>';
							if($posted_by == $loggeduser) {
								echo '<p class="post_info"><a href="posting.php?mode=editreply&commentid='.$commentid.'">Edit</a> | <a href="process.php?table=replies&action=delete&commentid='.$commentid.'">Delete</a> | '.$date_posted.'</p><br><br><hr class="small_line"><p>'.$message.'</p>';
							} else {
								echo '<p class="post_info">'.$date_posted.'</p><br><br><hr class="small_line"><p>'.$message.'</p>';
							}
						echo '</td>
					</tr>
				</table>
					';
							$postreply = 1;
						}
						echo '<br>
				<a href="posting.php?mode=addreply&f='.$f.'&postid='.$postid.'" style="color:white"><div id="new_tr_b">New Reply</div></a>';
						$n = 1;
					}
					if($n == 0) {
						header("Location: http://www.jaweb.comze.com/errors/error404.php");
					}
				} else {
					header("Location: index.php");
				}
				?><br><br><br>
				<?php
				if($ok == 1) {
					if(isset($_GET['postid'])) {
						$postid = $_GET['postid'];
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
				</form>';
					}
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