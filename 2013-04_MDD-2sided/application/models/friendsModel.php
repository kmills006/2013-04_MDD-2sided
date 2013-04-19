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

            return $row;
       }else{
            return false;
       }
    }


    

    // getFriendRequests
    public function getFriendRequests($requesters){

    	$userID = $this->session->userdata('userID');

    	$this->load->helper('objectToArray.php');
    	$requesters = objectToArray($requesters);

    	if(!$requesters){

    	}else{

	    	foreach($requesters as $requester => $r){

				$this->db->select('u.username, u.user_id');
				$this->db->from('users as u');
				$this->db->join('user_friends as uf', 'u.user_id = uf.user_id');
				$this->db->where("uf.user_id =", $r['requester']);
				$this->db->where("active =", 0);
				$this->db->where("uf.friend_id =", $userID);
				
				$query = $this->db->get();
				
				if($query->num_rows > 0){
					foreach($query->result() as $row){
						$dataResults[] = $row;
					}

				}else{
					// No results found

					return false;
				}
	    	}

	    	return $dataResults;
	    }
    }



    // acceptRequest
    public function acceptRequest($requesterID, $acceptingUserID){
    	$accept = array('active' => 1);

    	$this->db->where('user_id', $requesterID);
    	$this->db->where('friend_id', $acceptingUserID);
    	$this->db->update('user_friends', $accept);
    }



    // rejectRequest
    public function rejectRequest($requesterID, $rejectingUserID){
    	echo "Requester ID: ".$requesterID;
    	echo "</br>";
    	echo "User ID: ".$rejectingUserID;

    	$decline = array(
    				'user_id' => $requesterID, 
    				'friend_id' => $rejectingUserID
    	);

    	$this->db->delete('user_friends', $decline);

    }




    // sendFriendRequest
    public function sendFriendRequest($userID, $friendID){
		$this->db->select('username');
		$this->db->where("user_id = '$userID'");
		$getUsername = $this->db->get('users');
		
		$requester = $getUsername->row()->username;
		
		// userID represents the user who 
		$newFriendRequest = array(
		'user_id' => $userID,
		'friend_id' => $friendID,
		'active' => 0
		);
		
		$query = $this->db->insert('user_friends', $newFriendRequest);

        if(!$query){
            return false;
        }else{
            return true;
        }
    }


}