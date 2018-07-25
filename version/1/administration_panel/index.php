<?php
require_once('../config.php');
require_once('logincheck.php');
if($ok == 0) {
	header ("Location: http://jaweb.comze.com/version/1/administration_panel/login.php");
}
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
				<p class="post_info">Welcome, <?php echo $loggeduser; ?>! [<a href="logout.php">Logout</a>]</p>
				<br>
				<table width="100%" class="admin_table" cellspacing="0">
					<tr>
						<td colspan="2"><center><b>Select a table.</td>
					</tr>
					<tr>
						<td>Posts</td>
						<?php
						$posts= mysql_query("SELECT * FROM posts");
						$posts_num = mysql_num_rows($posts);
						?>
						<td align="right"><a href="posts/">(<?php echo $posts_num; ?>) Open</a></td>
					</tr>
					<tr>
						<td>Tutorials</td>
						<?php
						$tuts= mysql_query("SELECT * FROM tutorials");
						$tuts_num = mysql_num_rows($tuts);
						?>
						<td align="right"><a href="tutorials/">(<?php echo $tuts_num; ?>) Open</a></td>
					</tr>
					<tr>
						<td>Subscriptions</td>
						<?php
						$new = mysql_query("SELECT * FROM subscriptions WHERE new = 1");
						$newsubemail = mysql_num_rows($new);
						?>
						<td align="right"><a href="subscriptions/">(<?php echo $newsubemail; ?>) Open</a></td>
					</tr>
					<tr>
						<td>Visitors</td>
						<?php
						$visit = mysql_query("SELECT DISTINCT date FROM visitors ORDER BY id DESC LIMIT 1");
						while($row = mysql_fetch_array($visit)) {
							$date = $row['date'];
							$novq = mysql_query("SELECT * FROM visitors WHERE date='$date'");
							$nov = mysql_num_rows($novq);
							$uvq = mysql_query("SELECT DISTINCT ip FROM visitors WHERE date='$date'");
							$nouu = mysql_num_rows($uvq);
						}
						?>
						<td align="right"><a href="visitors/">(<?php echo $nov; ?> / <?php echo $nouu; ?>) Open</a></td>
					</tr>
					<tr>
						<td>Contacts</td>
						<?php
						$query = mysql_query("SELECT * FROM contacts WHERE read_e=0");
						$unread_emails = mysql_num_rows($query);
						?>
						<td align="right"><a href="contacts/">(<?php echo $unread_emails; ?>) Open</a></td>
					</tr>
					<tr>
						<td>Quotes</td>
						<?php
						$query = mysql_query("SELECT * FROM webquotes");
						$webquotes = mysql_num_rows($query);
						?>
						<td align="right"><a href="quotes/">(<?php echo $webquotes; ?>) Open</a></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
<input type="hidden" value="<?php $randas = substr(str_shuffle(str_repeat('_ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',10000)),0,10000); echo $randas; ?>" name="h">	<div id="footer">	<div id="copyright">	<center><img src="http://jaweb.comze.com/version/1/images/skin/default/logo/footer.png"><br><br><br>Copyright JaWeb 2012.<br><br>	<q>Watch, Learn, Listen</q><br><br>Website developed and designed by Juvar Abrera.<br><br><br><br><br><br>	<span>		<a href="http://jaweb.comze.com/version/1/">Home</a> | 		<a href="http://jaweb.comze.com/version/1/tutorials.php">Tutorials</a> | 		<a href="http://jaweb.comze.com/version/1/privacy.php">Privacy Policy</a> | 		<a href="http://jaweb.comze.com/version/1/about.php#thiswebsite">About This Website</a> | 		<a href="http://jaweb.comze.com/version/1/about.php#webowner">Web Owner</a>	</span></center>	<a href="http://jaweb.comze.com/version/1/administration_panel/"><div id="admin">	</div></a>	</div>	<div id="subscribe">	<h2>Subscribe</h2>	<p>Subscribe to our website if you want to receive some emails from us!</p>	<form action="http://www.jaweb.comze.com/version/1/subscribe.php" method="post">	<input type="text" name="subscribe_email" placeholder="E-mail" class="text">	<input type="submit" value="Subcribe" class="button">	</form>	</div>	<div id="networks">		<h4>Like and Subscribe!</h4>		<a href="http://www.facebook.com/tutorialsjaweb" target="_blank" class="facebook"></a>		<a href="http://www.youtube.com/user/JaWebTutorials" target="_blank" class="youtube"></a>	</div></div></div><div id="ie_container"><br><br><br>Sorry but this website is not available in internet explorer.</div></body></html>