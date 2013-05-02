<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	function __construct(){
		parent:: __construct();

		$this->load->model('userModel');

	}

	public function index(){
		// Checking if there is a valid user session and load appropriate header
		if($this->session->userdata("isLoggedIn") == 1){

			$data['isLoggedIn'] = 1;
			$data['view'] = "about";

			// User is logged in, load loggedInHeader/Footer
			$this->load->view('includes/loggedInTemplate', $data);

		}else{
			
			$data['isLoggedIn'] = 0;
			$data['view'] = "about";

			// User is not logged in, load landingHeader/Footer
			$this->load->view('includes/landingTemplate', $data);
		}
	}

	public function contact(){
		$data['view'] = 'contactInfo';

		// Checking if there is a valid user session and load appropriate header
		if($this->session->userdata("isLoggedIn") == 1){

			$data['isLoggedIn'] = 1;

			// User is logged in, load loggedInHeader/Footer
			$this->load->view('includes/loggedInTemplate', $data);

		}else{
			
			$data['isLoggedIn'] = 0;

			// User is not logged in, load landingHeader/Footer
			$this->load->view('includes/landingTemplate', $data);
		}
	}
}