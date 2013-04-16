<?

class Decks extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    // getAllDecks
    // returns all decks in order from most popular to least
	public function getAllDecks(){
		
		$dataResults = array();

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
				$data_results[] = $row;
			}

		}else{
			// No Results Found
		}

		// var_dump($data_results);

		// if($data_results){
		// 	return $data_results;
		// }else{
		// 	return false;
		// }

		return $data_results;

	} // end of getAllDecks    




} // end of Decks class