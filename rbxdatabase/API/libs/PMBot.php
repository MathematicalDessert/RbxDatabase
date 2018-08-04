<?php
	function PMUser($UserId) {
	
		// Make request to roblox to login and then retrieve the cookies.
		$CookieFile = "Cookies.txt";
		
		$ch = curl_init("https://m.roblox.com/login");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch,CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $CookieFile);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $CookieFile);
		curl_setopt($ch,CURLOPT_POSTFIELDS, "UserName=rbxdatabaseFeedback&Password=rbxdatabase123"); // Credentials go here.
		$result = curl_exec($ch);
		curl_close($ch);
		
		// Get the request validation token that is needed to send messages.
		$url = "http://www.roblox.com/build/set-place-state";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, " ");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $CookieFile);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $CookieFile);
		$content = curl_exec($ch);
		curl_close($ch);
		if (strpos($content,'Token: ') != false) {
			$start = strpos($content,'Token: ') + 7;
			$length = strpos($content,'Set-Cookie:') - $start - 2;
			$key = substr($content,$start,$length);
		}
		
		// Get some extra cookies that are needed to send Messages.
		$ch = curl_init("http://web.roblox.com/build/upload?groupId=1");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $CookieFile);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $CookieFile);
		$result = curl_exec($ch);
		curl_close($ch);

		// Make the request to send the message.
		$url = "http://www.roblox.com/messages/send?token=" . urlencode($key);
		$ch = curl_init($url);
		$fields_string = "";
		$fields = array(
			'__RequestVerificationToken' => $key,
			'Subject' => "RBXDatabase Automated Message",
			'Body' => "You have received a message from RBXDatabase! Please check your RBXDatabase profile for more information.",
			'RecipientId' => urlencode($UserId),
			'CacheBuster' => urlencode($time),
		);
		foreach($fields as $key=>$value) {
			if ($key == "CacheBuster") {
				$fields_string .= $key.'='.$value;
			} else {
				$fields_string .= $key.'='.$value.'&';
			}
		}
		rtrim($fields_string, '&');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $CookieFile);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $CookieFile);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Host: www.roblox.com",
			"Connection: keep-alive",
			"Accept: application/json",
			"Origin: http://www.roblox.com",
			"X-Requested-With: XMLHttpRequest",
			"User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36",
			"Content-Type: application/x-www-form-urlencoded",
			"Referer: http://www.roblox.com/",
			"Accept-Encoding: gzip,deflate,sdch",
			"Accept-Language: en-US,en;q=0.8",
		));
		curl_setopt($ch,CURLOPT_POST, true);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		$result = curl_exec($ch);
		print($result);
		curl_close($ch);
	}
?>
