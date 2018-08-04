<?
	$Post = json_decode(file_get_contents('php://input'));
	if ($Post->{"AccessKey"} == "QKVDIS@DFEIJNC+DSJKFH-") {
		$con = mysqli_connect('localhost', 'rbxdb_user', '2566224') or die("couldn't connect");
		mysqli_select_db($con, "rbxdb_wintergames") or die("couldn't select");
		$ID = mysqli_real_escape_string($con, $Post->{"UserID"});
		$Game = mysqli_real_escape_string($con, $Post->{"Game"});
		$TopNum = mysqli_real_escape_string($con, $Post->{"TopNum"}) + 0;
		$Where = "WHERE";
		$Top = "";
		if ($ID != "") {
			$Where .= " UserId='$ID'";
		}
		if ($Game != "") {
			if ($Where == "WHERE") {
				$Where .= " Game='$Game'";
			} else {
				$Where .= " AND Game='$Game'";
			}
		}
		if ($TopNum != "") {
			$Top .= " ORDER BY Score DESC LIMIT $TopNum";
		}
		if ($Where == "WHERE") {
			$Where = "";
		}
		$Result = mysqli_query($con, "SELECT * FROM Leaderboard $Where $Top") or die(mysqli_error($con));
		$Tab1 = array();
		$Tab2 = array();
		while($Row = mysqli_fetch_array($Result))
		{
			if ($Row[0] == "") {
				die('{"Success":false,"Error":"No result found."}');
			}
			$Tab3 = array();
			$Tab3["UserID"] = $Row[0]+0;
			$Tab3["Username"] = $Row[1];
			$Tab3["Score"] = $Row[2]+0;
			$Tab3["Game"] = $Row[3];
			$Tab2[]=$Tab3;
		}
		$Tab1["Success"] = true;
		$Tab1["Result"] = $Tab2;
		die(json_encode($Tab1));
	} else {
		die('{"Success":false,"Error":"Invalid access key."}');
	}
?>