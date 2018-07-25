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
				if(isset($_GET['mode'])) {
					$mode = $_GET['mode'];
					if($mode == 'viewprofile') {
						if(isset($_GET['profileid'])) {
							$profileid = $_GET['profileid'];
							$query = mysql_query("SELECT * FROM users WHERE id='$profileid'");
							$n = 0;
							while($row = mysql_fetch_array($query)) {
								$username = $row['username'];
								$email = $row['email'];
								$id = $row['id'];
								$date_joined = $row['date_joined'];
								$last_login = $row['last_action'];
								$forum_pos = $row['forumpos'];
								switch ($forum_pos) {
									case 1:
										$forum_pos = "Member";
										break;
									case 2:
										$forum_pos = "Moderator";
										break;
									case 3:
										$forum_pos = "Administrator";
										break;
								}
								$totaluserpost = mysql_query("SELECT * FROM posts WHERE posted_by='$username'");
								$totaluserpost = mysql_num_rows($totaluserpost);
								$totaluserreply = mysql_query("SELECT * FROM replies WHERE posted_by='$username'");
								$totaluserreply = mysql_num_rows($totaluserreply);
								echo '
				<a href="member.php?mode=viewprofile&profileid='.$id.'"><h2>'.$username.'\'s Profile</h2></a><hr class="small_line">
				<table width="100%" cellpadding="5px">
					<tr valign="top">
						<td width="300px"><p>Email: '.$email.'</p>
						<p>User ID: '.$id.'</p>
						<p>Forum Position: '.$forum_pos.'</p>
						<p>Total Post: '.$totaluserpost.' posts</p>
						<p>Total Replies: '.$totaluserreply.' replies</p>
						<p>Date Joined: '.$date_joined.'</p>
						<p>Last Action: '.$last_login.'</p>
						</td>
						<td><b>About Me ';
						if($username == $loggeduser) {
							echo '<a href="member.php?mode=editprofile&profileid='.$profileid.'">[Edit My Account/ Profile]</a>';
						}
						echo '</b><hr class="small_line"><p>Wahaha</p></td>
					</tr>
				</table>
				';
							$n = 1;
							}
							if($n == 0) {
								echo 'User not found';
							}
						}
					} elseif($mode == 'editprofile') {
						if(isset($_GET['profileid'])) {
							$profileid = $_GET['profileid'];
							$query = mysql_query("SELECT * FROM users WHERE id='$profileid'");
							$n=0;
							while ($row = mysql_fetch_array($query)) {
								$username = $row['username'];
								$email = $row['email'];
								$password = $row['password'];
								$profileid = $row['profileid'];
								if($username == $loggeduser) {
									echo '
				<h3>Edit Your Account/ Profile</h3>
				<form action="process.php?table=users&action=edit&profileid='.$profileid.'">
				<table width="100%" cellpadding="10">
					<tr>
						<td>Email</td>
						<td><input type="text" class="text" value="'.$email.'"> <span class="desc">Change your email</span></td>
					</tr>
					<tr valign="top">
						<td>Change Password</td>
						<td><input type="password" class="text"> <span class="desc">Type your new password.</span><br>
						<input type="password" class="text"> <span class="desc">Repeat your new password.</span><br>
						<input type="password" class="text"> <span class="desc">Type your current password to confirm.</span></td>
					</tr>
					<tr valign="top">
						<td></td>
						<td><input type="submit" class="button" value="Save Changes"></td>
					</tr>
				</table>
				</form>
				';
								} else {
									echo 'Lol.';
								}
								$n = 1;
							}
							if($n == 0) {
								header("Location: http://www.jaweb.comze.com/errors/error403.php");
							}
						} else {
							header("Location: index.php");
						}
					} else {
						header("Location: index.php");
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