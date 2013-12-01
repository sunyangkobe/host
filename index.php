<?php
/*
 * 2012 Jan 27
* Web Host interface system
*
* This index page will play a role of wrapper and the only portal to access the
* website. Page jumping is done by using URL GET tokens
*
* @author Kobe Sun
*
*/

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Yang Sun (Kobe)</title>
<link href="css/default.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<script src="js/flowplayer-3.2.6.min.js" type="text/javascript"></script>
<script src="js/mootools-core.js" type="text/javascript"></script>
<script src="js/mootools-more.js" type="text/javascript"></script>
<script src="js/listmenu.js" type="text/javascript"></script>
</head>
<body>
	<?php include_once("analyticstracking.php") ?>
	
	<div id="banner">
		<div id="name">Yang Sun (Kobe)</div>
		<div id="school">CARNEGIE MELLON UNIVERSITY</div>
	</div>
	<div id="container">
		<div id="menu">
			<ul>
				<li><a href="index.php?action=home">HOME</a></li>
				<li><a href="index.php?action=academic">ACADEMICS</a></li>
				<li><a href="index.php?action=proj">PROJECTS</a></li>
				<li><a href="index.php?action=teach">TEACHING</a></li>
				<li><a href="index.php?action=research">RESEARCH</a></li>
				<li><a href="index.php?action=career">CAREER</a></li>
				<!--<li><a href="index.php?action=classmates">同学录</a></li>-->
			</ul>
		</div>
		<div id="content">
		<?php
		if (!isset($_GET["action"])) {
			include_once("pages/home.php");
		} else {
			$filename = "pages/" . $_GET["action"] . ".php";
			if (file_exists($filename))
			include_once($filename);
			else
			include_once("pages/error.php");
		}
		?>
		</div>
	</div>
	<div id="footer">Yang Sun (Kobe) &copy; 2013 | All rights reserved |
		Last Update: 5:46pm Monday (EDT) - Feb 4nd, 2013</div>
</body>
</html>
