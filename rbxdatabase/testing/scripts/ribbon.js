$(document).ready(function() {
	// animation
	/*function animateBlur(targ, init, dest) {
		$({rad: init}).animate({rad: dest}, {
			duration: 2000,
			step: function() {
				$(targ).css({
					"filter": "blur(" + this.rad + "px)",
					"-webkit-filter": "blur(" + this.rad + "px)",
					"-moz-filter": "blur(" + this.rad + "px)",
					"-o-filter": "blur(" + this.rad + "px)",
					"-ms-filter": "blur(" + this.rad + "px)",
				});
			}
		});
	}*/

	// button events
	$("#login-button").click(function() {
		$("#cancel-login-button").removeClass("hidden").addClass("shown").transit({opacity: "0.4"}, 600, "snap");
		$("#ide-shroud").removeClass("hidden").addClass("shown").transit({opacity: "1"}, 600, "snap");
		$("#login-title").removeClass("hidden").addClass("shown").transit({opacity: "1", left: "60px"}, 500, "snap");
		$("#ide-login").removeClass("hidden").addClass("shown").transit({opacity: "1", scale: "1, 1"}, 600, "snap");
	});

	$("#cancel-login-button").click(function() {
		$("#login-title").transit({opacity: "0"}, 600, "snap");
		$("#ide-shroud").transit({opacity: "0"}, 600, "snap");
		$("#cancel-login-button").transit({opacity: "0"}, 600, "snap");
		$("#ide-login").transit({opacity: "0"}, 600, "snap", function() {
			$("#ide-shroud").removeClass("shown").addClass("hidden");
			$("#ide-login").removeClass("shown").addClass("hidden").css({opacity: "0", scale: "0.9, 0.9"});
			$("#login-title").removeClass("shown").addClass("hidden").css({opacity: "0", left: "120px"});
			$("#cancel-login-button").removeClass("shown").addClass("hidden").css({opacity: "0"});
		});
	});

	$("#cancel-login-button").mouseenter(function() { $("#cancel-login-button").transit({opacity: "1"}, 300, "snap"); });
	$("#cancel-login-button").mouseleave(function() { $("#cancel-login-button").transit({opacity: "0.4"}, 300, "snap"); });

	// internal ribbon code
	$(".ribbon-tab").click(function() {
		var self = $(this);
		if (self.hasClass("new-tab")) {
			$(".current-tab").addClass("new-tab");
			$(".current-tab").removeClass("current-tab");
			self.removeClass("new-tab");
			self.addClass("current-tab");
			if (self.data("panel") == "home") {
				$(".shown").transit({opacity: "0", left: "+50px"}, 150, "snap", function() {
					$(".shown").removeClass("shown").addClass("hidden");
					$("#home-panel").removeClass("hidden").addClass("shown").css("left", "-50px").transit({opacity: "1", left: "0px"}, 150, "snap");
				});
			}
			else if (self.data("panel") == "edit") {
				$(".shown").transit({opacity: "0", left: "+50px"}, 150, "snap", function() {
					$(".shown").removeClass("shown").addClass("hidden");
					$("#edit-panel").removeClass("hidden").addClass("shown").css("left", "-50px").transit({opacity: "1", left: "0px"}, 150, "snap");
				});
			}
			else if (self.data("panel") == "view") {
				$(".shown").transit({opacity: "0", left: "+50px"}, 150, "snap", function() {
					$(".shown").removeClass("shown").addClass("hidden");
					$("#view-panel").removeClass("hidden").addClass("shown").css("left", "-50px").transit({opacity: "1", left: "0px"}, 150, "snap");
				});
			}
			else if (self.data("panel") == "tools") {
				$(".shown").transit({opacity: "0", left: "+50px"}, 150, "snap", function() {
					$(".shown").removeClass("shown").addClass("hidden");
					$("#tools-panel").removeClass("hidden").addClass("shown").css("left", "-50px").transit({opacity: "1", left: "0px"}, 150, "snap");
				});
			}
			else if (self.data("panel") == "help") {
				$(".shown").transit({opacity: "0", left: "+50px"}, 150, "snap", function() {
					$(".shown").removeClass("shown").addClass("hidden");
					$("#help-panel").removeClass("hidden").addClass("shown").css("left", "-50px").transit({opacity: "1", left: "0px"}, 150, "snap");
				});
			}
		}
	});
	$(".panel-item").mouseenter(function() {
		$("#status-tooltip").text($(this).data("tooltip"));
	});
	$(".panel-item").mouseleave(function() {
		$("#status-tooltip").text("");
	});
});