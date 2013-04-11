<?php


class Browse extends CI_Controller {		
		public function index (){
			$this->load->model("Browse_model");
			
			if($this->session->userdata("is_logged_in") == 0){
				$this->session->sess_destroy();

				// Landing Header
				$this->load->view("includes/landingHeader.php");
				
				// Browse Content
				$q["allDecks"] = $this->Browse_model->getDesks();
				$this->load->view("browse.php", $q);
	
				// Landing Footer
				$this->load->view("includes/landingFooter.php");
			}else{
				// User Header
				$this->load->view("includes/userHeader.php");
	
				// Browse Content
				$q["allDecks"] = $this->Browse_model->getDesks();
				$this->load->view("browse.php", $q);
				//var_dump($q);
	
				// User Footer
				$this->load->view("includes/userFooter.php");
			}
		}



		// Takes user to the about page
		public function about(){
			$this->load->model("cards_model");
	
			if($this->session->userdata("is_logged_in") == 0){
				$this->session->sess_destroy();

				// Landing Header
				$this->load->view("includes/landingHeader.php");
				
				// About Content
				// Selected Decks Cards
				$deckID = '50f7812d8d18d';
				$c["cards"] = $this->cards_model->getCards($deckID);
				$this->load->view("about", $c);
	
				// Landing Footer
				$this->load->view("includes/landingFooter.php");
			}else{
				// User Header
				$this->load->view("includes/userHeader.php");
	
				// About Content
				// Selected Decks Cards
				$deckID = '50f7812d8d18d';
				$c["cards"] = $this->cards_model->getCards($deckID);
				$this->load->view("about", $c);
	
				// User Footer
				$this->load->view("includes/userFooter.php");
			}
		}
		
		
		
		// getcards
		public function getcards($deckID){
			$this->load->model("cards_model");
			
			if($this->session->userdata("is_logged_in") == 0){
				// Landing Header
				$this->load->view("includes/landingHeader.php");
				
				// Selected Decks Cards
				$c["cards"] = $this->cards_model->getCards($deckID);
				$this->load->view("browsecards", $c);
	
				// Landing Footer
				$this->load->view("includes/landingFooter.php");
			}else{
				// User header
				$this->load->view("includes/userHeader");
				
				// User cards
				$c["cards"] = $this->cards_model->getCards($deckID);
				
				//var_dump($c);
				$this->load->view("browsecards", $c);
	
				// User footer
				$this->load->view("includes/userFooter");	
			}
		}
		public function getDecks($userID){
			$this->load->model("cards_model");

			// User Header
			$this->load->view("includes/userHeader");

			// User Content
			$d["decks"] = $this->cards_model->getUserDecks($userID);
			//var_dump($d);
			$this->load->view("decks", $d);

			// User Footer
			$this->load->view("includes/userFooter");
		}
		
		// rating
		public function sendVote(){		
			$this->load->model("Decks_model");
			$r = $this->Decks_model->sendVote($_POST);
		}
		// get voting
		public function getVote(){
			$this->load->model("Decks_model");
			$r = $this->Decks_model->getVote($_POST);

			echo json_encode($r);
		}
		// check voting
		public function checkVote(){
			$this->load->model("Decks_model");
			$r = $this->Decks_model->checkVote($_POST);

			echo json_encode($r);
		}
		// search
		public function search(){
			$this->load->model("Decks_model");
			$r = $this->Decks_model->search($_POST);
			
			echo json_encode($r);
		}
		// get tags
		public function getTags(){
			$this->load->model("Decks_model");
			$r = $this->Decks_model->getTags();

			echo json_encode($r);
		}
		// get tags
		public function getDeckTags(){
			$this->load->model("Decks_model");
			$r = $this->Decks_model->getDeckTags($_POST);

			echo json_encode($r);
		}
		public function deleteTag(){
			$this->load->model("Decks_model");
			$r = $this->Decks_model->deleteTag($_POST);

			echo json_encode($r);
		}
}



