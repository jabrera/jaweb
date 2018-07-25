<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'jwd';
mysql_connect($host, $username, $password);
mysql_select_db($database);
?><html>
<head>
<title>JaWeb Design - Share your Web Designs</title>
<link rel="stylesheet" href="styles/default/style.css">
<style type="text/css">
a.left_top_logo {
	background:url(images/skin/default/logo/top.png);
	width:140px;
	height:44px;
	display:block;
}
</style>
</head>
<body><center>
<div id="container">
	<div id="left_sb">
		<div id="left_sb_bg">
			
		</div>
		<div id="red_line">
		
		</div>
		<div id="wrapper">
			<br><a href="#" class="left_top_logo"></a><br><br><br>
			<div id="navigation">
				<a href="#"><div id="nav_menu">Home</div></a>
				<a href="#"><div id="nav_menu">About</div></a>
				<a href="#"><div id="nav_menu">Web Design</div></a>
				<a href="#"><div id="nav_menu">Tutorial</div></a>
				<a href="#"><div id="nav_menu">Contact</div></a>
			</div>
		</div>
	</div>
	<div id="center">
		<div id="center_base">
			<div id="header">
				<div id="sign-up_base">
					<a href="#"><div id="sign-up">
					Log in
					</div></a>
				</div>
			</div>
			<div id="wrapper">
				<h1>Submitted Websites</h1><hr class="dot">
				<p>
				<?php
				$query = mysql_query("SELECT * FROM websites");
				mysql_num_rows($query);
				while($row = mysql_fetch_array($query)) {
					$id = $row['id'];
					$title = $row['title'];
					$submit_by = $row['submit_by'];
					$sbq = mysql_query("SELECT * FROM users WHERE id = '$submit_by'");
					$n = 0;
					while($row = mysql_fetch_array($sbq)) {
						$submit_by = $row['username'];
						$n = 1;
					}
					if($n == 0) {
						$submit_by = "Anonymous";
					}
					$photosrc = 'images/webtemplate/'.$id.'.jpg';
					if(!file_exists($photosrc)) {
						$photosrc = 'images/webtemplate/nophoto.jpg';
					}
					echo '
				<a href="#"><div id="web_thumbnail_a">
					<img src="'.$photosrc.'">
					<div id="web_title_a"><div id="web_title_wrap">'.$title.'<br>By: <a href="#" style="color:#bbb;">'.$submit_by.'</a></div></div>
				</div></a>
				';
				}
				?>
				<!-- <a href="#"><div id="web_thumbnail_a">
					<img src="images/skin/default/webtemplate/1.jpg" width="300px">
					<div id="web_title_a"><div id="web_title_wrap">Title<br>By: <a href="#" style="color:#bbb;">Juvar Abrera</a></div></div>
				</div></a> -->
				</p>
			</div>
		</div>
	<div id="footer">
		<div id="copyright">
			<center><a href="#" class="left_top_logo"></a><br>Copyright JaWeb2012.<br><br>Website developed and designed by Juvar Abrera.
		</div>
	</div>
	</div>
</div>
<div id="top">
	<div id="top_base">
		<div id="search">
		<input type="text" placeholder="Search Websites">
		</div>
	<a href="#"><div id="top_base_nav">Log in</div></a>
	<a href="#"><div id="top_base_nav">Register</div></a>
	</div>
</div>
</body>
</html>