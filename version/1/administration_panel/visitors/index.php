<?php
require_once('../../config.php');
require_once('../logincheck.php');
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html><head><title>JaWeb - Free Online Web Tutorials</title>	<meta name="description" content="JaWeb Online Free Web Tutorials" />	<meta name="keywords" content="Juvar Abrera, Juvar, Abrera, JaWeb, Free, Online, Web, Tutorials, Lessons, HTML, CSS, CSS3, Javascript, jQuery, PHP, mySQL" />	<meta name="author" content="Juvar Abrera" />	<meta name="copyright" content="2012 Copyright Juvar Abrera" />	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />	<!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="http://jaweb.comze.com/version/1/styles/default/6a617765626373737374796c657368656574666f726965.css"><![endif]--><style type="text/css"><?php require_once('../../styles/default/6a617765626373737374796c6573686565742.css'); ?></style></head><body><center><input type="hidden" value="<?php $randas = substr(str_shuffle(str_repeat('_ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',10000)),0,10000); echo $randas; ?>" name="h"><div id="container"><div id="top">	<div id="top_base">		<a href="http://jaweb.comze.com/version/1/"><div id="logo">				</div></a>		<div id="search">		<form action="http://jaweb.comze.com/version/1/search.php" method="get">			<input type="text" name="q" placeholder="Search Tutorials">		</form>		</div>		<div id="navigation">			<a href="http://jaweb.comze.com/version/1/" class="main"><div class="main">Home</div></a>			<a href="http://jaweb.comze.com/version/1/about.php" class="main"><div class="main">About</div></a>			<a href="http://jaweb.comze.com/version/1/tutorials.php" class="main"><div class="main">Tutorials</div>			<a href="http://jaweb.comze.com/version/1/contact.php" class="main"><div class="main">Contact</div></a>		</div>	</div>	</div>
	<div id="content">
		<div id="admin_base">
			<div id="wrapper">
				<div id="content_title">
				<a href="../index.php">Administration Login</a> / Visitors Management
				</div>
				<p class="post_info">Welcome, <?php echo $loggeduser; ?>! [<a href="../logout.php">Logout</a>]</p>
				<br>
				<table class="admin_table" width="100%" cellspacing="0">
					<tr>
						<td>Date</td>
						<td>Page Reloads</td>
						<td>Number of Visitor</td>
					</tr>
					<?
					$query1 = mysql_query("SELECT DISTINCT date FROM visitors ORDER BY date DESC LIMIT 10");
					while($row = mysql_fetch_array($query1)) {
						$date = $row['date'];
						$novq = mysql_query("SELECT * FROM visitors WHERE date='$date'");
						$nov = mysql_num_rows($novq);
						while($row=mysql_fetch_array($novq)) {
							$wdate = $row['wdate'];
						}
						$uvq = mysql_query("SELECT DISTINCT ip FROM visitors WHERE date='$date'");
						$uv = mysql_num_rows($uvq);
						echo '
					<tr>
						<td>'.$wdate.'</td>
						<td>'.$nov.'</td>
						<td>'.$uv.'</td>
					</tr>
					';
					}
					?>
				</table>
				<br>
<form action="index.php" method="get">
<input type="text" class="text" name="q" placeholder="Search"> 
<select name="sort">
	<option value="ip">IP Address</option>
	<option value="hashcode">Hashcode</option>
	<option value="date">Date</option>
