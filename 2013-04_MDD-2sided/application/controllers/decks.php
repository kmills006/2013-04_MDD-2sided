<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Decks extends CI_Controller {

	function __construct(){
		parent:: __construct();

		$this->load->model('decksModel');
		$this->load->model('tagsModel');
		$this->load->model('userModel');

		$this->load->library("pagination");

	}

	public function index(){

		$this->getAllDecks();
		
	}


	public function getAllDecks(){
		$totalDecks = $this->decksModel->getDecksCount();


		// Setting up pagination
		$config = array();
        $config["base_url"] = base_url()."/index.php/decks/getAllDecks";
        $config["total_rows"] = $this->decksModel->getDecksCount();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);
       
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['decks'] = $this->decksModel->fetchDecks($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        // Pulling both the top tags and top users for landing page display
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


	// viewDecks
	public function userDecks($userID){
		$data['profileInfo'] = $this->userModel->getProfile($userID);
		$data['decks'] = $this->decksModel->getUsersDecks($userID);

		$data['view'] = 'userDecks';

		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';

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
		$newDeck['title'] = $_POST['title'];
		$newDeck['tags'] = $_POST['tags'];
		$newDeck['privacy'] = $_POST['privacy'];

		// Form-Validation
		$this->load->library('form_validation');

		$config = array(
					array(
						'field' => 'title',
						'label' => 'Deck Title',
						'rules' => 'required'
					)
		);

		$this->form_validation->set_rules($config);


		// If the form validation fails, throw error msg
		if($this->form_validation->run() == false){
			$this->addNewDeck();
		}else{

			$userID = $this->session->userdata('userID');

			// Add new deck
			$deck = $this->decksModel->addNewDeck($newDeck);
			$deck['userID'] = $userID;
			
			if(!$deck){
				// Throw error msg on why the deck couldn't be added
			}else{
				echo json_encode($deck);
			}
		}
	}

	public function editDeckTitle(){
		$r = $this->decksModel->editDeckTitle($_POST);
	}
	
	public function editDeckPrivacy(){
		$r = $this->decksModel->editDeckPrivacy($_POST);
	}
	
	public function deleteDeck(){
		$r = $this->decksModel->deleteDeck($_POST);	
	}
	public function search(){
		$r = $this->decksModel->search($_POST);
		
		echo json_encode($r);
	}
}