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
					header("Location:index.php");
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
				<?php
				echo '
				<p class="post_info"><a href="index.php">Forum</a> > <a href="changepass.php">Change password</a></p><br><br><hr class="small_line">
				';
				if($ok == 0) {
					if(isset($_GET['ha']) && isset($_GET['he'])) {
						$ha = $_GET['ha'];
						$he = $_GET['he'];
						$query = mysql_query("SELECT * FROM forgotpass WHERE h1='$ha' AND h2='$he' AND avail = 1 LIMIT 1");
						$n = 0;
						while($row = mysql_fetch_array($query)) {
							$id = $row['id'];
							$n=1;
							echo '
				<h2>Change Password</h2>
				<table class="forum_table">
					<tr>
						<td><br><center><form action="changepass.php?action=change&na='.$ha.'&ne='.$he.'" method="post">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td colspan="2"><span class="message">Please enter your new password.</span></td><td rowspan="3"><div class="login_side" style="padding-left:20px;border-left:1px dashed grey;"><img src="../../images/skin/default/bg/jaweb_side.jpg" style="border-radius:10px 10px 0px 0px;"></div></td>
							</tr>
							<tr>
								<td>Password :</td><td><input type="password" name="npassword" class="text" placeholder="Email"></td>
							</tr>
							<tr>
								<td>Re-enter Password :</td><td><input type="password" name="rnpassword" class="text" placeholder="Email"></td>
							</tr>
							<tr>
								<td></td><td><input type="submit" class="button" value="Change My Password!"></td>
							</tr>
						</table>
						</form></td>
					</tr>
				</table>
							';
						}
						if($n == 0) {
							header("Location: http://www.jaweb.comze.com/errors/error403.php");
						}
					} elseif (isset($_GET['action']) && isset($_GET['na']) && isset($_GET['ne'])) {
						$action = $_GET['action'];
						$na = $_GET['na'];
						$ne = $_GET['ne'];
						$npass = $_POST['npassword'];
						$rnpass = $_POST['rnpassword'];
						if ($npass != $rnpass) {
							echo '
				<h2>Change Password</h2>
				<table class="forum_table">
					<tr>
						<td><br><center><form action="changepass.php?na='.$na.'&ne='.$ne.'" method="post">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td colspan="2"><span class="error">Password do not match.</span></td><td rowspan="3"><div class="login_side" style="padding-left:20px;border-left:1px dashed grey;"><img src="../../images/skin/default/bg/jaweb_side.jpg" style="border-radius:10px 10px 0px 0px;"></div></td>
							</tr>
							<tr>
								<td>Password :</td><td><input type="password" name="npassword" class="text" placeholder="Email"></td>
							</tr>
							<tr>
								<td>Re-enter Password :</td><td><input type="password" name="rnpassword" class="text" placeholder="Email"></td>
							</tr>
							<tr>
								<td></td><td><input type="submit" class="button" value="Change My Password!"></td>
							</tr>
						</table>
						</form></td>
					</tr>
				</table>
							';
						} else {
							mysql_query("UPDATE forgotpass SET avail = 0, pass_a = '$npass' WHERE h1='$na' AND h2='$ne' LIMIT 1");
							$qpass = mysql_query("SELECT * FROM forgotpass WHERE h1='$na' AND h2='$ne' LIMIT 1");
							while($row = mysql_fetch_array($qpass)) {
								$email = $row['email'];
								$aqpass = mysql_query("SELECT * FROM users WHERE email = '$email' LIMIT 1");
								mysql_query("UPDATE users SET password = '$npass' WHERE email='$email' LIMIT 1");
								header("Location: index.php");
							}
							echo 'YES';	
						}
					} else {
						header("Location: http://www.jaweb.comze.com/errors/error403.php");
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