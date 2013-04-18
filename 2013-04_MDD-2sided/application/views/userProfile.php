<? 
	$this->load->helper('objectToArray.php');
	$this->load->helper('isMulti.php');

	$profileInfo = objectToArray($profileInfo);

	if(!isMulti($profileInfo)){
		// No
	}else{
		$userInfo = $profileInfo[0];
	}
?>

<div id="info">
	<div class="sizer">
		<section id="picture">
			<article>
				<img src="" alt="" width="140" height="140">
				
				<button>View Decks</button>
				
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
				<h2>Orlando, FL</h2>
				<h2>Memeber Since <? echo $userInfo['date_of_reg']; ?></h2>
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

			<? if($this->session->userdata('userID') == $userInfo['user_id']){ ?>

				<!-- the user is logged in and viewing their own profile -->
				<button>Edit Profile</button>
				<button>Notifications<span>(11)</span></button>
			
			<? }if($this->session->userdata('isLoggedIn') == 1 && isset($areFriends)){

					// the user is logged in and checkFriendship ran
					if(!$areFriends){ ?>

						<!-- users are not friends and can add each other -->
						<button>Add Friend</button>

					<? }else{
						// Users are already friends, add a way to unfriend user
					}
			   }else{

			   		// there is no user currently logged in, no buttons are available
			} ?>

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