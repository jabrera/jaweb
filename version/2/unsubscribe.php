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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>JaWeb</title>

	<meta name="description" content="JaWeb Online Free Web Tutorials" />
	
	<meta name="keywords" content="Juvar Abrera, Juvar, Abrera, JaWeb, Free, Online, Web, Tutorials, Lessons, HTML, CSS, CSS3, Javascript, jQuery, PHP, mySQL, Turbo C, Photoshop" />
	
	<meta name="author" content="Juvar Abrera" />
	
	<meta name="copyright" content="2012 Copyright Juvar Abrera" />
	
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	
	<?php /* <!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="http://www.jaweb.comze.com/version/2/styles/default/ie.css"><![endif]--> */ ?>
	
	<link rel="stylesheet" type="text/css" href="http://www.jaweb.comze.com/version/2/styles/default/style.css">
	
</head>
<body>
<input type="hidden" value="<?php $randas = substr(str_shuffle(str_repeat('_ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',10000)),0,10000); echo $randas; ?>" name="h">
<div id="body_con">
	<div id="con_content">
		<div id="left_sb">
			<div id="content_pad">
				<div id="navigation">
					<div id="nav">
						<span class="nav_title">Navigation<img src="images/skin/default/bg/mini_icon.png" class="mini_icon_r"></span><hr class="dashed_lg">
						<a href="http://www.jaweb.comze.com/version/2/index.php"><div id="nav_op"><div id="nav_op_p">Home</div></div></a>
						<a href="http://www.jaweb.comze.com/version/2/about.php"><div id="nav_op"><div id="nav_op_p">About</div></div></a>
						<a href="http://www.jaweb.comze.com/version/2/tutorials.php"><div id="nav_op"><div id="nav_op_p">Tutorials</div></div></a>
						<a href="http://www.jaweb.comze.com/version/2/contact.php"><div id="nav_op"><div id="nav_op_p">Contact</div></div></a>
					</div>
					<div id="nav">
						<span class="nav_title">More<img src="images/skin/default/bg/mini_icon.png" class="mini_icon_r"></span><hr class="dashed_lg">
						<a href="http://www.jaweb.comze.com/version/2/downloads.php"><div id="nav_op"><div id="nav_op_p">Downloads</div></div></a>
						<a href="http://www.jaweb.comze.com/version/2/webdeveloper/"><div id="nav_op"><div id="nav_op_p">The Web Developer</div></div></a>
						<a href="http://www.jfx-design.comoj.com/"><div id="nav_op"><div id="nav_op_p">Jfx-Design</div></div></a>
					</div>
					<div id="nav">
						<span class="nav_title">Recent Tutorials<img src="images/skin/default/bg/mini_icon.png" class="mini_icon_r"></span><hr class="dashed_lg">
						<?php
						$query = mysql_query("SELECT * FROM tutorials ORDER BY id DESC LIMIT 5");
						$ab = 0;
						while ($row=mysql_fetch_array($query)) {
							$id = $row['id'];
							$title = $row['title'];
							if(strlen($title) > 35) {
								$title2 = substr($title,0,35);
								$title2 = $title2.'...';
							} else {
								$title2 = $title;
							}
							$message = $row['message'];
							$message = substr($message,0,55);
							$category = $row['category'];
							$video = $row['video'];
							$link_category = strtolower($category);
							$h = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',15)),0,15);
							$sql = mysql_query("SELECT * FROM hash WHERE tutid='$id'");
							if(mysql_num_rows($sql) == 0) {
								$views = 'No views';
							} else {
								$views = mysql_num_rows($sql).' views';
							}
							echo '<a href="http://www.jaweb.comze.com/version/2/watch.php?category='.$link_category.'&id='.$id.'&h='.$h.'" alt="'.$title.'" title="'.$title.'"><div id="nav_op"><div id="nav_op_p" style="padding:7px 15px 2px 5px;"><div class="side_video"><img src="http://img.youtube.com/vi/'.$video.'/1.jpg" id="vid_thumb">'.$title2.' <hr class="dashed_lg"><span class="views">'.$views.'</span></div></div></div></a>
							';
							$ab = 1;
						}
						if($ab==0) {
							echo '<a href="#"><div id="nav_op"><div id="nav_op_p">There are no tutorials posted.</div></div></a>
							';
						}
						?>
					</div>
					<div id="nav">
						<span class="nav_title">Designer's Quotes<img src="images/skin/default/bg/mini_icon.png" class="mini_icon_r"></span><hr class="dashed_lg">
						<?php
						$query_g = mysql_query("SELECT * FROM webquotes ORDER BY RAND() LIMIT 1");
						while($row = mysql_fetch_array($query_g)) {
							$randwebquote = $row['quote'];
							$randwebdesigner = $row['quoted_by'];
							echo '
						<span style="padding-right:15px;width:100%;display:block;"><em><q>'.$randwebquote.'</q><br><br>- '.$randwebdesigner.'</em></span>
						';
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<div id="center">
			<div id="content_pad">
				<div id="cover_photo">
					<div id="total_tut">
					<?php
					$query = mysql_query("SELECT * FROM tutorials");
					$total_tuts = mysql_num_rows($query);
					?>
					Total of <a href="http://www.jaweb.comze.com/version/2/tutorials.php"><?php echo $total_tuts; ?></a> tutorials
					</div>
				</div>
				<div id="center_base">
					<div id="left_align_it" style="overflow:hidden;">
					<span class="title"><img src="images/skin/default/bg/mini_icon.png" class="mini_icon_l">Unsubscribe</span><hr class="dashed_lg">
					<?php
					if (isset($_POST['unsubscribe_email'])) {
						$email = $_POST['unsubscribe_email'];
						$searchEmailAt = strpos($email, '@');
						$searchEmailDot = strpos($email, '.');
						if($email == '') {
						echo '
					<p><center><form action="http://www.jaweb.comze.com/version/2/unsubscribe.php" method="post"><table>
						<tr><td><span class="error">Please enter your email to unsubscribe!</span></td></tr>
						<tr><td><input type="text" name="unsubscribe_email" class="text_default" placeholder="E-mail"></td></tr>
						<tr><td><input type="submit" value="Unsubscribe" class="submit_default" style="width:250px;"></td></tr>
					</table></form></center></p>
						';
						} elseif ($searchEmailAt == 0){
							echo '
						<p><center><form action="http://www.jaweb.comze.com/version/2/unsubscribe.php" method="post"><table>
							<tr><td><span class="error">Your email is not valid.</span></td></tr>
						<tr><td><input type="text" name="unsubscribe_email" class="text_default" placeholder="E-mail"></td></tr>
						<tr><td><input type="submit" value="Unsubscribe" class="submit_default" style="width:250px;"></td></tr>
						</table></form></center></p>
							';
						} elseif ($searchEmailDot == 0) {
							echo '
						<p><center><form action="http://www.jaweb.comze.com/version/2/unsubscribe.php" method="post"><table>
							<tr><td><span class="error">Your email is not valid.</span></td></tr>
						<tr><td><input type="text" name="unsubscribe_email" class="text_default" placeholder="E-mail"></td></tr>
						<tr><td><input type="submit" value="Unsubscribe" class="submit_default" style="width:250px;"></td></tr>
						</table></form></center></p>
							';
						} else {
							$query = mysql_query("SELECT * FROM subscriptions WHERE email='$email' LIMIT 1");
							$available = mysql_num_rows($query);
							if ($available == 1) {
								mysql_query("DELETE FROM subscriptions WHERE email='$email'");  
								echo '<img src="images/skin/default/bg/left_logo.png" style="float:left;margin-left:20px;margin-right:15px;"><p>Your email, '.$email.', has been unsubscribe in our website.</p><p>You won\'t be receiving any emails of updates and announcements from our website.</p><p>Thank you for unsubscribing!</p>';
							} else {
								echo '
							<p><center><form action="http://www.jaweb.comze.com/version/2/unsubscribe.php" method="post"><table>
								<tr><td><span class="error">This email does not exist.</span></td></tr>
						<tr><td><input type="text" name="unsubscribe_email" class="text_default" placeholder="E-mail"></td></tr>
						<tr><td><input type="submit" value="Unsubscribe" class="submit_default" style="width:250px;"></td></tr>
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
					<p><center><form action="http://www.jaweb.comze.com/version/2/unsubscribe.php" method="post"><table>
						<tr><td><span class="message">Please enter your email to unsubscribe.</span></td></tr>
						<tr><td><input type="text" name="unsubscribe_email" value="'.$email.'" class="text_default" placeholder="E-mail"></td></tr>
						<tr><td><input type="submit" value="Unsubscribe" class="submit_default" style="width:250px;"></td></tr>
					</table></form></center></p>
					';
					}
					?>
					</div>
				</div>
			</div>
		</div>
		<div id="con_footer">
			<div id="footer_bg">
				<div id="footer_content">
				JaWeb &copy; 2012 | <a href="http://www.jaweb.comze.com/version/2/index.php">Home</a> | 
				<a href="http://www.jaweb.comze.com/version/2/tutorials.php">Tutorials</a> | 
				<a href="http://www.jaweb.comze.com/version/2/privacy.php">Privacy Policy</a> | 
				<a href="http://www.jaweb.comze.com/version/2/about.php">About This Website</a> | 
				<a href="http://www.jaweb.comze.com/version/2/webdeveloper/">Web Developer</a> |
				<a href="http://www.jaweb.comze.com/version/2/web_log.php">Web Log</a>
				</div>
				<div id="footer_webdev">
				
				</div>
				<div id="footer_subs">
				<span class="title">Subscribe</span><hr class="dashed_lg">
				Subscribe in my website if you want to receive updates from us!<br><br>
				<form action="http://www.jaweb.comze.com/version/2/subscribe.php" method="post">
					<input type="text" class="text_default" name="subscribe_email" placeholder="example@domain.com">
					<input type="submit" class="submit_default" value="Subscribe">
				</form>
				</div>
			</div>
		</div>
	</div>
	<div id="nav_top">
		<div id="top_base">
			<div id="top_logo_base">
				<a href="http://www.jaweb.comze.com/version/2/index.php"><div id="top_logo">
				
				</div></a>
			</div>
			<div id="top_search">
				<form action="http://www.jaweb.comze.com/version/2/search.php" method="get">
				<input type="text" class="search_top" name="q" placeholder="Search Tutorials...">
				</form>
			</div>
		</div>
	</div>
	<div id="feedback">
		<div id="feedbackForm">
		<p>Do you like the new design?</p>
		<form action="http://www.jaweb.comze.com/version/2/feedback_process.php" method="post">
		<input type="radio" name="like" value="Like">Like<br>
		<input type="radio" name="like" value="Dislike">Dislike
		<p>Comments <i>(max. of 150 characters)</i></p>
		<textarea class="text_default" name="comments" style="min-height:75px;max-height:75px;" maxlength="150" placeholder="Comments..."></textarea><br><br>
		<input type="submit" style="margin-left:0px;width:250px;" class="submit_default" value="Send">
		</form>
		</div>
		<div id="fbText">
		Send Feedback
		</div>
	</div>
</div>
</body>
</html>