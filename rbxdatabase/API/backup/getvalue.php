<?
	$POST = json_decode(@file_get_contents('php://input'));
	$Key = $POST->{"ApiKey"};
	$Ind = $POST->{"Index"};
	
	$link = mysqli_connect('localhost', 'rbxdb_user', '2566224');
	$Key = mysqli_real_escape_string($link, $Key);
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
			$Arr = array();
			$Arr["Success"] = true;
			$Arr["Value"] = $Row["DataValue"];
			$Arr["Type"] = $Row["DataType"];
			print(json_encode($Arr));
		} else {
			print('{"Success":false,"Error":"No results found!"}');
		}
	}
	Else
	{
		print('{"Success":false,"Error":"Invalid API key."}');
	}
?>