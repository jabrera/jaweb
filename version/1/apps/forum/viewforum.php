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
				if(isset($_GET['f'])) {
					$f = $_GET['f'];
					$aq = mysql_query("SELECT * FROM category WHERE id='$f' LIMIT 1");
					$check = 0;
					while($r = mysql_fetch_array($aq)) {
						$title = $r['catname'];
						$desc = $r['description'];
						echo '
				<table width="100%">
					<tr>
						<td><h2>'.$title.'</h2><span class="desc">'.$desc.'</span></td>
						<td><p class="post_info"><br><br><br><a href="index.php">Forum</a> > <a href="viewforum.php?f='.$f.'">'.$title.'</a>
				<a href="posting.php?mode=newtopic&f='.$f.'" style="color:white"><div id="new_tr_b">Post A New Topic</div></a></p></td>
					</tr>
				</table>
				<hr class="small_line">
				<table width="100%" cellpadding="10px">
					<tr>
						<td></td>
						<td width="60px"><center><span class="desc">Replies</span></td>
						<td width="150px"><center><span class="desc">Last Reply</span></td>
					</tr>
				</table><table class="forum_table" width="100%">
					';
						$bq = mysql_query("SELECT * FROM posts WHERE under='$f' ORDER BY id DESC");
						$n=0;
						while($r = mysql_fetch_arraY($bq)) {
							$id = $r['id'];
							$title = $r['title'];
							$posted_by = $r['posted_by'];
							$getidofpostedby = mysql_query("SELECT * FROM users WHERE username = '$posted_by'");
							while($row = mysql_fetch_array($getidofpostedby)) {
								$user_id = $row['id'];
							}
							$date_posted = $r['date_posted'];
							$baq = mysql_query("SELECT * FROM replies WHERE postid='$id'");
							$noriap = mysql_num_rows($baq);
							$caq = mysql_query("SELECT * FROM replies WHERE postid='$id' ORDER BY id DESC LIMIT 1");
							$no_last = 0;
							while ($row = mysql_fetch_array($caq)) {
								$last_post_by = $row['posted_by'];
								$getidoflastreply = mysql_query("SELECT * FROM users WHERE username='$last_post_by'");
								while($row = mysql_fetch_array($getidoflastreply)) {
									$user_id2 = $row['id'];
								}
								$last_post_by = '<a href="member.php?mode=viewprofile&profileid='.$user_id2.'"><span class="desc">'.$last_post_by.'</span></a>';
								$no_last = 1;
							}
							if ($no_last == 0) {
								$last_post_by = '<span class="desc">No replies</span>';
							}
							echo '
						<tr>
							<td class="icon"><img src="http://www.jaweb.comze.com/images/skin/default/bg/forum_icon.png"></td>
							<td><a href="viewpost.php?postid='.$id.'">'.$title.'</a><br><span class="desc">Posted by: <a href="member.php?mode=viewprofile&profileid='.$user_id.'">'.$posted_by.'</a> - Date Posted: '.$date_posted.'</span></td>
							<td class="forum_num_pr">'.$noriap.'</td>
							<td class="forum_num_lr">'.$last_post_by.'</td>
						</tr>
						';
							$n=1;
						}
						if($n == 0) {
							echo '
						<tr>
							<td><center><span class="desc">There are no post in this forum. Click <a href="posting.php?mode=newtopic&f='.$f.'">here</a> to post a new one.</span></td>
						</tr>
						';
						}
						echo '
				</table><br>
				<a href="posting.php?mode=newtopic&f='.$f.'"><div id="new_tr_b">Post A New Topic</div></a>
				';
					}
					$check = 1;
					if($check == 0){
						echo 'yaye';
					}
				} else {
					header("Location: index.php");
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