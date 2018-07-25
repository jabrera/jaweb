<?php
require_once('config.php');
require_once('visit.php');
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html><head><title>JaWeb - Free Online Web Tutorials</title>	<meta name="description" content="JaWeb Online Free Web Tutorials" />	<meta name="keywords" content="Juvar Abrera, Juvar, Abrera, JaWeb, Free, Online, Web, Tutorials, Lessons, HTML, CSS, CSS3, Javascript, jQuery, PHP, mySQL" />	<meta name="author" content="Juvar Abrera" />	<meta name="copyright" content="2012 Copyright Juvar Abrera" />	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />	<!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="http://jaweb.comze.com/version/1/styles/default/6a617765626373737374796c657368656574666f726965.css"><![endif]--><style type="text/css"><?php require_once('styles/default/6a617765626373737374796c657368656574.css'); ?></style></head><body><center><input type="hidden" value="<?php $randas = substr(str_shuffle(str_repeat('_ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',10000)),0,10000); echo $randas; ?>" name="h"><div id="container"><div id="top">	<div id="top_base">		<a href="http://jaweb.comze.com/version/1/"><div id="logo">				</div></a>		<div id="search">		<form action="http://jaweb.comze.com/version/1/search.php" method="get">			<input type="text" name="q" placeholder="Search Tutorials">		</form>		</div>		<div id="navigation">			<a href="http://jaweb.comze.com/version/1/" class="main"><div class="main">Home</div></a>			<a href="http://jaweb.comze.com/version/1/about.php" class="main"><div class="main">About</div></a>			<a href="http://jaweb.comze.com/version/1/tutorials.php" class="main"><div class="main">Tutorials</div>			<a href="http://jaweb.comze.com/version/1/contact.php" class="main"><div class="main">Contact</div></a>		</div>	</div>	</div>
	<div id="content">
		<div id="header">
			<div id="gad_menu">
			<?php
			$widq = mysql_query("SELECT * FROM widgets ORDER BY id ASC");
			while($row = mysql_fetch_array($widq)) {
				$wid_name = $row['wid_name'];
				$wid_img = $row['wid_img'];
				$wid_url = $row['wid_url'];
				$wid_img = 'images/skin/default/wid/'.$wid_img.'.png';
				if(!file_exists($wid_img)) {
					$wid_img = 'images/skin/default/wid/noimg.png';
				}
				echo '
				<a href="'.$wid_url.'"><div id="widgadm">
					<img src="http://www.jaweb.comze.com/version/1/'.$wid_img.'">
					<div id="widname">
					'.$wid_name.'
						<div id="arrow_down"></div>
					</div>
				</div></a>
			';
			}
			?>
			</div>
			<div id="h_text">
			<?php
			$totalsql = mysql_query("SELECT * FROM tutorials");
			$totaloftuts = mysql_num_rows($totalsql);
			echo 'Total of <a href="http://www.jaweb.comze.com/version/1/tutorials.php" style="color:white;font-weight:normal;"><span>'.$totaloftuts.'</span></a> tutorials';
			?>
			</div>
		</div>
		<div id="center">
			<div id="wrapper">
				<div id="content_title">Unubscribe</div><br>
				<?php
				if (isset($_POST['unsubscribe_email'])) {
					$email = $_POST['unsubscribe_email'];
					$searchEmailAt = strpos($email, '@');
					$searchEmailDot = strpos($email, '.');
					if($email == '') {
					echo '
				<p><center><form action="unsubscribe.php" method="post"><table>
					<tr><td><span class="error">Please enter your email to unsubscribe!</span><br></td></tr>
					<tr><td><input type="text" name="unsubscribe_email" class="admin_text" placeholder="E-mail"></td></tr>
					<tr><td><input type="submit" value="Unsubscribe" class="admin_button"></td></tr>
				</table></form></center></p>
					';
					} elseif ($searchEmailAt == 0){
						echo '
					<p><center><form action="unsubscribe.php" method="post"><table>
						<tr><td><span class="error">Your email is not valid.</span><br></td></tr>
						<tr><td><input type="text" name="unsubscribe_email" class="admin_text" placeholder="E-mail"></td></tr>
						<tr><td><input type="submit" value="Unsubscribe" class="admin_button"></td></tr>
					</table></form></center></p>
						';
					} elseif ($searchEmailDot == 0) {
						echo '
					<p><center><form action="unsubscribe.php" method="post"><table>
						<tr><td><span class="error">Your email is not valid.</span><br></td></tr>
						<tr><td><input type="text" name="unsubscribe_email" class="admin_text" placeholder="E-mail"></td></tr>
						<tr><td><input type="submit" value="Unsubscribe" class="admin_button"></td></tr>
					</table></form></center></p>
						';
					} else {
						$query = mysql_query("SELECT * FROM subscriptions WHERE email='$email' LIMIT 1");
						$available = mysql_num_rows($query);
						if ($available == 1) {
							mysql_query("DELETE FROM subscriptions WHERE email='$email'");  
							echo '<p>Your email, '.$email.', has been unsubscribe in our website.';
						} else {
							echo '
						<p><center><form action="unsubscribe.php" method="post"><table>
							<tr><td><span class="error">This email does not exist.</span><br></td></tr>
							<tr><td><input type="text" name="unsubscribe_email" class="admin_text" placeholder="E-mail"></td></tr>
							<tr><td><input type="submit" value="Unsubscribe" class="admin_button"></td></tr>
						</table></form></center></p>
							';
						}
					}
				} else {
					if(isset($_GET['he'])) {
						$he = $_GET['he'];
						$heq = mysql_query("SELECT * FROM subscriptions WHERE unsubscribe='$he' LIMIT 1");
						$n = 0;
						while ($row = mysql_fetch_array($heq)) {
							$email = $row['email'];
						}
					}
					echo '
				<p><center><form action="unsubscribe.php" method="post"><table>
					<tr><td><span class="message">Please enter your email to unsubscribe.</span><br></td></tr>
					<tr><td><input type="text" name="unsubscribe_email" value="'.$email.'" class="admin_text" placeholder="E-mail"></td></tr>
					<tr><td><input type="submit" value="Unsubscribe" class="admin_button"></td></tr>
				</table></form></center></p>
				';
				}
				?>
			</div>
		</div>
		<div id="right_sb">
			<div id="wrapper">
				<div id="content_title">
				Recent Tutorials
				</div><p><hr class="small_line">
				<?php
				$query = mysql_query("SELECT * FROM tutorials ORDER BY id DESC LIMIT 5");
				$ab = 0;
				while ($row=mysql_fetch_array($query)) {
					$id = $row['id'];
					$title = $row['title'];
					$message = $row['message'];
					$message = substr($message,0,55);
					$category = $row['category'];
					$link_category = strtolower($category);
					$h = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',25)),0,25);
					$sql = mysql_query("SELECT * FROM hash WHERE tutid='$id'");
					$views = mysql_num_rows($sql);
					echo '
				<p><a href="watch.php?category='.$link_category.'&id='.$id.'&h='.$h.'">'.$title.'</a> | '.$message.'...<br></p><span class="info">Category: '.$category.' | '.$views.' views</span><hr class="small_line">
				';
					$ab = 1;
				}
				if($ab==0) {
					echo '<p class="post_info">There are no tutorials posted!</p>';
				}
				?>
				</p>
				<div id="content_title">
				Request A Tutorial
				</div><p>
				Do you want to learn more that is not listed here? Click <a href="contact.php">here</a> to request a tutorial.
				</p>
				<div id="content_title">
				Designer's Quotes
				</div><p>
				<?php
				$query = mysql_query("SELECT * FROM webquotes ORDER BY RAND() LIMIT 1");
				while($row = mysql_fetch_array($query)) {
					$randwebquote = $row['quote'];
					$randwebdesigner = $row['quoted_by'];
				}
				?>
				<em><q><?php echo $randwebquote; ?></q>
				<p align="right">- <?php echo $randwebdesigner; ?></p></em>
				</p>
			</div>
		</div>
	</div>
