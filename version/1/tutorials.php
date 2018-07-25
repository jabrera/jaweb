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
				<?php
				if(isset($_GET['category'])) {
					$category = $_GET['category'];
					if($category == 'html') {
						echo '
				<div id="content_title">
				<a href="tutorials.php">Tutorials</a> / HTML
				</div><p>List of HTML Tutorials</p><hr class="small_line">
				';
						$sql = mysql_query("SELECT * FROM tutorials WHERE category='HTML'");
						$n = 0;
						while($row = mysql_fetch_array($sql)) {
							$title = $row['title'];
							$id = $row['id'];
							$video = $row['video'];
							$h = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',25)),0,25);
							$query = mysql_query("SELECT * FROM hash WHERE tutid='$id'");
							$n = 1;
							if(mysql_num_rows($query) == 0) {
								$views = 0;
							} else {
								$views = mysql_num_rows($query);
							}
							echo '<a href="watch.php?category='.$category.'&id='.$id.'&h='.$h.'" class="tutorial_cat_tut"><img src="http://img.youtube.com/vi/'.$video.'/1.jpg" class="tut_vid_thumbnail"><span class="tut_vid_title">'.$title.'</span><span class="tut_vid_desc">'.$views.' views</span></a>';
						}
						if ($n==0) {
							echo '<p>There are no tutorials posted in this category.</p>';
						}
					} elseif($category == 'css') {
						echo '
				<div id="content_title">
				<a href="tutorials.php">Tutorials</a> / CSS
				</div><p>List of CSS Tutorials</p><hr class="small_line">
				';
						$sql = mysql_query("SELECT * FROM tutorials WHERE category='CSS'");
						$n = 0;
						while($row = mysql_fetch_array($sql)) {
							$title = $row['title'];
							$id = $row['id'];
							$video = $row['video'];
							$h = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',25)),0,25);
							$query = mysql_query("SELECT * FROM hash WHERE tutid='$id'");
							$n = 1;
							if(mysql_num_rows($query) == 0) {
								$views = 0;
							} else {
								$views = mysql_num_rows($query);
							}
							echo '<a href="watch.php?category='.$category.'&id='.$id.'&h='.$h.'" class="tutorial_cat_tut"><img src="http://img.youtube.com/vi/'.$video.'/1.jpg" class="tut_vid_thumbnail"><span class="tut_vid_title">'.$title.'</span><span class="tut_vid_desc">'.$views.' views</span></a>';
						}
						if ($n==0) {
							echo '<p>There are no tutorials posted in this category.</p>';
						}
					} elseif($category == 'php') {
						echo '
				<div id="content_title">
				<a href="tutorials.php">Tutorials</a> / PHP
				</div><p>List of PHP Tutorials</p><hr class="small_line">
				';
						$sql = mysql_query("SELECT * FROM tutorials WHERE category='PHP'");
						$n = 0;
						while($row = mysql_fetch_array($sql)) {
							$title = $row['title'];
							$id = $row['id'];
							$video = $row['video'];
							$h = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',25)),0,25);
							$query = mysql_query("SELECT * FROM hash WHERE tutid='$id'");
							$n = 1;
							if(mysql_num_rows($query) == 0) {
								$views = 0;
							} else {
								$views = mysql_num_rows($query);
							}
							echo '<a href="watch.php?category='.$category.'&id='.$id.'&h='.$h.'" class="tutorial_cat_tut"><img src="http://img.youtube.com/vi/'.$video.'/1.jpg" class="tut_vid_thumbnail"><span class="tut_vid_title">'.$title.'</span><span class="tut_vid_desc">'.$views.' views</span></a>';
						}
						if ($n==0) {
							echo '<p>There are no tutorials posted in this category.</p>';
						}
					} elseif($category == 'mysql') {
						echo '
				<div id="content_title">
				<a href="tutorials.php">Tutorials</a> / mySQL
				</div><p>List of mySQL Tutorials</p><hr class="small_line">
				';
						$sql = mysql_query("SELECT * FROM tutorials WHERE category='mySQL'");
						$n = 0;
						while($row = mysql_fetch_array($sql)) {
							$title = $row['title'];
							$id = $row['id'];
							$video = $row['video'];
							$h = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',25)),0,25);
							$query = mysql_query("SELECT * FROM hash WHERE tutid='$id'");
							$n = 1;
							if(mysql_num_rows($query) == 0) {
								$views = 0;
							} else {
								$views = mysql_num_rows($query);
							}
							echo '<a href="watch.php?category='.$category.'&id='.$id.'&h='.$h.'" class="tutorial_cat_tut"><img src="http://img.youtube.com/vi/'.$video.'/1.jpg" class="tut_vid_thumbnail"><span class="tut_vid_title">'.$title.'</span><span class="tut_vid_desc">'.$views.' views</span></a>';
						}
						if ($n==0) {
							echo '<p>There are no tutorials posted in this category.</p>';
						}
					} elseif($category == 'turbo c') {
						echo '
				<div id="content_title">
				<a href="tutorials.php">Tutorials</a> / Turbo C
				</div><p>List of Turbo C Tutorials</p><hr class="small_line">
				';
						$sql = mysql_query("SELECT * FROM tutorials WHERE category='Turbo C'");
						$n = 0;
						while($row = mysql_fetch_array($sql)) {
							$title = $row['title'];
							$id = $row['id'];
							$video = $row['video'];
							$h = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',25)),0,25);
							$query = mysql_query("SELECT * FROM hash WHERE tutid='$id'");
							$n = 1;
							if(mysql_num_rows($query) == 0) {
								$views = 0;
							} else {
								$views = mysql_num_rows($query);
							}
							echo '<a href="watch.php?category='.$category.'&id='.$id.'&h='.$h.'" class="tutorial_cat_tut"><img src="http://img.youtube.com/vi/'.$video.'/1.jpg" class="tut_vid_thumbnail"><span class="tut_vid_title">'.$title.'</span><span class="tut_vid_desc">'.$views.' views</span></a>';
						}
						if ($n==0) {
							echo '<p>There are no tutorials posted in this category.</p>';
						}
					} elseif($category == 'photoshop') {
						echo '
				<div id="content_title">
				<a href="tutorials.php">Tutorials</a> / Photoshop
				</div><p>List of Photoshop Tutorials</p><hr class="small_line">
				';
						$sql = mysql_query("SELECT * FROM tutorials WHERE category='Photoshop'");
						$n = 0;
						while($row = mysql_fetch_array($sql)) {
							$title = $row['title'];
							$id = $row['id'];
							$video = $row['video'];
							$h = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',25)),0,25);
							$query = mysql_query("SELECT * FROM hash WHERE tutid='$id'");
							$n = 1;
							if(mysql_num_rows($query) == 0) {
								$views = 0;
							} else {
								$views = mysql_num_rows($query);
							}
							echo '<a href="watch.php?category='.$category.'&id='.$id.'&h='.$h.'" class="tutorial_cat_tut"><img src="http://img.youtube.com/vi/'.$video.'/1.jpg" class="tut_vid_thumbnail"><span class="tut_vid_title">'.$title.'</span><span class="tut_vid_desc">'.$views.' views</span></a>';
						}
						if ($n==0) {
							echo '<p>There are no tutorials posted in this category.</p>';
						}
					} elseif($category == 'others') {
						echo '
				<div id="content_title">
				<a href="tutorials.php">Tutorials</a> / Others
				</div><p>List of Other Tutorials</p><hr class="small_line">
				';
						$sql = mysql_query("SELECT * FROM tutorials WHERE category='Others'");
						$n = 0;
						while($row = mysql_fetch_array($sql)) {
							$title = $row['title'];
							$id = $row['id'];
							$video = $row['video'];
							$h = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',25)),0,25);
							$query = mysql_query("SELECT * FROM hash WHERE tutid='$id'");
							$n = 1;
							if(mysql_num_rows($query) == 0) {
								$views = 0;
							} else {
								$views = mysql_num_rows($query);
							}
							echo '<a href="watch.php?category='.$category.'&id='.$id.'&h='.$h.'" class="tutorial_cat_tut"><img src="http://img.youtube.com/vi/'.$video.'/1.jpg" class="tut_vid_thumbnail"><span class="tut_vid_title">'.$title.'</span><span class="tut_vid_desc">'.$views.' views</span></a>';
						}
						if ($n==0) {
							echo '<p>There are no tutorials posted in this category.</p>';
						}
					} else {
						header("Location: http://jaweb.comze.com/version/1/errors/error404.php");
					}
				} else {
					echo '
				<div id="content_title">
				Tutorials
				</div>
				<p><b>Categories</b></p><hr class="small_line">
				<p>';
				$sql = mysql_query("SELECT DISTINCT category FROM tutorials");
				$n = 0;
				while($row=mysql_fetch_array($sql)) {
					$category = $row['category'];
					$query = mysql_query("SELECT * FROM tutorials WHERE category='$category'");
					$num_tutorials = mysql_num_rows($query);
					$link_category = strtolower($category);
					echo '<a href="tutorials.php?category='.$link_category.'" class="tutorial_cat_tut">'.$category.'<span>'.$num_tutorials.' tutorials</span></a>';
					$n = 1;
				}
				if ($n == 0) {
					echo '<p>There are no categories in this tutorial.</p>';
				}
				echo '</p>';
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