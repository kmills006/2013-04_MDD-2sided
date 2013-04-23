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
				<ul>
					<li>
						<h1>English</h1>
						<h2>X 299</h2>
					</li>
					<li>
						<h1>Math</h1>
						<h2>X 123</h2>
					</li>
					<li>
						<h1>Science</h1>
						<h2>X 80</h2>
					</li>
					<li>
						<h1>Compuer Stuff</h1>
						<h2>X 77</h2>
					</li>
					<li>
						<h1>Spelling Bee</h1>
						<h2>X 60</h2>
					</li>
					<li>
						<h1>Something</h1>
						<h2>X 50</h2>
					</li>
				</ul>
			</section>
			<section id="topUsers">
				<h1>Top Users</h1>
				<ul>
					<li>
						<div class="badge"></div>
						<h2>Kolby99</h2>
					</li>
					<li>
						<div class="badge"></div>
						<h2>Kristy123</h2>
					</li>
					<li>
						<div class="badge"></div>
						<h2>Batman</h2>
					</li>
					<li>
						<div class="badge"></div>
						<h2>Superman</h2>
					</li>
					<li>
						<div class="badge"></div>
						<h2>Ironman</h2>
					</li>
					<li>
						<div class="badge"></div>
						<h2>The Hulk</h2>
					</li>
				</ul>
			</section>


			<section id="decks"> 
				<!-- looping through all the decks and presenting them in order of top rated -->
				<? foreach($decks as $deck){ ?>
					<article class="deck">
						<h1 class="username"><? echo anchor("user/profilePage/{$deck["user_id"]}", $deck['username'], 'title="View all of users decks"'); ?></h1>
						<h1 class="votes"><? echo $deck['rating'] ?></h1>
						<h1 class="deckname"><? echo anchor("cards/getCards/{$deck["user_id"]}/{$deck["deck_id"]}", $deck['title'], 'title="View Deck"'); ?></h1>
					</article>
				<? } ?>
			</section> <!-- end of decks -->

		</div> <!-- end of sizer -->
	</div> <!-- end of content -->

	<!-- Jquery -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<? echo base_url(); ?>js/libs/jquery-1.9.1.min.js"><\/script>')</script>

	<!-- Scripts -->
	<script type="text/javascript" src="<? echo base_url(); ?>js/main.js"></script>

	<!-- Inits -->
	<script type="text/javascript">initNav();</script>