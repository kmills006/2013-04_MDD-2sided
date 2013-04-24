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
	//Registration
	$('#registerForm').on('submit', function(e){
		var username = $('#registerForm input[name="username"]').val(),
			email = $('#registerForm input[name="r-email"]').val(),
			password = $('#registerForm input[name="password"]').val(),
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
	});
}; //End initValidation 

//Opens and closes deck's settings.
var initDeck = function(){
	var options = $('.options');

	options.on('click', function(e){
		if(!$(e.target).is("li")){
			var that = $(this),
				opened = that.hasClass('open')
			;
			options.removeClass('open');
			opened ? that.removeClass('open') : that.addClass('open');
		}
	});
}; //End initDeck

//Functionality for cards page including cycling through cards and adding new cards.
var initCard = function(){
	var shuffle = [];
	var shuffled = [];

	var initShuffle = function(){
		for (var i = 0; i < $('.aCard').length; i++) {
			shuffle.push(i);
		}
	};

	var initCards = function(ind){

		if($(".activeCardBack")[0]){
			$('.activeCardBack').rotate3Di('unflip', 180, {direction: 'clockwise', sideChange: flipBack});
		}else{
			var cards = $('.aCard');
			$('.activeCard').removeClass('activeCard');
			$('.aCard').addClass('hideCard');

			if(ind !== 0)cards.eq(ind-1).addClass('leftCard').removeClass('hideCard rightCard activeCard');
			cards.eq(ind).addClass('activeCard').removeClass('hideCard rightCard leftCard');
			cards.eq(ind+1).addClass('rightCard').removeClass('hideCard leftCard activeCard');

			var top = $('.activeCard').index() + 1;
			var bot = $('.aCard').length;
			var per = top/bot * 100 + '%';

			$('#progNum').html(top + '/' + bot);

			$('#p').animate({
				width: per
			}, 1000, function() {
				if(per == '100%'){
					$('#p').addClass('pFull');
				}else{
					$('.pFull').removeClass('pFull');
				}
			});
		}
	};

	//ON CLICK FUNCTIONS FOR CARD TOOLS
	$('#leftArrow').on('click', function(e){
		if($('.activeCard').index() !== 0 && $('.cardedit')[0] === undefined)initCards($('.activeCard').index()-1);
	});
	$('#rightArrow').on('click', function(e){
		if($('.activeCard').index() != $('.aCard').length-1 && $('.cardedit')[0] === undefined)initCards($('.activeCard').index()+1);
	});
	$('#randomButton').on('click', function(e){
		if($('.cardedit')[0] === undefined){
			var ind = shuffle[Math.floor(Math.random()*shuffle.length)];
			shuffle.splice(shuffle.indexOf(ind),1);
			shuffled.push(ind);
			initCards(ind);

			if(shuffle.length === 0){
				$.each(shuffled, function(key, value) {
					shuffle.push(value);
					shuffled = [];
				});
			}
		}
	});

	//ON KEYDOWN FUNCTIONS FOR CARD TOOLS
	$(document).keydown(function(e){
		if(e.keyCode == 32 && $('#question')[0] === undefined && $('#answer')[0] === undefined && $('#cards')[0] && $('.cardedit')[0] === undefined && $(document.activeElement).attr('id') != 'searchIni' && $(document.activeElement).attr('class') != 'res'){
			$('.activeCard').rotate3Di('flip', 180, {direction: 'clockwise', sideChange: flipCard});
			$('.activeCardBack').rotate3Di('unflip', 180, {direction: 'clockwise', sideChange: flipBack});
			return false;
		}else if(e.keyCode == 37 && $('#question')[0] === undefined && $('#answer')[0] === undefined && $('#cards')[0] && $('.cardedit')[0] === undefined && $(document.activeElement).attr('id') != 'searchIni' && $(document.activeElement).attr('class') != 'res'){
			if($('.activeCard').index() !== 0)initCards($('.activeCard').index()-1);
			return false;
		}else if(e.which == 39 && $('#question')[0] === undefined && $('#answer')[0] === undefined && $('#cards')[0] && $('.cardedit')[0] === undefined && $(document.activeElement).attr('id') != 'searchIni' && $(document.activeElement).attr('class') != 'res'){
			if($('.activeCard').index() != $('.aCard').length-1)initCards($('.activeCard').index()+1);
			return false;
		}else if(e.which == 40 && $('#question')[0] === undefined && $('#answer')[0] === undefined && $('#cards')[0] && $('.cardedit')[0] === undefined && $(document.activeElement).attr('id') != 'searchIni' && $(document.activeElement).attr('class') != 'res'){
			var ind = shuffle[Math.floor(Math.random()*shuffle.length)];
			shuffle.splice(shuffle.indexOf(ind),1);
			shuffled.push(ind);
			initCards(ind);
			if(shuffle.length === 0){
				$.each(shuffled, function(key, value) {
					shuffle.push(value);
					shuffled = [];
				});
			}
			return false;
		}
	});

	//FUNCTIONS FOR FLIPPING CARD
	var currentCardTitle;
	var currentCardAnswer;

	var flipCard = function() {
		var that = $(this);
		currentCardTitle = that.find('.question').text();
        currentCardAnswer = that.find('.answer').text();
		that.removeClass('activeCard');
        that.addClass('activeCardBack');
        that.find('.question').html(currentCardAnswer);
    };
    var flipCardQ = function(){
		var that = $(this);
		currentCardTitle = that.find('.question').text();
        currentCardAnswer = that.find('.answer').text();
		that.removeClass('activeCard');
        that.addClass('activeCardBack');
		$('.activeCardBack .question').replaceWith('<textarea id="answer" type="text" name="canswer" placeholder="Enter your answer here then press enter"></textarea>');
		$('#answer').focus();
    };
    var flipBackQ = function(){
		var that = $(this);
		ans = that.find('#answer').val();
		that.find('#answer').parent().replaceWith('<li class="aCard activeCard"><h1 class="question">' + currentCardTitle + '</h1><h1 class="answer">'+ ans +'</h1></li>');
    };
    var flipBack = function() {
		var that = $(this);
        that.removeClass('activeCardBack');
        that.addClass('activeCard');
        that.find('.question').html(currentCardTitle);
    };
	$('#lilFLip').on('click', function(e){
		if($('.cardedit')[0] === undefined){
			$('.activeCard').rotate3Di('flip', 180, {direction: 'clockwise', sideChange: flipCard});
			$('.activeCardBack').rotate3Di('unflip', 180, {direction: 'clockwise', sideChange: flipBack});
		}
	});

	//FUNCTIONS FOR ADDING A CARD
	var initAnswer = function(ques){

		$(document).keypress(function(e){
			if(e.which == 13 && $('#answer')[0]){
				var ans = $('#answer').val();
				$('.activeCardBack').rotate3Di('unflip', 180, {direction: 'clockwise', sideChange: flipBackQ});

				var deckID = window.location.pathname.split('/').pop();

				$.ajax({
					url: base + "index.php/cards/addNewCard",
					type: "post",
					dataType: "json",
					data: {
						deckID: deckID,
						question: ques,
						answer: ans
					},
					success: function(response){
						console.log(response);
					},
					error: function(response){
						console.log(response);
					}
				});
			}
		});
	};

	$('#addCard').on('click', function(e){
		if($('#firstCard')[0])$('#firstCard').remove();

		if($('#question')[0] === undefined  && $('#answer')[0] === undefined){
			initCards($('.aCard').length);
			$('#cards ul').append('<li class="aCard activeCard"><textarea id="question" type="text" name="ctitle" placeholder="Enter your question here then press enter"></textarea></li>');

			$('#question').focus();
			$('#question').keypress(function(e){
				if(e.which == 13){
					var ques = $('#question').val();
					$('.activeCard').replaceWith('<li class="aCard activeCard"><h1 class="question">' + ques + '</h1></li>');
					$('.activeCard').rotate3Di('flip', 180, {direction: 'clockwise', sideChange: flipCardQ});

					initAnswer(ques);
					return false;
				}
			});
		}
	});

	//Delete Card
	$('#deleteButton').on('click', function(e){
		if($('#firstCard')[0] === undefined){
			var cardID = $('.activeCard').attr("data-cardid");
			$.ajax({
				url: "../../yourcards/deletecard",
				type: "post",
				dataType: "json",
				data: {cardID: cardID},
				success: function(response){
					console.log(response);
				},
				error: function(why){
					console.log(why.status);
					console.log("error function");
				}
			});

			$('.activeCard').remove();
			initCards($('.activeCard').index()+1);
		}
		if($('.aCard').length === 0){
			$('#cards ul').append('<li id="firstCard" class="aCard activeCard"><h1>Please add your first card!</h1></li>');
		}
	});

	//EditCard
	$('#editButton').on('click', function(e){
		var currentCardTitle = $('.activeCard').find('.question').text();

		//Edit Question
		$('.activeCard').find('.question').replaceWith('<input type="text" class="cardedit" value="' + currentCardTitle +'"/>');
		if($('.editHint').length === 0)$('.cardedit').after('<p class="editHint">Press Enter To Submit Changes.</p>');
		$('.cardedit').keypress(function(e){
			if(e.which == 13){

				var newQuestion = $(this).val();
				$('.cardedit').replaceWith('<h1 class="question">' + newQuestion + '</h1>');
				$('.editHint').remove();

				var cardID = $(".activeCard").attr("data-cardid");

				$.ajax({
					url: base + "index.php/yourcards/editquestion",
					type: "post",
					data: {cardID: cardID,
						question: newQuestion},
					success: function(response){
						console.log(response);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
						console.log(XMLHttpRequest);
						console.log(textStatus);
						console.log(errorThrown);
					}
				});
			}
		});

		//Edit Answer
		var currentCardAnswer = $('.activeCardBack').find('.answer').text();
		$('.activeCardBack').find('.question').replaceWith('<input type="text" class="cardedit" value="' + currentCardAnswer +'"/>');
		if($('.editHint').length === 0)$('.cardedit').after('<p class="editHint">Press Enter To Submit Changes.</p>');
		$('.cardedit').keypress(function(e){
			if(e.which == 13){

				var newAnswer = $(this).val();
				$('.cardedit').replaceWith('<h1 class="question">' + newAnswer + '</h1>');
				$('.activeCardBack').find('.answer').html(newAnswer);
				$('.editHint').remove();

				var cardID = $(".activeCardBack").attr("data-cardid");

				$.ajax({
					url: "../../yourcards/editanswer",
					type: "post",
					data: {cardID: cardID,
						answer: newAnswer},
					success: function(response){
						console.log(response);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
						console.log(XMLHttpRequest);
						console.log(textStatus);
						console.log(errorThrown);
					}
				});
			}
		});
	});

	initShuffle();
	initCards(0);
};

