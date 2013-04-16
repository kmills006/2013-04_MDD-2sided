<?php

	class Cards extends CI_Controller{
		function __construct(){
			parent:: __construct();

			$this->load->model("cards_model");
			$this->load->model("Decks_model");
		}

		public function index(){
			$this->load->view("includes/userHeader");
			$this->load->view("browsecards");
			$this->load->view("includes/userFooter");
		}

		public function getcards($deckID){
			// User header
			$this->load->view("includes/userHeader");
			
			// User cards
			$c["cards"] = $this->cards_model->getCards($deckID);

			$this->load->view("browsecards", $c);

			// User footer
			$this->load->view("includes/userFooter");
		}
	}

?>