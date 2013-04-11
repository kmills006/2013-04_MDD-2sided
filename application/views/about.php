	<div id="content">

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
	
	function is_multi($array) {
   		return (count($array) != count($array, 1));
	}

	if(isset($cards)){
		$c = objectToArray($cards);
		
			$parts = explode('/',  current_url());
			$ratingURL = end($parts);
					
			// if $c is empty 
			if($c == NULL){
				echo "Null";
			}else{ 
				$ismult = is_multi($c);
				if(!$ismult){ ?> 
                
				<section id="cards">
					<ul>
						<li id="firstCard" class="aCard">
							<h1>Please add your first card!</h1>
						</li>
					</ul>
				</section>
          
		 	<? }else{ ?>

                   	
            
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
			<button type="button" id="editButton" style="visibility:hidden;">Edit</button>
			<button type="button" id="deleteButton" style="visibility:hidden;">Delete</button>
			<div id="cardTools" class="aboutTools">
				<div id="toolButtons">
					<div id="leftArrow"></div>
					<button type="button" id="lilFLip">Flip Card</button>
					<div id="rightArrow"></div>
				</div>
			</div>
		</section>

		<section id="btf">
			<div class="sizer">
				<article class="arts">
					<h1>Social Studying</h1>
					<img src="<? echo base_url(); ?>imgs/art-img-1.jpg" alt="reason number to use 2sided number one" width="221" height="96" />
					<p>2sided is a great way to study with friends. Create your own flashcards to help you study and share them with the world. </p>
				</article>
				<article class="arts">
					<h1>Study the best</h1>
					<img src="<? echo base_url(); ?>imgs/art-img-2.jpg" alt="reason number to use 2sided number two" width="221" height="96" />
					<p>Voting on decks allow the browse page to be filled with only the best of the flashcards.</p>
				</article>
				<article class="arts">
					<h1>Follow your friends</h1>
					<img src="<? echo base_url(); ?>imgs/art-img-3.jpg" alt="reason number to use 2sided number three" width="221" height="96" />
					<p>Find an awesome deck? Go to that user’s page to find the rest of their decks.</p>
				</article>
				<article class="arts dontdoit">
					<h1>Easy to start</h1>
					<img src="<? echo base_url(); ?>imgs/art-img-4.jpg" alt="reason number to use 2sided number four" width="221" height="96" />
					<p>Signing up to use 2sided is simple, all you need is an email to start sharing your own flashcards.</p>
				</article>
			</div>
		</section>



