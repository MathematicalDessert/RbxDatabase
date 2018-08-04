$(document).ready(function() {
	setTimeout(function() {
		$("#landing-login").transit({opacity: "1", left: "50%"}, 700, "snap");
	}, 400);

	function initRequest() {
		try {
			return new XMLHttpRequest();
		}
		catch (e) {
			try {
					return new ActiveXObject("Msxml2.XMLHTTP");
				}
			catch (e) {
				try {
					return new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e) {
					// Something went wrong
					alert("Your browser does not support XMLHTTP requests.\nPlease upgrade to a modern browser.");
					return false;
				}
			}
		}
	}

	function doLogin() {
		
	}
});