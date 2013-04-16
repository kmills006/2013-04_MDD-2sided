<?php

	class Browse_model extends CI_Model {
	    function __construct()
	    {
	        parent::__construct();
			
			$this->load->database();
	    }
		
		
		// Check if the deck has cards in it
		public function check_if_cards_exist($deckID) {
			$q = $this->db->get_where("cards", array("deck_id" => $deckID));
													   
	        if ($q->num_rows() > 0) {
	            return TRUE;
	        } else {
	            return FALSE;
	        }
	    }  


	    // Get All Desk
	    function getDesks(){
			$this->db->select("decks.deck_id, COUNT(rating) as rating, users.user_id, users.username, decks.title");
			$this->db->from("decks");
			$this->db->join("users", "decks.user_id = users.user_id");
			$this->db->join("ratings", "decks.deck_id = ratings.deck_id");
			$this->db->where("decks.privacy", 0);
			$this->db->where("rating", 1);
			$this->db->group_by("deck_id");
			$this->db->order_by("rating", "desc"); 

			$q = $this->db->get();
			
	    	// if db has more than 0 rows, run
	   		if($q->num_rows() > 0){
	   			 foreach ($q->result() as $row){
					// checking if there are cards in the decks
					$check = $this->check_if_cards_exist($row->deck_id);
					
					if($check){	
						$data_results[] = $row;
					}else{
						// No Cards in Deck	
					}
				}
	    	}else{
	    		//echo "No Results";
	    	}
			return $data_results;
			
	    } // end of getDecks()

	} // end of class

?>