<?php
	session_start();
	require_once('recaptchalib.php');
	$privatekey = "6Ld2aO0SAAAAAGgyqBuC17qQ9FpfuEPTFnCYBVwh";
	$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
	if (!$resp->is_valid) {
		//die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." . "(reCAPTCHA said: " . $resp->error . ")");
		header("Location: register.php?err=1&msg=Invalid+Captcha.");
	} else {
		if ($_SESSION['loggedin'] != "1") {
			$username = strip_tags(trim($_POST["UN"]));
			$password = strip_tags(trim($_POST["PW"]));
			if ($username == "") {
				header("Location:  register.php?err=1&msg=Username+cannot+be+blank.");
			} elseif (preg_match("[\W\S]", $username)) {
				header("Location: register.php?err=1&msg=Usernames+can+only+contain+alphanumeric+characters.");
			} else {
				if ($password == "") {
					header("Location: register.php?err=1&msg=Password+cannot+be+blank.");
				} else { 
					$con = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff') or die("couldn't connect");
					mysqli_select_db($con, "users") or die(mysqli_error($con));
					$username = mysqli_real_escape_string($con, $username);
					$temp = mysqli_query($con, "SELECT * FROM Users WHERE Username='$username'");
					$row = mysqli_fetch_assoc($temp);
					if ($row) {
						header("Location: register.php?err=1&msg=User+already+exists.");
					} else {
						$password = mysqli_real_escape_string($con, $password);
						$query = "INSERT INTO Users (Username, Password, ApiKey)
							VALUES ('$username', '" . crypt($password, "24gh523j4") . "', '" . hash("md5", "slkdjf23794 $username 23488kfj", false) . "')";
						mysqli_query($con,$query) or die("Couldn't execute query");
						mysqli_select_db($con, "errdata") or die("couldn't select 3");
						mysqli_query($con, "CREATE TABLE IF NOT EXISTS " . $username . "_data (
							ErrorId		SERIAL,
							GameId		BIGINT UNSIGNED NOT NULL,
							ErrorScript	VARCHAR(20),
							ErrorMessage	TEXT,
							ErrorStacktrace	TEXT,
						PRIMARY KEY(ErrorId) )");
						mysqli_select_db($con, "data") or die(mysqli_error($con));
						mysqli_query($con, "CREATE TABLE IF NOT EXISTS " . $username . "_data (
							ID int(11) NOT NULL AUTO_INCREMENT,
							DataKey varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
							DataValue longtext COLLATE utf8_unicode_ci,
							DataType enum('BOL','NIL','NUM','STR','TAB','AXS','BCOL','CFR','CLR3','ENM','FCS','RAY','REG3','R316','UDM','UDM2','VEC2','VEC3','V316','V216') COLLATE utf8_unicode_ci DEFAULT NULL,
							Busy tinyint(1) NOT NULL,
							BusyTime int(20) NOT NULL,
							Queue longtext NOT NULL,
							QID int(20) NOT NULL DEFAULT 0,
							DataGroup longtext NOT NULL,
						PRIMARY KEY(ID) )");
						header("Location: landing.php?msg=Account+created.");
					}
				}
			}
		} else {
			header("Location: landing.php?err=1&msg=You+are+already+logged+in.");
		}
	}
?>