<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends CI_Controller {

	function __construct(){
		parent:: __construct();

		$this->load->model('decksModel');
		$this->load->model('userModel');
	}

	public function index(){
		$data['view'] = 'authenticationView';

		$this->load->view('includes/landingTemplate', $data);
	}


	// facebookRequest
	public function facebookRequest(){
		$this->load->library('fbconnect');

		$data = array(
			'redirect_uri' => site_url('authentication/handleFacebookLogin'),
			'scope' => 'email'
		);

		redirect($this->fbconnect->getLoginUrl($data));
	}


	// handleFacebookLogin
	public function handleFacebookLogin(){
		$this->load->library('fbconnect');

		if($this->fbconnect->user){
			// If user exists, check it against the database
			// If user is already in the database, direct them to their home page with all their decks
			// If user has never logged in before, add user to the database

			$fbUser = $this->fbconnect->user;

			if($this->userModel->isMember($fbUser)){
				echo "isMember";
			}else{
				echo "not member";
			};

		}
	}

} // end of authentication