</select>
<input type="submit" class="button" value="Search" style="width:120px">
</form>
				<?php
				if(isset($_GET['q'])) {
					$q = $_GET['q'];
					if(isset($_GET['sort'])) {
						$sort = $_GET['sort'];
						if($sort == 'ip') {
							$query = mysql_query("SELECT * FROM visitors WHERE ip='$q'");
							echo '<h3>There are '.mysql_num_rows($query).' results found in "'.$q.'"! <a href="index.php">[Cancel Search]</a></h3>';
						} elseif($sort == 'date') {
							$query = mysql_query("SELECT * FROM visitors WHERE date='$q'");
							echo '<h3>There are '.mysql_num_rows($query).' results found in "'.$q.'"! <a href="index.php">[Cancel Search]</a></h3>';
						} elseif($sort == 'hashcode') {
							$query = mysql_query("SELECT * FROM visitors WHERE hashcode='$q'");
							echo '<h3>There are '.mysql_num_rows($query).' results found in "'.$q.'"! <a href="index.php">[Cancel Search]</a></h3>';
						}
					}
				}
				?>
				<table width="100%" class="admin_table" cellspacing="0">
					<tr>
						<td>Hashcode</td>
						<td>Date</td>
						<td>Page</td>
						<td>IP</td>
					</tr>
					<?php
					if (isset($_GET["page"])) {
						$page = $_GET["page"];
					} else {
						$page=1;
					}; 
					$limit = 200;
					$start_from = ($page-1) * $limit; 
					if(isset($_GET['q'])) {
						$q = $_GET['q'];
						if(isset($_GET['sort'])) {
							$sort = $_GET['sort'];
							if($sort == 'ip') {
								$query = mysql_query("SELECT * FROM visitors WHERE ip='$q' ORDER BY date DESC LIMIT $start_from, $limit");
								$n = 0;
								while($row = mysql_fetch_array($query)) {
									$hashcode = $row['hashcode'];
									$date = $row['date'];
									$page = $row['page'];
									$ip = $row['ip'];
									echo '
								<tr>
									<td>'.$hashcode.'</td>
									<td>'.$date.'</td>
									<td>'.$page.'</td>
									<td>'.$ip.'</td>
								</tr>
								';
									$n=1;
								}
								$top = mysql_query("SELECT COUNT(id) FROM visitors WHERE ip='$q'"); 
								$top_row = mysql_fetch_row($top); 
								$total_records = $top_row[0]; 
								$total_pages = ceil($total_records / $limit);
								if ($n == 0) {
									echo
								'
								<tr>
									<td colspan="4"><center><b>No result found!<td>
								</tr>
								';
								} else {
								/* echo '
								<tr>
									<td colspan="4"><hr class="small_line"><center><b><span class="desc">Pages ('.$limit.' results per page)</span></b><br>';
								for ($i=1; $i<=$total_pages; $i++) { 
									echo '<a href="index.php?q='.$q.'&sort='.$sort.'&page='.$i.'" class="pagination">'.$i.'</a> '; 
								}; 
								echo '</center><td>
								</tr>'; */
								} 
							} elseif ($sort == 'hashcode') {
								$query = mysql_query("SELECT * FROM visitors WHERE hashcode='$q' ORDER BY date DESC LIMIT $start_from, $limit");
								$n = 0;
								while($row = mysql_fetch_array($query)) {
									$hashcode = $row['hashcode'];
									$date = $row['date'];
									$page = $row['page'];
									$ip = $row['ip'];
									echo '
								<tr>
									<td>'.$hashcode.'</td>
									<td>'.$date.'</td>
									<td>'.$page.'</td>
									<td>'.$ip.'</td>
								</tr>
								';
									$n=1;
								}
								$top = mysql_query("SELECT COUNT(id) FROM visitors WHERE hashcode='$q'"); 
								$top_row = mysql_fetch_row($top); 
								$total_records = $top_row[0]; 
								$total_pages = ceil($total_records / $limit);
								if ($n == 0) {
									echo
								'
								<tr>
									<td colspan="4"><center><b>No result found!<td>
								</tr>
								';
								} else {
								/* echo '
								<tr>
									<td colspan="4"><hr class="small_line"><center><b><span class="desc">Pages ('.$limit.' results per page)</span></b><br>';
								for ($i=1; $i<=$total_pages; $i++) { 
									echo '<a href="index.php?q='.$q.'&sort='.$sort.'&page='.$i.'" class="pagination">'.$i.'</a> '; 
								}; 
								echo '</center><td>
								</tr>'; */
								} 
							} elseif ($sort == 'date') {
								$query = mysql_query("SELECT * FROM visitors WHERE date='$q' ORDER BY date DESC LIMIT $start_from, $limit");
								$n = 0;
								while($row = mysql_fetch_array($query)) {
									$hashcode = $row['hashcode'];
									$date = $row['date'];
									$page = $row['page'];
									$ip = $row['ip'];
									echo '
								<tr>
									<td>'.$hashcode.'</td>
									<td>'.$date.'</td>
									<td>'.$page.'</td>
									<td>'.$ip.'</td>
								</tr>
								';
									$n=1;
								}
								$top = mysql_query("SELECT COUNT(id) FROM visitors WHERE date='$q'"); 
								$top_row = mysql_fetch_row($top); 
								$total_records = $top_row[0]; 
								$total_pages = ceil($total_records / $limit);
								if ($n == 0) {
									echo
								'
								<tr>
									<td colspan="4"><center><b>No result found!<td>
								</tr>
								';
								} else {
								/* echo '
								<tr>
									<td colspan="4"><hr class="small_line"><center><b><span class="desc">Pages ('.$limit.' results per page)</span></b><br>';
								for ($i=1; $i<=$total_pages; $i++) { 
									echo '<a href="index.php?q='.$q.'&sort='.$sort.'&page='.$i.'" class="pagination">'.$i.'</a> '; 
								}; 
								echo '</center><td>
								</tr>'; */
								}
							} else {
								header("Location: http://www.jaweb.comze.com/version/1/errors/error404.php");
							}
						} else {
							header("Location: http://www.jaweb.comze.com/version/1/errors/error404.php");
						}
					} else {
						$query = mysql_query("SELECT * FROM visitors ORDER BY date DESC LIMIT $start_from, $limit");
						$n = 0;
						while($row = mysql_fetch_array($query)) {
							$hashcode = $row['hashcode'];
							$date = $row['date'];
							$page = $row['page'];
							$ip = $row['ip'];
							echo '
						<tr>
							<td>'.$hashcode.'</td>
							<td>'.$date.'</td>
							<td>'.$page.'</td>
							<td>'.$ip.'</td>
						</tr>
						';
							$n=1;
						}
						$top = mysql_query("SELECT COUNT(id) FROM visitors"); 
						$top_row = mysql_fetch_row($top); 
						$total_records = $top_row[0]; 
						$total_pages = ceil($total_records / $limit);
						if ($n == 0) {
							echo
						'
						<tr>
							<td colspan="4"><center><b>No result found!<td>
						</tr>
						';
						} else {
						/* echo '
						<tr>
							<td colspan="4"><hr class="small_line"><center><b><span class="desc">Pages ('.$limit.' results per page)</span></b><br>';
						for ($i=1; $i<=$total_pages; $i++) { 
							echo '<a href="index.php?q='.$q.'&sort='.$sort.'&page='.$i.'" class="pagination">'.$i.'</a> '; 
						}; 
						echo '</center><td>
						</tr>'; */
						} 
					}
					?>
					
				</table>
			</div>
		</div>
	</div>
