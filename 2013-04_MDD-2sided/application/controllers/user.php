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

		echo "Profile Page";

		$parts = explode('/',  uri_string());
		$uri = end($parts);

		// Setting the correct view
		$data['view'] = 'userProfile';



		/* We will need to check if the user is logged in or not, if they are friends
		with the person whose profile they are trying to look at or if they are viewing 
		their own profile */

		/* 
			Possible Profile Views

			- Non-logged in user viewing a profile
			- User first logs in and is directed to their profile page
			- User views another profile from decks/search/users pages
			- User views a friends profile

			-- Kolby, anymore you can think of please add! 

		*/


		// Checking how to load users profile
		if($this->session->userdata('isLoggedIn') == 0){
			/* There is no logged in user and they clicked on a username
			to view their profile and decks */

			echo "User is not logged in";

			// Setting the userID from the end of the uri_string to retrieve profile
			$data['profileInfo'] = $this->userModel->getProfile($uri);


			// $data['view'] = 'userProfile';

			$this->load->view('includes/landingTemplate', $data);

		}if($this->session->userdata('isLoggedIn') == 1 && $uri == 'profilePage'){
			/* User is logged in and coming straight from login screen, 
			they either logged in via Facebook or through 2sided */

			echo "</br>";
			echo "Login Successful, session started";

			$userID = $this->session->userdata('userID');

			$data['profileInfo'] = $this->userModel->getProfile($userID);

			$this->load->view('includes/loggedInTemplate', $data);

		}if($this->session->userdata('isLoggedIn') == 1 && $uri != 'profilePage'){
			/* User is logged in but viewing another users profile, still trying to
			figure out the best way to accomplish this */

			// Setting the userID from the end of the uri_string to retrieve profile
			$data['profileInfo'] = $this->userModel->getProfile($uri);

			$this->load->view('includes/loggedInTemplate', $data);

		}else{

		}
 
	}




	// viewAll
	// Users page allowing users to view all other users in the community
	// Can be views either logged in or not
	public function viewAll(){
		echo "viewAll";

		$data['view'] = 'users';

		switch($this->session->userdata('isLoggedIn')){
			case 0:
				$this->load->view('includes/landingTemplate', $data);

				echo "not logged in";
			break;

			case 1:
				$this->load->view('includes/loggedInTemplate', $data);

				echo "logged in";
			break;

			default:
				echo "default";
			break;
		};

	}




}