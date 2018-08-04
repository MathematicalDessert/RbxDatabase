<?php
	session_start();
	if ($_SESSION['loggedin'] != "1") {
		?>
		<!-- Dear whoever wrote the echo code. In the future, instead of echoeing the html you want to load, just use the PHP closing tag, put your
		html code, then use the PHP open tag. I did this. It looks much nicer and works better. -->
		<!DOCTYPE html>

		<html>
			<head>
				<meta charset="UTF-8">
				<link rel="stylesheet" type="text/css" href="../styles/panel-api.css">
				<script type="text/javascript" src="../scripts/jquery-2.0.3.min.js"></script>
				<script type="text/javascript" src="../scripts/jquery.transit.min.js"></script>
			</head>
			<body>
				<div id="main-wrap">
					You need to be logged in to see this page.
				</div>
			</body>
		</html> <?
	} else {
		$User = $_SESSION["username"];
		?>
		<!DOCTYPE html>

		<html>
			<head>
				<meta charset="UTF-8">
				<link rel="stylesheet" type="text/css" href="../styles/panel-err.css">
				<script type="text/javascript" src="../scripts/jquery-2.0.3.min.js"></script>
				<script type="text/javascript" src="../scripts/jquery.transit.min.js"></script>
			</head>
			<body>
				<div id="main-wrap">
					<h1>Welcome, <? print($User); ?>!</h1>
					<p>Please select an item from the submenu to the left.</p>
					<br />
					<br />
					<p>We're sorry for the lack of work that's been done here; we have been having some technical difficulties with ROBLOX and it's interaction with our API.</p>
				</div>
			</body>
		</html> <?
	}
?>
