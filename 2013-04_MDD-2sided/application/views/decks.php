<?
	$this->load->helper('isMulti.php');

	// echo "<pre>";
	// print_r($topTags);
	// echo "</pre>";

?>
	<div id="content">
		<div class="sizer">
			<section id="topDeck">
				<h1 class="votes"><? echo $decks[0]['rating'] ?></h1>
				<h1 class="deckname"><? echo anchor("cards/getCards/{$decks[0]["user_id"]}/{$decks[0]["deck_id"]}", $decks[0]['title'], 'title="View Deck"'); ?></h1>
			</section>
			<section id="topTags">
				<h1>Top Tags</h1>
				<ul>
					<? foreach($topTags as $topTag){ ?>
						<li>
							<h1><? echo anchor("tags/getDecks/{$topTag["tagName"]}", $topTag['tagName'], 'title="View tags"'); ?></h1>
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
				<?
					for ($i=1; $i < count($decks); $i++) { ?>
					<article class="deck">
						<h1 class="votes"><? echo $decks[$i]['rating'] ?></h1>
						<h1 class="deckname"><? echo anchor("cards/getCards/{$decks[$i]["user_id"]}/{$decks[$i]["deck_id"]}", $decks[$i]['title'], 'title="View Deck"'); ?></h1>
					</article>
				<? } ?>

			</section> <!-- end of decks -->

		</div> <!-- end of sizer -->
	</div> <!-- end of content -->

	<section id="pagination">
		<div class="sizer">
			<div class="pagg">
				<? echo $links; ?>
			</div>
		</div>
	</section>

	<!-- Jquery -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<? echo base_url(); ?>js/libs/jquery-1.9.1.min.js"><\/script>')</script>

	<!-- Scripts -->
	<script type="text/javascript" src="<? echo base_url(); ?>js/main.js"></script>
