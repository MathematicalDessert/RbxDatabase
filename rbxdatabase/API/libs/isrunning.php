<?php // please use long php tags instead of the short ones
		// Make request to roblox to login and then retrieve the cookies.
		$cookies = "";
		$ch = curl_init("https://www.roblox.com/newlogin");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch,CURLOPT_POST, 2);
		curl_setopt($ch,CURLOPT_POSTFIELDS, "username=kirkyturky12&password=kirk4226652"); // dem credentials
		$result = curl_exec($ch);
		preg_match_all('/^Set-Cookie:\s*([^\r;]*)/mi', $result, $ms);
		foreach ($ms[1] as $m) {
			$cookies = $cookies . $m . "; ";
		}
		curl_close($ch);
		//print($result);
		
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
		
		
		print($cookies);
		// Take the GET info you entered to send the Message.
		$ID = $_GET["ID"];
		$url = "http://www.roblox.com/Game-place?id=" . $ID;
		//print($url);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Host: www.roblox.com",
			"Connection: keep-alive",
			"Accept: */*",
			"Origin: http://www.roblox.com",
			"X-Requested-With: XMLHttpRequest",
			"X-MicrosoftAjax: Delta=true",
			"User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36",
			"Content-Type: application/x-www-form-urlencoded",
			"Referer: http://www.roblox.com/Game-place?id=$ID",
			"Accept-Language: en-US,en;q=0.8",
			"Cookie: $cookies",
		));
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, "ctl00%24ScriptManager=ctl00%24cphRoblox%24TabbedInfo%24GamesTab%24RunningGamesList%24RunningGamesUpdatePanel%7Cctl00%24cphRoblox%24TabbedInfo%24GamesTab%24RunningGamesList%24RunningGamesRefreshButton&ctl00_cphRoblox_TabbedInfo_ClientState=%7B%22ActiveTabIndex%22%3A1%2C%22TabState%22%3A%5Btrue%2Ctrue%2Ctrue%5D%7D&__RequestVerificationToken=e-ySMd3_9ikQqveJ8xJTVwubibvO12nwU-dacs9ee3_CP-APFVYIxVgUloSuHsTb0k62IiVhLKbWCIXaftUSzvCnyhFXcUzFop_-nFHfWBgu6r02ANOa9K_v9MyIopqsN-l9J-ypoogW-HVfoBD20aJGg-A1&__RequestVerificationToken=pZdB7QoRodO95i2wxS5xQ5kq1-pSZoPgvOxn02NQgYfOKymByZBlhEdN5mnrAbKvf6VnriGDk7wkJk9DF2IvmgqopTeJlgTECyiWtolOZMSd-O0NojP2Qhknh3rStCjzuWYg1X85T3e6D4YLOklvwA1YVes1&ctl00%24cphRoblox%24TabbedInfo%24CommentaryTab%24CommentsPane%24NewCommentTextBox=Write%20a%20comment!&comments=&rdoOnline=on&rdoOnline2=on&rdoNotifications=on&__EVENTTARGET=&__EVENTARGUMENT=&__VIEWSTATE=%2FwEPDwUKLTQ2Mjk2NDY2Mw9kFgJmD2QWAgIBEBYCHgZhY3Rpb24FLy9BbnRpcy1Qcml2YXRlLVNjcmlwdC1CdWlsZGVyLXBsYWNlP2lkPTIxMDUzMjE5ZBYEAgcPDxYCHgdWaXNpYmxlaGRkAgoPZBYGAgIPZBYwZg8VAR1BbnRpJ3MgUHJpdmF0ZSBTY3JpcHQgQnVpbGRlcmQCAQ9kFgYCBQ8WAh8BaGQCCQ8WAh8BaGQCCw8WAh8BaGQCAg8VAkAvUGxhY2VJdGVtLmFzcHg%2FaWQ9MjEwNTMyMTkmc2VvbmFtZT1BbnRpcy1Qcml2YXRlLVNjcmlwdC1CdWlsZGVyHUFudGkncyBQcml2YXRlIFNjcmlwdCBCdWlsZGVyZAIDD2QWCAIBDxUBAzUwMGQCAg8VAgMyODADNTAwZAIDDw9kFgIeDUFsdGVybmF0ZVRleHQFHUFudGkncyBQcml2YXRlIFNjcmlwdCBCdWlsZGVyFgQCAQ8PFhAeBkhlaWdodBsAAAAAAIBxQAEAAAAeBVdpZHRoGwAAAAAAQH9AAQAAAB4IQ3NzQ2xhc3MFGCBub3RyYW5zbGF0ZSBub3RyYW5zbGF0ZR4KSXNVcmxGaW5hbGceCEltYWdlVXJsBTVodHRwOi8vdDcucmJ4Y2RuLmNvbS9kMGI2ZmI4ZWI2ODJkYWQxMzc2MzU5YzI2NDVmNTk0Mh4LQ29tbWFuZE5hbWVlHg9Db21tYW5kQXJndW1lbnRkHgRfIVNCAoIDZGQCAg8WBB4GaGVpZ2h0BQMyODAeBXdpZHRoBQM1MDBkAgQPFgQeC18hSXRlbUNvdW50Zh8BaGQCBA8WAh8BaGQCBg8VAQBkAgcPFgQeBWNsYXNzBRlBZGRSZW1vdmVGYXZvcml0ZSB0b29sdGlwHg5vcmlnaW5hbC10aXRsZQUQQWRkIHRvIEZhdm9yaXRlc2QCCQ8VAnxJZiB5b3UgYXJlIG5vdCBhbGxvd2VkIGluIGhlcmUsIHlvdSBjYW4gcGxheSB0aGUgcHVibGljIHZlcnNpb24gb2YgdGhpcyBTQg0KaHR0cDovL3d3dy5yb2Jsb3guY29tL1BsYWNlSXRlbS5hc3B4P0lEPTIxMDUzMjc5fElmIHlvdSBhcmUgbm90IGFsbG93ZWQgaW4gaGVyZSwgeW91IGNhbiBwbGF5IHRoZSBwdWJsaWMgdmVyc2lvbiBvZiB0aGlzIFNCDQpodHRwOi8vd3d3LnJvYmxveC5jb20vUGxhY2VJdGVtLmFzcHg%2FSUQ9MjEwNTMyNzlkAgsPDxYIHwdkHwhlHwlkHwFoZGQCDA8VAQc0NzE5MzUzZAINDxUEFS9Vc2VyLmFzcHg%2FSUQ9NDcxOTM1MwtBbnRpQm9vbXowcgtBbnRpQm9vbXowcgkxMC8yLzIwMDlkAg4PFQEBMGQCDw8WEh4PZGF0YS1hc3NldC10eXBlBQVQbGFjZR8OBSVidG4tcHJpbWFyeSBidG4tbWVkaXVtIFB1cmNoYXNlQnV0dG9uHg5kYXRhLWl0ZW0tbmFtZQUdQW50aSdzIFByaXZhdGUgU2NyaXB0IEJ1aWxkZXIeDGRhdGEtaXRlbS1pZAUIMjEwNTMyMTkeE2RhdGEtZXhwZWN0ZWQtcHJpY2UFATAeD2RhdGEtcHJvZHVjdC1pZAUHMzUzMzczNB4XZGF0YS1leHBlY3RlZC1zZWxsZXItaWQFBzQ3MTkzNTMeE2RhdGEtYmMtcmVxdWlyZW1lbnQFATAeEGRhdGEtc2VsbGVyLW5hbWUFC0FudGlCb29tejByZAIQDxUBATBkAhEPFQEAZAIUDxYCHwFoZAIVDxYCHwFoZAIWDxUGAAkxLzIyLzIwMTAKMSB3ZWVrIGFnbwMxMDMGMTIsNTY4AjIwZAIXDxYCHwFoZAIYDxYCHwFoFgJmDxUBHUFudGkncyBQcml2YXRlIFNjcmlwdCBCdWlsZGVyZAIZDxUCBi9nYW1lcwNBbGxkAhsPFQYJaW52aXNpYmxlCDIxMDUzMjE5CDIxMDUzMjE5CDIxMDUzMjE5AjM0CDIxMDUzMjE5ZAIcD2QWAmYPFQEIMTgzODAzMjRkAh0PFQEIMjEwNTMyMTlkAgMPFgIfAWhkAgUPZBYEZg8PFgIfAWhkZAICD2QWAgIBD2QWBGYPDxYCHwFoZBYCZg9kFgJmD2QWBAIDDxYEHw0C%2F%2F%2F%2F%2Fw8fAWhkAgcPDxYCHwFoZGQCAQ9kFgJmD2QWAmYPZBYEAgEPFgIfAWgWAmYPDxYCHwFoZGQCAw8WAh8BZxYGAgEPFCsAAg8WBB4LXyFEYXRhQm91bmRnHw1mZGRkAgMPZBYCZg9kFgwCAQ8PFgQfBQUxYnRuLWNvbnRyb2wgYnRuLWNvbnRyb2wtbWVkaXVtIHRyYW5zbGF0ZSBkaXNhYmxlZB8KAgJkZAIDDw8WBB8FBTFidG4tY29udHJvbCBidG4tY29udHJvbC1tZWRpdW0gdHJhbnNsYXRlIGRpc2FibGVkHwoCAmRkAgUPDxYCHgRUZXh0BQEwZGQCBw8PFgIfGQUBMGRkAgkPDxYEHwUFMWJ0bi1jb250cm9sIGJ0bi1jb250cm9sLW1lZGl1bSB0cmFuc2xhdGUgZGlzYWJsZWQfCgICZGQCCw8PFgQfBQUxYnRuLWNvbnRyb2wgYnRuLWNvbnRyb2wtbWVkaXVtIHRyYW5zbGF0ZSBkaXNhYmxlZB8KAgJkZAIFDw8WAh8BaGRkGAYFGmN0bDAwJGNwaFJvYmxveCRUYWJiZWRJbmZvDw9kAgFkBURjdGwwMCRjcGhSb2Jsb3gkVGFiYmVkSW5mbyRHYW1lc1RhYiRSdW5uaW5nR2FtZXNMaXN0JFBhZ2luZ011bHRpVmlldw8PZAIBZAVJY3RsMDAkY3BoUm9ibG94JFRhYmJlZEluZm8kR2FtZXNUYWIkUnVubmluZ0dhbWVzTGlzdCRSdW5uaW5nR2FtZXNMaXN0Vmlldw88KwAOAwhmDGYNAv%2F%2F%2F%2F8PZAUjY3RsMDAkcmJ4R29vZ2xlQW5hbHl0aWNzJE11bHRpVmlldzEPD2QCAmQFHl9fQ29udHJvbHNSZXF1aXJlUG9zdEJhY2tLZXlfXxYBBRpjdGwwMCRjcGhSb2Jsb3gkVGFiYmVkSW5mbwVFY3RsMDAkY3BoUm9ibG94JE5ld0dhbWVQYWdlQ29udHJvbCRWaXNpdEJ1dHRvbnMkVmlzaXRCdXR0b25zTXVsdGlWaWV3Dw9kZmTEGDmLfTV2YG9ONkda1UfAdSkqyQ%3D%3D&__EVENTVALIDATION=%2FwEWAwKig%2Bq4BQKKop7sCALBlsDFCaGxPheDduJnmMi7VpP5VziKBoNE&__ASYNCPOST=true&ctl00%24cphRoblox%24TabbedInfo%24GamesTab%24RunningGamesList%24RunningGamesRefreshButton=Refresh");
		$result = curl_exec($ch);
		print($result);
		//print($cookies);
?>