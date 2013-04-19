<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifications extends CI_Controller {

	function __construct(){
		parent:: __construct();

		$this->load->model('userModel');
		$this->load->model('friendsModel');
	}

	public function index(){

	}


	// checkNew
	public function checkNewNotifications(){

		$getRequests = $this->friendsModel->checkFriendRequests($this->session->userdata('userID'));

		$data['friendRequests'] = $this->friendsModel->getFriendRequests($getRequests);

		$data['view'] = 'notificationsView';

		$this->load->view('includes/loggedInTemplate', $data);
	}




} // end of notifications class