<input type="hidden" value="<?php $randas = substr(str_shuffle(str_repeat('_ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',10000)),0,10000); echo $randas; ?>" name="h">	<div id="footer">	<div id="copyright">	<center><img src="http://jaweb.comze.com/version/1/images/skin/default/logo/footer.png"><br><br><br>Copyright JaWeb 2012.<br><br>	<q>Watch, Learn, Listen</q><br><br>Website developed and designed by Juvar Abrera.<br><br><br><br><br><br>	<span>		<a href="http://jaweb.comze.com/version/1/">Home</a> | 		<a href="http://jaweb.comze.com/version/1/tutorials.php">Tutorials</a> | 		<a href="http://jaweb.comze.com/version/1/privacy.php">Privacy Policy</a> | 		<a href="http://jaweb.comze.com/version/1/about.php#thiswebsite">About This Website</a> | 		<a href="http://jaweb.comze.com/version/1/about.php#webowner">Web Owner</a>	</span></center>	<a href="http://jaweb.comze.com/version/1/administration_panel/"><div id="admin">	</div></a>	</div>	<div id="subscribe">	<h2>Subscribe</h2>	<p>Subscribe to our website if you want to receive some emails from us!</p>	<form action="http://www.jaweb.comze.com/version/1/subscribe.php" method="post">	<input type="text" name="subscribe_email" placeholder="E-mail" class="text">	<input type="submit" value="Subcribe" class="button">	</form>	</div>	<div id="networks">		<h4>Like and Subscribe!</h4>		<a href="http://www.facebook.com/tutorialsjaweb" target="_blank" class="facebook"></a>		<a href="http://www.youtube.com/user/JaWebTutorials" target="_blank" class="youtube"></a>	</div></div></div><div id="ie_container"><br><br><br>Sorry but this website is not available in internet explorer.</div></body></html>