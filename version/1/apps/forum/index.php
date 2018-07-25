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
				</table><hr class="small_line">
					';
				} else {
					echo '
				<table width="100%">
					<tr>
						<td><input type="text" class="text" placeholder="Search Topics" style="border-radius:10px 0px 0px 10px;"> <input type="submit" class="button" value="Search" style="width:100;border-radius:0px 10px 10px 0px;"></td>
						<td><p align="right"><a href="login.php">Log in</a> | <a href="register.php">Register</a></p></td>
					</tr>
				</table><hr class="small_line">
					';
				}
				?>
				<p class="post_info"><a href="index.php">Forum</a></p>
				<br><br>
				<hr class="small_line">
				<h2>General</h2>
				<table width="100%">
					<tr>
						<td></td>
						<td class="pr_pad_lr"><center><span class="desc">Posts</span></td>
						<td class="pr_pad_lr"><center><span class="desc">Replies</span></td>
					</tr>
				</table>
				<table class="forum_table" width="100%">
					<?php
					$aq = mysql_query("SELECT * FROM category WHERE under=3");
					$n=0;
					while($r = mysql_fetch_arraY($aq)) {
						$catid = $r['id'];
						$catname = $r['catname'];
						$desc = $r['description'];
						$aaq = mysql_query("SELECT * FROM posts WHERE under='$catid'");
						$nop = mysql_num_rows($aaq);
						$abq = mysql_query("SELECT * FROM replies WHERE under='$catid'");
						$nor = mysql_num_rows($abq);
						echo '
					<tr>
						<td class="icon"><img src="http://www.jaweb.comze.com/images/skin/default/bg/forum_icon.png"></td>
						<td><a href="viewforum.php?f='.$catid.'">'.$catname.'</a><br><span class="desc">'.$desc.'</span></td>
						<td class="forum_num_pr">'.$nop.'</td>
						<td class="forum_num_pr">'.$nor.'</td>
					</tr>
					';
						$n=1;
					}
					if($n == 0) {
						echo '
					<tr>
						<td><center><span class="desc">There are no forum in this category</span></td>
					</tr>
					';
					}
					?>
				</table>
				<br>
				<hr class="small_line">
				<h2>Community</h2>
				<table width="100%">
					<tr>
						<td></td>
						<td class="pr_pad_lr"><center><span class="desc">Posts</span></td>
						<td class="pr_pad_lr"><center><span class="desc">Replies</span></td>
					</tr>
				</table>
				<table class="forum_table" width="100%">
					<?php
					$aq = mysql_query("SELECT * FROM category WHERE under=1");
					$n=0;
					while($r = mysql_fetch_arraY($aq)) {
						$catid = $r['id'];
						$catname = $r['catname'];
						$desc = $r['description'];
						$aaq = mysql_query("SELECT * FROM posts WHERE under='$catid'");
						$nop = mysql_num_rows($aaq);
						$abq = mysql_query("SELECT * FROM replies WHERE under='$catid'");
						$nor = mysql_num_rows($abq);
						echo '
					<tr>
						<td class="icon"><img src="http://www.jaweb.comze.com/images/skin/default/bg/forum_icon.png"></td>
						<td><a href="viewforum.php?f='.$catid.'">'.$catname.'</a><br><span class="desc">'.$desc.'</span></td>
						<td class="forum_num_pr">'.$nop.'</td>
						<td class="forum_num_pr">'.$nor.'</td>
					</tr>
					';
						$n=1;
					}
					if($n == 0) {
						echo '
					<tr>
						<td><center><span class="desc">There are no forum in this category</span></td>
					</tr>
					';
					}
					?>
				</table>
				<br>
				<hr class="small_line">
				<h2>Help Me Code</h2>
				<table width="100%">
					<tr>
						<td></td>
						<td class="pr_pad_lr"><center><span class="desc">Posts</span></td>
						<td class="pr_pad_lr"><center><span class="desc">Replies</span></td>
					</tr>
				</table>
				<table class="forum_table" width="100%">
					<?php
					$aq = mysql_query("SELECT * FROM category WHERE under=2");
					$n=0;
					while($r = mysql_fetch_arraY($aq)) {
						$catid = $r['id'];
						$catname = $r['catname'];
						$desc = $r['description'];
						$aaq = mysql_query("SELECT * FROM posts WHERE under='$catid'");
						$nop = mysql_num_rows($aaq);
						$abq = mysql_query("SELECT * FROM replies WHERE under='$catid'");
						$nor = mysql_num_rows($abq);
						echo '
					<tr>
						<td class="icon"><img src="http://www.jaweb.comze.com/images/skin/default/bg/forum_icon.png"></td>
						<td><a href="viewforum.php?f='.$catid.'">'.$catname.'</a><br><span class="desc">'.$desc.'</span></td>
						<td class="forum_num_pr">'.$nop.'</td>
						<td class="forum_num_pr">'.$nor.'</td>
					</tr>
					';
						$n=1;
					}
					if($n == 0) {
						echo '
					<tr>
						<td><center><span class="desc">There are no forum in this category</span></td>
					</tr>
					';
					}
					?>
				</table>
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