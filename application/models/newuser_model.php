<?php

	class Newuser_model extends CI_Model {
	    function __construct()
	    {
	        parent::__construct();
	    }

		public function check_if_username_exists($value, $variable) {
	        $this->db->select($value);
	        $this->db->where($value, $variable);

	        $query = $this->db->get('users');

	        if ($query->num_rows() > 0) {
	            //Value exists in database
	            return TRUE;
	        } else {
	            //Value doesn't exist in database
	            return FALSE;
	        }
	    }  

	    public function validate(){

	    	$this->load->database();

	    	// get users information
	    	$un = $this->security->xss_clean($this->input->post("username"));
	    	$email = $this->security->xss_clean($this->input->post("r-email"));
	    	$pass = $this->security->xss_clean($this->input->post("password"));
	    	$dateofreg = date("Y-m-d");
			$userID = uniqid();

			$exi = $this->check_if_username_exists('username', $un);

			if(!$exi){
				// prep query
				$data = array(
							"user_id" => $userID,
							"email" => $email,
							"username" => $un,
							"pword" => md5($pass),
							"date_of_reg" => $dateofreg
						);

		     	// run query
		    	$query = $this->db->insert("users", $data);
		    	return true;
			}else{
				return false;
			}

	    } // End of Validate


	}
?>