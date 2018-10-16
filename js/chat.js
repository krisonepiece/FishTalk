$(".messages").animate({ scrollTop: $(document).height() }, "fast");

$("#profile-img").click(function() {
	$("#status-options").toggleClass("active");
});

$(".expand-button").click(function() {
  $("#profile").toggleClass("expanded");
	$("#contacts").toggleClass("expanded");
});

$("#status-options ul li").click(function() {
	$("#profile-img").removeClass();
	$("#status-online").removeClass("active");
	$("#status-away").removeClass("active");
	$("#status-busy").removeClass("active");
	$("#status-offline").removeClass("active");
	$(this).addClass("active");
	
	if($("#status-online").hasClass("active")) {
		$("#profile-img").addClass("online");
	} else if ($("#status-away").hasClass("active")) {
		$("#profile-img").addClass("away");
	} else if ($("#status-busy").hasClass("active")) {
		$("#profile-img").addClass("busy");
	} else if ($("#status-offline").hasClass("active")) {
		$("#profile-img").addClass("offline");
	} else {
		$("#profile-img").removeClass();
	};
	
	$("#status-options").removeClass("active");
});

function newMessage(name) {
	message = $(".message-input input").val();
	if($.trim(message) == '') {
		return false;
	}
	$('<li class="sent"><img src="http://140.117.169.140/FishTalk/images/' + name + '.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
	$('.message-input input').val(null);
	$(".messages").animate({ scrollTop: $(document).height() }, "fast");
};

//# sourceURL=pen.js