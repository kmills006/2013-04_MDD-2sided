<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent:: __construct();

		$this->load->model('userModel');
	}

	public function index(){

	}


	// profilePage
	public function profilePage(){

		/* We will need to check if the user is logged in or not, if they are friends
		with the person whose profile they are trying to look at or if they are viewing 
		their own profile */

		if($this->session->userdata('isLoggedIn') == 0){
			echo "User is not logged in";

			// spliting apart the uri string to get the userID
			$parts = explode('/',  uri_string());
			$userID = end($parts);

			$data['profileInfo'] = $this->userModel->getProfile($userID);

			$data['view'] = 'userProfile';

			$this->load->view('includes/landingTemplate', $data);
		}else{
			echo "here";
		}
 
	}




}