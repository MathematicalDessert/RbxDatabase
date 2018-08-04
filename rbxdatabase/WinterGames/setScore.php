<?
	$Post = json_decode(file_get_contents('php://input'));
	if ($Post->{"AccessKey"} == "QKVDIS@DFEIJNC+DSJKFH-") {
		$con = mysqli_connect('localhost', 'rbxdb_user', '2566224') or die("couldn't connect");
		mysqli_select_db($con, "rbxdb_wintergames") or die("couldn't select");
		$ID = mysqli_real_escape_string($con, $Post->{"UserID"});
		$User = mysqli_real_escape_string($con, $Post->{"User"});
		$Score = mysqli_real_escape_string($con, $Post->{"Score"});
		$Game = mysqli_real_escape_string($con, $Post->{"Game"});
		$Result = mysqli_query($con, "SELECT * FROM Leaderboard WHERE UserId='$ID' AND Game='$Game'") or die(mysqli_error($con));
		$Result = mysqli_fetch_row($Result);
		if ($Result[0] == "") {
			$Result = mysqli_query($con, "INSERT INTO Leaderboard (UserId, UserName, Score, Game) VALUES ($ID,'$User',$Score,'$Game')") or die(mysqli_error($con));
			die('{"Success":true}');
		} else {
			$Result = mysqli_query($con, "UPDATE Leaderboard SET UserName='$User', Score=$Score WHERE UserId='$ID' AND Game='$Game'") or die(mysqli_error($con));
			die('{"Success":true}');
		}
	} else {
		die('{"Success":false,"Error":"Invalid access key."}');
	}
?>