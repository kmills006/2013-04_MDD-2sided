(function($) {

	var win = $(window),
		nav = $('nav'),
		navigation = $('#navigation'),
		signup = $('.signup, .user'),
		tools = $('#tools'),
		login = $('#tools .login'),
		header = $('header'),
		sizer = $('.sizer'),
		logo = $('#logo')
	;

	var initNavResponse = function(){
		var search = $('#search'),
			research = $('.research')
		;

		if(win.innerWidth() <= 480){
			sizer.width(480);
			navigation.append(signup);
			header.append(navigation);
			search.remove();
			if($('.research').length < 1)login.before('<li class="research"><p>Search</p></li>');
			$('.login').remove();
			if($('div.login').length < 1)logo.before('<div class="login"><a href="'+base+'/index.php/authentication" title="User Login">Log In</a></div>');
			nav.contents().unwrap()
		}else if(win.innerWidth() <= 768){
			sizer.width(768);
			navigation.append(signup);
			search.remove();
			if($('.research').length < 1)login.before('<li class="research"><p>Search</p></li>');
		}else{
			sizer.width(960);
			if($('#search').length < 1) navigation.after('<input type="text" id="search"/>');
			tools.prepend(signup);
			research.remove();
		}
	};

	win.on('resize', function(e){
		initNavResponse();
	});

	initNavResponse();

}(jQuery));