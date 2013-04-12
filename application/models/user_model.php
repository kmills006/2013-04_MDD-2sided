<?php

	class User_model extends CI_Model {

	    function __construct(){
	        parent::__construct();
			
			$this->load->database();
	    }



	    /* LOGIN/REGISTER
	    -----------------------
	   	-----------------------
	   	---------------------*/



	    // checkIfUsernameExists
	    // Checks if username already exists
		function check_if_username_exists($value, $variable) {
	        $this->db->select($value);
	        $this->db->where($value, $variable);

	        $query = $this->db->get('users');

	        if ($query->num_rows() > 0) {
	            return TRUE;
	        } else {
	            return FALSE;
	        }
	    }  



	    // isMember
	    // Checks if users is already a member of 2Sided
	    function isMemeber($facebookUser){

	    	$q = $this->db->get_where('users', array('email' => $facebookUser['email']));

	    	if($q->num_rows() == 1){
	    		
	    		foreach($q->result() as $row){
	    			$data_results[] = $row;
	    		}

	    		return $data_results;

	    	}else{
	    		// No Results
	    	}
	    }



	    // registerFromFacebook
	    // If user doesn't exist, add user to the database
	    function registerFromFacebook($facebookUser){

	    	$un = $this->security->xss_clean($facebookUser['username']);
	    	$email = $this->security->xss_clean($facebookUser['email']);
	    	$fbID = $this->security->xss_clean($facebookUser['id']);
	    	$dateofreg = date("Y-m-d");
			$userID = uniqid();

			$exi = $this->check_if_username_exists('username', $un);

			if(!$exi){
				$data = array(
					"user_id" => $userID,
					"email" => $email,
					"username" => $un,
					"facebook_id" => $fbID,
					"date_of_reg" => $dateofreg
				);

		    	$q = $this->db->insert("users", $data);

		    	return true;

			}else{
				return false;
			}

	    }


	    // registerNewUser
	    // Submit new user to the database
	    function registerNewUser(){
	    	$un = $this->security->xss_clean($this->input->post("username"));
	    	$email = $this->security->xss_clean($this->input->post("r-email"));
	    	$pass = $this->security->xss_clean($this->input->post("password"));
	    	$dateofreg = date("Y-m-d");
			$userID = uniqid();

			$exi = $this->check_if_username_exists('username', $un);

			if(!$exi){
				$data = array(
					"user_id" => $userID,
					"email" => $email,
					"username" => $un,
					"pword" => md5($pass),
					"date_of_reg" => $dateofreg
				);

		    	$q = $this->db->insert("users", $data);

		    	$sdata = array(
					"userid" => $userID,
					"email" => $email,
					"username" => $un,
					"is_logged_in" => 1,
					"validated" => true
    			);

	    		$this->session->set_userdata($sdata);

		    	return true;
			
			}else{
				// Username already exists
				return false;
			}

	    }




	    // loginFacebookUser
	    // Login Facebook user
	    function loginFacebookUser($facebookUser){
	    	$this->db->where('username', $facebookUser['username']);
	    	$this->db->where('email', $facebookUser['email']);

	    	$q = $this->db->get("users");

	    	if($q->num_rows == 1){

	    		foreach($q->result() as $row){
					$data_results[] = $row;
				}
			    
			    $sdata = array(
					"userid" => $row->user_id,
					"email" => $row->email,
					"username" => $row->username,
					"is_logged_in" => 1,
					"validated" => true
				);

				$this->session->set_userdata($sdata);

				return true;

	    	}else{
	    		// No Results
	    	}
	    }



	    // loginUser
	    function loginRegularUser(){
	    	// echo "loginRegularUser";

	    	$un = $this->security->xss_clean($this->input->post("username"));
	    	$pass = $this->security->xss_clean($this->input->post("password"));

			$this->db->where("username", $un); 
	    	$this->db->where("pword", md5($pass));

	    	$q = $this->db->get("users");


	    	if($q->num_rows == 1){
	    		$row = $q->row();
	    		
	    		$sdata = array(
					"userid" => $row->user_id,
					"email" => $row->email,
					"username" => $row->username,
					"is_logged_in" => 1,
					"validated" => true
    			);

	    		$this->session->set_userdata($sdata);
				
	    		return true;

	    	}else{
	    		return false;
	    	}
	    }


		/* USER IS LOGGED IN
	    -----------------------
	   	-----------------------
	   	---------------------*/


		// loadUser
		// Load user information
		function loadUser(){
			$userID= $this->session->userdata("userid");
			
			$q = $this->db->get_where("users", array("user_id" => $userID));
		
			if($q->num_rows() > 0){
	   			 foreach ($q->result() as $row){	
				    $data_results[] = $row;
				}
				return $data_results;
			}else{
				// No Results	
			}
		}
		

		
		// uploadImage
		// Upload user profile picture
		function uploadImage($img){
			$userID= $this->session->userdata("userid");
			$fileName = $img["upload_data"]["file_name"];
			
			$data = array(
				"profile_img" => $fileName
			);
				
			$this->db->where("user_id", $userID);
			$q = $this->db->update("users", $data);
			
			if(!$q){
				return false;	
			}else{
				return true;	
			}
		}




		
	}
		