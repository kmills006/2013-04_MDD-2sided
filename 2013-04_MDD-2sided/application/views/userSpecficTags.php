<?
	
	$this->load->helper('isMulti.php');

	/* $this->load->helper('objectToArray.php');
	
	$decks = objectToArray($decks);
	
	if(!isMulti($profileInfo)){
		// No
	}else{
		$userInfo = $profileInfo[0];
	}

	$profileImg = null;


	if(isset($decks['username'])){
		$username = $decks['username'];
		$userID = $decks['user_id'];
		$profileImg = $decks['profile_img'];
	}else{
		$username = $decks[0]['username'];
		$userID = $decks[0]['user_id'];
		$profileImg = $decks[0]['profile_img'];
	} */

	/* echo '<pre>';
	print_r($tags);
	echo '</pre>'; */

	$profileInfo = $profileInfo[0];
?>

	<div id="info" class="decksPage">
		<div class="sizer">
			<section id="picture">

				<? if($profileInfo['profile_img'] == null){
					echo img('imgs/profile_imgs/profile-img_placeholder.png');
				}else{
					echo img('imgs/profile_imgs/'.$profileInfo['profile_img']); 
				} ?>

			</section>
			
			<section id="profileInfo">
				<h1><? echo $profileInfo['username'] ?></h1>
				
				<h2>Joined <? echo $profileInfo['date_of_reg']; ?></h2>

				<? if($profileInfo['profileCount'] == 0){
					// Noone has viewed this profile yet, do not include profile count
				}else{ ?>
					<h2><? echo $profileInfo['profileCount']; ?> Profile Views</h2>
				<? } ?>

				<h3 class="rating"><? echo $profileInfo['ratingsCount'] ?></h3>
			</section>

		</div> <!-- end of sizer -->
	</div> <!-- end of info -->

	

	<? if(!isMulti($tags)){ ?>
	
	<? }else{ ?>

		<section id="decks" class="userDecksPage"> 
			<div class="sizer">
				<h1><? echo $tags[0]['tagName']; ?></h1>
				<!-- looping through all the decks and presenting them /Should be in order of date created/ -->
				<? foreach($tags as $tag){ ?>
					<article class="deck" data-deckid="<? echo $tag['deck_id'] ?>" >
						<h1 class="deckname"><? echo anchor("cards/getCards/{$userID}/{$tag['deck_id']}", $tag['title']); ?></h1>
						<? if($this->session->userdata('userID') == $userID) echo '<div class="options"><ul><li class="editTitle">Edit Title</li><li class="changePrivacy">Change privacy</li><li class="deleteDeck">Delete Deck</li></ul></div>' ?>
					</article>
				<? } ?>
			</div> <!-- end of sizer -->
		</section> <!-- end of decks -->	

	<? } ?>
			
	

	<section id="editModal">
		<div style="position:relative;">
			<button>X</button>
			<h1>Edit Title</h1>
			<input type="text" />
			<button>Edit Title</button>
		</div>
	</section>

	<section id="privacyModal">
		<div style="position:relative;">
			<button>X</button>
			<h1>Make deck private?</h1>
			<button>Change</button>
		</div>
	</section>

	<section id="deleteModal">
		<div style="position:relative;">
			<button>X</button>
			<h1>Delete this deck?</h1>
			<button>Delete</button>
		</div>
	</section>

	<!-- Jquery -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<? echo base_url(); ?>js/libs/jquery-1.9.1.min.js"><\/script>')</script>

	<!-- Scripts -->
	<script type="text/javascript" src="<? echo base_url(); ?>js/main.js"></script>
	<script type="text/javascript" src="<? echo base_url(); ?>js/deck.js"></script>

	<!-- Inits -->
	<script type="text/javascript">initDeck();</script>

