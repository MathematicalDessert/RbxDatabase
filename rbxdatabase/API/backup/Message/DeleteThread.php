<?
	$User = $_GET["User"];
	$Pass = $_GET["Pass"];
	$ThreadKey = $_GET["Thread"];
	if ($Depth == "") { $Depth = 1; }
	if ($IncludeContact == "") { $IncludeContact = "true"; }
	$Login = $_GET["Login"];
	$cookiepath = 'cookie.txt';
	if ($Pass == "Kirk4226652") {
		if ($Login == "true") {
			//unlink("cookie.txt");
			$ch = curl_init("https://cprodctnxsf.att.net/commonLogin/igate_edam/login.do");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiepath);
			curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiepath);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Host: cprodctnxsf.att.net",
				"Connection: keep-alive",
				"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
				"Origin: https://cprodctnxsf.att.net",
				"User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36",
				"Content-Type: application/x-www-form-urlencoded",
				"Referer: https://cprodctnxsf.att.net/commonLogin/igate_edam/controller.do?TAM_OP=login&USERNAME=unauthenticated&ERROR_CODE=0x00000000&ERROR_TEXT=HPDBA0521I%20%20%20Successful%20completion&METHOD=GET&URL=%2F%3Ftucd567%3Dw&REFERER=https%3A%2F%2Fcprodx.att.net%2FcommonLogin%2Figate_edam%2Fcontroller.do%3FTAM_OP%3Dlogout%26USERNAME%3Dunauthenticated%26ERROR_CODE%3D0x00000000%26ERROR_TEXT%3DSuccessful%2520completion%26METHOD%3DGET%26URL%3D%2Fpkmslogout%26REFERER%3D%26HOSTNAME%3Dcprodx.att.net%26AUTHNLEVEL%3D%26FAILREASON%3D%26PROTOCOL%3Dhttps%26OLDSESSION%3D%26style%3Dmessages.att.net%26amp%3Breturnurl%3Dhttps%3A%2F%2Fmessages.att.net&HOSTNAME=messages.att.net&AUTHNLEVEL=&FAILREASON=&PROTOCOL=https&OLDSESSION=",
				"Accept-Language: en-US,en;q=0.8",
				"Cache-Control: max-age=0",
			));
			curl_setopt($ch, CURLOPT_POSTFIELDS, "style=messages.att.net&targetURL=https%3A%2F%2Fmessages.att.net%2F&userid=$User&password=$Pass&signin=&rememberID=on");
			$result = curl_exec($ch);
			//print($result);

			$cookies = "";
			$ch = curl_init("https://messages.att.net");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiepath);
			curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiepath);
			//print(substr($to,8,strpos($to,"/",9)-8));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Host: messages.att.net",
				"Connection: keep-alive",
				"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
				"Origin: https://cprodctnxsf.att.net",
				"User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36",
				"Referer: https://cprodctnxsf.att.net/commonLogin/igate_edam/controller.do?TAM_OP=login&USERNAME=unauthenticated&ERROR_CODE=0x00000000&ERROR_TEXT=HPDBA0521I%20%20%20Successful%20completion&METHOD=GET&URL=%2F%3Ftucd567%3Dw&REFERER=https%3A%2F%2Fcprodx.att.net%2FcommonLogin%2Figate_edam%2Fcontroller.do%3FTAM_OP%3Dlogout%26USERNAME%3Dunauthenticated%26ERROR_CODE%3D0x00000000%26ERROR_TEXT%3DSuccessful%2520completion%26METHOD%3DGET%26URL%3D%2Fpkmslogout%26REFERER%3D%26HOSTNAME%3Dcprodx.att.net%26AUTHNLEVEL%3D%26FAILREASON%3D%26PROTOCOL%3Dhttps%26OLDSESSION%3D%26style%3Dmessages.att.net%26amp%3Breturnurl%3Dhttps%3A%2F%2Fmessages.att.net&HOSTNAME=messages.att.net&AUTHNLEVEL=&FAILREASON=&PROTOCOL=https&OLDSESSION=",
				"Accept-Language: en-US,en;q=0.8",
				"Cache-Control: max-age=0",
			));
			$result = curl_exec($ch);
			//print($result);
		}
		
		$ch = curl_init("https://messages.att.net/messages/v0/threads/$ThreadKey?deleteFavorites=false&action=DELETE");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiepath);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiepath);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Host: messages.att.net",
			"Connection: keep-alive",
			"Accept: */*",
			"X-Requested-With: XMLHttpRequest",
			"Origin: http://www.att.com",
			"User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; rv:11.0) like Gecko",
			"Content-Type: application/json",
			"Referer: http://messages.att.net",
			"Accept-Language: en-US,en;q=0.8",
		));
		$result = curl_exec($ch);
		curl_close($ch);
		print($result);
	}
?>