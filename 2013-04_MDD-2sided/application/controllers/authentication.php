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
					redirect('user/profilePage');
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
							// No user found
						}else{

							// Send user to logged in screen
							redirect('user/profilePage');
						}						

					}
			}

		}
	}




	// checkLogin
	public function checkLogin(){
		$this->load->library('form_validation');

		$config = array(
					array(
						'field' => 'username',
						'label' => 'Username',
						'rules' => 'required'
					), 
					array(
						'field' => 'password',
						'label' => 'Password',
						'rules' => 'required'
					)
		);

		$this->form_validation->set_rules($config);

		// If the form validation fails, return users to login screen w/ form error
		if($this->form_validation->run() == false){
			$data['view'] = 'authenticationView';

			$this->load->view('includes/landingTemplate', $data);
		}else{

			$result = $this->authenticationModel->loginUser();

			if(!$result){
				// Incorrect loggin information
				// Show error message

				echo "Incorrect login information, please try again.";
			}else{
				redirect('user/profilePage');
			}
		}

	}



	// registerNewUser
	public function registerNewUser(){
		$this->load->library('form_validation');

		$config = array(
					array(
						'field' => 'username',
						'label' => 'Username',
						'rules' => 'required|min_length[5]|max_length[20]'
					), 
					array(
						'field' => 'r-email',
						'label' => 'Email',
						'rules' => 'required'
					), 
					array(
						'field' => 'password',
						'label' => 'Password',
						'rules' => 'required|min_length[5]|max_length[20]'
					)
		);

		$this->form_validation->set_rules($config);

		// If the form validation fails, return users to register screen w/ form error
		if($this->form_validation->run() == false){
			$data['view'] = 'authenticationView';

			$this->load->view('includes/landingTemplate', $data);
		}else{

			$result = $this->authenticationModel->registerNewUser();

			if(!$result){
				// Could not create an account
				// Show error msg
				// Username already exists, please select another one
			}else{
				redirect('user/profilePage');
			}
		}
	}



	// userLogout
	public function userLogout(){

		$sessLogout = array('isLoggedIn' => 0);

		$sessData = array(
    			'userID' => null,
    			'email' => null,
    			'username' => null,
    			'isLoggedIn' => 0
    	);

    	$this->session->unset_userdata($sessData);

		redirect('decks');

	}

} // end of authentication