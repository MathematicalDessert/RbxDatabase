$(document).ready(function() {
	$(".panel-compat").click(function() {
		if (!$(this).hasClass("nav-current")) {
			var phref = $(this).data("panelhref");
			$(".nav-current").removeClass("nav-current").addClass("nav-new");
			$(this).removeClass("nav-new").addClass("nav-current");
			$("#control-view").transit({opacity: "0"}, 400, "snap");
			setTimeout(function() {
				$("#control-view").attr("src", "manage/" + phref);
			}, 400);
		}
	});

	document.getElementById("control-view").onload = function() {
		$("#control-view").transit({opacity: "1"}, 400, "snap");
	}
});