<?php
	session_start();
	if ($_SESSION['loggedin'] != "1") {
		header("Location: landing.php?err=1&msg=You+need+to+be+logged+in+to+see+this+page.");
	}
?>
<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="styles/manage.css">
		<link rel="icon" type="image/png" href="images/favicon.png">
		<script type="text/javascript" src="scripts/jquery-2.0.3.min.js"></script>
		<script type="text/javascript" src="scripts/jquery.transit.min.js"></script>
		<script type="text/javascript" src="scripts/manage.js"></script>
		<title>RBXDatabase - Manage</title>
	</head>
	<body>
		<div id="manage-title">RBXDatabase Management Panel 2.0</div>
		<div id="manage-user">Logged in as <?php print($_SESSION['username']); ?></div>
		<div id="manage-navigation">
			<a class="s1 nav-button nav-new panel-compat" data-panelhref="panel-dbm.php">Manage Database</a><br>
			<a class="s2 nav-button nav-new panel-compat" data-panelhref="panel-api.php">Manage API</a><br>
			<a class="s3 nav-button nav-new panel-compat" data-panelhref="panel-err.php">Manage Errors</a><br>
			<a class="s4 nav-button nav-new" href="logout.php">Exit Panel</a>
			<a class="s5 nav-button nav-new" style="position:absolute;bottom:30px;" href="http://help.rbxdatabase.com" target="__blank">Documentation</a>
			<a class="s6 nav-button nav-new panel-compat" data-panelhref="panel-about.php" style="position:absolute;bottom:0px;">About RBXDatabase</a>
		</div>
		<div id="manage-controls">
			<iframe src="manage/panel-welcome.php" id="control-view">Your Browser does not support the RBXDatabase Management Panel. Please upgrade to a <a href="http://whatbrowser.org">modern browser</a>.</iframe>
		</div>
		<div id="copyright">
			Powered by Team Network Studio. RBXDatabase &copy; 2014 rbxdatabase.com
		</div>
	</body>
</html>