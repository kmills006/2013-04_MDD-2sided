<?php

	class Decks_model extends CI_Model {
	    function __construct()
	    {
	        parent::__construct();

	        $this->load->database();
	    }
		
		
		public function check_if_rating_exists($deckID, $userID) {
			$q = $this->db->get_where("ratings", array("deck_id" => $deckID,
													   "user_id" => $userID));
													   
	        if ($q->num_rows() > 0) {
	            return TRUE;
	        } else {
	            return FALSE;
	        }
	    }  
		
		// Get All Decks
	    public function getDecks(){			
			$data_results = array();
			$userID= $this->session->userdata("userid");
			
			$this->db->select("*, users.profile_img");
			$this->db->from("decks");
			$this->db->join("users", "decks.user_id = users.user_id");
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



		// Get Single Deck
		public function getDeck($deckID){
			$data_results = array();


			$this->db->select("*, DATE_FORMAT(decks.date_created, '%m/%d/%Y') AS formated_date", FALSE);
			$this->db->from("decks");
			$this->db->where("deck_id", $deckID);

			$q = $this->db->get();
	    	
	    	if($q->num_rows() > 0){
	   			 foreach ($q->result() as $row)
				{	
				    $data_results[] = $row;
				}

				return $data_results;
	    	}else{
	    		
	    	}
	    	
	    	return $data_results;
		}



		// Add New Deck
	    public function newDeck($deckTitle, $tags,  $privacy){		
	    	$uid = $this->session->userdata("userid");
	    	$deckid = uniqid();
			
	    	if($privacy == "Public"){
	    		$privacy = 0;
	    	}else{
	    		$privacy = 1;
	    	}
			
	    	$data = array(
	    				"deck_id" => $deckid,
	    				"user_id" => $uid,
	    				"title" => $deckTitle,
	    				"privacy" => $privacy
	    	);

	    	$query = $this->db->insert("decks", $data);
			
			$tagsData = array();

	    	if($query){
				
				// inserting tags into DB
				foreach($tags as $tag){
					$tagID = uniqid();
				
					$tagData = array("deck_id" => $deckid, "tag_id" => $tagID, "tagName" => $tag);
					
					$tagsData[] = $tagData;
				};
		
				foreach($tagsData as $tag){
						$this->db->insert("tags", $tag);
				};
				
				// inserting UPVOTE for user into DB
				$dateRated = date('Y/m/d h:i:s', time());
				$userUpvote = array("deck_id" => $deckid,
									"rating_id" => uniqid(), 
									"user_id" => $uid,
									"rating" => 1,
									"date_rated" => $dateRated
				);
				$this->db->insert("ratings", $userUpvote);
				
				$ra = array("query" => $query, "deckid" => $deckid);
	    		return $ra;
	    	}else{
	    		return false;
	    	}
	    }
		
		
		// Edit Deck
		public function editDeck($deck){
			$deckID = $deck["deckID"];
			$dateEdited = date('Y/m/d h:i:s', time());
			$newTitle = $deck["newDeckName"];
			$newPrivacy = $deck["newPrivacy"];
			
			$data = array(
						"date_edited" => $dateEdited,
						"privacy" => $newPrivacy,
						"title" => $newTitle
			);
			
			$this->db->where("deck_id", $deckID);
			$this->db->update("decks", $data);
			
			//$q = $this->db->get();
			
			//return $q;
		}
		
		
		// Search Deck
		public function search($searchQuery){
			$search = $searchQuery["title"];
			
			$this->db->distinct();
			$this->db->select("decks.deck_id, decks.title");
			$this->db->join("tags", "decks.deck_id = tags.deck_id");
			$this->db->like("decks.title", $search);
			$this->db->or_like("tags.tagName", $search);
			$q = $this->db->get("decks");
	
		 	if($q->num_rows() > 0){
	   			 foreach ($q->result() as $row)
				{	
				   //$data_results[] = $row;
					$data_results[] = array("deckID" => $row->deck_id,
										  "deckTitle" => $row->title);
				}

				return $data_results;
	    	}else{
	    		echo "No Search Results";
	    	}
		}
		
		
		
		// Send Vote
		public function sendVote($vote){
			$dateVoted = date('Y/m/d h:i:s', time());
			$userID = $this->session->userdata("userid");
			
			if(!$this->session->userdata("userid")){
				echo "/login/";
			}else{
				if($vote["vote"] == "true"){
					$vote["vote"] = 1;
				}else if($vote["vote"] == "false"){
					$vote["vote"] = 0;
			}
				
					
				// checking if user has already voted on this certain deck
				// if they have, only UPDATE their vote
				// if they haven't, INSERT their vote
				$checkUser = $this->check_if_rating_exists($vote["deckID"], $userID);
				
				if($checkUser == TRUE){
					$data = array(
								"rating" => $vote["vote"],
								"date_rated" => $dateVoted
							);
						
					$this->db->where("deck_id", $vote["deckID"]);
					$this->db->where("user_id", $userID);
					$this->db->update("ratings", $data); 	
				}else{
					$rating_id = uniqid();
					$data = array(
						"deck_id" => $vote["deckID"],
						"rating_id" => $rating_id,
						"user_id" => $userID,
						"rating" => $vote["vote"],
						"date_rated" => $dateVoted
					);
					
					$q = $this->db->insert("ratings", $data);
				}
				
				//echo "/browse/getcards/".$vote["deckID"];
			}
		}
		
		// getVote
		public function getVote($post){
			$deckID = $post["deckID"];

			$this->db->select("COUNT(rating) as totalVotes");
			$this->db->from("ratings");
			$this->db->where("deck_id", $deckID);
			$this->db->where("rating", 1);

			$q = $this->db->get();

		 	if($q->num_rows() > 0){
	   			 foreach ($q->result() as $row)
				{	
				   $data_results[] = $row;
				}

				return $data_results;
	    	}else{
	    		echo "No Search Results";
	    	}
		}




		// GET VOTES
		public function getVotes($post){
			$deckID = $post['deckID'];


			$this->db->select("COUNT(rating) as r");
			$this->db->from("ratings");
			$this->db->where("deck_id", $deckID);
			$this->db->where("rating", 1);

			$q = $this->db->get();

		 	if($q->num_rows() > 0){
	   			 foreach ($q->result() as $row)
				{	
				   $data_results[] = $row;
				}

				return $data_results;
	    	}else{
	    		echo "No Search Results";
	    	}
		}

		public function checkVote($post){
			$deckID = $post["deckID"];
			
			$userID= $this->session->userdata("userid");

			$this->db->select("rating as checkVote");
			$this->db->from("ratings");
			$this->db->join("users", "users.user_id = ratings.user_id");

			$this->db->where("deck_id", $deckID);
			$this->db->where("ratings.user_id", $userID);

			$q = $this->db->get();

		 	if($q->num_rows() > 0){
	   			 foreach ($q->result() as $row)
				{	
				   $data_results[] = $row;
				}

				return $data_results;
	    	}else{
	    		echo "No Search Results";
	    	}
		}
		
		
		// deleteDeck
		public function deleteDeck($post){
			$deckID = $post["deckID"];
			$tables = array('ratings', 'tags', 'cards', 'decks');
			$this->db->where('deck_id', $deckID);
			$this->db->delete($tables);
		}

		// getTags
		public function getTags(){

			$this->db->select("COUNT(tagName) as count, tagName");
			$this->db->from("tags");
			$this->db->group_by("tagName"); 
			$this->db->order_by("COUNT(tagName)", "desc"); 
			$this->db->limit(12);

			$q = $this->db->get();

		 	if($q->num_rows() > 0){
	   			 foreach ($q->result() as $row)
				{	
				   $data_results[] = $row;
				}

				return $data_results;
	    	}else{
	    		echo "No Search Results";
	    	}
		}
		// getTags for a deck
		public function getDeckTags($post){
			$deckID = $post["deckID"];

			$this->db->select("COUNT(tagName) as count, tagName, tag_id");
			$this->db->from("tags");
			$this->db->group_by("tagName"); 
			$this->db->order_by("COUNT(tagName)", "desc"); 
			$this->db->where('deck_id', $deckID);

			$q = $this->db->get();

		 	if($q->num_rows() > 0){
	   			 foreach ($q->result() as $row)
				{	
				   $data_results[] = $row;
				}

				return $data_results;
	    	}else{
	    		echo "No Search Results";
	    	}
		}
		public function deleteTag($post){
			$deckID = $post["tagID"];

			$this->db->delete('tags', array('tag_id' => $deckID)); 

			return 'nice';
		}
		public function getUserName($post){
			$userID = $post["userID"];

			$this->db->select("username");
			$this->db->from("users");
			$this->db->where('user_id', $userID);

			$q = $this->db->get();

		 	if($q->num_rows() > 0){
	   			 foreach ($q->result() as $row)
				{	
				   $data_results[] = $row;
				}

				return $data_results;
	    	}else{
	    		echo "No Search Results";
	    	}
			
		}
	} 
?>