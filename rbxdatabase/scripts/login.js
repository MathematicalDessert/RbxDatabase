function getParam(name) {
	name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

$(document).ready(function() {
	var msg = getParam("msg");

	if (msg != "") {
		$("#login-status").css("opacity", "1").text(getParam("msg"));
		$("#landing-login").css({opacity: "1", left: "50%"});
		if (getParam("err") == 1) {
			$("#login-status").css("color", "red");
		}
	}

	if (msg == "") { 
		setTimeout(function() {
			$("#landing-login").transit({opacity: "1", left: "50%"}, 700, "snap");
		}, 400);
	}

	function doLogin() {
		$("#login-status").css("color", "#454545").text("Logging in...");
		$(".windows8, #login-status").transit({opacity: "1"}, 500, "ease");
		$("#landing-login").submit();
	}

	$("#submit-login").click(function(ev) {
		doLogin();
	});

	$("#submit-register").click(function(ev) {
		$("#login-status").css("color", "#454545").text("Registering your account...");
		$(".windows8, #login-status").transit({opacity: "1"}, 500, "ease");
	});


	$(".login-box").bind("keypress", function(e) {
		var key = e.keyCode || e.which;
		if (key == 13) {
			doLogin();
		}
	});
});