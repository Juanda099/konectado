// JavaScript Document
	
	$(document).ready(function(){
	var i = 0;
		$(document).scroll(function(e){

			e.preventDefault();
			if ($(this).scrollTop()>20 ){
				if(i == 0){
				// animate fixed div to small size:
				$('#navbarcont').stop().animate({height: 50, top:0},400,'easeOutQuint');
				$('#logo').stop().animate({width: 200, top:0},400,'easeOutQuint');
				$('#logo img').stop().animate({maxHeight: 40},400,'easeOutQuint');
				i = 1;
				}

			} else {
				if(i == 1){
				//  animate fixed div to original size
				$('#navbarcont').stop().animate({ top: 40, height: 120},400,'easeOutQuint');
				$('#logo').stop().animate({width: 200, top: 0},400,'easeOutQuint');
				$('#logo img').stop().animate({maxHeight: 80},400,'easeOutQuint');
				i=0
				}
			}


		});
	});
	