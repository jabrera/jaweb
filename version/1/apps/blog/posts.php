<?php
require_once('../config.php');
require_once('../visit.php');
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html><head><title>JaWeb - Free Online Web Tutorials</title>	<meta name="description" content="JaWeb Online Free Web Tutorials" />	<meta name="keywords" content="Juvar Abrera, Juvar, Abrera, JaWeb, Free, Online, Web, Tutorials, Lessons, HTML, CSS, CSS3, Javascript, jQuery, PHP, mySQL" />	<meta name="author" content="Juvar Abrera" />	<meta name="copyright" content="2012 Copyright Juvar Abrera" />	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />	<!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="http://jaweb.comze.com/version/1/styles/default/6a617765626373737374796c657368656574666f726965.css"><![endif]--><style type="text/css"><?php require_once('../../styles/default/6a617765626373737374796c6573686565742.css'); ?></style></head><body><center><input type="hidden" value="<?php $randas = substr(str_shuffle(str_repeat('_ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',10000)),0,10000); echo $randas; ?>" name="h"><div id="container"><div id="top">	<div id="top_base">		<a href="http://jaweb.comze.com/version/1/"><div id="logo">				</div></a>		<div id="search">		<form action="http://jaweb.comze.com/version/1/search.php" method="get">			<input type="text" name="q" placeholder="Search Tutorials">		</form>		</div>		<div id="navigation">			<a href="http://jaweb.comze.com/version/1/" class="main"><div class="main">Home</div></a>			<a href="http://jaweb.comze.com/version/1/about.php" class="main"><div class="main">About</div></a>			<a href="http://jaweb.comze.com/version/1/tutorials.php" class="main"><div class="main">Tutorials</div>			<a href="http://jaweb.comze.com/version/1/contact.php" class="main"><div class="main">Contact</div></a>		</div>	</div>	</div>
	<div id="content">
		<div id="header">
			<div id="gad_menu">
			<?php
			$widq = mysql_query("SELECT * FROM widgets ORDER BY id ASC");
			while($row = mysql_fetch_array($widq)) {
				$wid_name = $row['wid_name'];
				$wid_img = $row['wid_img'];
				$wid_url = $row['wid_url'];
				$wid_img = '../../images/skin/default/wid/'.$wid_img.'.png';
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
				<?php
				if(isset($_GET['id'])) {
					$id = $_GET['id'];
					$query = mysql_query("SELECT * FROM posts WHERE id='$id' LIMIT 1");
					$n = 0;
					while ($row = mysql_fetch_array($query)) {
						$id = $row['id'];
						$title = $row['title'];
						$message = $row['message'];
						$date_added = $row['date_added'];
						$posted_by = $row['posted_by'];
						echo '
					<div id="content_title">
					'.$title.'
					</div>
					<p class="post_info"><a href="posts.php?id='.$id.'">Date Posted: '.$date_added.'<br>Posted By: '.$posted_by.'</a></p>
					<p class="post_content">'.nl2br($message).'</p>
					';
						$n = 1;
					}
					if ($n == 0) {
						echo '
					<div id="content_title">
					Message
					</div>
					<p>Sorry but this post does not exist.<br><br>You\'ll be redirect to the home page in three seconds.</p>
					';
						header('Location: http://www.jaweb.comze.com/version/1/errors/error404.php');
					}
				}
				?>
				<div id="content_title">
				Random Posts
				</div><p>
				<?php
				$zquery = mysql_query("SELECT * FROM posts ORDER BY RAND() LIMIT 3");
				while($row = mysql_fetch_array($zquery)) {
					$id = $row['id'];
					$title = $row['title'];
					$message = $row['message'];
					$message = substr($message,0,50);
					echo '<div class="more_posts"><a href="posts.php?id='.$id.'">'.$title.'</a> | <span class="desc">'.$message.'...</span></div>';
				}
				?></p>
			</div>
		</div>
		<div id="right_sb">
			<div id="wrapper">
				<?php
				$query = mysql_query("SELECT DISTINCT year FROM posts ORDER BY year DESC");
				while ($row = mysql_fetch_array($query)) {
					$year = $row['year'];
					echo '
				<div id="content_title">
				'.$year.' Archieves
				</div><p>	
				';
					$queryb = mysql_query("SELECT DISTINCT month FROM posts ORDER BY month ASC");
					while($row = mysql_fetch_array($queryb)) {
						$month = $row['month'];
						switch ($month) {
							case 1:$nmonth='January';break;
							case 2:$nmonth='February';break;
							case 3:$nmonth='March';break;
							case 4:$nmonth='April';break;
							case 5:$nmonth='May';break;
							case 6:$nmonth='June';break;
							case 7:$nmonth='July';break;
							case 8:$nmonth='August';break;
							case 9:$nmonth='September';break;
							case 10:$nmonth='October';break;
							case 11:$nmonth='November';break;
							case 12:$nmonth='December';break;
						}
						echo '<li>'.$nmonth.'<ul>';
						$queryc = mysql_query("SELECT * FROM posts WHERE year='$year' AND month='$month'");
						while($row = mysql_fetch_array($queryc)) {
							$id = $row['id'];
							$title = $row['title'];
							echo '<li type="disc"><a href="posts.php?id='.$id.'">'.$title.'</a><hr class="small_line">';
						}
						
						echo '</ul>';
					}
				}
				?>
			</div>
		</div>
	</div>
<input type="hidden" value="<?php $randas = substr(str_shuffle(str_repeat('_ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',10000)),0,10000); echo $randas; ?>" name="h">	<div id="footer">	<div id="copyright">	<center><img src="http://jaweb.comze.com/version/1/images/skin/default/logo/footer.png"><br><br><br>Copyright JaWeb 2012.<br><br>	<q>Watch, Learn, Listen</q><br><br>Website developed and designed by Juvar Abrera.<br><br><br><br><br><br>	<span>		<a href="http://jaweb.comze.com/version/1/">Home</a> | 		<a href="http://jaweb.comze.com/version/1/tutorials.php">Tutorials</a> | 		<a href="http://jaweb.comze.com/version/1/privacy.php">Privacy Policy</a> | 		<a href="http://jaweb.comze.com/version/1/about.php#thiswebsite">About This Website</a> | 		<a href="http://jaweb.comze.com/version/1/about.php#webowner">Web Owner</a>	</span></center>	<a href="http://jaweb.comze.com/version/1/administration_panel/"><div id="admin">	</div></a>	</div>	<div id="subscribe">	<h2>Subscribe</h2>	<p>Subscribe to our website if you want to receive some emails from us!</p>	<form action="http://www.jaweb.comze.com/version/1/subscribe.php" method="post">	<input type="text" name="subscribe_email" placeholder="E-mail" class="text">	<input type="submit" value="Subcribe" class="button">	</form>	</div>	<div id="networks">		<h4>Like and Subscribe!</h4>		<a href="http://www.facebook.com/tutorialsjaweb" target="_blank" class="facebook"></a>		<a href="http://www.youtube.com/user/JaWebTutorials" target="_blank" class="youtube"></a>	</div></div></div><div id="ie_container"><br><br><br>Sorry but this website is not available in internet explorer.</div></body></html>