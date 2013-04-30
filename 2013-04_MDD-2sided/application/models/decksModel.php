<?

class DecksModel extends CI_Model {

    function __construct(){
        parent::__construct();

        $this->load->helper('objectToArray.php');
    }

    // getAllDecks
    // Retrieving all public decks for the browse page
	function getAllDecks(){

		$this->db->select('decks.deck_id, COUNT(rating) as rating, users.user_id, users.username, decks.title');
		$this->db->from('decks');
		$this->db->join('users', 'decks.user_id = users.user_id');
		$this->db->join('ratings', 'decks.deck_id = ratings.deck_id');
		$this->db->where('decks.privacy', 0);
		$this->db->where('rating', 1);
		$this->db->group_by('deck_id');
		$this->db->order_by('rating', 'desc');

		$query = $this->db->get();

		if($query->num_rows > 0){

			foreach($query->result() as $row){
				$dataResults[] = $row;
			}

		}else{
			// No Results Found
		}

		if(isset($dataResults)){
			$dataResults = objectToArray($dataResults);

			return $dataResults;
		}else{
			return false;
		}

	} // end of getAllDecks  



	// getUsersDecks
	// Returns all of a specfic users decks
	function getUsersDecks($userID){

		$this->db->select('d.deck_id, d.title, d.privacy, COUNT(r.rating) as ratingCount, u.username, u.user_id, u.profile_img');
		$this->db->from('users as u');
		$this->db->join('decks as d', 'u.user_id = d.user_id');
		$this->db->join('ratings as r', 'd.deck_id = r.deck_id');
		$this->db->where("u.user_id = '$userID'");

		/* Checking to see whether the user is looking at their own decks
		or looking at another users */
		if($this->session->userdata('userID')){
			if($this->session->userdata('userID') == $userID){
				/* Since user is looking at their own deck, pull 
				all their decks */
			}else{
				/* Only pull public decks */
				$this->db->where('d.privacy', 0);
			}
		}else{
			/* No user is logged in, show only public decks */
			
			/* Only pull public decks */
			$this->db->where('d.privacy', 0);
		}

		// $this->db->where('d.privacy', $privacy);
		$this->db->group_by('d.deck_id');

		$query = $this->db->get();

		if($query->num_rows > 0){

			foreach($query->result() as $row){
				$dataResults[] = $row;
			}

			// echo "<pre>";
			// print_r($dataResults);
			// echo "</pre>";

			return $dataResults;

		}else{

			// User has no decks yet, only pull out user's information
			$this->db->select('user_id, username, profile_img');
			$this->db->where('user_id', $userID);

			$query = $this->db->get('users');

			if($query->num_rows() == 1){
				$dataResults = $query->row();

				return $dataResults;
			}else{
				// No user found
			}
		
		}

	}  


	// getDeck
	// Retrieve all the information on a select deck
	function getDeck($userID, $deckID){
		$this->db->select('d.deck_id, d.title, u.username, COUNT(r.rating) as ratingCount, date_created, date_edited, u.profile_img, u.user_id');
		$this->db->join('users as u', 'u.user_id = d.user_id');
		$this->db->join('ratings as r', 'd.deck_id = r.deck_id');
		$this->db->where('u.user_id', $userID);
		$this->db->where('d.deck_id', $deckID);

		$query = $this->db->get('decks as d');

		if($query->num_rows()){

			foreach($query->result() as $data){
				$dataResults = objectToArray($data);
			}


			$dateCreated = strtotime($dataResults['date_created']);
			$dataResults['date_created'] = date("M d, Y", $dateCreated);

			$dateEdited = strtotime($dataResults['date_edited']);
			$dataResults['date_edited'] = date("M d, Y", $dateEdited);

			return $dataResults;
		}else{
			return false;
		}
	}



