<?php
	session_start();
	if ($_SESSION['loggedin'] == "1") {
		header("Location: manage.php");
	}
?>
<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="styles/landing.css">
		<link rel="icon" type="image/png" href="images/favicon.png">
		<script type="text/javascript" src="scripts/jquery-2.0.3.min.js"></script>
		<script type="text/javascript" src="scripts/jquery.transit.min.js"></script>
		<script type="text/javascript" src="scripts/login.js"></script>
		<title>RBXDatabase - Landing</title>
	</head>
	<body>
		<div id="landing-title">
			<span id="landing-title-rbx">rbx</span>database
		</div>
		<form id="landing-login" action="login.php" method="POST" autocomplete="off">
			<div id="login-contents">
				<span><span class="login-instruction">Username</span><br><input class="login-box" id="user" type="text" name="UN"></span><br><br>
				<span><span class="login-instruction">Password</span><br><input class="login-box" id="pass" type="password" name="PW"></span><br>
				<!--<a style="position: absolute;bottom: 7px;right: 72px;font-size: 13px;" class="button" onclick="document.getElementById('landing-login').action='new.php';document.getElementById('landing-login').submit()">Register</a>-->
				<a style="position: absolute;bottom: 7px;right: 72px;font-size: 13px;" class="button" href="register.php">Don't Have An Account?</a>
				<a style="position: absolute;bottom: 7px;right: 7px;font-size: 13px;" class="button" id="submit-login" onclick="document.getElementById('landing-login').submit()">Submit</a>
			</div>
		</form>
		<div id="login-status">
			Logging in...
		</div>
		<div class="windows8">
			<div class="wBall" id="wBall_1">
				<div class="wInnerBall">
				</div>
			</div>
			<div class="wBall" id="wBall_2">
				<div class="wInnerBall">
				</div>
			</div>
			<div class="wBall" id="wBall_3">
				<div class="wInnerBall">
				</div>
			</div>
			<div class="wBall" id="wBall_4">
				<div class="wInnerBall">
				</div>
			</div>
			<div class="wBall" id="wBall_5">
				<div class="wInnerBall">
				</div>
			</div>
		</div>
		<div id="copyright">
			Powered by Team Network Studio. RBXDatabase &copy; 2014 rbxdatabase.com
		</div>
	</body>
</html>