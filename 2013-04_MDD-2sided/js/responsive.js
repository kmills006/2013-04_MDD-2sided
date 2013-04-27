(function($) {

	var win      =  $(window),
		sizer    =  $('.sizer'),
		header   =  $('header'),
		newHtml  =  ''
	;
	//Changes the active class on the nav depending on what page you're on.
	var initNav = function(){
		var pathname = window.location.pathname;
		if(pathname.indexOf('decks') > -1){
			$('.decks').addClass('active');
		}else if(pathname.indexOf('cards') > -1){
			$('.decks').addClass('active');
		}else if(pathname.indexOf('user') > -1){
			$('.users').addClass('active');
		}else if(pathname.indexOf('about') > -1){
			$('.about').addClass('active');
		}else{
			$('.decks').addClass('active');
		}
	};

	var initNavResponse = function(){
		if(win.innerWidth() <= 605){
			header.load(base + 'index.php/mobile/loadHeader .sizer', function() {
				initNav();
			});
		}else if(win.innerWidth() <= 768){
			header.load(base + 'index.php/tablet/loadHeader .sizer', function() {
				initNav();
			});
		}else{
			header.load(base + 'index.php/pc/loadHeader .sizer', function() {
				initNav();
			});
		}
	};

	win.on('resize', function(e){
		initNavResponse();
	});

	initNavResponse();

}(jQuery));