	// addNewDeck
	// User adding a new deck to their collection
	function addNewDeck($newDeck){
		$userID = $this->session->userdata('userID');

		$deckID = uniqid();

		if($newDeck['privacy'] == "Public"){
			$privacy = 0;
		}else{
			$privacy = 1;
		}

		$newDeckData = array(
					'deck_id' => $deckID,
					'user_id' => $userID,
					'title' => $newDeck['title'],
					'privacy' => $privacy
 		);

 		$query = $this->db->insert('decks', $newDeckData);

 		if(!$query){
 			// Unable to add deck 
 		}else{

 			// inserting UPVOTE for user into DB
			$dateRated = date('Y/m/d h:i:s', time());

			$userUpvote = array(
				'deck_id' => $deckID,
				'rating_id' => uniqid(), 
				'user_id' => $userID,
				'rating' => 1,
				'date_rated' => $dateRated
			);

			$this->db->insert("ratings", $userUpvote);
		

			/* Checking how many decks the user has
			to determine if a badge should be given 
			or not */

			$this->db->select();
			$this->db->where('d.user_id', $userID);

			$query = $this->db->get('decks as d');

			/* if($query->num_rows == 1){
				// Users receives the 'Newb' badge for registering
	            $badgeParams = array('badgeID' => '517efd184e31b');
	            $this->load->library('userbadges.php', $badgeParams);


	            if($this->userbadges->badgeInfo){
	                $badgeInfo = $this->userbadges->badgeInfo;

	                $badgeInfo = objectToArray($badgeInfo);

	                $dateIssued = date('Y/m/d h:i:s', time());

	                $newBadge = array(
	                                'user_badge_id' => uniqid(),
	                                'user_id' => $userID,
	                                'badge_id' => $badgeInfo['badge_id'],
	                                'date_issued' => $dateIssued
	                );

	                $this->db->insert('user_badges', $newBadge);

	            }
			}else{
				
			} */

			switch($query->num_rows()){
				case 1:
					// User receives a badge for creating their first deck
					$badgeParams = array('badgeID' => '517efd184e31b');
				break;

				case 5:
					// User receives a badge for creating their fifth deck
					$badgeParams = array('badgeID' => '517f02b737512');
				break;

				case 10:
					// User receives a badge for creating their tenth deck
					$badgeParams = array('badgeID' => '517f02e45c07d');
				break;

				default:
					// User doesn't receive a new badge
				break;
			}

			if(isset($badgeParams)){
				
	           $this->load->library('userbadges.php', $badgeParams);


	            if($this->userbadges->badgeInfo){
	                $badgeInfo = $this->userbadges->badgeInfo;

	                $badgeInfo = objectToArray($badgeInfo);

	                $dateIssued = date('Y/m/d h:i:s', time());

	                $newBadge = array(
	                                'user_badge_id' => uniqid(),
	                                'user_id' => $userID,
	                                'badge_id' => $badgeInfo['badge_id'],
	                                'date_issued' => $dateIssued
	                );

	                $this->db->insert('user_badges', $newBadge);
	            }
			}

			// inserting tags in the database
			$tags = $newDeck['tags'];

			foreach($tags as $tag){

				$tagData = array(
								'tag_id' => uniqid(),
								'tagName' => $tag,
								'deck_id' => $deckID
				);

				$this->db->insert("tags", $tagData);

				$deckInfo = array(
								'deckID' => $deckID,
								'deckTitle' => $newDeck['title']
				);

				return $deckInfo;
			}


 		}
	}

	// editDeckTitle
	public function editDeckTitle($deck){
		$deckID = $deck["deckID"];
		$dateEdited = date('Y/m/d h:i:s', time());
		$newTitle = $deck["newDeckName"];
		
		$data = array(
					"date_edited" => $dateEdited,
					"title" => $newTitle
		);
		
		$this->db->where("deck_id", $deckID);
		$this->db->update("decks", $data);	
	}

	// editDeckPrivacy
	public function editDeckPrivacy($deck){
		$deckID = $deck["deckID"];
		$dateEdited = date('Y/m/d h:i:s', time());
		$newPrivacy = $deck["newPrivacy"];
		
		$data = array(
					"date_edited" => $dateEdited,
					"privacy" => $newPrivacy
		);
		
		$this->db->where("deck_id", $deckID);
		$this->db->update("decks", $data);	
	}

	// deleteDeck
	public function deleteDeck($post){
		$deckID = $post["deckID"];

		$tables = array('ratings', 'tags', 'cards', 'decks');

		$this->db->where('deck_id', $deckID);
		$query = $this->db->delete($tables);

		if(!$query){
			// Could not delete deck
			return false;
		}else{
			// Successfully removed deck and all information
			return true;
		}
	}

	// Search Deck
	public function search($searchQuery){
		$search = $searchQuery["title"];

		$this->db->distinct();
		$this->db->select("decks.deck_id, decks.title, decks.user_id");
		$this->db->join("tags", "decks.deck_id = tags.deck_id");
		$this->db->like("decks.title", $search);
		$this->db->or_like("tags.tagName", $search);
		$q = $this->db->get("decks");

	 	if($q->num_rows() > 0){
   			 foreach ($q->result() as $row)
			{	
				$data_results[] = array("userID" => $row->user_id,
									  "deckID" => $row->deck_id,
									  "deckTitle" => $row->title);
			}

			return $data_results;
    	}else{
    		echo "No Search Results";
    	}
	}


} // end of Decks class