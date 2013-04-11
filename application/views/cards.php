	<div id="content">
		<section id="topWelcome">
			<div class="sizer">

<?php
	$username = $this->session->userdata("username");

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


	if(isset($cards)){
		$c = objectToArray($cards);
			// if $c is empty 
			if($c == NULL){
				echo "Null";
			}else{ 
				$ismult = is_multi($c);
				
				// checking to see if the array is multileveled
				// if it isn't there are no cards in the deck
				if(!$ismult){ ?> 
					<h1 id="deckName"><? echo $c["title"]; ?></h1>
					
					<hgroup id="deckInfo">
						<h2>Created on <? echo $c["formated_date"]; ?> </h2>
						<h2 class="totalVotes">A+ :</h2>
						<!-- <h2>31 Down Votes</h2> -->
					</hgroup>
					
					
					<h3 id="addCard">Add Card</h3>
				</div>
			</section>
			
			<section id="cards">
				<ul>
					<li id="firstCard" class="aCard">
						<h1>Please add your first card!</h1>
					</li>
				</ul>
			</section>
                    
				<? }else{ // there are cards in the deck ?>
                   	<h1 id="deckName"><? echo $c[0]["title"]; ?></h1>
    
                    <hgroup id="deckInfo">
                        <h2>Created On : <? echo $c[0]["formated_date"]; ?> </h2>
						<h2 class="totalVotes">A+ :</h2>
                        <!-- <h2>31 Down Votes</h2> -->
                    </hgroup>
                    
                    <h3 id="addCard">Add Card</h3>

                </div>
            </section>
            
            <section id="cards">
                <ul>
                    <? foreach($c as $v){ ?>
                        <li class="aCard" data-cardid="<? echo $v["card_id"] ?>">
                            <h1 class="question"><? echo $v["question"]; ?></h1>
                            <h1 class="answer"><? echo $v["answer"]; ?></h1>
                        </li>
                    <? } ?>
                </ul>
            </section>
        <? }
		} ?>
<?php } ?>		
		<section id="cardT">
			<button type="button" id="editButton">Edit</button>
			<button type="button" id="deleteButton">Delete</button>
			<div id="cardTools">
				<div id="toolButtons">
					<div id="leftArrow"></div>
					<button type="button" id="lilFLip">Flip Card</button>
					<div id="rightArrow"></div>
				</div>
			</div>
			<button type="button" id="randomButton">Random</button>
		</section>

		<p id="progNum"></p>
		<div id="prog">
			<div id="p"></div>
		</div>

		<section id="deckTags">
			<div class="sizer">
				<ul class="yourTags">
			
				</ul>			
			</div>
		</section>
