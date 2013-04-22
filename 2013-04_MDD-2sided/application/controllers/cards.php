<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cards extends CI_Controller {

	function __construct(){
		parent:: __construct();

		$this->load->model('cardsModel');
	}


	// viewCards
	public function getCards($userID, $deckID){

		$deckInfo['deckID'] = $deckID;
		$deckInfo['userID'] = $userID;

		$data['view'] = "viewCards";

		$data['cards'] = $this->cardsModel->getCards($deckInfo);

		// var_dump($data);

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






}