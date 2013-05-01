<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent:: __construct();

		$this->load->model('userModel');
		$this->load->model('friendsModel');
		$this->load->model('badgeModel');
		$this->load->model('tagsModel');
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
			/* User is logged in and going to his/her profile page */

			$userID = $this->session->userdata('userID');

			// Getting logged in users profile information
			$data['profileInfo'] = $this->userModel->getProfile($userID);
			$data['uploadImage'] = true;

			// Check for any new friend requests
			$data['friendRequests'] = $this->friendsModel->checkFriendRequests($userID);

			$this->load->view('includes/loggedInTemplate', $data);

		}elseif($isLoggedIn == 1 && $uri == $userID){

			redirect('user/profilePage');

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

		if($isLoggedIn == 1 && $uri != 'profilePage'){
			// echo "Viewing someone else's profile.";

			$viewersID = $this->session->userdata('userID');
			$profileOwnerID = $uri;

			$result = $this->userModel->increaseUserViewCount($viewersID, $profileOwnerID);
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

		$this->load->helper('getUserInfo.php');

		$data['view'] = 'friendsList';
		
		$data['userInfo'] = getUserInfo($userID);

		if($this->friendsModel->getFriendsList($userID)){
			$data['friendsList'] = $this->friendsModel->getFriendsList($userID);			
		}

		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';

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


	// badgeList
	// View a list of all of a users badges
	public function badgeList($userID){
		$data['badges'] = $this->badgeModel->getBadges($userID);
		$data['view'] = 'badgeList';

		echo '<pre>';
		print_r($data);
		echo '</pre>';

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


	// tagList
	// View a list of all of a users tags on their decks
	public function tagList($userID){
		$data['tags'] = $this->tagsModel->getTags($userID);
		$data['view'] = 'tagList';

		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';

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



}