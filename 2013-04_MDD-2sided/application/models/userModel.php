<?

class UserModel extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    // isMember
    // Checking to see if the facebook user is already a member with 2sided
    public function isMember($fbUser){
    	$query = $this->db->get_where('users', array('email' => $fbUser['email']));

    	if($query->num_rows() == 1){
    		foreach($query->result() as $row){
    			$dataResults[] = $row;
    		}

    		return $dataResults;

    	}else{

    		// No user found
    		return false;

    		// Comments added to test out SourceTree instead of GitHub
    	}
    }

    // getProfile 
    // get all of users information
    public function getProfile($userID){
    	
    	$this->load->library('subquery');

    	$this->db->select("u.username, u.date_of_reg, u.profile_img");
	 
	   	$subDecks = $this->subquery->start_subquery("select");
		$subDecks->select('COUNT(d.deck_id) as deck_count')->from('users as u');
		$subDecks->join('decks as d', 'u.user_id = d.user_id');
		$subDecks->where("u.user_id = '$userID'");
		$this->subquery->end_subquery('deckCount');

    	$subCards = $this->subquery->start_subquery("select");
    	$subCards->select('COUNT(c.card_id) as card_count')->from('users as u');
    	$subCards->join('decks as d', 'u.user_id = d.user_id');
    	$subCards->join('cards as c', 'd.deck_id = c.deck_id');
		$subCards->where("u.user_id = '$userID'");
    	$this->subquery->end_subquery('cardCount');

    	$subTags = $this->subquery->start_subquery("select");
    	$subTags->select('COUNT(t.tag_id) as tag_count')->from('users as u');
    	$subTags->join('decks as d', 'u.user_id = d.user_id');
    	$subTags->join('tags as t', 'd.deck_id = t.deck_id');
		$subTags->where("u.user_id = '$userID'");
    	$this->subquery->end_subquery('tagsCount');

    	$subFriends = $this->subquery->start_subquery("select");
    	$subFriends->select('COUNT(uf.friend_id) as friend_count')->from('users as u');
    	$subFriends->join('user_friends as uf', 'u.user_id = uf.user_id');
		$subFriends->where("u.user_id = '$userID'");
    	$this->subquery->end_subquery('friendsCount');

    	$subRatings = $this->subquery->start_subquery("select");
    	$subRatings->select('COUNT(r.rating_id) as rating_count')->from('users as u');
    	$subRatings->join('decks as d', 'u.user_id = d.user_id');
    	$subRatings->join('ratings as r', 'd.deck_id = r.deck_id');
		$subRatings->where("u.user_id = '$userID'");
    	$this->subquery->end_subquery('ratingsCount');

    	$this->db->from('users as u');
    	$this->db->where("u.user_id = '$userID'");

		$query = $this->db->get();


    	 if($query->num_rows > 0){
    		foreach($query->result() as $row){
    			$dataResults[] = $row;
    		}
    	}else{
    		// No Results Found
    		echo "No Results";
    	}

    	if($dataResults){
    		return $dataResults;
    	}else{
    		return false;
    	} 
    }

} // end of user class