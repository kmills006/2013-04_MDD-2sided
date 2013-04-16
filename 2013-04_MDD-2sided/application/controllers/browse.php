<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Browse extends CI_Controller {

	public function index()
	{
		$data['view'] = 'browse';

		$this->load->view('includes/landingTemplate', $data);
	}
}