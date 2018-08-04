<?
	$POST = json_decode(@file_get_contents('php://input'));
	$Key = $POST->{"ApiKey"};
	$ID = $POST->{"GameID"};
	$Name = $POST->{"GameName"};

	$link = mysqli_connect('localhost', 'rbxdb_user', '2566224');
	$Key = mysqli_real_escape_string($link, $Key);
	$ID = mysqli_real_escape_string($link, $ID);
	$Name = mysqli_real_escape_string($link, $Name);
	$db = mysqli_select_db($link, 'rbxdb_users');
	$result = mysqli_query($link, "SELECT * FROM Users WHERE ApiKey='$Key'");
	$row = mysqli_fetch_assoc($result);
	$FoundKey = $row["ApiKey"];
	
	$date = date_create();
	$Time = date_format($date,"U");
	
	if ($FoundKey != "")
	{
		$db = mysqli_select_db($link, 'rbxdb_games');
		mysqli_query($link, "UPDATE Games SET GameName='$Name' WHERE ID='$ID'");
		$Result = mysqli_query($link, "SELECT Banned FROM Games WHERE ID='$ID'");
		$Result = mysqli_fetch_assoc($Result);
		$Banned = json_encode(explode(",",$Result["Banned"]));
		$db = mysqli_select_db($link, 'rbxdb_servers');
		mysqli_query($link, "UPDATE Servers SET TimeStamp='$Time' WHERE GameID='$ID' AND IP='" . $_SERVER["REMOTE_ADDR"] . "'");
		$Result = mysqli_query($link, "SELECT Queue FROM Servers WHERE GameID='$ID' AND IP='" . $_SERVER["REMOTE_ADDR"] . "'");
		$Result = mysqli_fetch_assoc($Result);
		$Queue = json_encode(explode(",",$Result["Queue"]));
		mysqli_query($link, "UPDATE Servers SET Queue='' WHERE GameID='$ID' AND IP='" . $_SERVER["REMOTE_ADDR"] . "'");
		$Send = array();
		$Send["Success"] = true;
		$Send["Banned"] = $Banned;
		$Send["Queue"] = $Queue;
		print(json_encode($Send));
	}
	Else
	{
		print('{"Success":false,"Error":"Invalid API key."}');
	}
?>