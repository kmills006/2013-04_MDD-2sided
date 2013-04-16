<?php

	class User extends CI_Controller {
		function __construct(){
	        parent::__construct();

	        $this->load->model("Decks_model");
			$this->load->model("User_model");
	        $this->load->model("cards_model");
	    }

		function index(){

			// User Header
			$this->load->view("includes/userHeader");

			// User Content
			$q["userInfo"] = $this->User_model->loadUser();
			$q["decks"] = $this->Decks_model->getDecks();
			
			$this->load->view("yourdecks", $q);

			// User Footer
			$this->load->view("includes/userFooter");
		}

		public function createDecks(){
			// User Header
			$this->load->view("includes/userHeader");

			// Create Dates Content
			$this->load->view("createdeck");
			
			// User Footer
			$this->load->view("includes/userFooter");
		}
		
		public function createDeck(){
			$deckTitle = $_POST["dtitle"];
			$tags = $_POST["tags"];
			$privacy = $_POST["privacy"];
			
			// Form-Validation
			$this->load->library('form_validation');
			$config = array(
						array(
							"field" => "dtitle",
							"label" => "Deck Title",
							"rules" => "required"
						)
			);

			$this->form_validation->set_rules($config);
			
			$r = $this->Decks_model->newDeck($deckTitle, $tags, $privacy);
			
			if($r["query"] == TRUE){
				echo $r["deckid"];
			}else{
				$this->index();
			}
		}
		
		public function editDeck(){
			$r = $this->Decks_model->editDeck($_POST);
		}
		
		
		public function deleteDeck(){
			$r = $this->Decks_model->deleteDeck($_POST);	
		}

		// get voting
		public function getVote(){
			$this->load->model("Decks_model");
			$r = $this->Decks_model->getVotes($_POST);
			echo json_encode($r);
		}
		public function getUserName(){
			$this->load->model("Decks_model");
			$r = $this->Decks_model->getUserName($_POST);
			echo json_encode($r);
		}
		
	
		
		// do_upload
		// upload profile image
		public function do_upload(){
			$userID = $this->session->userdata("userid");
			
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_width']  = '0';
			$config['max_width']  = '1024';
			$config['max_height']  = '1000';
			$config["file_name"]  = $userID;
			$config["overwrite"] = true;
			
			$this->load->library('upload');
			$this->upload->initialize($config);
			
			if (!$this->upload->do_upload()){
				$error = array('error' => $this->upload->display_errors());
				$this->index();
				echo $error["error"];
			}else{
				$data = array('upload_data' => $this->upload->data());
				$r = $this->User_model->uploadImage($data);
				
				if(!$r){
					// echo "Error going into the DB";	
				}else{
					$this->index();	
				}
				
				// Creating thumbnail
				$config2['image_library'] = 'gd2';
				$config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
				$config2['new_image'] = './uploads/thumbs/';
				$config2['maintain_ratio'] = FALSE;
				$config2['create_thumb'] = TRUE;
				$config2['thumb_marker'] = '_thumb';
				$config2['width'] = 50;
				$config2['height'] = 50;
				$this->load->library('image_lib',$config2); 
				$this->image_lib->resize();
				
				if (!$this->image_lib->resize()){
					//echo $this->image_lib->display_errors();
				}
			}
		}

	}

?>