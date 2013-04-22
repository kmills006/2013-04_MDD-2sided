<?

class CardsModel extends CI_Model {

    function __construct(){
        parent::__construct();
    }


    // getCards
    public function getCards($deckInfo){
    		$this->db->select("u.username, d.date_created, c.question, c.answer, d.deck_id, DATE_FORMAT(d.date_created, '%m/%d/%Y') AS formated_date", FALSE);
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

				echo "<pre>";
				print_r($dataResults);
				echo "</pre>";

			}else{

			}
    }



}
