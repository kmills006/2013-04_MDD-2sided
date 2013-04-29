<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent:: __construct();

		$this->load->model('userModel');
		$this->load->model('friendsModel');
	}

	public function index(){

	}


	// profilePage
	public function profilePage(){

		$parts = explode('/',  uri_string());
		$uri = end($parts);

		$isLoggedIn = $this->session->userdata('isLoggedIn');

		// Setting the correct view
		$data['view'] = 'userProfile';

		if($this->session->userdata('userID')){
			$userID = $this->session->userdata('userID');
		}


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
		if($isLoggedIn == false){
			/* There is no logged in user and they clicked on a username
			to view their profile and decks */

			// Setting the userID from the end of the uri_string to retrieve profile
			$data['profileInfo'] = $this->userModel->getProfile($uri);

			$this->load->view('includes/landingTemplate', $data);

		}if($isLoggedIn == 1 && $uri == 'profilePage'){
			/* User is logged in and coming straight from login screen, 
			they either logged in via Facebook or through 2sided */

			$userID = $this->session->userdata('userID');

			// Getting logged in users profile information
			$data['profileInfo'] = $this->userModel->getProfile($userID);

			// Check for any new friend requests
			$data['friendRequests'] = $this->friendsModel->checkFriendRequests($userID);

			$this->load->view('includes/loggedInTemplate', $data);

		}elseif($isLoggedIn == 1 && $uri == $userID){

			redirect('user/profilePage');
			// $this->profilePage();

		}elseif($isLoggedIn == 1 && $uri != $userID){
			/* User is logged in but viewing another users profile, still trying to
			figure out the best way to accomplish this */

			// Sending the userID from the end of the uri_string to retrieve profile
			$data['profileInfo'] = $this->userModel->getProfile($uri);

			/* Check if the the logged in user is friends with the user 
			whose profile they are about to view */
			$data['areFriends'] = $this->friendsModel->checkFriendship($uri);

			$this->load->view('includes/loggedInTemplate', $data);

		}else{

		}
 
	}


	// viewAll
	// Users page allowing users to view all other users in the community
	// Can be viewed either logged in or not
	public function viewAll($sortBy){
		
		// Setting the correct view
		$data['view'] = 'users';

		// Retrieving all users from database
		$data['users'] = $this->userModel->getAll($sortBy);


		// Checking whether user is logged in or not to determine which header to use
		switch($this->session->userdata('isLoggedIn')){
			case 0:
				$this->load->view('includes/landingTemplate', $data);
			break;

			case 1:
				$this->load->view('includes/loggedInTemplate', $data);
			break;

			default:

			break;
		};

	}


	// userSearch
	// Users can search through all the users in the community from the users page
	public function userSearch(){
		$searchQuery = $_POST;

		$searchResults = $this->userModel->userSearch($searchQuery);

		echo json_encode($searchResults);
	}


	// friendList
	// View a list of all of a users friends
	public function friendList($userID){

		$data['friendsList'] = $this->friendsModel->getFriendsList($userID);

		echo '<pre>';
		print_r($data);
		echo '</pre>';
		
	}



}