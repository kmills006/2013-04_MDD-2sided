<?

class TagsModel extends CI_Model {

   function __construct(){
        parent::__construct();

        $this->load->helper('objectToArray.php');
    }

    // getTopTags
    // Retrieve the top 6 tags used site wide to show on the landing page
   function getTopTags(){
   	 $this->db->select('tagName, COUNT(tagName) as tagCount');
   	 $this->db->from('tags');
   	 $this->db->limit('6');
   	 $this->db->order_by("tagCount", "desc"); 
   	 $this->db->group_by('tagName');

   	 $query = $this->db->get();

   	 if($query->num_rows > 0){
   	 	foreach($query->result() as $row){
   	 		$dataResults[] = $row;
   	 	} 

         $dataResults = objectToArray($dataResults);

   	 	return $dataResults;
   	 	
   	 }else{

   	 	return false;

   	 }
   }


   // getTags
   // Retrieve a list of all tags associated with a users decks
   function getTags($userID){
      $this->db->select('u.user_id, t.tagName, COUNT(t.tagName) as numberOfTags');
      $this->db->join('decks as d', 't.deck_id = d.deck_id');
      $this->db->join('users as u', 'd.user_id = u.user_id');
      $this->db->where('d.privacy', 0);
      $this->db->where('u.user_id', $userID);
      $this->db->group_by('t.tagName');

      $query = $this->db->get('tags as t');

      if($query->num_rows() > 0){
        foreach($query->result() as $row){
          $dataResults[] = $row;
        }

        $dataResults = objectToArray($dataResults);

        return $dataResults;

      }else{

        return false;

      }
      
   }


} // end of tags model