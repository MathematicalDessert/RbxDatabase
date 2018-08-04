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
		$Con = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff') or die($mysqli_error($Con));
		?>
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
					<?php
						mysqli_select_db($Con,"users") or die(mysqli_error($Con));
						$Result = mysqli_fetch_assoc(mysqli_query($Con, "SELECT ApiKey FROM Users WHERE Username='$User'"));
						$Key = $Result["ApiKey"];
					?>
					<span class="header">About Your API Key</span>
					<div>
						Every RBXDatabase user has a unique API Key that is generated for them upon registration.
						This Key keeps other users from accessing your data. <b style="color:red;">Never give another user your API Key!</b><br><br>
						Your API Key is <input type="text" id="api-key-pr" value="<?print($Key);?>" readonly></input>
					</div><br>
					<span class="header">Using your API Key</span>
					<div>
						Almost every request you send to RBXDatabase from your game will require your API Key.
						To save time, we recommend that you create a global variable that stores your Key, like so:
						<div class="code-block">
							_G.ApiKey = <span class="string">"<?print($Key);?>"</span> <span class="comment">-- your api key</span>
						</div><br>
						An example of how to use your API Key to save a key called "Test" with the value of "Swag":
						<div class="code-block">
							<span class="keyword">local</span> RBXDatabase = require(<span class="number">167431702</span>) <span class="comment">-- asset id of the rbxdatabase module</span><br>
							<span class="keyword">local</span> ApiKey = <span class="string">"<?print($Key);?>"</span> <span class="comment">-- your api key</span><br><br>
							RBXDatabase:Connect(ApiKey)<br>
							RBXDatabase:SetValue(<span class="string">"Test"</span>, <span class="string">"Swag"</span>)
						</div>
					</div>
				</div>
			</body>
		</html> <?
	}
?>
