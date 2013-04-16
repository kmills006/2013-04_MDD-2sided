<?
	$this->load->helper('objectToArray.php');
	$this->load->helper('isMulti.php');

	// converting results from query from StdObject to array
	$decks = objectToArray($decks);
?>

<div id="content">
		<div class="sizer">
			<article id="topDeck">
				<h1 class="username">kmills06</h1>
				<h1 class="votes">358</h1>
				<h1 class="deckname">A really long title</h1>
			</article>

			<section id="topTags">
				<h1>Top Tags</h1>
				<ul class="left">
			
				</ul>
				<ul class="right">
	
				</ul>
			</section>

			<section id="decks"> 
				<!-- looping through all the decks and presenting them in order of top rated -->
				<? foreach($decks as $deck){ ?>
					<article class="deck">
						<h1 class="username"><? echo anchor("user/getDecks/{$deck["user_id"]}", $deck['username'], 'title="View all of users decks"'); ?></h1>
						<h1 class="votes"><? echo $deck['rating'] ?></h1>
						<h1 class="deckname"><? echo $deck['title'] ?></h1>
					</article>
				<? } ?>
			</section> <!-- end of decks -->

		</div> <!-- end of sizer -->
	</div> <!-- end of content -->