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

		$this->db->select('d.deck_id, d.title, d.privacy');
		$this->db->from('users as u');
		$this->db->join('decks as d', 'u.user_id = d.user_id');
		$this->db->where("u.user_id = '$userID'");

		$query = $this->db->get();

		if($query->num_rows > 0){

			foreach($query->result() as $row){
				$dataResults[] = $row;
			}

			return $dataResults;

		}else{
			
			echo "User has no decks yet.";

			return false;
		}

	}  




} // end of Decks class