<?

class FriendsModel extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    // checkFriendRequests
    // checking if the logged in user has any new friend request
    public function checkFriendRequests($userID){
    	$this->db->select("uf.user_id as requester, active");
    	$this->db->from('user_friends as uf');
    	$this->db->join('users as u', 'uf.friend_id = u.user_id');
    	$this->db->where("uf.friend_id = '$userID'");
    	$this->db->where('uf.active = 0');


    	$query = $this->db->get();

    	if($query->num_rows > 0){
    		foreach($query->result() as $row){
    			$dataResults[] = $row;
    		}

    		return $dataResults;
    	}else{
    		return false;
    	}
    }


    // checkFriendship
    // checking if users are already friends
    public function checkFriendship($friendID){
        $userID = $this->session->userdata('userID');

        $this->db->select('u.user_id as user, uf.friend_id as friend, uf.active');
        $this->db->join('user_friends as uf', 'u.user_id = uf.user_id');
        $this->db->where("u.user_id = '$userID'");
        $this->db->where("uf.friend_id = '$friendID'");
       
       $query = $this->db->get('users as u');

       if($query->num_rows == 1){
            $row = $query->row();

            return true;
       }else{
            return false;
       }
    }


}