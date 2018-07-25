<?php
require_once('../config.php');
?><html>
<head>
<title>JaWeb - The Web Designer</title>
<style type="text/css">
body {
	margin:0px;
	font-family:arial;
	background:url(images/bodytransdiscwhite.png) no-repeat center top #dddddd;
}
#wo_Con {
	position:relative;
}
#wo_Top {
	background:#1c1c1c;
	height:100px;
	width:100%;
}
#wo_tBase { 
	width:950px;
	position:relative;
}
#wo_tBase #logo {
	background:url(images/weblogo.png) no-repeat center top;
	width:302px;
	height:142px;
	position:relative;
	-webkit-transition: all .3s ease-in-out;-moz-transition: all .3s ease-in-out;-o-transition: all .3s ease-in-out;-ms-transition: all .3s ease-in-out;
}
#wo_tBase #logo a {
	display:Block;
	width:100%;
	height:100%;
}
#wo_tBase #logo:hover {
	top:-15px;
}
#wo_Body {
	text-align:left;
	width:950px;
	padding-top:50px;
	position:relative;
}
#wo_bHeader {
	background:url(images/headermain.png);
	width:850px;
	height:535px;
	position:relative;
}
#circ1 {
	background:#aa1616;
	position:Absolute;
	top:428px;
	left:175px;
	border-radius:50px;
	width:20px;
	height:20px;
	opacity:0;
	-webkit-transition: all .3s ease-in-out;-moz-transition: all .3s ease-in-out;-o-transition: all .3s ease-in-out;-ms-transition: all .3s ease-in-out;
}
#circ1:hover {
	opacity:1;
}
#circ2 {
	background:#aa1616;
	position:Absolute;
	top:428px;
	left:298px;
	border-radius:50px;
	width:20px;
	height:20px;
	opacity:0;
	-webkit-transition: all .3s ease-in-out;-moz-transition: all .3s ease-in-out;-o-transition: all .3s ease-in-out;-ms-transition: all .3s ease-in-out;
}
#circ2:hover {
	opacity:1;
}
#circ3 {
	background:#aa1616;
	position:Absolute;
	top:256px;
	left:492px;
	border-radius:50px;
	width:20px;
	height:20px;
	opacity:0;
	-webkit-transition: all .3s ease-in-out;-moz-transition: all .3s ease-in-out;-o-transition: all .3s ease-in-out;-ms-transition: all .3s ease-in-out;
}
#circ3:hover {
	opacity:1;
}
#circ4 {
	background:#aa1616;
	position:Absolute;
	top:256px;
	left:521px;
	border-radius:50px;
	width:20px;
	height:20px;
	opacity:0;
	-webkit-transition: all .3s ease-in-out;-moz-transition: all .3s ease-in-out;-o-transition: all .3s ease-in-out;-ms-transition: all .3s ease-in-out;
}
#circ4:hover {
	opacity:1;
}
#circ5 {
	background:#aa1616;
	position:Absolute;
	top:256px;
	left:551px;
	border-radius:50px;
	width:20px;
	height:20px;
	opacity:0;
	-webkit-transition: all .3s ease-in-out;-moz-transition: all .3s ease-in-out;-o-transition: all .3s ease-in-out;-ms-transition: all .3s ease-in-out;
}
#circ5:hover {
	opacity:1;
}
#wo_bContent {
	padding-top:30px;
	padding-bottom:30px;
}
h2 {
	color:#888;
	text-shadow:0px 0px 5px #eee;
	margin-left:10px;
}
hr {
	border:0px solid red;
	border-top:1px solid #bbb;
	border-bottom:1px solid #ddd;
}
p {
	color:#888;
	text-shadow:0px 0px 3px #eee;
	margin-left:15px;
	margin-right:15px;
	text-align:justify;
}
#wo_Footer {
	background:url(images/footer.png) no-repeat center top;
	width:850px;
	position:relative;
	height:174px;
}
#wo_fCopyright {
	position:absolute;
	left:250px;
	top:75px;
	color:#888;
	text-shadow:0px 0px 3px #eee;
	font-size:12px;
	
}
#wo_fcLogo {
	background:url(images/minlogo.png) #1c1c1c 10px 10px no-repeat;
	padding:10px;
	width:128px;
	height:40px;
	position:absolute;
	top:-20px;
	right:-170px;
	border-radius:5px;
	box-shadow:0px 0px 5px #1c1c1c;
}
#wo_bMainImg {
	background:url(images/aboutme.png);
	width:450px;
	height:400px;
	margin-top:20px;
	float:left;
}
a.link {
	text-decoration:none;
	color:#777;
	font-weight:bold;
	text-shadow:0px 0px 3px #eee;
	-webkit-transition: all .3s ease-in-out;-moz-transition: all .3s ease-in-out;-o-transition: all .3s ease-in-out;-ms-transition: all .3s ease-in-out;
}
a.link:hover {
	border-bottom:1px dashed #1c1c1c;
}
</style>
</head>
<body><center>
<div id="wo_Con">
	<div id="wo_Top">
		<div id="wo_tBase">
			<div id="logo"><a href="http://www.jaweb.comze.com">
			
			</a></div>
		</div>
	</div>
	<div id="wo_Body">
		<div id="wo_bHeader">
			<div id="circ1">
			
			</div>
			<div id="circ2">
			
			</div>
			<div id="circ3">
			
			</div>
			<div id="circ4">
			
			</div>
			<div id="circ5">
			
			</div>
		</div>
		<div id="wo_bContent">
		<h2>The Web Developer</h2><hr>
			<div id="wo_bMainImg">
			
			</div>
		<p>Now that picture is me! Hi! I'm Juvar Abrera from Cavite, Philippines and I'm 16 years old. I've been maintaining this website for 4 months already and I guess I did a good job since I opened this website. I am currently studying BS Information Technology at De La Salle University - Dasmari&ntilde;as</p>
		<p>I've started studying my first mark-up language which is HTML, last April 2011. Then proceeded studying CSS, CSS3, Javascript, PHP and mySQL. Well, I don't call myself a professional web designer or web developer but I'd liked to make elegant and creative web designs.</p>
		<p>I studied using text tutorials at w3schools.com and video tutorials on youtube on how to make a website. I started making websites with notepad even though I have an application called Adobe Dreamweaver. By typing the code one-by-one, it'll be better for me to enhance my coding skills and to make creative designs.</p>
		<p>Some additional information about my hobby or interest is I like photography especially in Nature and Macro photography.</p>
		<p>I made this website because of my schoolmates that are having difficulties in web designing and development. Though I am not professional, I want to share my knowledge through tutorials. This website is not just by my schoolmates but also for the people around the world who are interested in making websites. I got this concept on making video tutorials is because of some famous YouTube Channels that also provides free video tutorials specifically, <a href="http://thenewboston.org/" class="link" target="_blank">thenewboston</a> and  <a href="http://phpacademy.org/" class="link" target="_blank">phpacademy</a>.</p>
		<p>I am currently studying a new programming language which is Turbo C. Though it is not related in websites, I still want to learn more about it. While I am studying about Turbo C, I also make simple tutorials that is in my website right now. Not just in Turbo C, but also I will try to make more tutorials about Photoshop.</p>
		</div>
	</div>
	<div id="wo_Footer">
		<div id="wo_fCopyright">
		Copyright 2012. Website developed and designed by Juvar Abrera. <a href="http://www.jaweb.comze.com"><div id="wo_fcLogo"></div></a>
		</div>
	</div>
</div>
</center></body>
</html>