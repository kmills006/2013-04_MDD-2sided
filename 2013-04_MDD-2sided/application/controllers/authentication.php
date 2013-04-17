<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends CI_Controller {

	function __construct(){
		parent:: __construct();

		$this->load->model('decksModel');
	}

	public function index(){
		$data['view'] = 'authenticationView';

		$this->load->view('includes/landingTemplate', $data);
	}

} // end of authentication