<?php
	// Helpers
	$this->load->helper('url');


	// objecToArray Function to convert stdObject to multidimensional array
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
	
	// checking to see if the array is multileveled
	function is_multi($array) {
   		return (count($array) != count($array, 1));
	}


	// Call objectToArray
	$a = objectToArray($allDecks);
	$results = is_multi($a);
	
	if($results){ 
	
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
				<ul class="left">
			
				</ul>
				<ul class="right">
	
				</ul>
			</section>

			<section id="decks"> 
<?php		
			foreach ($a as $key => $value) {
				//var_dump($value);
			?>
				<article class="deck">
					<h1 class="username"><?php echo anchor("browse/getdecks/{$value["user_id"]}", $value["username"] , "Check out this user's decks"); ?></h1>
					<h1 class="votes"><?php echo $value["rating"]; ?></h1>
					<h1 class="deckname"><?php echo anchor("browse/getcards/{$value["deck_id"]}", $value["title"] , "View cards for this deck"); ?></h1>
				</article>
			<?php } ?>

<? }else{
		echo "Not Multi";
	}?>
			</section> <!-- end of decks -->
		</div> <!-- end of sizer -->
