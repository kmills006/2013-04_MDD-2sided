<? 
	$this->load->helper('objectToArray.php');
	$this->load->helper('isMulti.php');

	$profileInfo = objectToArray($profileInfo);

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
			<article>
				
				<? echo img('imgs/profile_imgs/'.$userInfo['profile_img']); ?>
				
				<div class="button"><? echo anchor("decks/userDecks/{$userInfo['user_id']}", 'View Decks', 'View Decks');?></div>
				
				<ul class="profileLinks">
					<li><a href="Friends">Friends</a></li>
					<li><a href="Badges">Badges</a></li>
					<li class="last"><a href="Tags">Tags</a></li>
				</ul>
			</article>
		</section>
		
		<section id="profileInfo">
			<article>
				<h1><? echo $userInfo['username'] ?></h1>
				<!-- <h2>Orlando, FL</h2> -->
				<h2>Joined <? echo $userInfo['date_of_reg']; ?></h2>
				<h2>12 Profile Views</h2>
				<h3><? echo $userInfo['ratingsCount'] ?> Check Marks!</h3>
			</article>
		</section>

		<section id="quickInfo">
			<ul>
				<li><h1><? echo $userInfo['friendsCount']; ?></h1><h2>Friends</h2></li>
				<li><h1><? echo $userInfo['decksCount']; ?></h1><h2>Decks</h2></li>
				<li><h1><? echo $userInfo['cardsCount']; ?></h1><h2>Cards</h2></li>
				<li><h1>101</h1><h2>Comments</h2></li>
				<li class="last"><h1><? echo $userInfo['tagsCount']; ?></h1><h2>Tags</h2></li>
			</ul>
		</section>

		<section id="bgroup">

			<? 
				if(isset($friendRequests)){
					

					if($this->session->userdata('isLoggedIn') == 1 && $userInfo['user_id'] && $friendRequests == true){ ?>
						
						<!-- user has friend requests to check -->	
						<div class="button"><? echo anchor("notifications/checkNewNotifications", 'Notifications ('.count($friendRequests).')' , "Check your notifications") ?></div>
				
					<? }else{
						echo $friendRequests;
					}

				}if(isset($areFriends)){
					// var_dump($areFriends);

					$areFriends = objectToArray($areFriends);

					$loggedInUser = $this->session->userdata('userID');

					if(!$areFriends){ ?>

						<!-- users are not friends and can add each other -->
						<div class="button"><? echo anchor("friends/addNewFriend/{$loggedInUser}/{$userInfo["user_id"]}", 'Add Friend' , "Add new friend") ?></div>
					
					<? }if($loggedInUser == $areFriends['user'] && $areFriends['active'] == 0){ ?>

						<!-- logged in user has already sent a friend request and is waiting to be accepted -->
						<button>Pending Request</button>	
					
					<? } else{ 
						//echo "userProfile/areFriends/else";
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
			<li><div class="sizer"><img src="" alt="" width="50" height="50"><p>New Deck! Kristy123 created a new deck called Spelling ABC.</p><p class="date">12/12/12</p></div></li>
			<li><div class="sizer"><img src="" alt="" width="50" height="50"><p>New Friend! Kristy123 and Kolby99 are now friends.</p><p class="date">12/12/12</p></div></li>
			<li><div class="sizer"><img src="" alt="" width="50" height="50"><p>New Badge! Kristy123 recieved the badge Deck Master.</p><p class="date">12/12/12</p></div></li>
			<li><div class="sizer"><img src="" alt="" width="50" height="50"><p>New Deck! Kristy123 created a new deck called Spelling ABC.</p><p class="date">12/12/12</p></div></li>
			<li><div class="sizer"><img src="" alt="" width="50" height="50"><p>New Friend! Kristy123 and Kolby99 are now friends.</p><p class="date">12/12/12</p></div></li>
			<li><div class="sizer"><img src="" alt="" width="50" height="50"><p>New Deck! Kristy123 created a new deck called Spelling ABC.</p><p class="date">12/12/12</p></div></li>
		</ul>
	</div>
</div>