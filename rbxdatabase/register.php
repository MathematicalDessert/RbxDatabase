<?php
	session_start();
	if ($_SESSION['loggedin'] == "1") {
		header("Location: landing.php?err=1&msg=You+are+already+logged+in.");
	}
?>
<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="styles/register.css">
		<link rel="icon" type="image/png" href="images/favicon.png">
		<script type="text/javascript" src="scripts/jquery-2.0.3.min.js"></script>
		<script type="text/javascript" src="scripts/jquery.transit.min.js"></script>
		<script type="text/javascript" src="scripts/register.js"></script>
		<title>RBXDatabase - Register</title>
	</head>
	<body>
		<form id="register-wrap" action="new.php" method="POST" autocomplete="off">
			<div id="register-contents">
				<span><span class="register-instruction">Choose a Username</span><br><input class="register-box" id="user" type="text" name="UN"></span><br><br>
				<span><span class="register-instruction">Choose a Password</span><br><input class="register-box" id="pass" type="password" name="PW"></span><br><br>
				<span><span class="register-instruction">Confirm Password</span><br><input class="register-box" id="confirmpass" type="password"></span><br><br>
				<div align="center">
					<script type="text/javascript" src="http://www.google.com/recaptcha/api/challenge?k=6Ld2aO0SAAAAAF9vj1T0URU_DTp4-i8UUfVuYFux"></script>
					<noscript>
						<iframe src="http://www.google.com/recaptcha/api/noscript?k=6Ld2aO0SAAAAAF9vj1T0URU_DTp4-i8UUfVuYFux" height="300" width="500" frameborder="0"></iframe><br>
						<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
						<input type="hidden" name="recaptcha_response_field" value="manual_challenge">
					</noscript>
				</div>
				<a style="position: absolute;bottom: 7px;right: 80px;font-size: 13px;" class="button" href="landing.php">Cancel</a>
				<a style="position: absolute;bottom: 7px;right: 7px;font-size: 13px;" class="button" id="submit-register">Register</a>
			</div>
		</form>
		<div id="register-status">
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
		<div id="copyright">
			Powered by Team Network Studio. RBXDatabase &copy; 2014 rbxdatabase.com
		</div>
		</div>
	</body>
</html>