<?
	$this->load->helper('objectToArray.php');
	$this->load->helper('isMulti.php');
	
	$decks = objectToArray($decks);
	
	// if(!isMulti($decks)){

	// }else{
	
	// }

	// var_dump(count($decks));

	// echo "<pre>";
	// print_r($decks);
	// echo "</pre>";


	if(isset($decks['username'])){
		$username = $decks['username'];
		$userID = $decks['user_id'];
	}else{
		$username = $decks[0]['username'];
		$userID = $decks[0]['user_id'];
	}
?>

<div id="info">
	<div class="sizer">
		<section id="picture">
			<article>
				<? if(!isMulti($decks)){
					echo "here";
				}else{
					if($decks[0]['profile_img'] == null){
						echo img('imgs/profile_imgs/profile-img_placeholder.png');
					}else{
						echo img('imgs/profile_imgs/'.$decks[0]['profile_img']); 
					}
				}?>
			</article>
		</section>
		
		<section id="profileInfo">
			<article>
				<h1><? echo $username ?></h1>
				<!-- <h2>Orlando, FL</h2> -->
				<h2>Joined DATE</h2>
				<h2>12 Profile Views</h2>
				<h3>CHECKS Check Marks!</h3>
			</article>
		</section>

		<section id="bgroup">
			<?  if(!$isLoggedIn){
					// No user is logged in
				}else{

					// Checking if user is viewing their own deck
					if($this->session->userdata('userID') == $userID){ ?>
						<div class="button"><? echo anchor("decks/addNewDeck", 'Add New Deck', 'Add New Deck');?></div>
					<? }else{
						// Viewing another users decks, you can not add new deck
					}

				} ?>
		</sction>

	</div> <!-- end of sizer -->
</div> <!-- end of info -->
<div class="sizer">

	<? 	if(!isMulti($decks)){ ?>

		<h1>No Decks</h1>
	
	<? }else{ ?>

		<section id="decks"> 
			<!-- looping through all the decks and presenting them /Should be in order of date created/ -->
			<? foreach($decks as $deck){ ?>
				<article class="deck">
					<? if(!$deck['privacy']) echo '<h1 class="votes">' . $deck["ratingCount"] . '</h1>' ?>
					<? if($deck['privacy']) echo '<div class="private"></div>' ?>
					<h1 class="deckname"><? echo $deck['title'] ?></h1>
					<? if($this->session->userdata('userID') == $userID) echo '<div class="options"><p>Deck Options</p></div>' ?>
				</article>
			<? } ?>
		</section> <!-- end of decks -->	

	<? } ?>
		
</div> <!-- end of sizer -->

