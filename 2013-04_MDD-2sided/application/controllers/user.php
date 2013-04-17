<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent:: __construct();

		$this->load->model('userModel');
	}

	public function index(){

	}


	// getDecks
	public function profilePage(){

		// spliting apart the uri string to get the userID
		$parts = explode('/',  uri_string());
		$userID = end($parts);

		$data['userProfile'] = $this->userModel->getProfile($userID);

		$data['view'] = 'userProfile';

		$this->load->view('includes/landingTemplate', $data);
 
	}



}