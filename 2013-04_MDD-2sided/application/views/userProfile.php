<? 
	$this->load->helper('isMulti.php');

	if(!isMulti($profileInfo)){
		// No
	}else{
		$userInfo = $profileInfo[0];
	}

	$button = array('class' => 'button');
?>

	<div id="info">
		<div class="sizer">
			<section id="picture">
				<? if($userInfo['profile_img']){
					echo img('imgs/profile_imgs/'.$userInfo['profile_img']); 
				}else{
					echo img('imgs/profile_imgs/profile-img_placeholder.png'); 
				} ?>
				
				<div class="button"><? echo anchor("decks/userDecks/{$userInfo['user_id']}", 'View Decks', 'View Decks');?></div>
				
				<ul class="profileLinks">
					<li><? echo anchor("user/friendList/{$userInfo['user_id']}", 'Friends', 'View all of friends'); ?></li>
					<li><? echo anchor("user/badgeList/{$userInfo['user_id']}", 'Badges', 'View all badges'); ?></li>
					<li class="last"><a href="Tags">Tags</a></li>
				</ul>
			</section>
			
			<section id="profileInfo">
				<h1><? echo $userInfo['username'] ?></h1>
				<!-- <h2>Orlando, FL</h2> -->
				<h2>Joined <? echo $userInfo['date_of_reg']; ?></h2>
				<h2>12 Profile Views</h2>
				<h3 class="rating"><? echo $userInfo['ratingsCount'] ?></h3>
			</section>

			<section id="quickInfo">
				<ul>
					<li><h1><? echo $userInfo['friendsCount']; ?></h1><h2>Friends</h2></li>
					<li><h1><? echo $userInfo['decksCount']; ?></h1><h2>Decks</h2></li>
					<li><h1><? echo $userInfo['cardsCount']; ?></h1><h2>Cards</h2></li>
					<li><h1><? echo $userInfo['badgeCount']; ?></h1><h2>Badges</h2></li>
					<li class="last"><h1><? echo $userInfo['tagsCount']; ?></h1><h2>Tags</h2></li>
				</ul>
			</section>

			<section id="bgroup">

				<? 
					if(isset($friendRequests)){

						// var_dump($friendRequests);
						
						if($this->session->userdata('isLoggedIn') == 1 && $userInfo['user_id'] && $friendRequests == true){ ?>
							
							<!-- user has friend requests to check -->	
							<div class="button"><? echo anchor("notifications/checkNewNotifications", 'Notifications ('.count($friendRequests).')' , "Check your notifications") ?></div>
					
						<? }else{
							echo $friendRequests;
						}

					}if(isset($areFriends)){

						// echo '<pre>';
						// print_r($areFriends);
						// echo '</pre>';

						$loggedInUser = $this->session->userdata('userID');

						if(!$areFriends){ ?>

							<!-- users are not friends and can add each other -->
							<div class="button"><? echo anchor("friends/addNewFriend/{$loggedInUser}/{$userInfo["user_id"]}", 'Add Friend' , "Add new friend") ?></div>
						
						<? }if($loggedInUser == $areFriends[0]['user_id'] && $areFriends[0]['active'] == 0){ ?>

							<!-- logged in user has already sent a friend request and is waiting to be accepted -->
							<button>Pending Request</button>	
						
						<? } else{ 
							// echo "userProfile/areFriends/else";
						}
					}
				?>

			</section>

		</div>	<!-- end of sizer -->
	</div> <!-- end of info -->

	<div id="activity">
		<div class="dbbg"><div class="sizer"><h1>Activity</h1></div></div>
		<div class="sizer">
			<ul>
				<li><img src="" alt="" width="50" height="50"><p>New Deck! Kristy123 created a new deck called Spelling ABC.</p><p class="date">12/12/12</p></li>
				<li><img src="" alt="" width="50" height="50"><p>New Friend! Kristy123 and Kolby99 are now friends.</p><p class="date">12/12/12</p></li>
				<li><img src="" alt="" width="50" height="50"><p>New Badge! Kristy123 recieved the badge Deck Master.</p><p class="date">12/12/12</p></li>
				<li><img src="" alt="" width="50" height="50"><p>New Deck! Kristy123 created a new deck called Spelling ABC.</p><p class="date">12/12/12</p></li>
				<li><img src="" alt="" width="50" height="50"><p>New Friend! Kristy123 and Kolby99 are now friends.</p><p class="date">12/12/12</p></li>
				<li><img src="" alt="" width="50" height="50"><p>New Deck! Kristy123 created a new deck called Spelling ABC.</p><p class="date">12/12/12</p></li>
			</ul>
		</div>
	</div>

	<!-- Jquery -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<? echo base_url(); ?>js/libs/jquery-1.9.1.min.js"><\/script>')</script>

	<!-- Scripts -->
	<script type="text/javascript" src="<? echo base_url(); ?>js/main.js"></script>

	<!-- Inits -->
