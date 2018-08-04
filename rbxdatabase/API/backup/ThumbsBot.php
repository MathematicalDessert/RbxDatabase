<?php

	if ($_GET["Mode"] == "Register") {
		$cookies = "";
		$Username = "b" . rand();
		print($Username . "<br>");

		$ch = curl_init("https://www.roblox.com/landing/animated");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch,CURLOPT_POST, 7);
		curl_setopt($ch,CURLOPT_POSTFIELDS, "lstMonths=12&lstDays=15&lstYears=1990&gender=Male&username=$Username&password=abcd123&passwordConfirm=abcd123"); // dem credentials
		$result = curl_exec($ch);
		preg_match_all('/^Set-Cookie:\s*([^\r;]*)/mi', $result, $ms);
		foreach ($ms[1] as $m) {
			$cookies = $cookies . $m . "; ";
		}
		curl_close($ch);
		print($result);
		
		$ch = curl_init("http://web.roblox.com/build/upload?groupId=1");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: $cookies"));
		$result = curl_exec($ch);
		preg_match_all('/^Set-Cookie:\s*([^\r;]*)/mi', $result, $ms);
		foreach ($ms[1] as $m) {
			$cookies = $cookies . $m . "; ";
		}
		curl_close($ch);
		
		$ch = curl_init("http://web.roblox.com/User.aspx?submenu=true");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Host: www.roblox.com",
			"Connection: keep-alive",
			"Accept: application/json, text/javascript",
			"Origin: http://www.roblox.com",
			"User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36",
			"Referer: http://www.roblox.com/",
			"Accept-Language: en-US,en;q=0.8",
			"Cookie: $cookies",
		));
		$result = curl_exec($ch);
		curl_close($ch);
		//print($result);
		$start = strpos($result,"?ID=")+4;
		if ($start > 5) {
			
			$link = mysqli_connect('sql200.000space.com', 'space_14914441', 'kirk4226652');
			mysqli_select_db($link, 'space_14914441_thumbs');
			$end = strpos($result,"&ForcePublicView")-$start;
			$ID = substr($result, $start, $end);
			print("Saving $Username with ID: $ID and Cookies: $cookies");

			mysqli_query($link,"INSERT INTO Bots(UserID,Name,Cookies) VALUES('$ID','$Username','$cookies')");
			
			$ch = curl_init("https://www.roblox.com/Services/Secure/AddParentEmail.asmx/InsertParentEmail");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch,CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Host: www.roblox.com",
				"Connection: keep-alive",
				"Accept: */*",
				"X-Requested-With: XMLHttpRequest",
				"User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; rv:11.0) like Gecko",
				"Content-Type: application/json; charset=utf-8",
				"Referer: https://www.roblox.com/My/Account.aspx",
				"Accept-Language: en-US,en;q=0.8",
				"Cache-Control: no-cache",
				"Cookie: $cookies",
			));
			print("Using: " . '{"emailAddress":"kirksaunders12@yahoo.com","userID":' . $ID . ',"pwd":"abcd123","ClientIpAddress":"' . $_SERVER['SERVER_ADDR'] . '","resetParentEmail":false}');
			curl_setopt($ch,CURLOPT_POSTFIELDS, '{"emailAddress":"kirksaunders12@yahoo.com","userID":' . $ID . ',"pwd":"abcd123","ClientIpAddress":"' . $_SERVER['SERVER_ADDR'] . '","resetParentEmail":false}'); // dem credentials
			$result = curl_exec($ch);
			curl_close($ch);
			print($result);

		} else {
			print("Not saving. Captcha encountered.");
		}
	} else {
		$PID = $_GET["ID"];
		$Vote = $_GET["Vote"];
		$link = mysqli_connect('sql200.000space.com', 'space_14914441', 'kirk4226652');
		mysqli_select_db($link, 'space_14914441_thumbs');
		$Result = mysqli_query($link,"SELECT * FROM Bots");
		
		//$Row = mysqli_fetch_assoc($Result);
		
		while($Row = mysqli_fetch_assoc($Result)) {
		
			$cookies = $Row["Cookies"];
			$ch = curl_init("http://www.roblox.com/build/upload?groupId=1");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: $cookies"));
			$result = curl_exec($ch);
			preg_match_all('/^Set-Cookie:\s*([^\r;]*)/mi', $result, $ms);
			foreach ($ms[1] as $m) {
				$cookies = $cookies . $m . "; ";
			}
			curl_close($ch);
			
			$ch = curl_init("http://www.roblox.com/Game/PlaceLauncher.ashx?request=RequestGame&placeId=$PID");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Host: www.roblox.com",
				"Connection: keep-alive",
				"Accept: application/json, text/javascript, */*; q=0.01",
				"Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
				"X-Requested-With: XMLHttpRequest",
				"User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; rv:11.0) like Gecko",
				"Referer: http://www.roblox.com/bleh-place?id=$PID",
				"Accept-Language: en-US,en;q=0.8",
				"Cookie: $cookies",
			));
			print("'Joined' game with " . $Row["Name"] . "<br>");
			$result = curl_exec($ch);
			curl_close($ch);
			
			$ch = curl_init("http://www.roblox.com/bleh-place?id=$PID");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Host: www.roblox.com",
				"Connection: keep-alive",
				"Accept: */*",
				"User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; rv:11.0) like Gecko",
				"Referer: http://www.roblox.com/bleh-place?id=$PID",
				"Accept-Language: en-US,en;q=0.8",
				"Cookie: $cookies",
			));
			$result = curl_exec($ch);
			$start = strpos($result,'href="')+6;
			$end = strpos($result,'">here')-$start;
			$newurl = substr($result,$start,$end);
			curl_close($ch);
						
			$ch = curl_init("http://www.roblox.com$newurl");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Host: www.roblox.com",
				"Connection: keep-alive",
				"Accept: */*",
				"User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; rv:11.0) like Gecko",
				"Referer: http://www.roblox.com/bleh-place?id=$PID",
				"Accept-Language: en-US,en;q=0.8",
				"Cookie: $cookies",
			));
			$result = curl_exec($ch);
			$start = strpos($result,'name="__RequestVerificationToken" type="hidden" value="')+55;
			$end = strpos($result,'<div class="voting-panel body"')-$start-6;
			$Token = substr($result,$start,$end);
			//print($result);
			curl_close($ch);
			
			
			print("Voting with token: $Token" . "<br>");
			
			$ch = curl_init("http://www.roblox.com/voting/canvote?assetId=$PID");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Host: www.roblox.com",
				"Connection: keep-alive",
				"Accept: */*",
				"X-Requested-With: XMLHttpRequest",
				"Origin: http://www.roblox.com",
				"User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; rv:11.0) like Gecko",
				"Referer: http://www.roblox.com$newurl",
				"Accept-Language: en-US,en;q=0.8",
				"Cookie: $cookies",
			));
			//print("<br>$cookies<br>");
			$result = curl_exec($ch);
			print($result);
			preg_match_all('/^Set-Cookie:\s*([^\r;]*)/mi', $result, $ms);
			foreach ($ms[1] as $m) {
				$cookies = $cookies . $m . "; ";
			}
			curl_close($ch);
			
			print($cookies);
			
			$ch = curl_init("http://www.roblox.com/voting/vote?assetId=$PID&vote=$Vote");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch,CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Host: www.roblox.com",
				"Connection: keep-alive",
				"Accept: */*",
				"X-Requested-With: XMLHttpRequest",
				"Origin: http://www.roblox.com",
				"User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; rv:11.0) like Gecko",
				"Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
				"Referer: http://www.roblox.com$newurl",
				"Accept-Language: en-US,en;q=0.8",
				"Cookie: $cookies",
			));
			//print("<br>$cookies<br>");
			curl_setopt($ch,CURLOPT_POSTFIELDS, "__RequestVerificationToken=$Token");
			$result = curl_exec($ch);
			curl_close($ch);
			print($result);
			
		}
	}
	/*
	
	// Get the request validation token that is needed to send messages.
	$url = "http://www.roblox.com/build/set-place-state";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, " ");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: $cookies"));
	$content = curl_exec($ch);
	curl_close($ch);
	if (strpos($content,'Token: ') != false) {
		$start = strpos($content,'Token: ') + 7;
		$length = strpos($content,'Set-Cookie:') - $start - 2;
		$key = substr($content,$start,$length);
	}
	//print($content);
	//print($key . "OKOKOKOKOKOK");
	
	// Get some extra cookies that are needed to send Messages.
	$ch = curl_init("http://web.roblox.com/build/upload?groupId=1");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: $cookies"));
	$result = curl_exec($ch);
	preg_match_all('/^Set-Cookie:\s*([^\r;]*)/mi', $result, $ms);
	foreach ($ms[1] as $m) {
		$cookies = $cookies . $m . "; ";
	}
	curl_close($ch);
	//print($result);
	//print($cookies);

	
	// Take the GET info you entered to send the Message.
	//$subject = $_GET["sub"];
	//$body = $_GET["body"];
	$url = "http://www.roblox.com/messages/send?token=" . urlencode($key);
	//print($url);
	$ch = curl_init($url);
	$fields_string = "";
	$fields = array(
		'subject' => "RBXDatabase Automated Message",
		'body' => "You have received a message from RBXDatabase! Please check your RBXDatabase profile for more information.",
		'recipientid' => urlencode($UserId),
		'cachebuster' => urlencode("120398120948" + $time),
	);
	foreach($fields as $key=>$value) {
		if ($key == "cachebuster") {
			$fields_string .= $key.'='.$value;
		} else {
			$fields_string .= $key.'='.$value.'&';
		}
	}
	rtrim($fields_string, '&');
	//print($fields_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		"Host: www.roblox.com",
		"Connection: keep-alive",
		"Accept: application/json, text/javascript",
		"Origin: http://www.roblox.com",
		"X-Requested-With: XMLHttpRequest",
		"User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36",
		"Content-Type: application/x-www-form-urlencoded",
		"Referer: http://www.roblox.com/My/NewMessage.aspx?RecipientID=$recip",
		"Accept-Language: en-US,en;q=0.8",
		"Cookie: $cookies",
	));
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	$result = curl_exec($ch);
	//print($result);
	//print($cookies);
	*/
?>