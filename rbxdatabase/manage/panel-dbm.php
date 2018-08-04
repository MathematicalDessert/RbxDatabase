<?
	session_start();
	if ($_SESSION['loggedin'] != "1") { ?>
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="UTF-8">
				<link rel="stylesheet" type="text/css" href="../styles/panel-api.css">
				<script type="text/javascript" src="../scripts/jquery-2.0.3.min.js"></script>
				<script type="text/javascript" src="../scripts/jquery.transit.min.js"></script>
			</head>
			<body>
				<div id="main-wrap">
					You need to be logged in to see this page.
				</div>
			</body>
		</html>	<?} else {
?>
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="UTF-8">
			<link rel="stylesheet" type="text/css" href="../styles/panel-db.css">
			<script type="text/javascript" src="../scripts/jquery-2.0.3.min.js"></script>
			<script type="text/javascript" src="../scripts/jquery.transit.min.js"></script>
			<script type="text/javascript">
				function UpdatePage() {
					var Select = document.getElementById("SelectGroup");
					var Value = Select.options[Select.selectedIndex].value;
					document.location = "?Group=" + Value;
				}
			</script>
		</head>
		<body>
			<? // Just a simple data "viewer" for now.
				$Con = mysqli_connect('storage.tn-studio.com', 'rbxdatabase', 'ys5f4uifkr5rlpwgacxy5sbnjzhykzym2r1uzj06r0mwptt4r7c3b5zfmo5d3sff','data');
				$Results = mysqli_query($Con, "SELECT DataGroup FROM " . $_SESSION['username'] ."_data") or die(mysqli_error($Con));
				$Group = mysqli_real_escape_string($Con,$_GET["Group"]);
				print("<select id='SelectGroup' onchange='javascript:UpdatePage()'>");
				print("<option value=''>None</option>");
				$Num = 0;
				$Num2 = 0;
				while($Row = mysqli_fetch_assoc($Results)) {
					$g = $Row["DataGroup"];
					if ($g != "") {
						print("<option value='$g'>$g</option>");
						$Num = $Num+1;
						if ($g == $Group) {
							$Num2 = $Num;
						}
					}
				}
				print("</select>");
				?>
					<script type="text/javascript">document.getElementById("SelectGroup").selectedIndex=<?print($Num2);?></script>
				<?
				$Results = mysqli_query($Con, "SELECT * FROM " . $_SESSION['username'] ."_data WHERE DataGroup='$Group'") or die(mysqli_error($Con));
				print("<table border=1 style='width:500px'><tr><td>Key</td><td>Value</td><td>Type</td><td>Data Group</td></tr>");
				while($Row = mysqli_fetch_assoc($Results)) {
					print("<tr><td>" . stripslashes($Row["DataKey"]) . "</td><td>" . stripslashes($Row["DataValue"]) . "</td><td>" . $Row["DataType"] . "</td><td>" . $Row["DataGroup"] . "</td></tr>");
				}
				print("</table>");
			?>
			<div id="panel-tools">
			</div>
			<div id="panel-base">
			</div>
		</body>
	</html>
<? } ?>