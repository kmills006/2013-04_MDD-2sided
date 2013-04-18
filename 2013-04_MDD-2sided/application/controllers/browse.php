<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Browse extends CI_Controller {

	function __construct(){
		parent:: __construct();

		$this->load->model('decksModel');
	}

	public function index(){

		echo "<pre>";
		print_r($this->session->all_userdata());
		echo '</pre>';

		$results = $this->decksModel->getAllDecks();

		if($results){
			$data['decks'] = $results;
		}else{
			// No Results Found
		}

		$data['view'] = 'browse';

		// If user is not logged in, load landingHeader/Footer
		$this->load->view('includes/landingTemplate', $data);

		// If user is logged in, load loggedInHeader/Footer
		// $this->load->view('include/loggedInTemplate', $data);
	}


	// getAllDecks
	function getAllDecks(){
		$this->decks->getAllDecks();
	}
}