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
		$Result = mysqli_query($link, "SELECT * FROM Games WHERE ID='$ID'") or die(mysqli_error($link));
		$Result = mysqli_fetch_assoc($Result);
		if ($Result["ID"] == "") {
			mysqli_query($link, "INSERT INTO Games(ID,Name,Banned) VALUES($ID,'$Name','')");
		}
		mysqli_select_db($link, "rbxdb_servers");
		mysqli_query($link, "INSERT INTO Servers(ID,IP,GameID,Players,Queue,TimeStamp) VALUES('','" . $_SERVER["REMOTE_ADDR"] . "','$ID','','','$Time')");
		print('{"Success":true}');
	}
	Else
	{
		print('{"Success":false,"Error":"Invalid API key."}');
	}
?>