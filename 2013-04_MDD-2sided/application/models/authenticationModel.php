<?

class AuthenticationModel extends CI_Model {

    function __construct(){
        parent::__construct();

        $this->load->helper('objectToArray.php');
    }


    // checkIfUsernameExists
    // Checks if username already exists
	function checkIfUsernameExists($value, $variable) {
        $this->db->select($value);
        $this->db->where($value, $variable);

        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
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

    		return false;
    	}
    }



    // registerFromFacebook
    public function registerFromFacebook($fbUser){
    	$un = $this->security->xss_clean($fbUser['username']);
    	$email = $this->security->xss_clean($fbUser['email']);
    	$fbID = $this->security->xss_clean($fbUser['id']);
    	$dateOfReg = date('Y/m/d h:i:s', time());
		$userID = uniqid();

		$exi = $this->checkIfUsernameExists('username', $un);

        // Pull users current profile picture
        // http://graph.facebook.com/{Facebook ID}/picture


        $url = 'https://graph.facebook.com/'.$fbID.'/picture?type=large';

        /* Extract the filename */
        $profileImg = $userID.'.png';
        
        /* Save file wherever you want */
        file_put_contents('imgs/profile_imgs/'.$profileImg, file_get_contents($url));

		if(!$exi){

			$data = array(
				"user_id" => $userID,
				"email" => $email,
				"username" => $un,
				"facebook_id" => $fbID,
				"date_of_reg" => $dateOfReg,
                "profile_img" => $profileImg
			);
            
            $q = $this->db->insert("users", $data);

            // Users receives the 'Newb' badge for registering
            $badgeParams = array('badgeID' => '51797a502cf4a');
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

            }else{
                // No badge returned
                // Handle error
                echo "here";
            }

            return true;

		}else{
			return false;
		}
    }



    // registerNewUser
    public function registerNewUser(){
    	$username = $this->security->xss_clean($this->input->post("username"));
    	$email = $this->security->xss_clean($this->input->post("r-email"));
    	$password = $this->security->xss_clean($this->input->post("password"));
    	$dateOfReg = date('Y/m/d h:i:s', time());
		$userID = uniqid();

		$exi = $this->checkIfUsernameExists('username', $username);

		if(!$exi){
			$data = array(
				"user_id" => $userID,
				"email" => $email,
				"username" => $username,
				"pword" => md5($password),
				"date_of_reg" => $dateOfReg
			);

	    	$q = $this->db->insert("users", $data);

            // Users receives the 'Newb' badge for registering
            $badgeParams = array('badgeID' => '51797a502cf4a');
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

                // $dataResults['badgeInfo'] = $badgeInfo;

            }else{
                // No badge returned
                // Handle error
                // 
                echo "here";
            }

            // Setting session information
            $sdata = array(
                "userID" => $userID,
                "email" => $email,
                "username" => $username,
                "isLoggedIn" => 1
            );

    		$this->session->set_userdata($sdata);

	    	return true;
		
		}else{
			// Username already exists
			return false;
		}
    }



    // loginFbUser
    public function loginFbUser($fbUser){
    	$this->db->where('username', $fbUser['username']);
    	$this->db->where('email', $fbUser['email']);

    	$query = $this->db->get('users');

    	if($query->num_rows == 1){

    		$row = $query->row();

    		$sessData = array(
    			'userID' => $row->user_id,
    			'email' => $row->email,
    			'username' => $row->username,
    			'isLoggedIn' => 1
    		);

    		$this->session->set_userdata($sessData);

    		return true;

    	}else{
    		// Nothing returned from the database

    		return false;
    	}
    }



    // loginUser
    public function loginUser(){
    	$username = $this->security->xss_clean($this->input->post('username'));
    	$password = $this->security->xss_clean($this->input->post('password'));

    	$this->db->where('username', $username);
    	$this->db->where('pword', md5($password));

    	$query = $this->db->get('users');

    	if($query->num_rows == 1){

    		$row = $query->row();

    		$sessData = array(
    			'userID' => $row->user_id,
    			'email' => $row->email,
    			'username' => $row->username,
    			'isLoggedIn' => 1
    		);

    		$this->session->set_userdata($sessData);

    		return true;

    	}else{
    		return false;
    	}
    }


}