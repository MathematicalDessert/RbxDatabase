<?php
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
		die(json_encode(array("succ" => true)));
	} else {
		die(json_encode(array("succ" => $succ, "error" => $username)));
	}
?>