<? /*
	$c = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff') or die(mysqli_error($c));
	mysqli_select_db($c,"users") or die(mysqli_error($c));
	$r = mysqli_query($c,"SELECT * FROM Users") or die(mysqli_error($c));
	while($Row = mysqli_fetch_assoc($r)) {
		mysqli_select_db($c,"data") or die(mysqli_error($c));
		$re = mysqli_fetch_assoc(mysqli_query($c,"SELECT * FROM " . $Row["Username"] . "_data"));
		if ($re["Group"] == "") {
			print($Row["Username"] . "<br>");
			mysqli_select_db($c, "data") or die(mysqli_error($c));
			mysqli_query($c, "ALTER TABLE " . $Row["Username"] . "_data ADD DataGroup longtext NOT NULL");
		} else {
			print($Row["Username"] . " already has it!<br>");
		}
	}
	print("done");  */
?>