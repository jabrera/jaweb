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
				<p class="post_info"><a href="index.php">Forum</a> > <a href="login.php">Log in</a></p><br><br><hr class="small_line">
				';
				if($ok == 0) {
					if(isset($_POST['username']) || isset($_POST['password'])) {
						$myusername = mysql_real_escape_string($_POST['username']);
						$mypassword = mysql_real_escape_string($_POST['password']);
						if($myusername != '' || $mypassword != '') {
							$sql = mysql_query("SELECT * FROM users WHERE username = '$myusername' AND password = '$mypassword' LIMIT 1");
							$count = mysql_num_rows($sql);
							if($count == 1) {
								$checkuseractivation = mysql_query("SELECT * FROM users WHERE username='$myusername' AND activate=1 LIMIT 1");
								$result_cua = mysql_num_rows($checkuseractivation);
								if($result_cua == 1) {
									$_SESSION['username'] = $myusername;
									$_SESSION['password'] = $mypassword;
									$_SESSION['firstlogin'] = 0;
									$_SESSION['login'] = 0;
									$_SESSION['userrecord'] = mysql_fetch_assoc($sql);
									if(isset($_GET['reurl'])) {
										$r = $_GET['reurl'];
										header("Location: ".$r);
									} else {
										header("Location: index.php");
									}
									exit;
								} else {
									header("Location: activate.php");
								}
							} else {
								echo '
				<h2>Log in</h2>
				<table class="forum_table">
					<tr>
						<td><br><center><form action="login.php" method="post">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td colspan="2"><span class="error">Incorrect username or password</span></td><td rowspan="4"><div class="login_side" style="padding-left:20px;border-left:1px dashed grey;"><img src="../../images/skin/default/bg/jaweb_side.jpg" style="border-radius:10px 10px 0px 0px;"><br><br><center><span style="font-size:12px;"><a href="forgotpass.php">Forgot your password?</a><br><a href="register.php">New here? Sign up now!</a></span></center></div></td>
							</tr>
							<tr>
								<td>Username:</td><td><input type="text" name="username" class="text" placeholder="Username"></td>
							</tr>
							<tr>
								<td>Password:</td><td><input type="password" name="password" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td></td><td><input type="submit" class="button" value="Log in"></td>
							</tr>
						</table>
						</form></td>
					</tr>
				</table>
								';
							}
						} else {
								echo '
				<h2>Log in</h2>
				<table class="forum_table">
					<tr>
						<td><br><center><form action="login.php" method="post">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td colspan="2"><span class="error">Please fill up the form correctly.</span></td><td rowspan="4"><div class="login_side" style="padding-left:20px;border-left:1px dashed grey;"><img src="../../images/skin/default/bg/jaweb_side.jpg" style="border-radius:10px 10px 0px 0px;"><br><br><center><span style="font-size:12px;"><a href="forgotpass.php">Forgot your password?</a><br><a href="register.php">New here? Sign up now!</a></span></center></div></td>
							</tr>
							<tr>
								<td>Username:</td><td><input type="text" name="username" class="text" placeholder="Username"></td>
							</tr>
							<tr>
								<td>Password:</td><td><input type="password" name="password" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td></td><td><input type="submit" class="button" value="Log in"></td>
							</tr>
						</table>
						</form></td>
					</tr>
				</table>
								';
						}
					} else {
						echo '
				<h2>Log in</h2>
				<table class="forum_table">
					<tr>
						<td><br><center><form action="login.php" method="post">
						<table cellpadding="0" cellspacing="0">
							<tr valign="top">
								<td colspan="2"><span class="message">Please use your account to log in.</span></td><td rowspan="4"><div class="login_side" style="padding-left:20px;border-left:1px dashed grey;"><img src="../../images/skin/default/bg/jaweb_side.jpg" style="border-radius:10px 10px 0px 0px;"><br><br><center><span style="font-size:12px;"><a href="forgotpass.php">Forgot your password?</a><br><a href="register.php">New here? Sign up now!</a></span></center></div></td>
							</tr>
							<tr>
								<td>Username:</td><td><input type="text" name="username" class="text" placeholder="Username"></td>
							</tr>
							<tr>
								<td>Password:</td><td><input type="password" name="password" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td></td><td><input type="submit" class="button" value="Log in"></td>
							</tr>
						</table>
						</form></td>
					</tr>
				</table>
								';
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