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
		$result = $this->friendsModel->sendFriendRequest($userID, $friendID);

		if(!$result){
			// Could not be added
			echo "Could not be added.";
		}else{
			// Success, friend request pending
			redirect('user/profilePage/'.$friendID);
		}

	}

	// acceptRequest
	// triggered when a user accepts a new friend request
	public function acceptRequest($requesterID, $userID){
		$data = $this->friendsModel->acceptRequest($requesterID, $userID);

		redirect('user/profilePage/'.$requesterID);
	}

	// rejectingUserID
	// triggered when a user rejects a friend request
	public function rejectRequest($requesterID, $userID){
		$this->friendsModel->rejectRequest($requesterID, $userID);
	}

} // end of friends class