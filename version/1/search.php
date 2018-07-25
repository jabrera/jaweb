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
				<div id="content_title">Search</div><br>
				<?php
				if (isset($_GET['q'])) {
					$q = $_GET['q'];
					if(!$q) {
						echo '
				<p><center><form action="search.php" method="get"><table>
					<tr><td><span class="error">Please enter a query!</span><br></td></tr>
					<tr><td><input type="text" name="q" placeholder="Search Tutorials" class="text"></td></tr>
					<tr><td><input type="submit" value="Search" class="button"></td></tr>
				</table></form></center></p>
				';
					} else {
						if (isset($_GET["page"])) {
							$page = $_GET["page"];
						} else {
							$page=1;
						}; 
						$limit = 10;
						$start_from = ($page-1) * $limit; 
						$sqlr = mysql_query("SELECT * FROM tutorials WHERE title LIKE '%".$q."%'"); 
						$sql = mysql_query("SELECT * FROM tutorials WHERE title LIKE '%".$q."%' ORDER BY date DESC LIMIT $start_from, $limit"); 
						$n=0;
						if($sql) {
							if(mysql_num_rows($sql) == 0) {
								echo '
				<p><center><form action="search.php" method="get"><table>
					<tr><td><span class="error">Search again.</span><br></td></tr>
					<tr><td><input type="text" name="q" placeholder="Search Tutorials" class="text"></td></tr>
					<tr><td><input type="submit" value="Search" class="button"></td></tr>
				</table></form></center></p>
				<p>No results found for <b>"'.$q.'".</b></p>
				';
							} else {
								$numberofresults = mysql_num_rows($sqlr);
								echo '
				<p><center><form action="search.php" method="get"><table>
					<tr><td><span class="message">'.$numberofresults.' results</span><br></td></tr>
					<tr><td><input type="text" name="q" placeholder="Search Tutorials" class="text"></td></tr>
					<tr><td><input type="submit" value="Search" class="button"></td></tr>
				</table></form></center></p><hr class="small_line">
				';
								while($row=mysql_fetch_array($sql)) {
									$id = $row['id'];
									$category = $row['category'];
									$title = $row['title'];
									$message = $row['message'];
									$h = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',25)),0,25);
									$link_category = strtolower($category);
									echo '
									<p><a href="watch.php?category='.$link_category.'&id='.$id.'&h='.$h.'">'.$title.'</a> | '.$message.'<br></p><span class="info">Category: '.$category.'</span><hr class="small_line">
									';
									$n = 1;
								}
								$top = mysql_query("SELECT COUNT(id) FROM tutorials WHERE title LIKE '%".$q."%'"); 
								$top_row = mysql_fetch_row($top); 
								$total_records = $top_row[0]; 
								$total_pages = ceil($total_records / $limit);
								if($page == 1) {
									$next_page_num = $page + 1;
									$prev_page = '';
									$next_page = '<a href="search.php?q='.$q.'&page='.$next_page_num.'" class="pagination">Next</a> '; 
								} elseif ($page == $total_pages) {
									$prev_page_num = $page - 1;
									$prev_page = '<a href="search.php?q='.$q.'&page='.$prev_page_num.'" class="pagination">Prev</a> ';
									$next_page = ''; 
								} else {
									$next_page_num = $page + 1;
									$prev_page_num = $page - 1;
									$prev_page = '<a href="search.php?q='.$q.'&page='.$prev_page_num.'" class="pagination">Prev</a> ';
									$next_page = '<a href="search.php?q='.$q.'&page='.$next_page_num.'" class="pagination">Next</a> '; 
								}
								if ($n == 0) {
									header("Location: http://www.jaweb.comze.com/version/1/errors/error404.php");
								} else {
									echo '<center><b><span class="desc">Pages ('.$limit.' results per page)</span></b><br><br>'.$prev_page;
									for ($i=1; $i<=$total_pages; $i++) { 
										if($i==$page) {
											echo '<a href="search.php?q='.$q.'&page='.$i.'" class="pagination" style="background:#aa1616;color:#1c1c1c;">'.$i.'</a> '; 
										} else {
											echo '<a href="search.php?q='.$q.'&page='.$i.'" class="pagination">'.$i.'</a> '; 
										}
									} 
									echo $next_page.'</center>';
								}
							}
						}
					}
				} else {
					echo '
				<p><center><form action="search.php" method="get"><table>
					<tr><td><span class="error">Please enter a query!</span><br></td></tr>
					<tr><td><input type="text" name="q" placeholder="Search Tutorials" class="text"></td></tr>
					<tr><td><input type="submit" value="Search" class="button"></td></tr>
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