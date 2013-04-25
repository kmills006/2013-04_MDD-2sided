<?

class CardsModel extends CI_Model {

    function __construct(){
        parent::__construct();

        $this->load->helper('objectToArray.php');
    }


    // getCards
    public function getCards($deckInfo){
		$this->db->select("u.username, d.date_created, c.question, c.answer, d.deck_id, c.card_id, DATE_FORMAT(d.date_created, '%m/%d/%Y') AS formated_date", FALSE);
		$this->db->from("cards as c");
		$this->db->join("decks as d", "d.deck_id = c.deck_id");
		$this->db->join("users as u", "d.user_id = u.user_id");
		$this->db->join('ratings as r', 'd.deck_id = r.deck_id');
		$this->db->where("d.deck_id", $deckInfo['deckID']);
		$this->db->group_by('c.card_id');

		$query = $this->db->get();

		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$dataResults[] = $row; 
			}

            $dataResults = objectToArray($dataResults);
            
            // echo '<pre>';
            // print_r($dataResults);
            // echo '</pre>';

			return $dataResults;

		}else{

			return false;

		}
    }

    // addNewCard
    public function addNewCard($newCard){
    	$cardID = uniqid();

    	$data = array(
    					'deck_id' => $newCard['deckID'],
    					'card_id' => $cardID,
    					'question' => $newCard['question'],
    					'answer' => $newCard['answer']
    	);

    	$q = $this->db->insert('cards', $data);

    	if(!$q){
    		// New card could not be added
    		return false;
    	}else{
    		return true;
    	}
    }

    // edit question
    public function editQuestion($editPost){
        $dateEdited = date('Y/m/d h:i:s', time());
        
        $data = array(
                    "question" => $editPost["question"],
                    "date_edited" => $dateEdited
        );

        $this->db->where("card_id", $editPost["cardID"]);
        $this->db->update("cards", $data);
    }

    // editAnswer
    public function editAnswer($editPost){
        $dateEdited = date('Y/m/d h:i:s', time());
        
        $data = array(
                    "answer" => $editPost["answer"],
                    "date_edited" => $dateEdited
        );

        $this->db->where("card_id", $editPost["cardID"]);
        $this->db->update("cards", $data);
    }

    // delete card
    public function deleteCard($cardID){
        $cardID = $cardID["cardID"];
        
        $q = $this->db->delete("cards", array("card_id" => $cardID));
        
        if($q){
            return true;
        }else{
            return false;
        }           
    }

    // Check Vote
    public function checkVote($post){
        $deckID = $post["deckID"];
        
        $userID = $this->session->userdata('userID');

        $this->db->select("*");
        $this->db->from("ratings");

        $this->db->where("deck_id", $deckID);
        $this->db->where("user_id", $userID);

        $query = $this->db->get();

        if($query->num_rows() > 0){
             foreach ($query->result() as $row)
            {   
               $data_results[] = $row;
            }

            return $data_results;
        }else{
            return false;
        }
    }
    public function check_if_rating_exists($deckID, $userID){
        $q = $this->db->get_where("ratings", array("deck_id" => $deckID,
                                                   "user_id" => $userID));
                                                   
        if ($q->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }  

    // Send Vote
    public function sendVote($vote){
        $dateVoted = date('Y/m/d h:i:s', time());
        $userID = $this->session->userdata("userID");
        
        if(!$userID){
            echo "login";
        }else{

            $rating_id = uniqid();
            $data = array(
                        "deck_id" => $vote["deckID"],
                        "rating_id" => $rating_id,
                        "user_id" => $userID,
                        "rating" => 1,
                        "date_rated" => $dateVoted
            );
            
            $q = $this->db->insert("ratings", $data);   
        }
    }

    public function cancelVote($vote){

        $dateEdited = date('Y/m/d h:i:s', time());
        $userID = $this->session->userdata("userID");
        $deckID = $vote["deckID"];

        if(!$userID){
            echo "login";
        }else{
                
            $this->db->where("deck_id", $deckID);
            $this->db->where("user_id", $userID);
            $query = $this->db->delete("ratings");

            if(!$query){
                // Could not delete deck
                return false;
            }else{
                // Successfully removed deck and all information
                return true;
            }
        } 
    }
}
