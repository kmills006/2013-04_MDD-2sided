/*  
	2sided
	Authors: Kristy Miller and Kolby Sisk
*/

(function($){



	/*
	===============================================
	=========================== APPLICATION GLOBALS	
	*/
	
	var win = $(window),
		body = $(document.body),
		container = $('#container'),
		currentUser = {},
		tags = [],
		keepFocus = false;
	;	


	/*
	===============================================
	========================= APPLICATION FUNCTIONS	
	*/

	//Sets Top Deck
	if($('#topDeck').length){
		topUsername = $('.username a')[0].outerHTML;
		topRating = $('.votes')[1].innerHTML;
		topDeckname = $('.deckname a')[0].outerHTML;


		$('#topDeck .username').html(topUsername);
		$('#topDeck .votes').html(topRating);
		$('#topDeck .deckname').html(topDeckname);

		$('.deck').first().remove();
	}else{

	}

	//Edit Deck
	$('.deck .edit').on('click', function(e){
		var that = $(this);
		var dad = that.parent();
		var deckName = $(this).parent().find('.deckname').text();

		if(that.parent().attr('class') == 'deckEdit'){
			var newDeckName = dad.find('.deckname').val();
			var newPrivacy = dad.find('.privacyCheck').prop('checked');
			
			var deckID = that.attr("data-deckid");
			var privacy = 0;			
			
			if(newPrivacy){
				newPrivacy = dad.find('.privacy').text();
			}else{
				if(dad.find('.privacy').text() == "Public"){
					newPrivacy = "Private";
				}else{
					newPrivacy = "Public"
				}
			}
			
			if(newPrivacy == "Public"){
				privacy = 0;
			}else if(newPrivacy == "Private"){
				privacy = 1;
			}
			
			$.ajax({
				url: base + "index.php/user/editDeck",
				type: "post",
				data: {deckID: deckID,
					   newDeckName: newDeckName,
					   newPrivacy: privacy},
				success: function(response){
					console.log(response);	
					$.ajax({
						url: "",
						context: document.body,
						success: function(s,x){
					  		$(this).html(s);
					  	}
					});	
				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
					console.log(XMLHttpRequest);
					console.log(textStatus);
					console.log(errorThrown);
				}
			});
		
			that.html('Edit');
			dad.attr('class','deck');
			if(dad.find('.privacyCheck').prop('checked') == false){
				if(dad.find('.privacy').html() == 'Private'){
					dad.find('.privacy').html('Public')
				}else{
					dad.find('.privacy').html('Private')
				}
			}
			dad.find('.privacyCheck').remove();
			dad.find('.deckname').replaceWith('<h1 class="deckname">' + newDeckName + '</h1>');


		}else{
			that.html('Save');
			dad.attr('class','deckEdit');
			dad.find('.privacy').before('<input class="privacyCheck" type="checkbox" name="option1" value="Public" checked />');
			dad.find('.deckname').replaceWith('<input class="deckname" value="' + deckName + '" />');
			dad.find('input').focus();
		}
		return false;
	});

	var delTag = function(){
		$('.del').on('click', function(e){
			$(this).parent().remove()
		});
	};
	
	
	$('#tagInput').keypress(function(e){
		var that = $(this);
		var tg = $.trim(that.val());

		if(e.which == 13 && that.val().length<2){return false};
		   
		if(e.which == 13 && that.val().length>1){

			tags.push(tg);
			
			$('#tagArea').append('<h1>' + tg + '<span class="del"></span></h1>');
			that.val('');
			delTag();
			return false;
		}
	});
	
	//Create Deck
	$("#create-deck-btn").click(function(){
		if($('#deck-title').val().length > 2 && $('#tagArea').children().length > 1){
			var newDeckTitle = $("#deck-title").val();
			var privacy = $(".privacy:checked").val();
			
			$.ajax({
				url: base + "index.php/user/createDeck",
				type: "post",
				data: {dtitle: newDeckTitle,
					   tags: tags,
					   privacy: privacy},
				success: function(response){
					console.log(response);
					window.location.replace("../yourcards/getcards/" + response);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
						console.log(XMLHttpRequest);
						console.log(textStatus);
						console.log(errorThrown);
				}
			});
		}else{
			if($('#deck-title').val().length < 2){
				$('#deckForm .titleError').text('Must enter a title.');
			}else {
				$('#deckForm .titleError').text('');
			}

			if($('#tagArea').children().length < 2){
				$('#deckForm .error').text('Please add at least 2 tags.');
			}else{
				$('#deckForm .error').text('');
			}
		}
		return false;
	});
	
	

	//CARD PAGE FUNCTIONALITY//
	var shuffle = [];
	var shuffled = [];

	var initShuffle = function(){

		for (var i = 0; i < $('.aCard').length; i++) {
			shuffle.push(i);
		};
	};

	var initCards = function(ind){

		if($(".activeCardBack")[0]){
			$('.activeCardBack').rotate3Di('unflip', 180, {direction: 'clockwise', sideChange: flipBack});
		}else{
			var cards = $('.aCard');
			$('.activeCard').removeClass('activeCard');
			$('.aCard').addClass('hideCard');

			if(ind != 0)cards.eq(ind-1).addClass('leftCard').removeClass('hideCard rightCard activeCard');
			cards.eq(ind).addClass('activeCard').removeClass('hideCard rightCard leftCard');
			cards.eq(ind+1).addClass('rightCard').removeClass('hideCard leftCard activeCard');

			var top = $('.activeCard').index() + 1;
			var bot = $('.aCard').length;
			var per = top/bot * 100 + '%';

			$('#progNum').html(top + '/' + bot);

			$('#p').animate({
				width: per,
			}, 1000, function() {
				if(per == '100%'){
					$('#p').addClass('pFull');
				}else{
					$('.pFull').removeClass('pFull');
				}
			});
		};
	};

	//ON CLICK FUNCTIONS FOR CARD TOOLS
	$('#leftArrow').on('click', function(e){
		if($('.activeCard').index() != 0 && $('.cardedit')[0] == undefined)initCards($('.activeCard').index()-1);
	});
	$('#rightArrow').on('click', function(e){
		if($('.activeCard').index() != $('.aCard').length-1 && $('.cardedit')[0] == undefined)initCards($('.activeCard').index()+1);
	});
	$('#randomButton').on('click', function(e){
		if($('.cardedit')[0] == undefined){
			var ind = shuffle[Math.floor(Math.random()*shuffle.length)];
			shuffle.splice(shuffle.indexOf(ind),1);
			shuffled.push(ind);
			initCards(ind);

			if(shuffle.length == 0){
				$.each(shuffled, function(key, value) {
					shuffle.push(value);
					shuffled = [];
				});
			};
		};
	});

	//ON KEYDOWN FUNCTIONS FOR CARD TOOLS
	$(document).keydown(function(e){
	    if(e.keyCode == 32 && $('#question')[0] == undefined && $('#answer')[0] == undefined && $('#cards')[0] && $('.cardedit')[0] == undefined && $(document.activeElement).attr('id') != 'searchIni' && $(document.activeElement).attr('class') != 'res'){
	    	$('.activeCard').rotate3Di('flip', 180, {direction: 'clockwise', sideChange: flipCard});
			$('.activeCardBack').rotate3Di('unflip', 180, {direction: 'clockwise', sideChange: flipBack});
			return false;
	    }else if(e.keyCode == 37 && $('#question')[0] == undefined && $('#answer')[0] == undefined && $('#cards')[0] && $('.cardedit')[0] == undefined && $(document.activeElement).attr('id') != 'searchIni' && $(document.activeElement).attr('class') != 'res'){
			if($('.activeCard').index() != 0)initCards($('.activeCard').index()-1);
			return false;
	    }else if(e.which == 39 && $('#question')[0] == undefined && $('#answer')[0] == undefined && $('#cards')[0] && $('.cardedit')[0] == undefined && $(document.activeElement).attr('id') != 'searchIni' && $(document.activeElement).attr('class') != 'res'){
			if($('.activeCard').index() != $('.aCard').length-1)initCards($('.activeCard').index()+1);
			return false;
	    }else if(e.which == 40 && $('#question')[0] == undefined && $('#answer')[0] == undefined && $('#cards')[0] && $('.cardedit')[0] == undefined && $(document.activeElement).attr('id') != 'searchIni' && $(document.activeElement).attr('class') != 'res'){
	    	var ind = shuffle[Math.floor(Math.random()*shuffle.length)];
			shuffle.splice(shuffle.indexOf(ind),1);
			shuffled.push(ind);
			initCards(ind);
			if(shuffle.length == 0){
				$.each(shuffled, function(key, value) {
					shuffle.push(value);
					shuffled = [];
				});
			};
			return false;
	    };
	});
	//SCRIPTS FOR FLIPPING CARD//
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
    	$('.activeCardBack .question').replaceWith('<textarea id="answer" type="text" name="canswer" placeholder="Enter your answer here then press enter"></textarea>')
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
		if($('.cardedit')[0] == undefined){
			$('.activeCard').rotate3Di('flip', 180, {direction: 'clockwise', sideChange: flipCard});
			$('.activeCardBack').rotate3Di('unflip', 180, {direction: 'clockwise', sideChange: flipBack});
		};
	});


	//ADD NEW CARD SCRIPTS//
	var initAnswer = function(ques){

		$(document).keypress(function(e){
		    if(e.which == 13 && $('#answer')[0]){
  	  			var ans = $('#answer').val();
				$('.activeCardBack').rotate3Di('unflip', 180, {direction: 'clockwise', sideChange: flipBackQ});

				var deckID = window.location.pathname.split('/').pop();

				$.ajax({
					url: base + "index.php/yourcards/newcard",
					type: "post",
					dataType: "json",
					data: {deckID: deckID,
						   ques: ques,
						   ans: ans},
					success: function(response){
						$.ajax({
							url: "",
							context: document.body,
							success: function(s,x){
						  		$(this).html(s);
						  	}
						});	
					},
					error: function(why){
						$.ajax({
							url: "",
							context: document.body,
							success: function(s,x){
						  		$(this).html(s);
						  	}
						});	
					}
				});
				$(document).unbind('keydown');	
				$(document).unbind('keypress');		
		    };
		});
	};

	$('#addCard').on('click', function(e){
		if($('#firstCard')[0])$('#firstCard').remove();

		if($('#question')[0] == undefined  && $('#answer')[0] == undefined){
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
		  		};
			});
		};
	});
	
	//Delete Card
	$('#deleteButton').on('click', function(e){
		if($('#firstCard')[0] == undefined){
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
		if($('.aCard').length == 0){
			$('#cards ul').append('<li id="firstCard" class="aCard activeCard"><h1>Please add your first card!</h1></li>');
		}
	});	

	//EditCards//
	$('#editButton').on('click', function(e){
		var currentCardTitle = $('.activeCard').find('.question').text();
		
		//Edit Question
		$('.activeCard').find('.question').replaceWith('<input type="text" class="cardedit" value="' + currentCardTitle +'"/>')
		if($('.editHint').length == 0)$('.cardedit').after('<p class="editHint">Press Enter To Submit Changes.</p>');
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
		$('.activeCardBack').find('.question').replaceWith('<input type="text" class="cardedit" value="' + currentCardAnswer +'"/>')
		if($('.editHint').length == 0)$('.cardedit').after('<p class="editHint">Press Enter To Submit Changes.</p>');
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
			};
		});

	});
	

	//Search functionality
	var focusCounter = -1;
	var numberOfItems = 0;

	$('#searchResults').hide();

	$('nav input').keyup(function(e){
		numberOfItems = 0;
		$('#searchResults').show();
		var search = $(this).val();
		$.ajax({
			url: base + "index.php/browse/search",
			type: "post",
			data: {title: search},
			success: function(response){
				if(response == 'No Search Resultsnull'){
					$('#searchResults').html('');
					$('#searchResults').hide();
				}else{
					var r = JSON.parse(response);
					numberOfItems = r.length;
					if($('nav input').val().length == 0){
						$('#searchResults').html('');
						$('#searchResults').hide();
					}else{
						$('#searchResults').html('');
						for (var i = 0; i < 5; i++) {
							$('#searchResults').append('<li class="result"><a class="res" href="' + base + 'index.php/browse/getcards/' + r[i].deckID +'">' + r[i].deckTitle + '</a></li>');
						};	
					}
				}
			}
		});
	});


	$(document).keydown(function(e){
		if(numberOfItems >= 6)numberOfItems = 5;

		if(e.keyCode == 40){
			if(focusCounter != numberOfItems-1){

				focusCounter ++;

				$('.res')[focusCounter].focus();
				console.log(focusCounter);
		    	return false;
	    	}
	    	return false
		}

		if(e.keyCode == 38){
			if(focusCounter >= 0){
				focusCounter --;
				if(focusCounter == -1){
					$('#searchIni').focus();
				}else{
					$('.res')[focusCounter].focus()
				}
				console.log(focusCounter);
		    	return false;
	    	}
		}
	});
	

	$(document).on('click', function(e){
		if($(e.target).parent().attr('class') != 'result'){
			$('#searchResults').hide();
		}		
	});

	//Validation!!!!//
	var validatesYou = function(ini, regi){
		if(!regi.test(ini)){ 
			console.log('fix yo shit'); 
	    	return false;  
		}else{ 
			return true;
		} 
	};

	//LogIn 
	$('#loginForm').on('submit', function(e){
		var username = $('#loginForm input[name="username"]').val();
		var password = $('#loginForm input[name="password"]').val();

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
		var username = $('#registerForm input[name="username"]').val();
		var email = $('#registerForm input[name="r-email"]').val();
		var password = $('#registerForm input[name="password"]').val();
		var cpassword = $('#registerForm input[name="r-c-password"]').val();

		var userReg = /^[\w_.]{5,12}$/;
		var emailReg = /([A-z0-9]{1,})[@]([A-z0-9]{1,})[.]([A-z]{2,4}$)/; 
		var passReg = /^[a-z0-9_-]{5,18}$/;

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
	//Error messages for login and registration
	if(window.location.pathname == '/index.php/login/usererror'){
		$('.regError').text('Username or email already exists');
	}
	if(window.location.pathname == '/index.php/login/loginerror'){
		$('.error').text('Username or password was incorrect.');
	}

	//Delete yo decks
	$('.deckDelete').on('click', function(e){
		var deckID = $(this).parent().find('.edit').attr('data-deckid');

		$.ajax({
			url: "user/deleteDeck",
			type: "post",
			data: {deckID: deckID},
			success: function(response){
				console.log(response);	
				$.ajax({
					url: "",
					context: document.body,
					success: function(s,x){
				  		$(this).html(s);
				  	}
				});
			}
		});
	});

	//Voting page load
	if (window.location.pathname.toLowerCase().indexOf("browse/getcards") >= 0){
		var deckID = window.location.pathname.split('/')[4];
		var voted = false;

		$.ajax({
			url: base + "index.php/browse/getVote",
			type: "post",
			data: {deckID: deckID},
			success: function(response){
				var r = JSON.parse(response);
				var totalVotes = r[0]['totalVotes'];
				$('.totalVotes').html('A+ : ' + totalVotes);
			}
		});
		
		$.ajax({
			url: base + "index.php/browse/checkVote",
			type: "post",
			data: {deckID: deckID},
			success: function(response){
				console.log(response);
				var r = JSON.parse(response);
				var check = r[0]['checkVote'];
				console.log(check);

				if(response != 'No Search Resultsnull'){
					if(check == 1){
						voted = true;
						$('#aPlus').addClass('selectedGrade');
					}
					if(check == 0){
						voted = true;
						$('#aMinus').addClass('selectedGrade');
					}
				}else{
				}
			}
		});
	};

	//Voting
	$('#voting div').on('click', function(e){
		if($(this).attr('class') != "selectedGrade"){
			$('.selectedGrade').removeClass('selectedGrade');
			$(this).addClass('selectedGrade');

			if($(e.target).text() == 'A+'){
				var vote = true;
			}else if($(e.target).text() == 'A-'){
				var vote = false;
			}
			
			var deckID = window.location.pathname.split('/')[4];


			$.ajax({
				url: base + "../index.php/browse/sendvote",
				type: "post",
				data: {
					deckID: deckID,
					vote: vote
				},
				success: function(response){
					var tv = $('.totalVotes').text().replace(/\D/g, '');
					var totalVotes = parseInt(tv);
				
					if(vote){
						 totalVotes += 1;
						$('.totalVotes').text('A+ : ' + totalVotes);
					}else if(!vote){
						totalVotes -= 1;
						$('.totalVotes').text('A+ : ' + totalVotes);
					}
					if(response == '/login/')window.location.replace("../../login/");
				}
			});
			return false;
		};
	});
	//Getting Tags
	if($('#topDeck').length){
		console.log('fwe');
		$('.browse').addClass('active');
		$.ajax({
			url: base + "index.php/browse/getTags",
			type: "post",
			data: {},
			success: function(response){
				var r = JSON.parse(response);
				
				$('.left').html('');
				$('.right').html('');

				for (var i = 0; i < 6; i++) {
					$('.left').append('<li><h1>'+ r[i].tagName +'</h1><p>X '+ r[i].count +'</p></li>');
				};
				for (var i = 6; i < 12; i++) {
					$('.right').append('<li><h1>'+ r[i].tagName +'</h1><p>X '+ r[i].count +'</p></li>');
				};
			}
		});
	}

	//Getting Votes for userdecks
	if($('#createDeckButton').length){
		$.each($('.edit'), function(key, value) {
			$.ajax({
				url: base + "index.php/user/getVote",
				type: "post",
				data: {deckID : $(value).attr('data-deckid')},
				success: function(response){
					var r = JSON.parse(response);
					var v = r[0]['r'];

					$(value).parent().find('.votes').html(v);				
				}
			});
		});
	};

	if($('#addCard').length){
		$('.yourdecks').addClass('active');
		var deckID = window.location.pathname.split('/')[4];

		$.ajax({
			url: base + "index.php/user/getVote",
			type: "post",
			data: {deckID : deckID},
			success: function(response){
				var r = JSON.parse(response);
				//console.log(r);
				$('.totalVotes').html('A+ : ' + r[0]['r']);
			}
		});
	};

	if($('.aCard').length){

		var deckID = window.location.pathname.split('/')[4];

		$.ajax({
			url: base + "index.php/browse/getDeckTags",
			type: "post",
			data: {deckID: deckID},
			success: function(response){
				var r = JSON.parse(response);
				$('.yourTags').html('');
				for (var i = 0; i < r.length; i++) {
					if($('#voting').length){
						$('.yourTags').append('<li><h1 data-tagid="'+r[i]['tag_id']+'">' + r[i]['tagName'] + '</h1></li>');
					}else{
						$('.yourTags').append('<li><h1 data-tagid="'+r[i]['tag_id']+'">' + r[i]['tagName'] + '<span class="del"></span></h1></li>');
					}
				};

				$('.del').on('click', function(e){
					var tagID = $(this).parent().attr('data-tagid')
					$.ajax({
						url: base + "index.php/browse/deleteTag",
						type: "post",
						data: {tagID: tagID},
						success: function(response){
							console.log(response);
							$.ajax({
								url: "",
								context: document.body,
								success: function(s,x){
							  		$(this).html(s);
							  	}
							});
						}
					});
				});
			}
		});
	};
	if($('#addFriendButton').length){
		$('.browse').addClass('active');
		var userID = window.location.pathname.split('/')[4];

		$.each($('.deck'), function(key, value) {
			$.ajax({
				url: base + "index.php/user/getVote",
				type: "post",
				data: {deckID : $(value).attr('data-deckid')},
				success: function(response){
					var r = JSON.parse(response);
					var v = r[0]['r'];

					$(value).find('.votes').html(v);				
				}
			});
		});
		$.ajax({
			url: base + "index.php/user/getUserName",
			type: "post",
			data: {userID : userID},
			success: function(response){
				var r = JSON.parse(response);
				var un = r[0]['username'];

				$('.welcomeUser').text(un + "'s Decks");

			}
		});
	};

	if($('#voting').length){
		$('.yourdecks').removeClass('active');
		$('.browse').addClass('active');
	}


	$('.filebutton').change(function(e){
		$('.filebutton').eq(0).css('display', 'none');
		$('.filebutton').eq(1).css('display', 'block');
	});


	if($('#btf').length == 0){
		$('footer').css('margin-top','100px');
	}


	//Navigation Functionality//
	var initNav = function(){
		var pathname = window.location.pathname;
		//console.log(pathname);

		if(pathname == '/index.php/user'){
			$('.yourdecks').addClass('active');
		}else if(pathname == '/index.php/browse'){
			$('.browse').addClass('active');
		}else if(pathname == '/index.php/browse/about'){
			$('.about').addClass('active');
		}else if(pathname == '/'){
			$('.browse').addClass('active');
		}else if(pathname == '/index.php/yourcards'){
			$('.yourdecks').addClass('active');
		}

		if(pathname == '/'){
			window.location.replace("/index.php");
		}
	};

	/*
	===============================================
	=============================== Inits Functions
	*/

	// Finds current page and changes nav to active
	initNav();
	initShuffle();
	initCards(0);



	
	
	
	
})(jQuery); // end private scope




