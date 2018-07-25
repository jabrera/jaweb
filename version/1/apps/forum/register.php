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
				echo '
				<p class="post_info"><a href="index.php">Forum</a> > <a href="register.php">Register</a></p><br><br><hr class="small_line">
				';
				?>
				<h2>Register</h2>
				<table class="forum_table">
					<tr>
						<td><br><center>
						<?php
						if(isset($_POST['username']) || isset($_POST['password']) || isset($_POST['email']) || isset($_POST['repassword']) || isset($_POST['reemail'])) {
							$username = mysql_real_escape_string($_POST['username']);
							$password = mysql_real_escape_string($_POST['password']);
							$repassword = mysql_real_escape_string($_POST['repassword']);
							$email = mysql_real_escape_string($_POST['email']);
							$reemail = mysql_real_escape_string($_POST['reemail']);
							if(strlen($username) >= 3 && strlen($username) <=15) {
								if(strlen($password) >= 3 && strlen($password) <=25) {
									if($password == $repassword) {$searchEmailAt = strpos($email, '@');$searchEmailDot = strpos($email, '.');
										if($searchEmailAt != 0) {
											if($searchEmailDot != 0) {
												if($email == $reemail) {$checkuser = mysql_query("SELECT * FROM users WHERE username = '$username' LIMIT 1");
													if(mysql_num_rows($checkuser) != 1) {$checkemail = mysql_query("SELECT * FROM users WHERE email = '$email' LIMIT 1");
														if(mysql_num_rows($checkemail) != 1) {
															echo '<p>Congratulations! One more step and you are fully registered.<br>Your activation code has been sent on your email.<br><span class="desc">If you can\'t see the message coming from us. Please check your spam folder.</span></p><br>';
															$activate = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',20)),0,20);
															$actiond = date('YmdHis');
															$date_joined = date('F d Y');
															mysql_query("INSERT INTO users (username, password, status, last_action, date_joined, email, forumpos, activate) 
																					VALUES ('$username', '$password', 0, '$actiond', '$date_joined', '$email', 1, '$activate') ");
															$emailTitle = "Activate Your Account Here";
															$emailMessage = 'You are now registered in our website but you can\'t use it unless you activate your account.<br><br>To activate your account, please click the link below:<br><a href="http://www.jaweb.comze.com/forum/activate.php?activationcodeforaccount='.$activate.'">http://www.jaweb.comze.com/forum/activate.php?activationcodeforaccount='.$activate.'</a>';
															$emailSubject = "JaWeb Registration - ".$emailTitle;
															$webmaster = $email;
															$emailContent = '<style type="text/css">#email_content {background:url(http://www.jaweb.comze.com/images/skin/default/bg/copyright.png) no-repeat center bottom #1c1c1c;padding:50px;width:500px;text-align:left;color:white;font-family:trebuchet ms;overflow:hidden;}#email_content #email_message {float:right;width:360px;border-bottom:3px dashed white;padding-bottom:20px;position:relative;}#email_content img {float:left;margin-right:20px;margin-bottom:20px;}#email_content #email_message #email_c {position:absolute;bottom:-30px;font-size:12px;font-style:italic;color:grey;}#email_content a {color:#aa1515;text-decoration:none;}p.posted_by{color:grey;font-size:14px;font-style:italic;margin-top:50px;}</style><br><br><center><div id="email_content"><img src="http://www.jaweb.comze.com/images/skin/default/logo/footer.png"><div id="email_message"><h3>'.$emailTitle.'</h3><p>'.$emailMessage.'</p><p class="posted_by">- '.$fullname.'<br>'.$email.'<div id="email_c">Copyright JaWeb 2012</div></div></div></center>';
															$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
															$headers .= "From: JaWeb <noreply@jaweb.comze.com>\r\n"; 
															mail($webmaster, $emailSubject, $emailContent, $headers);
														} else {
															echo '
						<form action="register.php" method="post">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td colspan="2"><span class="error">This email is already used.</span></td>
							</tr>
							<tr>
								<td>Username:</td><td><input type="text" name="username" class="text" placeholder="Username"></td>
							</tr>
							<tr>
								<td>Password:</td><td><input type="password" name="password" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Re-enter Password:</td><td><input type="password" name="repassword" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Email:</td><td><input type="text" name="email" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Re-enter Email:</td><td><input type="text" name="reemail" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td></td><td><input type="submit" class="button" value="Register"></td>
							</tr>
						</table>
						</form>';
														}
													} else {
														echo '
						<form action="register.php" method="post">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td colspan="2"><span class="error">This username is already used.</span></td>
							</tr>
							<tr>
								<td>Username:</td><td><input type="text" name="username" class="text" placeholder="Username"></td>
							</tr>
							<tr>
								<td>Password:</td><td><input type="password" name="password" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Re-enter Password:</td><td><input type="password" name="repassword" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Email:</td><td><input type="text" name="email" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Re-enter Email:</td><td><input type="text" name="reemail" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td></td><td><input type="submit" class="button" value="Register"></td>
							</tr>
						</table>
						</form>';

													}
												} else {
													echo '
						<form action="register.php" method="post">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td colspan="2"><span class="error">Your email does not match.</span></td>
							</tr>
							<tr>
								<td>Username:</td><td><input type="text" name="username" class="text" placeholder="Username"></td>
							</tr>
							<tr>
								<td>Password:</td><td><input type="password" name="password" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Re-enter Password:</td><td><input type="password" name="repassword" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Email:</td><td><input type="text" name="email" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Re-enter Email:</td><td><input type="text" name="reemail" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td></td><td><input type="submit" class="button" value="Register"></td>
							</tr>
						</table>
						</form>';
												}
											} else {
												echo '
						<form action="register.php" method="post">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td colspan="2"><span class="error">Invalid email address.</span></td>
							</tr>
							<tr>
								<td>Username:</td><td><input type="text" name="username" class="text" placeholder="Username"></td>
							</tr>
							<tr>
								<td>Password:</td><td><input type="password" name="password" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Re-enter Password:</td><td><input type="password" name="repassword" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Email:</td><td><input type="text" name="email" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Re-enter Email:</td><td><input type="text" name="reemail" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td></td><td><input type="submit" class="button" value="Register"></td>
							</tr>
						</table>
						</form>';
											}
										} else {
											echo '
						<form action="register.php" method="post">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td colspan="2"><span class="error">Invalid email address.</span></td>
							</tr>
							<tr>
								<td>Username:</td><td><input type="text" name="username" class="text" placeholder="Username"></td>
							</tr>
							<tr>
								<td>Password:</td><td><input type="password" name="password" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Re-enter Password:</td><td><input type="password" name="repassword" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Email:</td><td><input type="text" name="email" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Re-enter Email:</td><td><input type="text" name="reemail" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td></td><td><input type="submit" class="button" value="Register"></td>
							</tr>
						</table>
						</form>';
										}
									} else {
										echo '
						<form action="register.php" method="post">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td colspan="2"><span class="error">Your pasword does not match.</span></td>
							</tr>
							<tr>
								<td>Username:</td><td><input type="text" name="username" class="text" placeholder="Username"></td>
							</tr>
							<tr>
								<td>Password:</td><td><input type="password" name="password" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Re-enter Password:</td><td><input type="password" name="repassword" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Email:</td><td><input type="text" name="email" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Re-enter Email:</td><td><input type="text" name="reemail" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td></td><td><input type="submit" class="button" value="Register"></td>
							</tr>
						</table>
						</form>';
									}
								} else {
									echo '
						<form action="register.php" method="post">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td colspan="2"><span class="error">Password must be 3-25 characters.</span></td>
							</tr>
							<tr>
								<td>Username:</td><td><input type="text" name="username" class="text" placeholder="Username"></td>
							</tr>
							<tr>
								<td>Password:</td><td><input type="password" name="password" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Re-enter Password:</td><td><input type="password" name="repassword" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Email:</td><td><input type="text" name="email" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Re-enter Email:</td><td><input type="text" name="reemail" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td></td><td><input type="submit" class="button" value="Register"></td>
							</tr>
						</table>
						</form>';
								}
							} else {
								echo '
						<form action="register.php" method="post">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td colspan="2"><span class="error">Username must be 3-15 characters.</span></td>
							</tr>
							<tr>
								<td>Username:</td><td><input type="text" name="username" class="text" placeholder="Username"></td>
							</tr>
							<tr>
								<td>Password:</td><td><input type="password" name="password" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Re-enter Password:</td><td><input type="password" name="repassword" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Email:</td><td><input type="text" name="email" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Re-enter Email:</td><td><input type="text" name="reemail" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td></td><td><input type="submit" class="button" value="Register"></td>
							</tr>
						</table>
						</form>';
							}
						} else {
							echo '
						<form action="register.php" method="post">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td>Username:</td><td><input type="text" name="username" class="text" placeholder="Username"></td>
							</tr>
							<tr>
								<td>Password:</td><td><input type="password" name="password" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Re-enter Password:</td><td><input type="password" name="repassword" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Email:</td><td><input type="text" name="email" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td>Re-enter Email:</td><td><input type="text" name="reemail" class="text" placeholder="Password"></td>
							</tr>
							<tr>
								<td></td><td><input type="submit" class="button" value="Register"></td>
							</tr>
						</table>
						</form>';
						}
						?>
						</td>
					</tr>
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