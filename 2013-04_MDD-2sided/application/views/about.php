	<div id="content">
	    <section id="cards">
	        <ul>
	            <li class="aCard" data-cardid="50f94ca069af1">
	                <h1 class="question">2sided is a social way to study using flashcards and friends.</h1>
	                <h1 class="answer">Nice! You can also press the spacebar to flip cards. Press the left and right arrows to move to another card.</h1>
	            </li>
	            <li class="aCard" data-cardid="50f94d23c689e">
	                <h1 class="question">Create an account by clicking sign up. By signing up you can create your own decks and share them with the world!</h1>
	                <h1 class="answer">You can also create private decks that will only be seen by you.</h1>
	            </li>
	            <li class="aCard" data-cardid="50f94dabdcc75">
	                <h1 class="question">Decks of cards can be voted on. This helps you find the best decks on 2sided.</h1>
	                <h1 class="answer">The most popular decks will be shown on the Decks page.</h1>
	            </li>
	            <li class="aCard" data-cardid="50f94dc89a0e9">
	                <h1 class="question">Browse for free!</h1>
	                <h1 class="answer">Just click on Decks in the navigation above you.</h1>
	            </li>
	        </ul>
	    </section>
	    		
		<section id="cardT">
			<div class="space"></div>
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
					<p>Voting on decks insures that you can find the best decks fast. You can vote on any deck, and everyone else can vote on your decks.</p>
				</article>
				<article class="arts">
					<h1>Follow your friends</h1>
					<img src="<? echo base_url(); ?>imgs/art-img-3.jpg" alt="reason number to use 2sided number three" width="221" height="96" />
					<p>Connect with your friends and people around the world. You can share decks with your friends and with the world.</p>
				</article>
				<article class="arts dontdoit">
					<h1>Easy to start</h1>
					<img src="<? echo base_url(); ?>imgs/art-img-4.jpg" alt="reason number to use 2sided number four" width="221" height="96" />
					<p>Signing up to use 2sided is simple, all you need is an email or facebook account to start sharing your own flashcards.</p>
				</article>
			</div>
		</section>
	</div> <!-- end of content -->

	<!-- Jquery -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<? echo base_url(); ?>js/libs/jquery-1.9.1.min.js"><\/script>')</script>
    
    <!-- Plugins -->
    <script type="text/javascript" src="<? echo base_url(); ?>js/plugins/rotate3Di.js"></script>

    <!-- Scripts -->
    <script type="text/javascript" src="<? echo base_url(); ?>js/main.js"></script>
	<script type="text/javascript" src="<? echo base_url(); ?>js/card.js"></script>

    <!-- Inits -->
    <script type="text/javascript">initCard();</script>