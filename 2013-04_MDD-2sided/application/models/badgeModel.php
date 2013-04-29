<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BadgeModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('objectToArray.php');
	}


	function getBadges($userID){
		$this->db->select();
		$this->db->join('badges as b', 'ub.badge_id = b.badge_id');
		$this->db->where('ub.user_id', $userID);
		$query = $this->db->get('user_badges as ub');

		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$dataResults[] = $row;
			}

			$dataResults = objectToArray($dataResults);

			return $dataResults;
		}else{
			// User has not received any badges yet
			
			return false;
		}
	}

}

/* End of file badgeModel.php */
/* Location: ./application/models/badgeModel.php */