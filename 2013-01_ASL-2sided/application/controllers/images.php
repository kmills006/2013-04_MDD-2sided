<?php
class Images extends Controller {
	
	function index() {
		
		$this->load->model('Image_model');
		
		if ($this->input->post('upload')) {
			$this->Image_model->do_upload();
		}
		
		$data['images'] = $this->Image_model->get_images();
		
		$this->load->view('gallery', $data);
		
	}
	
}