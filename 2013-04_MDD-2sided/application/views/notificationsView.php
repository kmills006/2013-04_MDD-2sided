<?

	$this->load->helper('objectToArray.php');
	$friendRequests = objectToArray($friendRequests);

	$userID = $this->session->userdata('userID');

	if(isset($friendRequests)){
		foreach($friendRequests as $requester){ ?>
			
			<p><? echo anchor("user/profilePage/{$requester["user_id"]}", $requester['username'], 'View users profile');?> wants to be your friend!</p>
			<div class="button"><? echo anchor("friends/acceptRequest/{$requester["user_id"]}/{$userID}", 'Accept', 'Accept friend request') ?></div>
			<div class="button"><? echo anchor("friends/rejectRequest/{$requester["user_id"]}/{$userID}", 'Decline', 'Accept friend request') ?></div>
			
		
		<? }
	}else{
		echo "No notifications";
	}