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
					<div id="left_align_it">
					<span class="title"><img src="images/skin/default/bg/mini_icon.png" class="mini_icon_l">Privacy Policy</span><hr class="dashed_lg">
					<p>This Privacy Policy governs the manner in which JaWeb collects, uses, maintains and discloses information collected from users (each, a "User") of the <a href="http://www.jaweb.comze.com">http://www.jaweb.comze.com</a> website ("Site"). This privacy policy applies to the Site and all products and services offered by JaWeb.<br><br>

					<b>Personal identification information</b><br><br>

					We may collect personal identification information from Users in a variety of ways, including, but not limited to, when Users visit our site, register on the site, subscribe to the newsletter, fill out a form, and in connection with other activities, services, features or resources we make available on our Site. Users may be asked for, as appropriate, name, email address. Users may, however, visit our Site anonymously. We will collect personal identification information from Users only if they voluntarily submit such information to us. Users can always refuse to supply personally identification information, except that it may prevent them from engaging in certain Site related activities.<br><br>

					<b>Non-personal identification information</b><br><br>

					We may collect non-personal identification information about Users whenever they interact with our Site. Non-personal identification information may include the browser name, the type of computer and technical information about Users means of connection to our Site, such as the operating system and the Internet service providers utilized and other similar information.<br><br>

					<b>Web browser cookies</b><br><br>

					Our Site may use "cookies" to enhance User experience. User's web browser places cookies on their hard drive for record-keeping purposes and sometimes to track information about them. User may choose to set their web browser to refuse cookies, or to alert you when cookies are being sent. If they do so, note that some parts of the Site may not function properly.<br><br>

					<b>How we use collected information</b><br><br>

					JaWeb may collect and use Users personal information for the following purposes:<br>
					<ul>
					<li><i>- To improve customer service</i><br>
						Information you provide helps us respond to your customer service requests and support needs more efficiently.</li>
					<li><i>- To personalize user experience</i><br>
						We may use information in the aggregate to understand how our Users as a group use the services and resources provided on our Site.</li>
					<li><i>- To improve our Site</i><br>
						We may use feedback you provide to improve our products and services.</li>
					<li><i>- To send periodic emails</i><br>
					We may use the email address to respond to their inquiries, questions, and/or other requests. </li>
					</ul>
					<b>How we protect your information</b><br><br>

					We adopt appropriate data collection, storage and processing practices and security measures to protect against unauthorized access, alteration, disclosure or destruction of your personal information, username, password, transaction information and data stored on our Site.<br><br>

					<b>Sharing your personal information</b><br><br>

					We do not sell, trade, or rent Users personal identification information to others. We may share generic aggregated demographic information not linked to any personal identification information regarding visitors and users with our business partners, trusted affiliates and advertisers for the purposes outlined above.We may use third party service providers to help us operate our business and the Site or administer activities on our behalf, such as sending out newsletters or surveys. We may share your information with these third parties for those limited purposes provided that you have given us your permission.<br><br>

					<b>Changes to this privacy policy</b><br><br>

					JaWeb has the discretion to update this privacy policy at any time. When we do, we will revise the updated date at the bottom of this page. We encourage Users to frequently check this page for any changes to stay informed about how we are helping to protect the personal information we collect. You acknowledge and agree that it is your responsibility to review this privacy policy periodically and become aware of modifications.<br><br>

					<b>Your acceptance of these terms</b><br><br>

					By using this Site, you signify your acceptance of this policy. If you do not agree to this policy, please do not use our Site. Your continued use of the Site following the posting of changes to this policy will be deemed your acceptance of those changes.<br><br>

					<b>Contacting us</b><br><br>

					If you have any questions about this Privacy Policy, the practices of this site, or your dealings with this site, please contact us at:<br>
					<a href="http://www.jaweb.comze.com">JaWeb</a><br>
					<a href="http://www.jaweb.comze.com">http://www.jaweb.comze.com</a><br>
					contact@jaweb.comze.com<br>
					<br>
					This document was last updated on June 15, 2012<br><br></p>
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