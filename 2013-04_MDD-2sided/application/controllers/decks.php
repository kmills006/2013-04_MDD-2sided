<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Decks extends CI_Controller {

	function __construct(){
		parent:: __construct();

		$this->load->model('decksModel');
		$this->load->model('tagsModel');
		$this->load->model('userModel');
	}

	public function index(){

		$data['decks'] = $this->decksModel->getAllDecks();
		$data['topTags'] = $this->tagsModel->getTopTags();
		$data['topUsers'] = $this->userModel->getTopUsers();

		// Setting the main content view to decks
		$data['view'] = 'decks';

		// Checking if there is a valid user session and load appropriate header
		if($this->session->userdata("isLoggedIn") == 1){

			// User is logged in, load loggedInHeader/Footer
			$this->load->view('includes/loggedInTemplate', $data);

		}else{
			
			// User is not logged in, load landingHeader/Footer
			$this->load->view('includes/landingTemplate', $data);
		}

	}


	// getAllDecks
	function getAllDecks(){
		$this->decks->getAllDecks();
	}


	// viewDecks
	public function userDecks($userID){
		$data['profileInfo'] = $this->userModel->getProfile($userID);
		$data['decks'] = $this->decksModel->getUsersDecks($userID);

		$data['view'] = 'userDecks';

		// Checking if there is a valid user session and load appropriate header
		if($this->session->userdata("isLoggedIn") == 1){

			$data['isLoggedIn'] = 1;

			// User is logged in, load loggedInHeader/Footer
			$this->load->view('includes/loggedInTemplate', $data);

		}else{
			
			$data['isLoggedIn'] = 0;

			// User is not logged in, load landingHeader/Footer
			$this->load->view('includes/landingTemplate', $data);
		}
	}


	// addNewDeck
	public function addNewDeck(){
		$data['view'] = 'addNewDeck';

		$this->load->view('includes/loggedInTemplate', $data);
	}


	// confirmAddNewDeck
	public function confirmAddNewDeck(){
		$newDeck['title'] = $_POST['dtitle'];
		$newDeck['tags'] = $_POST['tags'];
		$newDeck['privacy'] = $_POST['privacy'];

		// Form-Validation
		$this->load->library('form_validation');

		$config = array(
					array(
						'field' => 'dtitle',
						'label' => 'Deck Title',
						'rules' => 'required'
					)
		);

		$this->form_validation->set_rules($config);


		// If the form validation fails, throw error msg
		if($this->form_validation->run() == false){
			$this->addNewDeck();
		}else{

			// Add new deck
			$added = $this->decksModel->addNewDeck($newDeck);

			if(!$added){
				// Throw error msg on why the deck couldn't be added
			}else{
				$this->userDecks($this->session->userdata('userID'));
			}
		}
	}



}