<input type="hidden" value="<?php $randas = substr(str_shuffle(str_repeat('_ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',10000)),0,10000); echo $randas; ?>" name="h">	<div id="footer">	<div id="copyright">	<center><img src="http://jaweb.comze.com/version/1/images/skin/default/logo/footer.png"><br><br><br>Copyright JaWeb 2012.<br><br>	<q>Watch, Learn, Listen</q><br><br>Website developed and designed by Juvar Abrera.<br><br><br><br><br><br>	<span>		<a href="http://jaweb.comze.com/version/1/">Home</a> | 		<a href="http://jaweb.comze.com/version/1/tutorials.php">Tutorials</a> | 		<a href="http://jaweb.comze.com/version/1/privacy.php">Privacy Policy</a> | 		<a href="http://jaweb.comze.com/version/1/about.php#thiswebsite">About This Website</a> | 		<a href="http://jaweb.comze.com/version/1/webowner/">Web Owner</a>	</span></center>	<a href="http://jaweb.comze.com/version/1/administration_panel/"><div id="admin">	</div></a>	</div>	<div id="subscribe">	<h2>Subscribe</h2>	<p>Subscribe to our website if you want to receive some emails from us!</p>	<form action="http://www.jaweb.comze.com/version/1/subscribe.php" method="post">	<input type="text" name="subscribe_email" placeholder="E-mail" class="text">	<input type="submit" value="Subcribe" class="button">	</form>	</div></div></div><div id="ie_container"><br><br><br>Sorry but this website is not available in internet explorer.</div></body></html>