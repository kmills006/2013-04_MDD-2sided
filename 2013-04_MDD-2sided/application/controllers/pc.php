<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pc extends CI_Controller {

	function __construct(){
		parent:: __construct();

	}

	public function index(){

	}

	public function loadHeader(){

		// Checking if there is a valid user session and load appropriate header
		if($this->session->userdata("isLoggedIn") == 1){

			// User is logged in, load loggedInHeader/Footer
			$this->load->view('includes/loggedInHeader');

		}else{
			
			// User is not logged in, load landingHeader/Footer
			$this->load->view('includes/landingHeader');
		}

	}
} // end of friends class