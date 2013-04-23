<?

	$this->load->helper('objectToArray.php');
	$this->load->helper('isMulti.php');

	$cards = objectToArray($cards);

	// echo "<pre>";
	// print_r($cards);
	// echo "</pre>";

	if($isLoggedIn == 1 && $userID == $this->session->userdata('userID')){
		echo "viewing own deck";
	}else{
		echo 'viewing someone elses';
	}



?>


    <div id="content">

    	<button>Add New Card</button>

        <section id="cards">
            <ul>

            	<?
            		if(!isMulti($cards)){
						echo "No Cards";
					}else{
						foreach($cards as $card){ ?>
		            		<li class="aCard">
		            			<h1 class="question"><? echo $card['question']?></h1>
		            			<h1 class="answer"><? echo $card['answer']?></h1>
		            		</li>
		            	<? }
					}
            	?>
            </ul>
        </section>
        	
		<section id="cardT">
			<button type="button" id="editButton" style="visibility:hidden;">Edit</button>
			<button type="button" id="deleteButton" style="visibility:hidden;">Delete</button>
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
	</div> <!-- end of content -->

    <!-- Jquery -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<? echo base_url(); ?>js/libs/jquery-1.9.1.min.js"><\/script>')</script>
    
    <!-- Plugins -->
    <script type="text/javascript" src="<? echo base_url(); ?>js/plugins/rotate3Di.js"></script>

    <!-- Scripts -->
    <script type="text/javascript" src="<? echo base_url(); ?>js/main.js"></script>

    <!-- Inits -->
    <script type="text/javascript">initNav();</script>
    <script type="text/javascript">initCard();</script>

