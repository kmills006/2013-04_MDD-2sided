<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('userModel');
	}

	function do_upload(){
		$userID = $this->session->userdata("userID");
		
		$config['upload_path'] = './imgs/profile_imgs/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_width']  = '0';
		$config['max_width']  = '1024';
		$config['max_height']  = '1000';
		$config["file_name"]  = $userID;
		$config["overwrite"] = true;
		
		$this->load->library('upload');

		$this->upload->initialize($config);
		
		if (!$this->upload->do_upload()){
			$error = array('error' => $this->upload->display_errors());

			// echo $error["error"];

		}else{
			$data = array('upload_data' => $this->upload->data());

			$result = $this->userModel->uploadImage($data['upload_data']);			
			
			/* if(!$result){
				// echo "Error going into the DB";	
			}else{
				redirect('user/profilePage');
			} */

			redirect('user/profilePage');
			
			// Creating thumbnail
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
			$config2['new_image'] = './uploads/thumbs/';
			$config2['maintain_ratio'] = FALSE;
			$config2['create_thumb'] = TRUE;
			$config2['thumb_marker'] = '_thumb';
			$config2['width'] = 50;
			$config2['height'] = 50;
			$this->load->library('image_lib',$config2); 
			$this->image_lib->resize();
			
			if (!$this->image_lib->resize()){
				//echo $this->image_lib->display_errors();
			}
		}
	}

}

/* End of file upload.php */
/* Location: ./application/controllers/upload.php */