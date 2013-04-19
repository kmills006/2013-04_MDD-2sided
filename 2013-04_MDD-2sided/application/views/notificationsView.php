<?


	echo "<pre>";
	print_r($friendRequests);
	echo "</pre>";

	$this->load->helper('objectToArray.php');
	$friendRequests = objectToArray($friendRequests);

	foreach($friendRequests as $requester){ ?>

		<p><? echo anchor("user/profilePage/{$requester["user_id"]}", $requester['username'], 'View users profile');?> wants to be your friend!</p>


	<? }