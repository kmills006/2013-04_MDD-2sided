<?

class UserModel extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    // getDecks
    public function getProfile($userID){
    	
    	$this->db->select('COUNT(deck_id) as deck_count, u.user_id');
    	$this->db->from('users as u');
    	$this->db->join('decks as d', 'u.user_id = d.user_id');
    	$this->db->where('u.user_id', $userID);
    	

    	$query = $this->db->get();

    	 if($query->num_rows > 0){
    		foreach($query->result() as $row){
    			$dataResults[] = $row;
    		}

    	}else{
    		// No Results Found
    	}

    	echo '<pre>';
    	print_r($dataResults);
    	echo '</pre>';

    	if($dataResults){
    		return $dataResults;
    	}else{
    		return false;
    	} 
    }

} // end of user class