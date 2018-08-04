<?
	$POST = json_decode(@file_get_contents('php://input'));
	$Key = $POST->{"ApiKey"};
	$Ind = $POST->{"Index"};
	
	$link = mysqli_connect('localhost', 'rbxdb_user', '2566224');
	$Key = mysqli_real_escape_string($link, $Key);
	$Ind = mysqli_real_escape_string($link, $Ind);
	mysqli_select_db($link, 'rbxdb_users');
	$result = mysqli_query($link, "SELECT * FROM Users WHERE ApiKey='$Key'");
	$row = mysqli_fetch_assoc($result);
	$FoundKey = $row["ApiKey"];
	
	if ($FoundKey != "")
	{
		mysqli_select_db($link, "rbxdb_gdata");
		$Result = mysqli_query($link,"SELECT * FROM " . $row["Username"] . "_data WHERE DataKey='$Ind'");
		$Row = mysqli_fetch_assoc($Result);
		if ($Row["DataKey"] != "") {
			$ID = $Row["ID"];
			mysqli_query($link,"DELETE FROM " . $row["Username"] . "_data WHERE ID='$ID'") or die(mysqli_error($link));
			print('{"Success":true}');
		} else {
			print('{"Success":false,"Error":"Value not found."}');
		}
	}
	Else
	{
		print('{"Success":false,"Error":"Invalid API key."}');
	}
?>