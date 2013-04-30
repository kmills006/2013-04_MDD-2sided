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
	var focusCounter   =  -1,
		numberOfItems  =  0,
		userSearch     =  $('#user-search')
	;

	userSearch.keyup(function(e){
		numberOfItems = 0;

		var search    =  $(this).val(),
			userArea  =  $('#users ul'),
			newUsers  =  ''
		;

		$.ajax({
			url: base + 'index.php/user/userSearch',
			type: 'post',
			data: { user: search },
			success: function(response){
				var r = $.parseJSON(response);
				$.each(r, function(key, value){
					if(!value["profile_img"]) value["profile_img"] = 'profile-img_placeholder.png';

					newUsers += '<li class="userList" data-userid="'+value["user_id"]+'">' +
								'<img src="'+base+'/imgs/profile_imgs/'+value["profile_img"]+'" width="70" height="70" alt=""/>' +
								'<h1>'+value["username"]+'</h1>' +
								'<h3>'+value["ratingCount"]+'</h3>' +
								'<div class="button"><a href="http://localhost:9999/mdd/2sided/2013-04_MDD-2sided/index.php/user/profilePage/'+value["user_id"]+'" title="View all of users decks">Visit Profile</a></div>' +
								'</li>';
				});
				userArea.html(newUsers);
			},
			error: function(response){
				console.log(response.responseText);
			}
		});
	});
}; // End of initUserSearch

//Search functionality
var initSearch = function(){
	var focusCounter = -1,
		numberOfItems = 0,
		searchResults = $('#searchResults'),
		search = $('nav #search'),
		doc = $(document)
	;

	searchResults.hide();

	search.keyup(function(e){
		numberOfItems = 0;
		searchResults.show();
		var search = $(this).val();
		$.ajax({
			url: base + "index.php/decks/search",
			type: "post",
			data: {title: search},
			success: function(response){
				console.log(response);
				if(response == 'No Search Resultsnull'){
					searchResults.html('');
					searchResults.hide();
				}else{
					var r = JSON.parse(response);
					numberOfItems = r.length;
					if($('nav input').val().length === 0){
						searchResults.html('');
						searchResults.hide();
					}else{
						searchResults.html('');
						for (var i = 0; i < 5; i++) {
							searchResults.append('<li class="result"><a class="res" href="' + base + 'index.php/cards/getCards/' + r[i].userID + "/" +r[i].deckID+'">' + r[i].deckTitle + '</a></li>');
						}
					}
				}
			}
		});
	});

	doc.keydown(function(e){
		if(numberOfItems >= 6)numberOfItems = 5;

		if(e.keyCode == 40){
			if(focusCounter != numberOfItems-1){

				focusCounter ++;

				$('.res')[focusCounter].focus();
				console.log(focusCounter);
				return false;
			}
			return false;
		}

		if(e.keyCode == 38){
			if(focusCounter >= 0){
				focusCounter --;
				if(focusCounter == -1){
					$('#searchIni').focus();
				}else{
					$('.res')[focusCounter].focus();
				}
				console.log(focusCounter);
				return false;
			}
		}
	}).on('click', function(e){
		if($(e.target).parent().attr('class') != 'result') $('#searchResults').hide();
	});
};//End search

// Adding and deleting tags to a deck when adding a deck
var initTags = function(){

	var tags        =  [],
		tagInput    =  $('#tagInput'),
		createDeck  =  $('#create-deck-btn'),
		form        =  $('#deckForm')
	;

	tagInput.keypress(function(e){
		var that  =  $(this),
			tg    =  $.trim(that.val())
		;

		if(e.which == 13 && that.val().length<2) return false;

		if(e.which == 13 && that.val().length>1){
			tags.push(tg);
			$('#tagArea').append('<h1>' + tg + '<span class="del"></span></h1>');
			that.val('');
			delTag();
			return false;
		}
	});

	$('form').on('sumbit', function(e){
		return false;
	});

	createDeck.click(function(e){
		var title    =  $("#deckTitle").val(),
			privacy  =  $(".privacy:checked").val()
		;

		$.ajax({
			url: base + 'index.php/decks/confirmAddNewDeck',
			type: 'post',
			dataType: "json",
			data: {
				title: title,
				privacy: privacy,
				tags: tags
			},
			success: function(response){
				window.location.replace("../cards/getCards/" +response.userID + "/" + response.deckID);
			},
			error: function(response){
				console.log(response.responseText);
			}
		});
		return false;
	});

	var delTag = function(){
		var del = $('.del');
		del.on('click', function(e){
			$(this).parent().remove();
		});
	};
};

//Voting 
var initVoting = function(){
	var deckID = window.location.pathname.split('/')[8];
	var voteButton = $('#vote');

	$.ajax({
		url: base + "index.php/cards/checkVote",
		type: "post",
		dataType: "json",
		data: {deckID: deckID},
		success: function(response){
			response !== false ? voteButton.find('a').addClass('voted').html('unlike deck') : console.log("no vote");
		}
	});

	//Voting
	voteButton.on('click', function(e){

		var that = $(this);
		var rating = parseInt($('.rating').html(), 10);

		if(that.find('a').attr('class') != "voted"){

			$.ajax({
				url: base + "index.php/cards/sendVote",
				type: "post",
				dataType: "json",
				data: {
					deckID: deckID
				},
				success: function(response){
					if(response){
						voteButton.find('a').addClass('voted').html('unlike deck');
						$('.rating').html( rating + 1);
					}
				}
			});

		}else{
			$.ajax({
				url: base + "index.php/cards/cancelVote",
				type: "post",
				data: {
					deckID: deckID
				},
				success: function(response){
					if(response){
						voteButton.find('a').removeClass('voted').html('like deck');
						$('.rating').html( rating - 1);
					}
				}
			});
		}
		return false;
	});
};