<?

	$this->load->helper('isMulti.php');



	if(!isMulti($profileInfo)){
		// No
	}else{
		$userInfo = $profileInfo[0];
	}

	// echo "<pre>";
	// print_r($cards);
	// echo "</pre>";

?>
		<div id="info">
			<div class="sizer">
				<section id="picture">
					<? if($userInfo['profile_img']){
						echo img('imgs/profile_imgs/'.$userInfo['profile_img']); 
					}else{
						echo img('imgs/profile_imgs/profile-img_placeholder.png'); 
					} ?>

					<? if($isLoggedIn == 1 && $userID == $this->session->userdata('userID')){ ?>
						<div id="addCard" class="button"><a href="#"> Add New Card</a></div>
					<? }else{ ?>
						<div id="vote" class="button"><a href="#">Like Deck</a></div>
					<? } ?>
				</section>
				
				<section id="profileInfo">
					<h1><? echo $userInfo['username'] ?></h1>
					<h2>Joined <? echo $userInfo['date_of_reg']; ?></h2>
					<h2>12 Profile Views</h2>
					<h3><? echo $userInfo['ratingsCount'] ?> Check Marks!</h3>
				</section>


			</div> <!-- end of sizer -->
		</div> <!-- end of info -->

        <section id="cards">
            <ul>
            	<?
            		if(!isMulti($cards)){
						echo "No Cards";
					}else{
						foreach($cards as $card){ ?>
		            		<li class="aCard" data-cardid="<? echo $card['card_id'] ?>">
		            			<h1 class="question"><? echo $card['question']?></h1>
		            			<h1 class="answer"><? echo $card['answer']?></h1>
		            		</li>
		            	<? }
					}
            	?>
            </ul>
        </section>
        	
		<section id="cardT">
			<? //hides or shows the edit and delete button.
	    		if($isLoggedIn == 1 && $userID == $this->session->userdata('userID')){ ?>
					<button type="button" id="editButton">Edit</button>
					<button type="button" id="deleteButton">Delete</button>

				<? }else{ ?>
					<div class="space"></div>
				<? }
    		?>
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

    <!-- Jquery -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<? echo base_url(); ?>js/libs/jquery-1.9.1.min.js"><\/script>')</script>
    
    <!-- Plugins -->
    <script type="text/javascript" src="<? echo base_url(); ?>js/plugins/rotate3Di.js"></script>

    <!-- Scripts -->
    <script type="text/javascript" src="<? echo base_url(); ?>js/main.js"></script>
	<script type="text/javascript" src="<? echo base_url(); ?>js/card.js"></script>

    <!-- Inits -->
    <script type="text/javascript">initNav();</script>
    <script type="text/javascript">initCard();</script>
	<script type="text/javascript">initVoting();</script>
