<?php
	require_once("libs/internal.php");
	$input = json_decode(@file_get_contents("compress.zlib://php://input"));
	
	list($succ, $username) = GetUsernameFromKey($input['ApiKey']);
	if ($succ) {
		list($succ2, $err) = CreateData($username, $input['Key'], $input['DataType']);
		if ($succ2) {
			die(json_encode(array("succ" => $succ2)));
		} else {
			die(json_encode(array("succ" => $succ2, "error" => $err)));
		}
	} else {
		die(json_encode(array("succ" => $succ, "error" => $username)));
	}
?>