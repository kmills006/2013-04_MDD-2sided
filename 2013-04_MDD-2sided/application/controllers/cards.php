<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cards extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('userModel');
		$this->load->model('cardsModel');
	}


	// viewCards
	public function getCards($userID, $deckID){

		$deckInfo['deckID'] = $deckID;
		$deckInfo['userID'] = $userID;

		$data['view'] = "viewCards";
		$data['profileInfo'] = $this->userModel->getProfile($userID);
		$data['cards'] = $this->cardsModel->getCards($deckInfo);
		$data['userID'] = $userID;
		$data['deckID'] = $deckID;

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




	// addNewCard
	 public function addNewCard(){
		$this->cardsModel->addNewCard($_POST);
	} 

	// deletecard
	public function deleteCard(){
		$this->cardsModel->deleteCard($_POST);
	}
	
	
	// editquestion
	public function editQuestion(){
		$this->cardsModel->editQuestion($_POST);
	}
	
	
	// editanswer
	public function editAnswer(){
		$this->cardsModel->editAnswer($_POST);
	}

	// check vote
	public function checkVote(){
		$r = $this->cardsModel->checkVote($_POST);

		echo json_encode($r);
	}

	// send vote
	public function sendVote(){
		$r = $this->cardsModel->sendVote($_POST);

		echo json_encode($r);
	}
	// send vote
	public function cancelVote(){
		$r = $this->cardsModel->cancelVote($_POST);

		echo json_encode($r);
	}
}