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

?>

<div id="info">
	<div class="sizer">
		<section id="picture">
			<article>
				<img src="" alt="" width="140" height="140">	
				<ul class="profileLinks">
					<li><a href="Friends">Friends</a></li>
					<li><a href="Badges">Badges</a></li>
					<li class="last"><a href="Tags">Tags</a></li>
				</ul>
			</article>
		</section>
		
		<section id="profileInfo">
			<article>
				<h1>USERNAME</h1>
				<!-- <h2>Orlando, FL</h2> -->
				<h2>Joined DATE</h2>
				<h2>12 Profile Views</h2>
				<h3>CHECKS Check Marks!</h3>
			</article>
		</section>

		<section id="bgroup">
			<button>Add Deck</button>
		</sction>
	</div>
</div>
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
	</div>

