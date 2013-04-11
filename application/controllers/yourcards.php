<?php

	class Yourcards extends CI_Controller{
		function __construct(){
			parent:: __construct();

			$this->load->model("cards_model");
			$this->load->helper(array('form', 'url'));
			$this->load->library('upload');
		}

		public function index(){
			$this->load->view("includes/userHeader");
			$this->load->view("cards");
			$this->load->view("includes/userFooter");
		}

		public function getcards($deckID){
			// User header
			$this->load->view("includes/userHeader");
			
			// User cards
			$c["cards"] = $this->cards_model->getCards($deckID);

			$this->load->view("cards", $c);

			// User footer
			$this->load->view("includes/userFooter");
		}


		//newcard
		public function newcard(){
			$r = $this->cards_model->newCard($_POST);
			echo $r;
		}
		
		// deletecard
		public function deletecard(){
			$r = $this->cards_model->deleteCard($_POST);
		}
		
		
		// editquestion
		public function editquestion(){
			$this->cards_model->editQuestion($_POST);
		}
		
		
		// editanswer
		public function editanswer(){
			$this->cards_model->editAnswer($_POST);
		}
	}

?>