<?

class UserModel extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    // getDecks
    public function getProfile($userID){
    	
    	// $this->db->select('COUNT(deck_id) as deck_count, u.user_id');
    	// $this->db->from('users as u');
    	// $this->db->join('decks as d', 'u.user_id = d.user_id');
    	// $this->db->where('u.user_id', $userID);

    	// $this->db->select('card_id, u.user_id, d.deck_id');
    	// $this->db->from('users');
    	// $this->db->join('decks as d', 'u.user_id = d.user_id');
    	// $this->db->where('u.user_id', $userID);

    	// $query = $this->db->query("SELECT username
		   //  					   FROM users
		   //  					   WHERE user_id = 5168c94dd332e");
    	

    	// $query = $this->db->get();

    	$this->db->select("*");
		$this->db->from(
			$this->db->select('c.card_id, u.user_id');
			$this->db->from('users');
			$this->db->join('decks as d', 'u.user_id = d.user_id');
			$this->db->join('cards as c', 'd.deck_id = c.deck_id');
		);

		$query = $this->db->get();


    	 if($query->num_rows > 0){
    		foreach($query->result() as $row){
    			$dataResults[] = $row;
    		}

	    	echo "<pre>";
	    	var_dump($dataResults);
	    	echo "</pre>";

    	}else{
    		// No Results Found
    		echo "No Results";
    	}

    	// echo '<pre>';
    	// print_r($dataResults);
    	// echo '</pre>';

    	// if($dataResults){
    	// 	return $dataResults;
    	// }else{
    	// 	return false;
    	// } 
    }

} // end of user class