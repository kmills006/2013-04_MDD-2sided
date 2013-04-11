<?php

	class Login_model extends CI_Model {
	    function __construct()
	    {
	        parent::__construct();
	    }


	    public function validate(){
	    	$this->load->database();

	    	// get users information
	    	$un = $this->security->xss_clean($this->input->post("username"));
	    	$pass = $this->security->xss_clean($this->input->post("password"));

	    	// prep query
			$this->db->where("username", $un); 
	    	$this->db->where("pword", md5($pass));

	    	// run query
	    	$query = $this->db->get("users");


	    	if($query->num_rows == 1){
	    		$row = $query->row();
	    		
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

	    } // End of Validate


	}
?>