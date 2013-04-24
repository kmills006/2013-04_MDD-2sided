<?

class DecksModel extends CI_Model {

    function __construct(){
        parent::__construct();
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

		if($dataResults){
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
			$this->db->select('user_id, username, u.profile_img');
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

		$newDeck = array(
					'deck_id' => $deckID,
					'user_id' => $userID,
					'title' => $newDeck['title'],
					'privacy' => $privacy
 		);

 		$query = $this->db->insert('decks', $newDeck);

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
			
			
			$tags = $newDeck['tags'];

			// inserting tags in the database
			foreach($tags as $tag){
				var_dump($tag);
			}

 			return true;
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


} // end of Decks class