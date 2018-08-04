<?php
	ini_set('display_errors', '1');
	session_start();
	if ($_SESSION['loggedin'] == "1") {
		header("Location: manage.php?li=1");
	} else { 
		$username = strip_tags(trim($_POST["UN"]));
		$password = strip_tags(trim($_POST["PW"]));
		if ($username != "") {
			$con = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff') or die("couldn't connect");
			mysqli_select_db($con, "users") or die(mysqli_error($con));
			$username = mysqli_real_escape_string($con, $username);
			$query = "SELECT * FROM Users WHERE Username='$username'";
			$result = mysqli_query($con,$query) or die("Couldn't execute query");
			$row = mysqli_fetch_assoc($result);
			if (crypt($password, "24gh523j4") == $row['Password']) {
				$_SESSION['loggedin'] = "1";
				$_SESSION['username'] = $row["Username"];
				header("Location: manage.php");
			} else {
				header("Location: landing.php?err=1&msg=" . urlencode("Invalid username or password."));
			}
		} else {
			header("Location: landing.php?err=1&msg=" . urlencode("Invalid username or password."));
		}
	}
?>