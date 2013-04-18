<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Decks extends CI_Controller {

	function __construct(){
		parent:: __construct();

		$this->load->model('decksModel');
	}

	public function index(){

		// echo "<pre>";
		// print_r($this->session->all_userdata());
		// echo '</pre>';

		$results = $this->decksModel->getAllDecks();

		if($results){
			$data['decks'] = $results;
		}else{
			// No Results Found
		}

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
		$data['decks'] = $this->decksModel->getUsersDecks($userID);

		$data['view'] = 'userDecks';

		$this->load->view('includes/loggedInTemplate', $data); 
	}
}