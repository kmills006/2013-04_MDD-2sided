<?php
	$username = $this->session->userdata("username");

	function objectToArray($a){
		if(is_object($a)){
			$a = get_object_vars($a);
			return $a;
		}if(is_array($a)){
			return array_map(__FUNCTION__, $a);
		}else{
			return $a;
		}
	}

	$d = objectToArray($decks);

?>
	<div id="content">
		<section id="topWelcome">
			<div class="sizer">
				<h1 class="welcomeUser"> Welcome, MOFO </h1>
				<h3 id="addFriendButton"><?php echo anchor("user/createdecks", "Add Friend", "Create New Deck"); ?></h3>
			</div>
		</section>

		<section id="yourdecks">
			<div class="sizer">

				<?php foreach($d as $v){ ?>
					<article class="deck" data-deckid="<? echo $v["deck_id"] ?>">
						<h1 class="votes">143</h1>
						<h1 class="deckname"><?php echo anchor("browse/getcards/{$v["deck_id"]}", $v["title"] , "View cards for this deck"); ?></h1>
					</article>
				<?php } ?>

			</div>
		</section>
