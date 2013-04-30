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
	var initUserButtons = function(){
		var userButton = $('.userList');

		userButton.off('click').on('click', function(){
			var that = $(this);
			var userid = that.attr('data-userid');

			window.location.href = base + "index.php/user/profilePage/" + userid;
		});

	};
	var initNavResponse = function(){
		if(win.innerWidth() <= 605){
			header.load(base + 'index.php/mobile/loadHeader .sizer', function() {
				initNav();
				initUserButtons();
				initSearch();
			});
		}else if(win.innerWidth() <= 768){
			header.load(base + 'index.php/tablet/loadHeader .sizer', function() {
				initNav();
				initSearch();
			});
		}else{
			header.load(base + 'index.php/pc/loadHeader .sizer', function() {
				initNav();
				initSearch();
			});
		}
	};

	win.on('resize', function(e){
		initNavResponse();
	});

	initNavResponse();

}(jQuery));
