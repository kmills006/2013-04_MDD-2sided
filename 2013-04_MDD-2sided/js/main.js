//Changes the active class on the nav depending on what page you're on.
var initNav = function(){
	var pathname = window.location.pathname;
	if(pathname.indexOf('decks') > -1){
		$('.decks').addClass('active');
	}else if(pathname.indexOf('cards') > -1){
		$('.decks').addClass('active');
	}else if(pathname.indexOf('user') > -1){
		$('.users').addClass('active');
	}else{
		$('.decks').addClass('active');
	}
}; //End initNav



//Validation for the login and registration.
var initValidation = function(){

	var validatesYou = function(ini, regi){
		if(!regi.test(ini)){
			return false;
		}else{
			return true;
		}
	};
	//LogIn
	$('#loginForm').on('submit', function(e){
		var username  =  $('#loginForm input[name="username"]').val(),
			password  =  $('#loginForm input[name="password"]').val()
		;
		if(username.length < 5){
			$('#loginForm .error').text('Please enter your username.');
			return false;
		}
		if(password.length < 5){
			$('#loginForm .error').text('Please enter your password.');
			return false;
		}
	});
	//Registration
	$('#registerForm').on('submit', function(e){
		var username  =  $('#registerForm input[name="username"]').val(),
			email     =  $('#registerForm input[name="r-email"]').val(),
			password  =  $('#registerForm input[name="password"]').val(),
			userReg   =  /^[\w_.]{5,12}$/,
			emailReg  =  /([A-z0-9]{1,})[@]([A-z0-9]{1,})[.]([A-z]{2,4}$)/,
			passReg   =  /^[a-z0-9_-]{5,18}$/
		;
		if(!validatesYou(password, passReg)){
			$('#registerForm .regError').text('Password must contain between 5 and 18 letters or numbers.');
			return false;
		}
		if(!validatesYou(username, userReg)){
			$('#registerForm .regError').text('Username must contain at between 5 and 12 letters or numbers.');
			return false;
		}
		if(!validatesYou(email, emailReg)){
			$('#registerForm .regError').text('Email must be a valid email address.');
			return false;
		}
	});
}; //End initValidation 




// User search functionality
var initUserSearch = function(){
	var focusCounter = -1;
	var numberOfItems = 0;

	$('#searchResults').hide();

	$('#user-search').keyup(function(e){
		numberOfItems = 0;

		$('#searchResults').show();

		var search = $(this).val();

		$.ajax({
			url: base + 'index.php/user/userSearch',
			type: 'post',
			data: { user: search },
			success: function(response){
				if(response == 'false'){
					$('#searchResults').replaceWith('<li class="result">No User Found</li>');
				}else{
					var results = JSON.parse(response);

					numberOfItems = results.length;

					if($('#user-search').val.length === 0){

						$('#searchResults').html('');
						$('#searchResults').hide();

					}else{

						$('#searchResults').html('');

						for(var i = 0; i < results.length; i++){
							$('#searchResults').append('<li class="result">' + results[i].username + '</li>');
						}
					}
				}
			},
			error: function(response){
				console.log(XMLHttpRequest);
				console.log(textStatus);
				console.log(errorThrown);
			}
		});
	});
}; // End of initUserSearch


var initTags = function(){

	$('#tagInput').keypress(function(e){
		var that = $(this);
		var tg = $.trim(that.val());
		var tags = [];

		if(e.which == 32 && that.val().length<2){return false;}

		if(e.which == 32 && that.val().length>1){

			tags.push(tg);

			$('#tagArea').append('<h1>' + tg + '<span class="del"></span></h1>');
			that.val('');
			delTag();
			return false;
		}
	});

	var delTag = function(){
		$('.del').on('click', function(e){
			$(this).parent().remove();
		});
	};
};