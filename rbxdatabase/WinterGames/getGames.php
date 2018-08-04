<?
	function IsInArray($Tab,$Val) {
		foreach($Tab as $v) {
			if ($v == $Val) {
				return true;
			}
		}
		return false;
	}

	$Post = json_decode(file_get_contents('php://input'));
	if ($Post->{"AccessKey"} == "QKVDIS@DFEIJNC+DSJKFH-") {
		$con = mysqli_connect('localhost', 'rbxdb_user', '2566224') or die("couldn't connect");
		mysqli_select_db($con, "rbxdb_wintergames") or die("couldn't select");
		$Result = mysqli_query($con, "SELECT Game FROM Leaderboard") or die(mysqli_error($con));
		$Tab1 = array();
		$Tab2 = array();
		while($Row = mysqli_fetch_array($Result))
		{
			if ($Row[0] == "") {
				die('{"Success":false,"Error":"No result found."}');
			}
			if (IsInArray($Tab2,$Row[0]) == false) {
				$Tab2[]=$Row[0];
			}
		}
		$Tab1["Success"] = true;
		$Tab1["Result"] = $Tab2;
		die(json_encode($Tab1));
	} else {
		die('{"Success":false,"Error":"Invalid access key."}');
	}
?>