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
					<table id="err-log-twrap">
						<tr>
							<td style="width: 90px !important;" class="err-table-header">Place Id</td>
							<td style="width: 120px !important;" class="err-table-header">Script Name</td>
							<td class="err-table-header">Message</td>
							<td class="err-table-header">Stacktrace</td>
						</tr>
						<?
							$con = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff',"errdata");
							$result = mysqli_query($con, "SELECT * FROM " . $_SESSION['username'] . "_data");
							while ($row = mysqli_fetch_assoc($result)) {
								$Errmsg = preg_replace("[\r\n]", "<br />", $row['ErrorMessage']);
								$Errtrce = preg_replace("[\r\n]", "<br />", $row['ErrorStacktrace']);
								echo ("<tr>" .
								"	<td>$row[GameId]</td>" .
								"	<td>$row[ErrorScript]</td>" .
								"	<td>$Errmsg</td>" .
								"	<td>$Errtrce</td>" .
								"</tr>");
							}
						?>
					</table>
				</div>
			</body>
		</html> <?
	}
?>
