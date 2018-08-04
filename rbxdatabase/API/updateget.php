<?php /*
	require_once("libs/internal.php"); // load RBXDB internal api
	$input = json_decode(@file_get_contents("compress.zlib://php://input"),true); // Without true, it is not an array, it is an object.
	
	list($succ, $username) = GetUsernameFromKey($input['ApiKey']);
	if ($succ) {
		while(CanUpdateData($username, $input['Key'], $input["Group"]) == false  ) {
			$time = time();
			if ($time-GetBusyTime($username, $input['Key'], $input["Group"]) >= 25) {
				break;
			}
			usleep(200000+rand(1,10000));
		}
		$time = time();
		SetCanUpdateData($username, $input['Key'], "1", $input["Group"]);
		SetBusyTime($username, $input['Key'], $time);
		list($succ2, $data) = GetData($username, $input['Key'], $input["Group"]);
		if ($succ2) {
			die(json_encode(array("succ" => $succ2, "data" => $data)));
		} else {
			die(json_encode(array("succ" => $succ2, "error" => $data)));
		}
	} else {
		die(json_encode(array("succ" => $succ, "error" => $username)));
	} */
?>