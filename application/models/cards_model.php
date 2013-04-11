<?php
	class Cards_model extends CI_Model {
		
	    function __construct()
	    {
	        parent::__construct();

	        $this->load->database();
	    }

	    function getCards($deckID){
	    	$uid = $this->session->userdata("userid");

	    	$data_results = array(); 
	    	
	    	$this->db->select("*, DATE_FORMAT(decks.date_created, '%m/%d/%Y') AS formated_date", FALSE);
			$this->db->from("cards");
			$this->db->join("decks", "decks.deck_id = cards.deck_id");
			$this->db->join("users", "decks.user_id = users.user_id");
			$this->db->where("decks.deck_id", $deckID);

			$q = $this->db->get();

	   		if($q->num_rows() > 0){
	   			 foreach ($q->result() as $row)
				{	
				    $data_results[] = $row;
					//var_dump($data_results);
				}
				return $data_results;
	    	}else{
				// If no cards are return, get just the deck information
				$this->db->select("*, DATE_FORMAT(decks.date_created, '%m/%d/%Y') AS formated_date", FALSE);
				$this->db->from("decks");
				$this->db->where("decks.deck_id", $deckID);
				
				$n = $this->db->get();
				foreach($n->result() as $row){
					return $row;
				}
			}
	    }


		// new card
	    function newCard($newCard){
	    	$cardID = uniqid();
			
			var_dump($newCard);
			
		
			$data = array(
						"deck_id" => $newCard["deckID"],
						"card_id" => $cardID,
						"question" => $newCard["ques"],
						"answer" => $newCard["ans"]
					);

	    	$q = $this->db->insert("cards", $data);
	    	
	    	if($q){
	    		return true;
	    	}else{
	    		return false;
	    	}
	    }
		
		// delete card
		function deleteCard($cardID){
			$cardID = $cardID["cardID"];
			
			$q = $this->db->delete("cards", array("card_id" => $cardID));
			
			if($q){
	    		return true;
	    	}else{
	    		return false;
	    	}			
		}
		
		// edit question
		function editQuestion($editPost){
			$dateEdited = date('Y/m/d h:i:s', time());
			
			$data = array(
						"question" => $editPost["question"],
						"date_edited" => $dateEdited
			);
	
			$this->db->where("card_id", $editPost["cardID"]);
			$this->db->update("cards", $data);
		}
		
		// edit answer
		function editAnswer($editPost){
			$dateEdited = date('Y/m/d h:i:s', time());
			
			$data = array(
						"answer" => $editPost["answer"],
						"date_edited" => $dateEdited
			);
	
			$this->db->where("card_id", $editPost["cardID"]);
			$this->db->update("cards", $data);
		}
		// edit answer
		function getUserDecks($userID){
			$data_results = array();
			
			$this->db->select("*");
			$this->db->from("decks");
			$this->db->where("decks.user_id", $userID);

			$q = $this->db->get();

	   		if($q->num_rows() > 0){
	   			 foreach ($q->result() as $row)
				{	
				    $data_results[] = $row;
					
					//var_dump($row);
				}
	    	}else{
	    		//echo "No Results";
	    	}

	    	return $data_results;

		}
		
		function uploadImage($imageData){
			$imgPath = $imageData["upload_data"]["file_name"];	
		}
		
		
		
	}
?>