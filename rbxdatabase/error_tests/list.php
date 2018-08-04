<html>
	<head>
		<style>
			pre {
				display: inline;
			}
		</style>
	</head>
	<body>
		<ul style="margin: 0; padding: 0;">
			<?php
				$akey = "";
				$table = "";
				if ($_GET) {
					
					$test = mysqli_connect('localhost', 'rbxdb_user', '2566224', 'rbxdb_users');
					$akey = mysqli_real_escape_string($test, $_GET['access']);
					$res = mysqli_fetch_assoc(mysqli_query($test, "SELECT Username FROM Users WHERE ApiKey='$akey'"));
					if ($res) {
						$table = $res['Username'] . "_data";
					} else {
						die("Invalid ApiKey");
					}
				} else {
					die("No get data");
				}
			
				$rep = "<br>	";
				$con = mysqli_connect('localhost', 'rbxdb_user', '2566224', 'rbxdb_errdata');
				$result = mysqli_query($con, "SELECT * FROM $table");
				while ($row = mysqli_fetch_assoc($result)) {
					$Errmsg = preg_replace("[\r\n]", $rep, $row['ErrorMessage']);
					$Errtrce = preg_replace("[\r\n]", $rep, $row['ErrorStacktrace']);
					echo ("<li><pre>Id $row[ErrorId] from game $row[GameId]</pre><ul>" .
					"<li><pre>Errored Script: $row[ErrorScript]</pre></li><li><pre>Error Message: $Errmsg</pre></li><li><pre>Error Stacktrace: $Errtrce</pre></li>" .
					"</ul></li>");
				}
			?>
		</ul>
	</body>
</html>