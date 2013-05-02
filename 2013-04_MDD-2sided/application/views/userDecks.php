<?
	$this->load->helper('objectToArray.php');
	$this->load->helper('isMulti.php');
	
	$decks = objectToArray($decks);
	
	if(!isMulti($profileInfo)){
		// No
	}else{
		$userInfo = $profileInfo['userInfo'];
	}


	// echo "<pre>";
	// print_r($userInfo);
	// echo "</pre>";

	$profileImg = null;


	if(isset($decks['username'])){
		$username = $decks['username'];
		$userID = $decks['user_id'];
		$profileImg = $decks['profile_img'];
	}else{

		$username = $decks[0]['username'];
		$userID = $decks[0]['user_id'];
		$profileImg = $decks[0]['profile_img'];
	}

	$addDeckButton = array('class' => 'addDeckButton');
?>

	<div id="info" class="decksPage">
		<div class="sizer">
			<section id="picture">

				<? if($profileImg == null){
					echo img('imgs/profile_imgs/profile-img_placeholder.png');
				}else{
					echo img('imgs/profile_imgs/'.$profileImg); 
				} ?>

				<?  if(!$isLoggedIn){
					// No user is logged in
				}else{

					// Checking if user is viewing their own deck
					if($this->session->userdata('userID') == $userID){ ?>
						<div class="button"><? echo anchor("decks/addNewDeck", 'Add Deck', 'Add New Deck');?></div>
					<? }else{
						// Viewing another users decks, you can not add new deck
					}
				} ?>
			</section>
			
			<section id="profileInfo">
				<h1><? echo $userInfo['username'] ?></h1>
				
				<h2>Joined: <? echo $userInfo['date_of_reg']; ?></h2>

				<? if($profileInfo['profileViews'] == 0){
					// Noone has viewed this profile yet, do not include profile count
				}else{ ?>
					<h2><? echo $profileInfo['profileViews']; ?> Profile Views</h2>
				<? } ?>

				<h3 class="rating"><? echo $profileInfo['ratingCount'] ?></h3>
			</section>

		</div> <!-- end of sizer -->
	</div> <!-- end of info -->

	<? if(!isMulti($decks)){ ?>
	
	<? }else{ ?>

		<section id="decks" class="userDecksPage"> 
			<div class="sizer">
				<!-- looping through all the decks and presenting them /Should be in order of date created/ -->
				<? foreach($decks as $deck){ ?>
					<article class="deck" data-deckid="<? echo $deck['deck_id'] ?>" >
						<? if(!$deck['privacy']) echo '<h1 class="votes">' . $deck["ratingCount"] . '</h1>' ?>
						<? if($deck['privacy']) echo '<div class="private"></div>' ?>
						<h1 class="deckname"><? echo anchor("cards/getCards/{$userID}/{$deck['deck_id']}", $deck['title']); ?></h1>
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

