<?
	require_once("libs/internal.php"); // load RBXDB internal api
	error_reporting(E_ERROR | E_PARSE);
	$Input = $HTTP_RAW_POST_DATA;
	$Input2 = gzinflate(substr($HTTP_RAW_POST_DATA,10,-8));
	if ($Input2 != "") {
		$Input = $Input2;
	}
	$input = json_decode($Input,true); // Without true, it is not an array, it is an object.

	list($succ, $username) = GetUsernameFromKey($input['ApiKey']);
	if ($succ) {
		list($succ2, $data) = GetData($username, $input['Key'], $input["Group"]);
		if ($succ2) {
			$time = time();
			if ($time-GetBusyTime($username, $input['Key'], $input["Group"]) >= 25) {
				ClearQueue($username, $input['Key'], $input["Group"]);
			}
			$time = time();
			SetBusyTime($username, $input['Key'], $time, $input["Group"]);
			$id = GetNewQueueID($username, $input['Key'], $input["Group"]);
			AddToQueue($username,$input['Key'],$id, $input["Group"]);
			if (GetCurQueue($username,$input['Key'], $input["Group"]) == $id) {
				$data['queueID'] = $id;
				$data['ready'] = true;
				die(json_encode(array("succ" => true, "data" => $data)));
			} else {
				die(json_encode(array("succ" => true, "data" => array("queueID" => $id,"ready" => false))));
			}
		} else {
			die(json_encode(array("succ" => $succ2, "error" => $data)));
		}
	} else {
		die(json_encode(array("succ" => $succ, "error" => $username)));
	}
?>