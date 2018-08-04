<?php /*
	require_once("libs/internal.php"); // load RBXDB internal api
	$input = json_decode(@file_get_contents("compress.zlib://php://input"),true); // Without true, it is not an array, it is an object.
	
	list($succ, $username) = GetUsernameFromKey($input['ApiKey']);
	if ($succ) {
		list($succ2, $err) = SetData($username, $input['Key'], $input['Value'], $input["DataType"], $input["Group"]);
		usleep(1000);
		SetCanUpdateData($username, $input['Key'], "0", $input["Group"]);
		if ($succ2) {
			die(json_encode(array("succ" => $succ2)));
		} else {
			die(json_encode(array("succ" => $succ2, "error" => $err)));
		}
	} else {
		die(json_encode(array("succ" => $succ, "error" => $username)));
	} */
?>