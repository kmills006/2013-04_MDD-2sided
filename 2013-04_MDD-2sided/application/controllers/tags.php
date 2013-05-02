<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('tagsModel');
		$this->load->model('userModel');
		
	}

	// viewTags
	// Retrieve a list of all decks with that tag from a specific user
	public function viewTags($userID, $tagName){
		$data['userID'] = $userID;
		$data['tagName'] = $tagName;

		$data['tags'] = $this->tagsModel->viewTags($data);
		$data['profileInfo'] = $this->userModel->getProfile($userID);
		$data['view'] = 'userSpecficTags';

		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';

		// Checking whether user is logged in or not to determine which header to use
		switch($this->session->userdata('isLoggedIn')){
			case 0:
				$this->load->view('includes/landingTemplate', $data);
			break;

			case 1:
				$this->load->view('includes/loggedInTemplate', $data);
			break;

			default:

			break;

		}
	}

	// getTags
	// Retrieve a list of all the decks with that tag from top tags
	public function getDecks($tagName){
		$data['tags'] = $this->tagsModel->getTopDecks($tagName);
		$data['view'] = 'topTagList';

		// Checking whether user is logged in or not to determine which header to use
		switch($this->session->userdata('isLoggedIn')){
			case 0:
				$this->load->view('includes/landingTemplate', $data);
			break;

			case 1:
				$this->load->view('includes/loggedInTemplate', $data);
			break;

			default:

			break;

		}
	}

}

/* End of file tags.php */
/* Location: ./application/controllers/tags.php */