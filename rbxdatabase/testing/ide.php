<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="styles/ide.css">
		<script type="text/javascript" src="scripts/jquery-2.0.3.min.js"></script>
		<script type="text/javascript" src="scripts/jquery.transit.min.js"></script>
		<script type="text/javascript" src="scripts/ribbon.js"></script>
		<title>LuaStudio IDE</title>
	</head>
	<body>
		<div id="ide-shroud" class="hidden"></div>
		<div id="login-title" class="hidden">Log In</div>
		<a id="cancel-login-button" class="hidden"><img src="images/ide/back.png"></img></a>
		<form id="ide-login" class="hidden">
			<div id="login-contents">
				<span><span class="login-instruction">Profile Name</span><br><input class="login-box" id="user" type="text" name="usern"></span><br><br>
				<span><span class="login-instruction">Password</span><br><input class="login-box" id="pass" type="password" name="passw"></span><br>
				<a style="position: absolute;bottom: 7px;right: 0px;font-size: 13px;" class="mega-button" id="submit-login" onclick="document.getElementById('ide-login').submit()">Submit</a>
			</div>
		</form>
		<div id="ide-main">
			<div id="ide-ribbon">
				<div id="ribbon-tabs">
					<div class="tab-spacing"></div>
					<div data-panel="home" class="ribbon-tab current-tab">Home</div>
					<div data-panel="edit" class="ribbon-tab new-tab">Edit</div>
					<div data-panel="view" class="ribbon-tab new-tab">View</div>
					<div data-panel="tools" class="ribbon-tab new-tab">Tools</div>
					<div data-panel="help" class="ribbon-tab new-tab">Help</div>
				</div>
				<div id="ribbon-panels">
					<div id="home-panel" class="ribbon-panel shown">
						<div class="sub-panel">
							<div data-tooltip="Creates a new file without saving the current one" class="panel-item" id="">
								<img class="panel-item-image" src="images/ide/filenew.png"></img>
								<div class="panel-item-name">New</div>
							</div>
							<div data-tooltip="Opens an existing file from your account" class="panel-item" id="">
								<img class="panel-item-image" src="images/ide/fileopen.png"></img>
								<div class="panel-item-name">Open</div>
							</div>
							<div data-tooltip="Saves the current file to your account" class="panel-item" id="">
								<img class="panel-item-image" src="images/ide/filesave.png"></img>
								<div class="panel-item-name">Save</div>
							</div>
							<div data-tooltip="Saves the current file as a new file to your account" class="panel-item" id="">
								<img class="panel-item-image" src="images/ide/filesaveas.png"></img>
								<div class="panel-item-name">Save As</div>
							</div>
							<div data-tooltip="Exports the current file to a downloadable Lua file" class="panel-item" id="">
								<img class="panel-item-image" src="images/ide/export.png"></img>
								<div class="panel-item-name">Export</div>
							</div>
							<div class="sub-panel-title">File</div>
						</div>
						
						<div class="separator"></div>
						<div class="sub-panel">
							<div data-tooltip="Edit your LuaStudio preferences" class="panel-item" id="">
								<img class="panel-item-image" src="images/ide/settings.png"></img>
								<div class="panel-item-name">Settings</div>
							</div>
							<div data-tooltip="Customize your LuaStudio IDE" class="panel-item" id="">
								<img class="panel-item-image" src="images/ide/customize.png"></img>
								<div class="panel-item-name">Customize</div>
							</div>
							<div class="sub-panel-title">Editor</div>
						</div>
						<div class="separator"></div>
						<div class="sub-panel">
							<div data-tooltip="Collaborate with other developers" class="panel-item" id="">
								<img class="panel-item-image" src="images/ide/sharing.png"></img>
								<div class="panel-item-name">Share Link</div>
							</div>
							<div class="sub-panel-title">Sharing</div>
						</div>
						<div class="separator"></div>
						<div class="sub-panel">
							<div data-tooltip="Log in to your account to manage your files" class="panel-item" id="login-button">
								<img class="panel-item-image" src="images/ide/login.png"></img>
								<div class="panel-item-name">Log In</div>
							</div>
							<div data-tooltip="Make a new account" class="panel-item" id="register-button">
								<img class="panel-item-image" src="images/ide/register.png"></img>
								<div class="panel-item-name">Register</div>
							</div>
							<div class="sub-panel-title">Account</div>
						</div>
					</div>
					<div id="edit-panel" class="ribbon-panel hidden">
						<div class="sub-panel">
							<div data-tooltip="Undo your last edit" class="panel-item" id="">
								<img class="panel-item-image" src="images/ide/undo.png"></img>
								<div class="panel-item-name">Undo</div>
							</div>
							<div data-tooltip="Redo your last undo" class="panel-item" id="">
								<img class="panel-item-image" src="images/ide/redo.png"></img>
								<div class="panel-item-name">Redo</div>
							</div>
							<div data-tooltip="Copy the selected text (requires clipboard permissions)" class="panel-item" id="">
								<img class="panel-item-image" src="images/ide/copy.png"></img>
								<div class="panel-item-name">Copy</div>
							</div>
							<div data-tooltip="Cut the selected text (requires clipboard permissions)" class="panel-item" id="">
								<img class="panel-item-image" src="images/ide/cut.png"></img>
								<div class="panel-item-name">Cut</div>
							</div>
							<div data-tooltip="Paste text from your clipboard (requires clipboard permissions)" class="panel-item" id="">
								<img class="panel-item-image" src="images/ide/paste.png"></img>
								<div class="panel-item-name">Paste</div>
							</div>
							<div class="sub-panel-title">Editing</div>
						</div>
					</div>
					<div id="view-panel" class="ribbon-panel hidden">
					</div>
					<div id="tools-panel" class="ribbon-panel hidden">
					</div>
					<div id="help-panel" class="ribbon-panel hidden">
					</div>
				</div>
			</div>
			<div id="ide-editor"></div>
			<div id="ide-explorer">
				<span id="explorer-title">Explorer</span>
				<div id="explorer-contents">
					<!-- Placeholder -->
				</div>
			</div>
			<div id="ide-status">
				<span id="status-tooltip"></span>
				<div id="status-right">
					<span id="status-filename">empty file.lua</span>
				</div>
			</div>
		</div>
	</body>
</html>