<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friends extends CI_Controller {

	function __construct(){
		parent:: __construct();

		$this->load->model('friendsModel');
	}

	public function index(){

	}

	// addNewFriend
	public function addNewFriend($userID, $friendID){
		$this->friendsModel->sendFriendRequest($userID, $friendID);
	}

	// acceptRequest
	public function acceptRequest($requesterID, $userID){
		echo "Friendship Accepted";

		$this->friendsModel->acceptRequest($requesterID, $userID);
	}

	// rejectingUserID
	public function rejectRequest($requesterID, $userID){
		echo "Friendship Rejected";

		$this->friendsModel->rejectRequest($requesterID, $userID);
	}

} // end of friends class