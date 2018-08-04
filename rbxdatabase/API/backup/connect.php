<?
	$POST = json_decode(@file_get_contents('php://input'));
	$Key = $POST->{"ApiKey"};
	
	$link = mysqli_connect('localhost', 'rbxdb_user', '2566224');
	$Key = mysqli_real_escape_string($link, $Key);
	$db = mysqli_select_db($link, 'rbxdb_users');
	$result = mysqli_query($link, "SELECT * FROM Users WHERE ApiKey='$Key'");
	$row = mysqli_fetch_assoc($result);
	$FoundKey = $row["ApiKey"];
	
	if ($FoundKey != "")
	{
		print('{"Success":true}');
	}
	Else
	{
		print('{"Success":false,"Error":"Invalid API key."}');
	}
?>