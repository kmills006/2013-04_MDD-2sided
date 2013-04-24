//Opens and closes deck's settings - edit deck title - change deck privacy - delete deck 
var initDeck = function(){
	var options        =  $('.options'),
		editTitle      =  $('.editTitle'),
		changePrivacy  =  $('.changePrivacy'),
		deleteDeck     =  $('.deleteDeck')
	;

	options.on('click', function(e){
		if(!$(e.target).is("li")){
			var that = $(this),
				opened = that.hasClass('open')
			;
			options.removeClass('open');
			opened ? that.removeClass('open') : that.addClass('open');
		}
	});

	//Moves the modal up and down and turns on bg
	var modalize = function(modalid){
		var modal  =  $('#' + modalid),
			close  =  modal.find('button:first-child'),
			shade  =  $('.shade')
		;

		shade.css('display', 'block');
		modal.css('top', '50%');
		close.on('click', function(e){ modal.css('top', '0%'); shade.css('display', 'none'); });
	};

	//Edit Deck Title
	editTitle.on('click', function(e){
		modalize('editModal');

		var that        =  $(this),
			parent      =  that.parent().parent().parent(),
			title       =  parent.find('.deckname a'),
			modal       =  $('#editModal'),
			titleInput  =  modal.find('input'),
			deckid      =  parent.attr('data-deckid'),
			button      =  $('#editModal button:last-child'),
			shade       =  $('.shade'),
			options     =  $('.options')
		;

		titleInput.val(title.html());

		button.on('click', function(e){
			$.ajax({
				url: base + "index.php/decks/editDeckTitle",
				type: "post",
				dataType: "json",
				data: {
					deckID: deckid,
					newDeckName: titleInput.val()
				},
				success: function(response){
					console.log('fwef');
				},
				error: function(response){
					console.log(response);
				}
			});

			modal.css('top', '0%');
			shade.css('display', 'none');
			options.removeClass('open');
			title.html(titleInput.val());
		});
	});

	changePrivacy.on('click', function(e){
		modalize('privacyModal');

		var that        =  $(this),
			parent      =  that.parent().parent().parent(),
			deckid      =  parent.attr('data-deckid'),
			button      =  $('#privacyModal button:last-child'),
			privacy     =  parent.find('.votes'),
			modal       =  $('#editModal'),
			shade       =  $('.shade'),
			options     =  $('.options'),
			newPrivacy
		;

		privacy.length === 0 ? newPrivacy = 0 : newPrivacy = 1;

		button.on('click', function(e){
			$.ajax({
				url: base + "index.php/decks/editDeckPrivacy",
				type: "post",
				dataType: "json",
				data: {
					deckID: deckid,
					newPrivacy: newPrivacy
				},
				success: function(response){
					$.ajax({
						url: "",
						context: document.body,
						success: function(s,x){
							$(this).html(s);
						}
					});
				},
				error: function(response){
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
	});

	deleteDeck.on('click', function(e){
		modalize('deleteModal');

		var that     =  $(this),
			parent   =  that.parent().parent().parent(),
			deckid   =  parent.attr('data-deckid'),
			button   =  $('#deleteModal button:last-child'),
			modal    =  $('#editModal'),
			shade    =  $('.shade'),
			options  =  $('.options')
		;

		button.on('click', function(e){
			$.ajax({
				url: base + "index.php/decks/deleteDeck",
				type: "post",
				dataType: "json",
				data: {
					deckID: deckid
				},
				success: function(response){
					$.ajax({
						url: "",
						context: document.body,
						success: function(s,x){
							$(this).html(s);
						}
					});
				},
				error: function(response){
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
	});
}; //End initDeck


