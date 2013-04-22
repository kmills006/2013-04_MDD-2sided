var initValidation = function(){

	//Validation//
	var validatesYou = function(ini, regi){
		if(!regi.test(ini)){
	    	return false;
	    }else{
			return true;
		} 
	};

	//LogIn// 
	$('#loginForm').on('submit', function(e){
		var username = $('#loginForm input[name="username"]').val(),
			password = $('#loginForm input[name="password"]').val()
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

	//Registration//
	$('#registerForm').on('submit', function(e){
		var username = $('#registerForm input[name="username"]').val(),
			email = $('#registerForm input[name="r-email"]').val(),
			password = $('#registerForm input[name="password"]').val(),
			cpassword = $('#registerForm input[name="r-c-password"]').val(),
			userReg = /^[\w_.]{5,12}$/,
			emailReg = /([A-z0-9]{1,})[@]([A-z0-9]{1,})[.]([A-z]{2,4}$)/,
			passReg = /^[a-z0-9_-]{5,18}$/
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
		if(cpassword != password){
			$('#registerForm .regError').text('Your passwords must match.');
			return false;
		}
	});
};


