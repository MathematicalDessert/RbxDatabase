<?php
	error_reporting(E_ERROR | E_PARSE);
	$Input = $HTTP_RAW_POST_DATA;
	$Input2 = gzinflate(substr($HTTP_RAW_POST_DATA,10,-8));
	if ($Input2 != "") {
		$Input = $Input2;
	}
	$Source = 'for i,v in pairs(_G) do getfenv()[i] = v end; _G.ScriptStart(script:GetFullName()); ' . htmlspecialchars($Input);
	$con = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff', 'ScriptCache');
	$savin = md5($Source);
	$result = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM Cache WHERE Source='$savin'"));
	if ($result["ID"] != "") {
		print($result["ID"]);
	} else {

		// Make request to roblox to login and then retrieve the cookies.

		function curlResponseHeaderCallback($ch, $headerLine) {
			global $cookies;
			if (preg_match('/^Set-Cookie:\s*([^;]*)/mi', $headerLine, $cookie) == 1)
			$cookies[] = $cookie[1];
			return strlen($headerLine); // Needed by curl
		}
			
		$ch = curl_init("https://www.roblox.com/newlogin");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HEADERFUNCTION, "curlResponseHeaderCallback");
		curl_setopt($ch, CURLOPT_POSTFIELDS, "username=KirkyScriptBuilder&password=kirkysbiscol123"); // Credentials go here.
		$result = curl_exec($ch);
		$cookies = implode("; ",$cookies);
		curl_close($ch);

		$XMLContent = '<roblox xmlns:xmime="http://www.w3.org/2005/05/xmlmime" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="http://www.roblox.com/roblox.xsd" version="4">
		<External>null</External>
		<External>nil</External>
		<Item class="LocalScript" referent="RBX0">
			<Properties>
				<bool name="Disabled">true</bool>
				<Content name="LinkedSource"><null></null></Content>
				<string name="Name">LocalScript</string>
				<ProtectedString name="Source">' . $Source . '</ProtectedString>
			</Properties>
		</Item>
	</roblox>';

		$ch = curl_init("http://www.roblox.com/Data/Upload.ashx?assetid=0&type=Model&name=LocalScript+Execute&description=&genreTypeId=1&ispublic=False&allowComments=False");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Host: www.roblox.com",
			"Connection: Keep-Alive",
			"User-Agent: Roblox/WinInet",
			"Content-Type: application/xml",
			"Pragma: no-cache",
			"Cookie: $cookies",
		));
		curl_setopt($ch,CURLOPT_POST, true);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $XMLContent);
		$result = curl_exec($ch);
		print($result);
		curl_close($ch);
		if (strpos($result,"e") == false) {
			$result = mysqli_query($con,"INSERT INTO Cache(Source,ID) VALUES('$savin','$result')");
		}
	}
?>
