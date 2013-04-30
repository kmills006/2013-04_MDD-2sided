<?

class TagsModel extends CI_Model {

   function __construct(){
        parent::__construct();

        $this->load->helper('objectToArray.php');
    }

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


} // end of tags model