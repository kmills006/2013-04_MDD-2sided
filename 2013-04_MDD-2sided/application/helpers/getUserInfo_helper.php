<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('getUserInfo')){
   
	function getUserInfo($userID) {
   		$CI =& get_instance();

   		$CI->load->helper('objectToArray');
   		$CI->load->database();

   		$CI->db->select('u.user_id, u.username, u.profile_img');
   		$CI->db->from('users as u');
   		$CI->db->where('u.user_id', $userID);
   		$query = $CI->db->get();

   		if($query->num_rows() > 0){
   			$user = $query->result();
   		}

   		$user = objectToArray($user);

   		return $user;		
   		
	}
}