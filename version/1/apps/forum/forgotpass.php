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
				<p class="post_info"><a href="index.php">Forum</a> > <a href="forgotpass.php">Forgot password</a></p><br><br><hr class="small_line">
				';
				if($ok == 0) {
					if(isset($_POST['email'])) {
						$email = $_POST['email'];
						$h1 = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',50)),0,50);
						$h2 = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',50)),0,50);
						$query = mysql_query("SELECT * FROM users WHERE email='$email' LIMIT 1");
						$n = 0;
						while($row = mysql_fetch_array($query)) {
							$id = $row['id'];
							$pass = $row['password'];
							mysql_query("INSERT INTO forgotpass (email, avail, h1, h2, pass_b) VALUES ('$email', 1, '$h1', '$h2','$pass')");
							$emailTitle = "Retrieve My Password";
							$emailMessage = 'One more step to change your password! To change your password, please click the link below at the url bar:<br><br>Notice: Once you visited the link above, it will not work anymore.<br><br><a href="http://www.jaweb.comze.com/apps/forum/changepass.php?id='.$id.'&ha='.$h1.'&he='.$h2.'">http://www.jaweb.comze.com/apps/forum/changepass.php?id='.$id.'&ha='.$h1.'&he='.$h2.'</a><br>';
							$emailSubject = "JaWeb - ".$emailTitle;
							$webmaster = $email;
							$emailContent = '<style type="text/css">#email_content {background:url(http://www.jaweb.comze.com/images/skin/default/bg/copyright.png) no-repeat center bottom #1c1c1c;padding:50px;width:500px;text-align:left;color:white;font-family:trebuchet ms;overflow:hidden;}#email_content #email_message {float:right;width:360px;border-bottom:3px dashed white;padding-bottom:20px;position:relative;}#email_content img {float:left;margin-right:20px;margin-bottom:20px;}#email_content #email_message #email_c {position:absolute;bottom:-30px;font-size:12px;font-style:italic;color:grey;}#email_content a {color:#aa1515;text-decoration:none;}p.posted_by{color:grey;font-size:14px;font-style:italic;margin-top:50px;}</style><br><br><center><div id="email_content"><img src="http://www.jaweb.comze.com/images/skin/default/logo/footer.png"><div id="email_message"><h3>'.$emailTitle.'</h3><p>'.$emailMessage.'</p><div id="email_c">Copyright JaWeb 2012</div></div></div></center>';
							$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
							$headers .= "From: JaWeb <noreply@jaweb.comze.com>\r\n"; 
							mail($webmaster, $emailSubject, $emailContent, $headers);
							echo '
				<h2>You\'re few steps away!</h2>
				<table class="forum_table">
					<tr>
						<td><br><center>
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td colspan="2"><span class="message">Please check your email to change your password.<br><br>If it is not on your inbox folder, do check your spam folder.</span></td><td rowspan="3"><div class="login_side" style="padding-left:20px;border-left:1px dashed grey;"><img src="../../images/skin/default/bg/jaweb_side.jpg" style="border-radius:10px 10px 0px 0px;"></div></td>
							</tr>
							<tr>
								<td></td><td></td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
							';
							$n=1;
						}
						if($n == 0) {
							echo 'no';
						}
					} else {
						echo '
				<h2>Forgot Password</h2>
				<table class="forum_table">
					<tr>
						<td><br><center><form action="forgotpass.php" method="post">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td colspan="2"><span class="error">Please enter your email to retrieve your password.</span></td><td rowspan="3"><div class="login_side" style="padding-left:20px;border-left:1px dashed grey;"><img src="../../images/skin/default/bg/jaweb_side.jpg" style="border-radius:10px 10px 0px 0px;"></div></td>
							</tr>
							<tr>
								<td>Email :</td><td><input type="text" name="email" class="text" placeholder="Email"></td>
							</tr>
							<tr>
								<td></td><td><input type="submit" class="button" value="Retrieve My Password!"></td>
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