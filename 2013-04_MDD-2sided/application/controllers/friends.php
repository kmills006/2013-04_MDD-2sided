<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friends extends CI_Controller {

	function __construct(){
		parent:: __construct();

		$this->load->model('userModel');
	}

	public function index(){

	}

	// addNewFriend
	public function addNewFriend($userID, $friendID){

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

		$this->db->insert('user_friends', $newFriendRequest);

	}

} // end of friends class