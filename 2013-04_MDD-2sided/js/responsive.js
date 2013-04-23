(function($) {

	var win = $(window),
		navigation = $('#navigation'),
		signup = $('.signup, .user'),
		tools = $('#tools'),
		login = $('#tools .login'),
		header = $('header'),
		sizer = $('.sizer')
	;

	var initNavResponse = function(){
		var search = $('#search'),
			research = $('.research')
		;

		if(win.innerWidth() <= 768){
			navigation.append(signup);
			search.remove();
			if($('.research').length < 1)login.before('<li class="research"><p>Search</p></li>');
			sizer.width(768);
		}else{
			if($('#search').length < 1) navigation.after('<input type="text" id="search"/>');
			tools.prepend(signup);
			research.remove();
			sizer.width(960);
		}
	};

	win.on('resize', function(e){
		initNavResponse();
	});

	initNavResponse();

}(jQuery));