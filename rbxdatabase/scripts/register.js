function getParam(name) {
	name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

$(document).ready(function() {
	var msg = getParam("msg");

	if (msg != "") {
		$("#register-status").css("opacity", "1").text(getParam("msg"));
		$("#register-wrap").css({opacity: "1", left: "50%"});
		if (getParam("err") == 1) {
			$("#register-status").css("color", "red");
		}
	}

	if (msg == "") { 
		setTimeout(function() {
			$("#register-wrap").transit({opacity: "1", left: "50%"}, 700, "snap");
		}, 400);
	}

	function doRegister() {
		var user = $("#user").val();
		var pw1 = $("#pass").val();
		var pw2 = $("#confirmpass").val();

		if (user == null || user == "") {
			$("#register-status").css({"color": "red", opacity: "1"}).text("Your username cannot be empty.");
		}
		else if (pw1 != pw2 || pw1 == null || pw1 == "" || pw2 == null || pw2 == "") {
			$("#register-status").css({"color": "red", opacity: "1"}).text("Your passwords do not match or are empty.");
		}
		else if (pw1 == pw2 && user != null && user != "") {
			$("#register-status").css("color", "#454545").text("Hold on while we set up your account...");
			$(".windows8, #register-status").transit({opacity: "1"}, 500, "ease");
			$("#register-wrap").submit();
		}
	}

	$("#submit-register").click(function(ev) {
		doRegister();
	});
});