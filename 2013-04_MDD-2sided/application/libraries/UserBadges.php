<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserBadges
{

  	protected $ci;
 	public $badgeID = null;
  	public $badgeInfo = null;

	public function __construct($badgeID){
        $badgeID = $badgeID;

        if(isset($badgeID)){
        	$this->getBadgeInformation($badgeID);
        }
	}


	// getBadgeInformation
	function getBadgeInformation($badgeID){

		$ci =& get_instance();

		$ci->db->select('*');
		$ci->db->where('badge_id', $badgeID['badgeID']);
		$q = $ci->db->get('badges');
		
		if(!$q->row()){
		    // No badge found;
		}else{
		    $this->badgeInfo = $q->row();
		} 
	}

	

}

/* End of file UserBadges.php */
/* Location: ./application/libraries/UserBadges.php */
