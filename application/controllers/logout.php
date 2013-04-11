<?php


	class Logout extends CI_Controller{
		function __construct(){
			parent:: __construct();
		}


		public function index(){

			$sess_logout = array("is_logged_in" => 0);
			
			$this->session->unset_userdata("is_logged_in");
			$this->session->set_userdata($sess_logout);

			redirect("browse");
		}



	}

?>