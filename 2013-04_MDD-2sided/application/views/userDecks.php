<?
	$this->load->helper('objectToArray.php');
	$this->load->helper('isMulti.php');
	
	$decks = objectToArray($decks);
	
	if(!isMulti($decks)){
		// No
	}else{
		// echo "<pre>";
		// print_r($decks);
		// echo "</pre>";
	}

	// var_dump($decks);
?>

<div id="info">
	<div class="sizer">
		<section id="picture">
			<article>
				<img src="" alt="" width="140" height="140">	
			</article>
		</section>
		
		<section id="profileInfo">
			<article>
				<h1><? echo $decks[0]['username'] ?></h1>
				<!-- <h2>Orlando, FL</h2> -->
				<h2>Joined DATE</h2>
				<h2>12 Profile Views</h2>
				<h3>CHECKS Check Marks!</h3>
			</article>
		</section>

		<section id="bgroup">
			<div class="button"><? echo anchor("", 'Add New Deck', 'Add New Deck');?></div>
		</sction>
	</div> <!-- end of sizer -->
</div> <!-- end of info -->
<div class="sizer">
	<section id="decks"> 
		<!-- looping through all the decks and presenting them /Should be in order of date created/ -->
		<? foreach($decks as $deck){ ?>
			<article class="deck">
				<? if($deck['privacy']) echo '<h1 class="votes"><? echo $deck["rating"] ?></h1>' ?>
				<? if(!$deck['privacy']) echo '<div class="private"></div>' ?>
				<h1 class="deckname"><? echo $deck['title'] ?></h1>
			</article>
		<? } ?>
	</section> <!-- end of decks -->	
</div> <!-- end of sizer -->

