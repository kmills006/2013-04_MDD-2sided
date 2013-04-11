<?php
	class Gallery extends CI_Controller{
		function __construct(){
			parent:: __construct();

			$this->load->model("cards_model");
		}
	
	public function index() {
		
		$this->load->model('image_model');
		
		if ($this->input->post('upload')) {
			$this->Image_model->do_upload();
		}
		
		$data['images'] = $this->Image_model->get_images();
		
		$this->load->view('gallery', $data);
		
	}
	
}
