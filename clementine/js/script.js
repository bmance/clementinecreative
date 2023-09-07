// DECLARED VARIABLES

var winWidth = $(window).width();  // WINDOW WIDTH
var winHeight = $(window).height(); // WINDOW HEIGHT
var scroll = $(window).scrollTop();
var winScroll = $(window).scrollTop();
var menu = 0;

$(document).ready(function() { // will be executed immediately
	winWidth = $(window).width();
	winHeight = $(window).height();
	$('#menuTxt').text('Menu');
	//alert('true');
	//$('#mobileMenu').slideDown();
});

$(window).on('load', function(){
	winWidth = $(window).width();
	winHeight = $(window).height();
});

$(window).resize(function(){
	winWidth = $(window).width();
	winHeight = $(window).height();
	if(winWidth >= 768){
	}
});

$(window).scroll(function() {
	scroll = $(window).scrollTop();
	var mainCnt = $('#clemmyWrapper').offset();
	if(scroll >= mainCnt.top){
		$('.scrollBck').fadeIn();
	}else{
		$('.scrollBck').fadeOut();
	}
});


$(window).scroll(function() {
	var winScroll = $(window).scrollTop();
});

function scrollBack(){
	$("html, body").animate({ scrollTop: 0 }, "slow");
}

function mobileMenu(){
	if(menu == 0){

		$('#menuContainer').slideDown('slow');

		if(winWidth >= 768){
			$('#menuContainer').animate({left: '0px'});
		}else{
			$('#menuContainer').animate({left: '0px'});
		}
		$('#menuButton').addClass('open');
		$('#menuTxt').text('Close');
		menu = 1;

	}else{

		if(winWidth >= 768){
			$('#menuContainer').animate({left: '-600px'});
		}else{
			//$('#menuContainer').slideUp('slow');
			//$('#menuButton').removeClass('open');
			//$('#menuTxt').text('Menu');
		}
		$('#menuContainer').slideUp('slow');
		$('#menuButton').removeClass('open');
		$('#menuTxt').text('Menu');
		menu = 0;
	}
}