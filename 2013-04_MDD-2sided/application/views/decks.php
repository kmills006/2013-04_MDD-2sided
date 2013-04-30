<?
	$this->load->helper('isMulti.php');

	// var_dump($decks);
?>

	<div id="content">
		<div class="sizer">
			<section id="topDeck">
				<h1 class="username">kmills06</h1>
				<h1 class="votes">358</h1>
				<h1 class="deckname">A really long title</h1>
			</section>
			<section id="topTags">
				<h1>Top Tags</h1>
				<ul>
					<? foreach($topTags as $topTag){ ?>
						<li>
							<h1><? echo $topTag['tagName']; ?></h1>
							<h2>X <? echo $topTag['tagCount']; ?></h2>
						</li>
					<? } ?>
				</ul>
			</section>
			<section id="topUsers">
				<h1>Top Users</h1>
				<ul>
					<? foreach($topUsers as $topUser){ ?>
						<li>
							<div class="badge"></div>
							<h2><? echo anchor("user/profilePage/{$topUser["user_id"]}", $topUser['username'], 'title="View profile"'); ?></h2>
						</li>

					<? } ?>
				</ul>
			</section>
			<section id="decks"> 
				<!-- looping through all the decks and presenting them in order of top rated -->
				<? foreach($decks as $deck){ ?>
					<article class="deck">
						<h1 class="username"><? echo anchor("user/profilePage/{$deck["user_id"]}", $deck['username'], 'title="View profile"'); ?></h1>
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
