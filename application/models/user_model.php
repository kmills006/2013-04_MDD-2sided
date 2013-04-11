<?php

	class User_model extends CI_Model {
	    function __construct()
	    {
	        parent::__construct();
			
			$this->load->database();
	    }
		
		function loadUser(){
			$userID= $this->session->userdata("userid");
			
			$q = $this->db->get_where("users", array("user_id" => $userID));
		
			if($q->num_rows() > 0){
	   			 foreach ($q->result() as $row)
				{	
				    $data_results[] = $row;
					//var_dump($data_results);
				}
				return $data_results;
			}else{
				// No Results	
			}
		}
		
		
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
		