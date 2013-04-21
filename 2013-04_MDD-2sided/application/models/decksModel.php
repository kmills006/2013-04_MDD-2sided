<?

class DecksModel extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    // getAllDecks
	public function getAllDecks(){

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


	// testing stuff

	// getUsersDecks
	// returns all of a specfic users decks
	public function getUsersDecks($userID){

		$this->db->select('d.deck_id, d.title, d.privacy, COUNT(r.rating) as ratingCount, u.username');
		$this->db->from('users as u');
		$this->db->join('decks as d', 'u.user_id = d.user_id');
		$this->db->join('ratings as r', 'd.deck_id = r.deck_id');
		$this->db->where("u.user_id = '$userID'");
		$this->db->where('r.rating', 1);

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
   //          print_r($dataResults);
   //          echo "</pre>";

			return $dataResults;

		}else{

			return false;
		
		}

	}  




} // end of Decks class