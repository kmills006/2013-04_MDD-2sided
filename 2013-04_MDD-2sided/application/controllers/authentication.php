<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends CI_Controller {

	function __construct(){
		parent:: __construct();

		$this->load->model('authenticationModel');
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

			if($this->authenticationModel->isMember($fbUser)){

				$data = $this->authenticationModel->loginFbUser($fbUser);

				if(!$data){
					// No user found
				}else{
					// Send user to logged in screen
					redirect('user');
				}

			}else{
					$data = $this->authenticationModel->registerFromFacebook($fbUser);

					if(!$data){

						// Could not add user to the database
						// Present error message
						// If username is already taken in the database, have user select a different username

						echo "Username already exists in DB";

					}else{
						$result = $this->authenticationModel->loginFbUser($fbUser);
						
						if(!$result){
							// No Results Found
						}else{

							// Send user to logged in screen
							redirect('user');
						}						

					}
			}

		}
	}

} // end of authentication