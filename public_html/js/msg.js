// JavaScript Document
	var url      = window.location.href;
	if (url.indexOf('?') == -1) {
	   
	}
	else {
		$(".divmsgcont").css("display", "block");
	}
	
	$('#ok').click(function(e) { 
		$(".divmsgcont").css("display", "none");
	});
