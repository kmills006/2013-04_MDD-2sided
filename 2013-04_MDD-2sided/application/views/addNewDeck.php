	<div id="content">
		<div class="sizer">

			<h1 class="tit">Create New Deck</h1>

			<div id="newDeck">

				<!-- <form id="deckForm"> -->
				<?php echo form_open("decks/confirmAddNewDeck"); ?>
					<p>Deck Title</p>
					<h2 class="titleError"></h2>
					<?php echo form_input('dtitle'); ?>
					<p>Deck Privacy</p>
					<input type="radio" name="privacy" value="Public" id="public" class="privacy" checked /> <label for="public">Public</label><br />
					<input type="radio" name="privacy" value="Private" id="private" class="privacy"/> <label for="private">Private</label>
					
					<h2 class="error"></h2>
					<p>Tags</p>
					<div id="tagArea"></div>
					<input id="tagInput" type="text" name="tags" placeholder="Add a tag and press enter">

					<button type="submit" id="create-deck-btn">Create Deck</button>
					<p class="cancel"><? echo anchor("user", "Cancel", "Cancel making a new deck"); ?></p>
				<?php echo form_close(); ?>

				<section>
					<article>
						<h1>What title should you use?</h1>
						<p>You can title your deck what ever you like! We suggest you use a title that describes the subjects your deck will cover.</p>
					</article>
					<article>
						<h1>Why would you change privacy?</h1>
						<p>The privacy of your deck will effect if other people can see it or not. If your deck is public it will show up for people browsing, and can be voted on.</p>
					</article>
					<article>
						<h1>What Are Tags?</h1>
						<p>Tags are the categories that your deck of flashcards will cover. 
							For example, if your deck will cover spelling and vocabulary then two tags you could include would be spelling and vocabulary.</p>
					</article>	
				</section>

			</div> <!-- end of newDeck -->
		</div> <!-- end of sizer -->