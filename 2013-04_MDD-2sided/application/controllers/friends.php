<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friends extends CI_Controller {

	function __construct(){
		parent:: __construct();

		$this->load->model('friendsModel');
	}

	public function index(){

	}

	// addNewFriend
	// triggered whenever a user tries to add a new friend
	public function addNewFriend($userID, $friendID){
		$this->friendsModel->sendFriendRequest($userID, $friendID);
	}

	// acceptRequest
	// triggered when a user accepts a new friend request
	public function acceptRequest($requesterID, $userID){
		$this->friendsModel->acceptRequest($requesterID, $userID);
	}

	// rejectingUserID
	// triggered when a user rejects a friend request
	public function rejectRequest($requesterID, $userID){
		$this->friendsModel->rejectRequest($requesterID, $userID);
	}

} // end of friends class