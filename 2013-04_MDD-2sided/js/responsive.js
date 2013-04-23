(function($) {

	var win = $(window);

	var initNavResponse = function(){
		if(win.innerWidth() <= 480){
			$('header').load(base + 'index.php/mobile/loadHeader');
		}else if(win.innerWidth() <= 768){
			$('header').load(base + 'index.php/tablet/loadHeader');
		}else{
			$('header').load(base + 'index.php/pc/loadHeader');
			sizer.width(960);
		}
	};

	win.on('resize', function(e){
		initNavResponse();
	});

	initNavResponse();

}(jQuery));