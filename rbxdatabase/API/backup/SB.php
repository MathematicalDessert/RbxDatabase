<?php
	$POST = @file_get_contents('php://input');
	file_put_contents("SB.txt",$POST);
?>