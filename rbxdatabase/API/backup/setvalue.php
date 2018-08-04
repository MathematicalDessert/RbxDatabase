<?
	$POST = json_decode(@file_get_contents('php://input'));
	$Key = $POST->{"ApiKey"};
	$Ind = $POST->{"Index"};
	$Val = $POST->{"Value"};
	$Typ = $POST->{"Type"};
	
	$link = mysqli_connect('localhost', 'rbxdb_user', '2566224');
	$Key = mysqli_real_escape_string($link, $Key);
	$Ind = mysqli_real_escape_string($link, $Ind);
	$Val = mysqli_real_escape_string($link, $Val);
	$Typ = mysqli_real_escape_string($link, $Typ);
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
				mysqli_query($link,"UPDATE " . $row["Username"] . "_data SET DataType='$Typ',DataValue='$Val' WHERE ID='$ID'");
				print('{"Success":true}');
			} else {
				mysqli_query($link,"INSERT INTO " . $row["Username"] . "_data(ID,DataKey,DataValue,DataType) VALUES('','$Ind','$Val','$Typ')") or die(mysqli_error($link));
				print('{"Success":true}');
			}
	}
	Else
	{
		print('{"Success":false,"Error":"Invalid API key."}');
	}
?>