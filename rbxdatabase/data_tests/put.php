<?php
	//ini_set('show_errors', true);
	if (file_get_contents("php://input")) {
		$arg = json_decode(file_get_contents("compress.zlib://php://input"), true);
		//echo("checking data...");
		$con = mysqli_connect('localhost', 'rbxdb_user', '2566224', 'rbxdb_main') or die('{"error":"Couldn\'t connect to database","succ":0}');
		$key = mysqli_real_escape_string($con, $arg["index"]);
		$val = mysqli_real_escape_string($con, $arg["value"]);
		$typ = mysqli_real_escape_string($con, $arg["dtype"]);
		
		//find username
		$result = mysqli_fetch_assoc(mysqli_query($con, "SELECT Username FROM Users WHERE ApiKey='$akey'"));
		if ($result) {
			$table = $result['Username'] . "_data";
			//echo($table);
			//echo($gid . " " . $scr . " " . $msg . " " . $trc);
			mysqli_select_db($con, 'rbxdb_gdata');
			mysqli_query($con, "INSERT INTO $table (Key, Value, DataType) VALUES ('$key','$val','$typ')");
			die('{"mesg":"Successfully saved","succ":1}');
		} else {
			die('{"error":"Invalid ApiKey","succ":0}');
		}
	} else {
		die('{"error":"No post data","succ":0}');
	}
?>