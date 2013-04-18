<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friends extends CI_Controller {

	function __construct(){
		parent:: __construct();

		$this->load->model('userModel');
	}

	public function index(){

	}

	// addNewFriend
	public function addNewFriend($userID, $friendID){
		echo "Add New Friend";

		echo "</br>";
		echo "userID: ".$userID;

		echo "</br>";
		echo "</br>";
		echo "friendID: ".$friendID;
	}

} // end of friends class