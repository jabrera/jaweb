<?php
require_once('../config.php');
require_once('logincheck.php');
?>
<!--
xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
xx                                  xx
xx          xxx  xxx           xxx  xx
xx          xxx  xxx           xxx  xx
xx          xxx  xxx           xxx  xx
xx  xxx     xxx  xxx    xxx    xxx  xx
xx  xxx     xxx  xxx   xxxxx   xxx  xx
xx  xxxxxxxxxx    xxxxxx   xxxxxx   xx
xx     xxxx        xxxx     xxxx    xx
xx                                  xx
xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html><head><title>JaWeb - Free Online Web Tutorials</title>	<meta name="description" content="JaWeb Online Free Web Tutorials" />	<meta name="keywords" content="Juvar Abrera, Juvar, Abrera, JaWeb, Free, Online, Web, Tutorials, Lessons, HTML, CSS, CSS3, Javascript, jQuery, PHP, mySQL" />	<meta name="author" content="Juvar Abrera" />	<meta name="copyright" content="2012 Copyright Juvar Abrera" />	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />	<!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="http://jaweb.comze.com/version/1/styles/default/6a617765626373737374796c657368656574666f726965.css"><![endif]--><style type="text/css"><?php require_once('../styles/default/6a617765626373737374796c6573686565742.css'); ?></style></head><body><center><input type="hidden" value="<?php $randas = substr(str_shuffle(str_repeat('_ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',10000)),0,10000); echo $randas; ?>" name="h"><div id="container"><div id="top">	<div id="top_base">		<a href="http://jaweb.comze.com/version/1/"><div id="logo">				</div></a>		<div id="search">		<form action="http://jaweb.comze.com/version/1/search.php" method="get">			<input type="text" name="q" placeholder="Search Tutorials">		</form>		</div>		<div id="navigation">			<a href="http://jaweb.comze.com/version/1/" class="main"><div class="main">Home</div></a>			<a href="http://jaweb.comze.com/version/1/about.php" class="main"><div class="main">About</div></a>			<a href="http://jaweb.comze.com/version/1/tutorials.php" class="main"><div class="main">Tutorials</div>			<a href="http://jaweb.comze.com/version/1/contact.php" class="main"><div class="main">Contact</div></a>		</div>	</div>	</div>
	<div id="content">
		<div id="admin_base">
			<div id="wrapper">
				<div id="content_title">
				Administration Login
				</div>
				<?php
				if ($ok == 0) {
					if(isset($_POST['username']) || isset($_POST['password'])) {
						$myusername = $_POST['username'];
						$mypassword = $_POST['password'];
						if((!$myusername) || (!$mypassword)) {
							echo '<form action="login.php" method="post"><center><table class="admin_login">
								<tr>
									<td colspan="2"><span class="error">Please fill up the text fields below.</span></td>
								</tr>
								<tr>
									<td>Username</td><td><input type="text" name="username" class="admin_text" placeholder="Username"></td>
								</tr>
								<tr>
									<td>Password</td><td><input type="password" name="password" class="admin_text" placeholder="Password"></td>
								</tr>
								<tr>
									<td></td>
									<td><input type="submit" value="Login" class="admin_button"></td>
								</tr>
							</table></center></form>';
						} else {
							$sql = mysql_query("SELECT * FROM users WHERE username='$myusername' AND password='$mypassword'");
							$count = mysql_num_rows($sql);
							if($count == 1) {
								$_SESSION['username'] = $myusername;
								$_SESSION['password'] = $mypassword;
								$_SESSION['userrecord'] = mysql_fetch_assoc($sql);
								header("Location: index.php");
							} else {
								echo '<form action="login.php" method="post"><center><table class="admin_login">
									<tr>
										<td colspan="2"><span class="error">Incorrect username or password. Please try again.</span></td>
									</tr>
									<tr>
										<td>Username</td><td><input type="text" name="username" class="admin_text" placeholder="Username"></td>
									</tr>
									<tr>
										<td>Password</td><td><input type="password" name="password" class="admin_text" placeholder="Password"></td>
									</tr>
									<tr>
										<td></td>
										<td><input type="submit" value="Login" class="admin_button"></td>
									</tr>
								</table></center></form>';
							}
						}
					} else {
						echo '<form action="login.php" method="post"><center><table class="admin_login">
							<tr>
								<td colspan="2"><span class="message">Please log in with your account.</span></td>
							</tr>
							<tr>
								<td>Username</td><td><input type="text" name="username" class="admin_text" placeholder="Username"></td>
							</tr>
							<tr>
								<td>Password</td><td><input type="password" name="password" class="admin_text" placeholder="Password"></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" value="Login" class="admin_button"></td>
							</tr>
						</table></center></form>';
					}
				} else {
					header("Location: index.php");
				}
				?>
			</div>
		</div>
	</div>
<input type="hidden" value="<?php $randas = substr(str_shuffle(str_repeat('_ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',10000)),0,10000); echo $randas; ?>" name="h">	<div id="footer">	<div id="copyright">	<center><img src="http://jaweb.comze.com/version/1/images/skin/default/logo/footer.png"><br><br><br>Copyright JaWeb 2012.<br><br>	<q>Watch, Learn, Listen</q><br><br>Website developed and designed by Juvar Abrera.<br><br><br><br><br><br>	<span>		<a href="http://jaweb.comze.com/version/1/">Home</a> | 		<a href="http://jaweb.comze.com/version/1/tutorials.php">Tutorials</a> | 		<a href="http://jaweb.comze.com/version/1/privacy.php">Privacy Policy</a> | 		<a href="http://jaweb.comze.com/version/1/about.php#thiswebsite">About This Website</a> | 		<a href="http://jaweb.comze.com/version/1/about.php#webowner">Web Owner</a>	</span></center>	<a href="http://jaweb.comze.com/version/1/administration_panel/"><div id="admin">	</div></a>	</div>	<div id="subscribe">	<h2>Subscribe</h2>	<p>Subscribe to our website if you want to receive some emails from us!</p>	<form action="http://www.jaweb.comze.com/version/1/subscribe.php" method="post">	<input type="text" name="subscribe_email" placeholder="E-mail" class="text">	<input type="submit" value="Subcribe" class="button">	</form>	</div>	<div id="networks">		<h4>Like and Subscribe!</h4>		<a href="http://www.facebook.com/tutorialsjaweb" target="_blank" class="facebook"></a>		<a href="http://www.youtube.com/user/JaWebTutorials" target="_blank" class="youtube"></a>	</div></div></div><div id="ie_container"><br><br><br>Sorry but this website is not available in internet explorer.</div></body></html>