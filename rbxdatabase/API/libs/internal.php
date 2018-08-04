<?php
	// Internal module for RBXDatabase
		// Gets Username from Api Key
		function GetUsernameFromKey($key) {
			$con = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff','users');
			$apikey = mysqli_real_escape_string($con, $key); //prevent malicious users from running MySQL code
			$result = mysqli_fetch_assoc(mysqli_query($con, "SELECT Username FROM Users WHERE ApiKey='$apikey'"));
			if ($result['Username']) {
				return array(true, $result['Username']);
			} else {
				return array(false, "Invalid ApiKey");
			}
		}
		
		/* Sets 'Database' data - overwrites old value if doesn't exist, sends to CreateData
		*/
		function SetData($user, $key, $value, $type, $group) {
			$con = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff','data');
			$table = mysqli_real_escape_string($con, $user) . "_data";
			$value = mysqli_real_escape_string($con, $value);
			$key = mysqli_real_escape_string($con, $key);
			$type = mysqli_real_escape_string($con, $type);
			$group = mysqli_real_escape_string($con, $group);
			
			$result = mysqli_fetch_assoc(mysqli_query($con, "SELECT DataType FROM $table WHERE DataKey='$key' AND DataGroup='$group'"));
			if ($result["DataType"] == "") {
				return CreateData($user, $key, $value, $type, $group);
			} else {
				$temp = $result;
				//if ($temp['DataType'] == $type) {
					$result = mysqli_query($con, "UPDATE $table" .
					"	SET DataValue='$value',DataType='$type'" .
					"	WHERE DataKey='$key' AND DataGroup='$group'"); // yay setting of data
					if ($result) {
						return array(true);
					} else {
						return array(false, "Unexpected Error");
					}
				/*} else {
					return array(false, "Invalid DataType"); // datatype matching
				}*/
			}
		}
		
		/* Gets 'Database' data - no modifications made
		*/
		function GetData($user, $key, $group) {
			$con = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff','data');
			$table = mysqli_real_escape_string($con, $user) . "_data";
			$keyo = $key;
			$key = mysqli_real_escape_string($con, $key);
			$group = mysqli_real_escape_string($con, $group);

			$data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM $table WHERE DataKey='$key' AND DataGroup='$group'"));
			if ($data['DataKey'] != "") {
				$data['DataKey'] = stripslashes($data['DataKey']);
				$data['DataValue'] = stripslashes($data['DataValue']);
				return array(true, $data);
			} else {
				return array(false, "Couldn't find data key '$keyo'");
			}
		}
		
		/* Returns all data in the user's 'Database'
		*/
		function DumpData($user, $group) {
			$con = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff','data');
			$table = mysqli_real_escape_string($con, $user) . "_data";
			$key = mysqli_real_escape_string($con, $key);
			$group = mysqli_real_escape_string($con, $group);
			$new = array();
			$data = mysqli_query($con, "SELECT * FROM $table WHERE DataGroup='$group'");
			while ($row = mysqli_fetch_assoc($data)) {
				if ($row["DataGroup"] == $group) {
					$row['DataKey'] = stripslashes($row['DataKey']);
					$row['DataValue'] = stripslashes($row['DataValue']);
					$new[] = $row;
				}
			}
			return array(true, $new);
		}
		
		/* Updates 'Database' data (This is outdated and not used in the API!)
			Data is overwritten unless it is one of these:
				STR - Data is appended
				NUM - Data is added
				TAB - Data is appended, overwritten if the key already exists.
		*/
		function UpdateData($user, $key, $value, $group) {
			$con = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff','data');
			$table = mysqli_real_escape_string($con, $user) . "_data";
			//$db = mysqli_real_escape_string($con, $db);
			$key = mysqli_real_escape_string($con, $key);
			$value = mysqli_real_escape_string($con, $value);
			$group = mysqli_real_escape_string($con, $group);
			
			$old = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM $table WHERE DataKey=$key AND DataGroup='$group'"));
			if ($old) {
				$newval = $old['DataValue'];
				if ($old['DataType'] == "TAB") {
					$newval = $newval . "&" . urlencode($key) . "=" . urlencode($value);
				} elseif ($old['DataType'] == "STR") {
					$newval = $newval . $value;
				} elseif ($old['DataType'] == "NUM") {
					$newval = floatval($newval) + floatval($value);
				}
				$succ = mysqli_query($con, 'UPDATE $table' .
				'	SET DataValue=$newval' .
				'	WHERE DataKey=$key');
				if ($succ) {
					return array(true);
				} else {
					return array(false, "Couldn't update data");
				}
			} else {
				return array(false, "Couldn't find data");
			}
		}
		
		function RemoveData($user, $key, $group) {
			$con = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff','data');
			$table = mysqli_real_escape_string($con, $user) . "_data";
			$key = mysqli_real_escape_string($con, $key);
			$group = mysqli_real_escape_string($con, $group);
			
			$temp = mysqli_query($con, "DELETE FROM $table WHERE DataKey='$key' AND DataGroup='$group'");
			if ($temp == false) {
				return array(false, "Unexpected Error");
			} else {
				return array(true);
			}
		}
		
		function CreateData($user, $key, $value, $type, $group) { // I kind of made SetData create the key if it doesn't exist. kthx
			$con = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff','data');
			$table = mysqli_real_escape_string($con, $user) . "_data";
			$value = mysqli_real_escape_string($con, $value);
			$key = mysqli_real_escape_string($con, $key);
			$type = mysqli_real_escape_string($con, $type);
			$group = mysqli_real_escape_string($con, $group);
			
			$temp = mysqli_query($con, "INSERT INTO $table(ID,DataKey,DataValue,DataType,Busy,DataGroup) VALUES('','$key','$value','$type','0','$group')");
			if ($temp == false) {
				return array(false, "Unexpected Error");
			} else {
				return array(true);
			}
		}
		
		function CanUpdateData($user, $key, $group) {
			$con = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff','data');
			$table = mysqli_real_escape_string($con, $user) . "_data";
			$key = mysqli_real_escape_string($con, $key);
			$group = mysqli_real_escape_string($con, $group);
			$result = mysqli_query($con,"SELECT Busy FROM $table WHERE DataKey='$key' AND DataGroup='$group'");
			$result = mysqli_fetch_assoc($result);
			if ($result["Busy"] == "1") {
				return false;
			} else {
				return true;
			}
		}
		
		function SetCanUpdateData($user, $key, $bool, $group) {
			$con = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff','data');
			$table = mysqli_real_escape_string($con, $user) . "_data";
			$key = mysqli_real_escape_string($con, $key);
			$bool = mysqli_real_escape_string($con, $bool);
			$group = mysqli_real_escape_string($con, $group);
			$result = mysqli_query($con,"UPDATE $table SET Busy='$bool' WHERE DataKey='$key' AND DataGroup='$group'");
			if ($result) {
				return true;
			} else {
				return false;
			}
		}
		
		function GetBusyTime($user, $key, $group) {
			$con = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff','data');
			$table = mysqli_real_escape_string($con, $user) . "_data";
			$key = mysqli_real_escape_string($con, $key);
			$group = mysqli_real_escape_string($con, $group);
			$result = mysqli_query($con,"SELECT BusyTime FROM $table WHERE DataKey='$key' AND DataGroup='$group'");
			$result = mysqli_fetch_assoc($result);
			return $result["BusyTime"];
		}
		
		function GetCurQueue($user, $key, $group) {
			$con = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff','data');
			$table = mysqli_real_escape_string($con, $user) . "_data";
			$key = mysqli_real_escape_string($con, $key);
			$group = mysqli_real_escape_string($con, $group);
			$result = mysqli_query($con,"SELECT Queue FROM $table WHERE DataKey='$key' AND DataGroup='$group'");
			$result = mysqli_fetch_assoc($result);
			$ex = explode(",",strval($result["Queue"]));
			return $ex[0];
		}

		function GetNewQueueID($user, $key, $group) {
			$con = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff','data');
			$table = mysqli_real_escape_string($con, $user) . "_data";
			$key = mysqli_real_escape_string($con, $key);
			$group = mysqli_real_escape_string($con, $group);
			$result = mysqli_query($con,"SELECT QID FROM $table WHERE DataKey='$key' AND DataGroup='$group'");
			$result = mysqli_fetch_assoc($result);
			$new = ($result["QID"]+0)+1;
			mysqli_query($con,"UPDATE $table SET QID='$new' WHERE DataKey='$key' AND DataGroup='$group'");
			return $new;
		}

		function AddToQueue($user, $key, $val, $group) {
			$con = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff','data');
			$table = mysqli_real_escape_string($con, $user) . "_data";
			$key = mysqli_real_escape_string($con, $key);
			$group = mysqli_real_escape_string($con, $group);
			$result = mysqli_query($con,"SELECT Queue FROM $table WHERE DataKey='$key' AND DataGroup='$group'");
			$result = mysqli_fetch_assoc($result);
			if (strval($result["Queue"]) == "") {
				$new = $val;
			} else {
				$new = strval($result["Queue"]) . "," . $val;
			}
			mysqli_query($con,"UPDATE $table SET Queue='$new' WHERE DataKey='$key' AND DataGroup='$group'");
		}

		function ClearQueue($user, $key, $group) {
			$con = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff','data');
			$table = mysqli_real_escape_string($con, $user) . "_data";
			$key = mysqli_real_escape_string($con, $key);
			$group = mysqli_real_escape_string($con, $group);
			mysqli_query($con,"UPDATE $table SET Queue='' WHERE DataKey='$key' AND DataGroup='$group'");
		}

		function QueueNext($user, $key, $group) {
			$con = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff','data');
			$table = mysqli_real_escape_string($con, $user) . "_data";
			$key = mysqli_real_escape_string($con, $key);
			$group = mysqli_real_escape_string($con, $group);
			$result = mysqli_query($con,"SELECT Queue FROM $table WHERE DataKey='$key'");
			$result = mysqli_fetch_assoc($result);
			//print($result['Queue']);
			$new = explode(",",$result["Queue"]);
			$new[0] = null;
			$new = implode(",",array_filter($new));
			//print($new);
			mysqli_query($con,"UPDATE $table SET Queue='$new' WHERE DataKey='$key' AND DataGroup='$group'");
		}

		function SetBusyTime($user, $key, $time, $group) {
			$con = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff','data');
			$table = mysqli_real_escape_string($con, $user) . "_data";
			$key = mysqli_real_escape_string($con, $key);
			$time = mysqli_real_escape_string($con, $time);
			$group = mysqli_real_escape_string($con, $group);
			$result = mysqli_query($con,"UPDATE $table SET BusyTime='$time' WHERE DataKey='$key' AND DataGroup='$group'");
			if ($result) {
				return true;
			} else {
				return false;
			}
		}
		
?>